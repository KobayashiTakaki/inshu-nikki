<template>
  <div>
    <input type="text" class="calendar" name="date" id="date" placeholder="日付" v-model="date">
    <select name="kind" v-model="selectedKind" v-on:change="fetchHow">
      <option v-for="kind in kinds" v-bind:value="kind.id">
        {{kind.name}}
      </option>
    </select>
    を
    <select name="how" v-model="selectedHow">
      <option v-for="how in hows" v-bind:value="how.id">
        {{how.name}}
      </option>
    </select>
    で
    <input type="number" name="count" id="count" value="1" v-model="count">杯
    <br>
    <button type="submit" v-bind:disabled="isDisabled">送信</button>
    <span v-for="error in errors">
      {{error}}
    </span>

  </div>
</template>
<script>
  export default {
    data() {
      return {
        date: '',
        selectedKind: 'beer',
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
      }
    },
    computed: {
      isDisabled: function () {
        this.errors = [];
        if(this.date=='') {
          this.errors.push("日付を入力してください");
        } else if (!this.date.match(/[0-9]{4}\/[0-9]{2}\/[0-9]{2}/)){
          this.errors.push("日付をYYYY/MM/DD形式で入力してください");
        }
        if(this.kind=='') {
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
      this.fetchHow()
    }
  }
</script>
