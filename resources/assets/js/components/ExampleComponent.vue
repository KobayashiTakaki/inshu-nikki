<template>
  <div class="card card-default">
    <div class="card-body">
      <div class="nav">
        <li><a class="nav-link" href="" v-on:click.prevent="changeDispType('A')">A表示</a></li>
        <li><a class="nav-link" href="" v-on:click.prevent="changeDispType('B')">B表示</a></li>
      </div>
      <p>dispType: {{ this.dispType }}</p>
      <p>records: {{ this.records }}</p>
      <p>kinds: {{ this.kinds }}</p>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      records: null,
      dispType: null,
      kinds: null
    }
  },
  methods: {
    getRecordsA: function() {
      axios
        .get("api/apiTest", {
          params: {
            type: this.dispType
          }
        })
        .then(response => { this.records = response.data })
      this.kinds = _.map(this.records, 'kind')
      console.log('getRecordsA')
      console.log(this.records)
      console.log(this.kinds)
    },
    getRecordsB: function() {
      axios
      .get("api/apiTest", {
        params: {
          type: this.dispType
        }
      })
      .then(response => { this.records = response.data })
      this.kinds = _.map(this.records, 'kind')
      console.log('getRecordsB')
      console.log(this.records)
      console.log(this.kinds)
    },
    changeDispType: function(type) {
      this.dispType = type
      switch(this.dispType) {
        case 'A':
          this.getRecordsA()
          break
        case 'B':
          this.getRecordsB()
          break
        default:
      }
    }
  },
  mounted() {
    this.changeDispType('A')
  }
}
</script>
