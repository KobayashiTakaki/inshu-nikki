<template>
  <div class="show_total card">
    <div class="card-header">
      <h5>今月の飲酒量</h5>
    </div>
    <div class="card-body">
      <div class="inshu-total-table">
        <div class="inshu-total-row" v-for="inshu in inshu_sum">
          <div class="inshu-total-row-kind">{{inshu.kind}}</div>
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
  mounted () {
  axios
    .get("api/inshu")
    .then(response => (this.inshu_sum = response.data))
  }
}
</script>
