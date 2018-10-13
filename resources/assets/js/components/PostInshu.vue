<template>
  <div class="card">
    <div class="card-body">
      <h5>飲酒登録</h5>
      <div class="form-group">
        <input class="form-control calendar" type="text" name="date" id="date" placeholder="日付" v-model="date" v-on:change="checkDate">
        <small class="text-muted" v-for="dateMsg in dateMsgs">{{dateMsg}}</small>

        <select class="form-control" name="kind" v-model="selectedKind" v-on:change="setHows(selectedKind)">
          <option value='' disabled selected style='display:none;'>種類</option>
          <option v-for="kind in kinds" v-bind:value="kind.kind">
            {{kind.kindDisp}}
          </option>
        </select>

        <select class="form-control" name="how" v-model="selectedHow" v-on:change="checkHow">
          <option value='' disabled style='display:none;'>飲み方</option>
          <option v-for="how in hows" v-bind:value="how.how">
            {{how.howDisp}}
          </option>
        </select>
        <button type="submit" v-bind:disabled="isDisabled">送信</button>
      </div>
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
        countMsgs: [],
        errors: [],
        dateErr: true,
        kindErr: true,
        howErr: true,
        dateMsgs: [],
        kindMsgs: [],
        howMsgs: [],
        countMsgs: []
      }
    },
    methods: {
      getDrinks: function() {
        axios
          .get("api/drink/index")
          .then(response => {
            this.drinks = response.data;
            if(this.drinks === null) {
              this.setKinds();
            }
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
    },
    computed: {
      isDisabled: function () {
        if (this.dateErr || this.kindErr || this.howErr) {
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
    }
  }
</script>
