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
        <select name="kind" v-model="selectedKind" v-on:change="fetchHow">
          <option value='' disabled selected style='display:none;'>種類</option>
          <option v-for="kind in kinds" v-bind:value="kind.id">
            {{kind.name}}
          </option>
        </select>
        <small>を</small>
        <small class="text-muted" v-for="kindMsg in kindMsgs">{{kindMsg}}</small>
      </div>
      <div class ="form-group">
        <select name="how" v-model="selectedHow" v-on:change="checkHow">
          <option value='' disabled selected style='display:none;'>飲み方</option>
          <option v-for="how in hows" v-bind:value="how.id">
            {{how.name}}
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
        kinds: [
        {id: 'beer', name: 'ビール'},
        {id: 'whiskey', name: 'ウィスキー'},
        {id: 'wine', name: 'ワイン'},
        {id: 'sake', name: '日本酒'},
        ],
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
      fetchHow: function() {
        this.selectedHow = '';
        var tmp_hows = [];
        if (this.selectedKind == 'beer') {
          tmp_hows = [
            {id: 'glass', name: 'グラス'},
            {id: 'mug_midium', name: '中ジョッキ'},
            {id: 'mug_large', name: '大ジョッキ'},
          ]
        } else if (this.selectedKind == 'whiskey') {
          tmp_hows = [
            {id: 'soda', name: 'ハイボール'},
            {id: 'water', name: '水割り'},
          ]
        } else if (this.selectedKind == 'wine') {
          tmp_hows = [
            {id: 'glass', name: 'グラス'},
          ]
        } else if (this.selectedKind == 'sake') {
          tmp_hows = [
            {id: 'glass', name: 'グラス'},
            {id: 'ichigou', name: '一合'},
          ]
        } else {
        }
        this.hows = tmp_hows;
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
      this.fetchHow(),
      this.setDateString(),
      this.checkDate(),
      this.checkKind(),
      this.checkHow(),
      this.checkCount()
    }
  }
</script>
