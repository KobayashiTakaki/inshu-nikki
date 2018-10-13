<template>
  <div class="show_total">
    <div class="nav my-2">
      <li><a class="nav-link" href="" v-on:click.prevent="changeDispType('monthly')">今月の飲酒量</a></li>
      <li><a class="nav-link" href="" v-on:click.prevent="changeDispType('all')">一覧</a></li>
    </div>
    <div class="mt-2" v-cloak>
      <table class="table table-sm" v-if="dispType === 'monthly'">
        <tr>
          <th scope="col">種類</th>
          <th scope="col">量</th>
        </tr>
        <tr v-for="inshuTotal in inshuTotals" v-if="inshuTotals.length !== 0">
          <td>{{ convKindDisp(inshuTotal.kind) }}</td>
          <td>{{ inshuTotal.totalAmount }} ml</td>
        </tr>
      </table>
      <div class="mt-2">
        <table class="table table-sm" v-if="dispType === 'all'">
          <tr>
            <th scope="col">日付</th>
            <th scope="col">種類</th>
            <th scope="col">飲み方</th>
            <th scope="col">杯</th>
            <th scope="col">量</th>
          </tr>
          <tr v-for="inshu in inshus" v-if="inshu.length !== 0">
            <td>{{ inshu.date }}</td>
            <td>{{ convKindDisp(inshu.kind) }}</td>
            <td>{{ convHowDisp(inshu.how) }}</td>
            <td>{{ inshu.count }}</td>
            <td>{{ inshu.amount }}ml</td>
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
      drinks: [],
      inshus: null,
      inshuTotals: [],
      dispType: 'monthly',
    }
  },
  methods: {
    //Drinkを取得する
    getDrinks: function() {
      axios
        .get("api/drink/index")
        .then(response => {
          this.drinks = response.data;
        });
    },
    //種類を表示用に変換する
    convKindDisp: function(kind) {
      const drink = _.head(_.filter(this.drinks, {'kind': kind}))
      if(drink !== null) {
        return drink.kindDisp;
      } else {
        return ''
      }

    },
    //飲み方を表示用に変換する
    convHowDisp: function(how) {
      const drink = _.head(_.filter(this.drinks, {'how': how}))
      return drink.howDisp;
    },
    //表示する内容を切り替える
    changeDispType: function(type) {
      if(this.dispType === type) {
        return;
      }
      switch(type) {
        case 'monthly': //今月の飲酒量を表示する
          this.showMonthlyInshus();
          break;
        case 'all': //一覧を表示する
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
    //今月の飲酒レコードを取得する
    getMonthlyInshus: function() {
      const dt = new Date();
      const yyyy = dt.getFullYear();
      const mm = ('00' + (dt.getMonth()+1)).slice(-2);
      const ddFrom = '01';
      const ddTo = ('00' + new Date(yyyy,parseInt(mm)+1,0).getDate()).slice(-2);
      this.dateFrom = yyyy + '/' + mm + '/' + ddFrom;
      this.dateTo = yyyy + '/' + mm + '/' + ddTo;
      axios
        .get("api/inshu/index", {
          params: {
            dateFrom: this.dateFrom,
            dateTo: this.dateTo
          }
        })
        .then(response => {
          this.inshus = response.data;
          this.calcInshuTotal();
        });
    },
    //全期間の飲酒レコードを取得する
    getAllInshus: function() {
      axios
        .get("api/inshu/index", {
          params: {
            dateFrom: '1900/01/01',
            dateTo: '9999/12/31'
          }
        })
        .then(response => {this.inshus = response.data});
    },
    //種類ごとに量を合計する
    calcInshuTotal: function() {
      this.inshuTotals = [];
      const monthlyInshus = this.inshus;
      const kinds = _.uniq(_.map(monthlyInshus, 'kind'));
      for(let kind of kinds) {
        const inshusSingle = _.filter(monthlyInshus, ['kind', kind]);
        _.forEach(inshusSingle, function(o) {
          o.amountTotal = o.amount * o.count;
        });
        this.inshuTotals.push({'kind': kind, 'totalAmount': _.sumBy(inshusSingle, 'amountTotal')});
      }
      this.inshuTotals = _.sortBy(this.inshuTotals, ['totalAmount']).reverse();
    }
  },
  created() {
    this.getDrinks();
    this.showMonthlyInshus();
  }
}
</script>
