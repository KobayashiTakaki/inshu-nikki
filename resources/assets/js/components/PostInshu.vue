<template>
  <div class="card">
    <div class="card-header">
      <h5>飲酒登録</h5>
    </div>
    <div class="card-body">
      <div class="form-group">
        <input type="text" class="calendar" name="date" id="date" placeholder="日付" v-model="date">
        <small class="text-muted" v-if="dateMsg">{{dateMsg}}</small>
      </div>
      <div class="form-group">
        <select name="kind" v-model="selectedKind" v-on:change="fetchHow">
          <option value='' disabled selected style='display:none;'>種類</option>
          <option v-for="kind in kinds" v-bind:value="kind.id">
            {{kind.name}}
          </option>
        </select>
        <small>を</small>
      </div>
      <div class ="form-group">
        <select name="how" v-model="selectedHow">
          <option value='' disabled selected style='display:none;'>飲み方</option>
          <option v-for="how in hows" v-bind:value="how.id">
            {{how.name}}
          </option>
        </select>
        <small>で</small>
      </div>
      <div class ="form-group">
        <input class="col-3" type="number" name="count" id="count" value="1" v-model="count" v-on:change="checkCount">
        <small>杯</small>
      </div>
      <button type="submit" v-bind:disabled="isDisabled">送信</button>
      <span class="error" v-for="error in errors">
        {{error}}
      </span>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        date: '',
        dateMsg: null,
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
        errors: []
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
      },
      setDateString: function() {
        var myDate = new Date();
        var yyyy = myDate.getFullYear();
        var mm = ('00' + (myDate.getMonth()+1)).slice(-2);
        var dd = ('00' + myDate.getDate()).slice(-2);
        this.date =  yyyy + '/' + mm + '/' + dd;
      },
      checkCount: function () {
        if (this.count > 10) {
          this.isDisabled = true;

        }
      }
    },
    computed: {
      isDisabled: function () {
        this.errors = [];
        if(this.date=='') {
          this.dateMsg = '日付を入力してください';
        } else if (!this.date.match(/[0-9]{4}\/[0-9]{2}\/[0-9]{2}/)){
          this.errors.push("日付をYYYY/MM/DD形式で入力してください");
        }
        if(this.selectedKind=='') {
          this.errors.push("種類を入力してください");
        }
        if(this.selectedHow=='') {
          this.errors.push("飲み方を選択してください");
        }
        if(this.count=='') {
          this.errors.push("数を入力してください");
        }
        if(!this.errors.length){
          return false;
        } else {
          return true;
        }
      }
    },
    mounted() {
      this.fetchHow(),
      this.setDateString()
    }
  }
</script>
