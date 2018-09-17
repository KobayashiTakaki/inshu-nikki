<template>
  <div class="card">
    <div class="card-header">
      <h5>飲酒登録</h5>
    </div>
    <div class="card-body">
      <div class="form-group">
        <input type="text" class="calendar" name="date" id="date" placeholder="日付" v-model="date" v-on:change="checkDate">
        <small class="text-muted" v-for="dateMsg in dateMsgs">{{dateMsg}}</small>
      </div>
      <div class="form-group">
        <select name="kind" v-model="selectedKind" v-on:change="setHows(selectedKind)">
          <option value='' disabled selected style='display:none;'>種類</option>
          <option v-for="kind in kinds" v-bind:value="kind.kind">
            {{kind.kindDisp}}
          </option>
        </select>
        <small>を</small>
        <small class="text-muted" v-for="kindMsg in kindMsgs">{{kindMsg}}</small>
      </div>
      <div class ="form-group">
        <select name="how" v-model="selectedHow" v-on:change="checkHow">
          <option value='' disabled style='display:none;'>飲み方</option>
          <option v-for="how in hows" v-bind:value="how.how">
            {{how.howDisp}}
          </option>
        </select>
        <small>で</small>
        <small class="text-muted" v-for="howMsg in howMsgs">{{howMsg}}</small>
      </div>
      <div class ="form-group">
        <input class="col-3" type="number" min="1" name="count" id="count" value="1" v-model="count" v-on:change="checkCount">
        <small>杯</small>
        <small class="text-muted" v-for="countMsg in countMsgs">{{countMsg}}</small>
      </div>
      <button type="submit" v-bind:disabled="isDisabled">送信</button>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        date: '',
        selectedKind: '',
        selectedHow: '',
        drinks: [],
        kinds: [],
        hows: [],
        count: 1,
        countMsgs: [],
        errors: [],
        dateErr: true,
        kindErr: true,
        howErr: true,
        countErr: true,
        dateMsgs: [],
        kindMsgs: [],
        howMsgs: [],
        countMsgs: []
      }
    },
    methods: {
      getDrinks: function() {
        axios
          .get("api/drinks")
          .then(response => {
            this.drinks = response.data;
            this.setKinds();
          });
      },
      setKinds: function() {
        _.forEach(this.drinks, o => this.kinds.push(_.pick(o, ['kind','kindDisp'])));
        this.kinds = _.uniqBy(this.kinds, 'kind');
      },
      setHows: function(kind) {
        this.hows = [];
        let drinks = _.filter(this.drinks, {'kind': kind});
        _.forEach(drinks, o => this.hows.push(_.pick(o, ['how','howDisp'])));
        this.checkKind();
      },
      setDateString: function() {
        var myDate = new Date();
        var yyyy = myDate.getFullYear();
        var mm = ('00' + (myDate.getMonth()+1)).slice(-2);
        var dd = ('00' + myDate.getDate()).slice(-2);
        this.date =  yyyy + '/' + mm + '/' + dd;
      },
      checkDate: function () {
        this.dateMsgs = [];
        if (this.date == '') {
          this.dateMsgs.push('日付を入力してください');
          this.dateErr = true;
        } else {
          this.dateErr = false;
        }
      },
      checkKind: function () {
        this.kindMsgs = [];
        if (this.selectedKind == '') {
          this.kindMsgs.push('種類を入力してください');
          this.kindErr = true;
        } else {
          this.kindErr = false;
        }
      },
      checkHow: function () {
        this.howMsgs = [];
        if (this.selectedHow == '') {
          this.howMsgs.push('飲み方を入力してください');
          this.howErr = true;
        } else {
          this.howErr = false;
        }
      },
      checkCount: function () {
        this.countMsgs = [];
        if (0 > this.count || 10 < this.count) {
          this.countMsgs.push('嘘でしょ？(10以下にしてください)');
          this.countErr = true;
        } else if (this.count == '') {
          this.countMsgs.push('数を入力してください');
          this.countErr = true;
        } else {
          this.countErr = false;
        }
      }
    },
    computed: {
      isDisabled: function () {
        if (this.dateErr || this.kindErr || this.howErr || this.countErr) {
          return true;
        } else {
          return false;
        }
      }
    },
    mounted() {
      this.getDrinks();
      this.setDateString();
      this.checkDate();
      this.checkKind();
      this.checkHow();
      this.checkCount();
    }
  }
</script>
