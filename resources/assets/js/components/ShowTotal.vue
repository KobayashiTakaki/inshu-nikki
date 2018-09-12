<template>
  <div class="show_total mt-2">
    <div class="nav my-2">
      <li><a class="nav-link" href="" v-on:click.prevent="changeDispType('monthly')">今月の飲酒量</a></li>
      <li><a class="nav-link" href="" v-on:click.prevent="changeDispType('all')">一覧</a></li>
    </div>
    <div class="mt-2">
      <table class="table table-sm" v-if="dispType === 'monthly'">
        <tr>
          <th scope="col">種類</th>
          <th scope="col">量</th>
        </tr>
        <tr v-for="inshuTotal in inshuTotals">
          <td>{{ inshuTotal.kind }}</td>
          <td>{{ inshuTotal.totalAmount }} ml</td>
        </tr>
      </table>
      <div class="mt-2">
        <table class="table table-sm" v-if="dispType === 'all'">
          <tr>
            <th scope="col">日付</th>
            <th scope="col">種類</th>
            <th scope="col">飲み方</th>
            <th scope="col">量</th>
            <th scope="col">杯</th>
          </tr>
          <tr v-for="inshu in inshus">
            <td>{{ inshu.date }}</td>
            <td>{{ inshu.kind }}</td>
            <td>{{ inshu.how }}</td>
            <td>{{ inshu.amount }}ml</td>
            <td>{{ inshu.count }}</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- {{ $data.inshus }}
    {{ $data.inshuTotals }} -->
  </div>
</template>
<script>
export default {
  data () {
    return {
      inshus: null,
      inshuTotals: [],
      dateFrom: '',
      dateTo: '',
      dispType: 'monthly',
      someData: null
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
    },
    changeDispType: function(type) {
      if(this.dispType === type) {
        return;
      }
      switch(type) {
        case 'monthly':
          this.showMonthlyInshus();
          break;
        case 'all':
          this.getAllInshus();
          break;
        default:
      }
      this.dispType = type;
    },
    showMonthlyInshus: function(){
      this.getMonthlyInshus();
      this.calcInshuTotal();
    },
    getMonthlyInshus: function() {
      let dt = new Date();
      let yyyy = dt.getFullYear();
      let mm = ('00' + (dt.getMonth()+1)).slice(-2);
      let ddFrom = '01';
      let ddTo = ('00' + new Date(yyyy,parseInt(mm)+1,0).getDate()).slice(-2);
      this.dateFrom = yyyy + '/' + mm + '/' + ddFrom;
      this.dateTo = yyyy + '/' + mm + '/' + ddTo;
      console.log(this.dateFrom);
      console.log(this.dateTo);
      axios
        .get("api/inshu", {
          params: {
            dateFrom: this.dateFrom,
            dateTo: this.dateTo
          }
        })
        // .then(function (response){
        //   inshusLocal = response.data;
        // })
        .then(response => {
          this.inshus = response.data;
          this.calcInshuTotal();
        });
    },
    getAllInshus: function() {
      axios
        .get("api/inshu", {
          params: {
            dateFrom: '1900/01/01',
            dateTo: '9999/12/31'
          }
        })
        .then(response => {this.inshus = response.data});
    },
    calcInshuTotal: function() {
      let inshus = this.inshus;
      this.inshuTotals = [];
      let monthlyInshus = inshus;
      let kinds = _.uniq(_.map(monthlyInshus, 'kind'));
      for(let kind of kinds) {
        let inshusSingle = _.filter(monthlyInshus, ['kind', kind]);
        //console.log(inshusSingle);
        _.forEach(inshusSingle, function(o) {
          // console.log(o.amount);
          // console.log(o.count);
          o.amountTotal = o.amount * o.count;
          //console.log(o.amountTotal);
        });
        this.inshuTotals.push({'kind': kind, 'totalAmount': _.sumBy(inshusSingle, 'amountTotal')});
      }
      this.inshuTotals = _.sortBy(this.inshuTotals, ['totalAmount']).reverse();
    }
  },
  mounted() {
    console.log('mounted');
    this.showMonthlyInshus();
    console.log(this.inshus);
  }
}
</script>
