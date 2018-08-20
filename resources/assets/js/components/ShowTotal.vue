<template>
  <div class="show_total card">
    <div class="card-header">
      <h5>今月の飲酒量</h5>
    </div>
    <div class="card-body">
      <div class="inshu-total-table">
        <div class="inshu-total-row" v-for="inshu in inshu_sum">
          <div class="inshu-total-row-kind">{{convKindDisp(inshu.kind)}}</div>
          <div class="inshu-total-row-amount"><span class="amount">{{inshu.amount}}</span>ml</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      inshu_sum: "null"
    }
  },
  methods: {
    convKindDisp: function(kind) {
      switch (kind) {
        case 'beer':
          return 'ビール';
          break;
        case 'whiskey':
          return 'ウィスキー';
          break;
        case 'wine':
          return 'ワイン';
          break;
        case 'sake':
          return '日本酒';
          break;
        default:
          return '';
      }
    }
  },
  mounted () {
  axios
    .get("api/inshu")
    .then(response => (this.inshu_sum = response.data))
  }
}
</script>
