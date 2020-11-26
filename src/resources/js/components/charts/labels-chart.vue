<template>
  <div class="container">
    <bar-chart
    v-if="loaded"
    :chartdata="chartdata"
    :options="options"/>
<!--
    <h1>data</h1>
    <pre>{{ chartdata }}</pre>
    <h1>options</h1>
    <pre>{{ options }}</pre> -->
  </div>
</template>

<script>
import BarChart from './render-bar-chart.vue'

export default {
  name: 'BarChartContainer',
  components: { BarChart },
  props: ['page_url'],
  created() {
    this.fetchData(this.page_url);
  },
  data: () => ({
    loaded: false,
    chartdata: {},
    options: {},
  }),
  methods: {
    fetchData(page_url){
      axios.get(page_url)
      .then((response) =>{
        if(response.status == 200){
          this.chartdata = response.data.data.data;
          this.options = response.data.data.options;
          this.loaded = true;

        }
      }).catch(err=>{
        console.log(err)
      });
    },
  },
}
</script>
