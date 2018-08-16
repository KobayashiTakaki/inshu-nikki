<template>
  <div class="show_total card" id="app2">
    <div class="card-header">
        <h5>今月の飲酒量</h5>
        <div class="dropdown float-right">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown button
          </button>
        </div>
    </div>
    <div class="card-body">
      <div class="inshu-total-table">
        <div class="inshu-total-row">
          <div class="inshu-total-row-kind">ビール</div>
          <div class="inshu-total-row-amount"><span class="amount">2000</span>ml</div>
          <div>{{inshu.data}}</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      inshu: null
    }
  },
  mounted () {
  axios
    .get("/api/inshu")
    .then(response => (this.inshu = response))
  }
}
</script>
