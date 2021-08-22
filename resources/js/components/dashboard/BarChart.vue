<template>
  <div>
    <div id="chart">
      <apexchart width="100%" type="bar" :options="options" :series="series">
      </apexchart>
    </div>
  </div>
</template>
<script>
export default {
  props: ["chart_data"],
  name: "BarChart",
  data() {
    return {
      options: {
        chart: {
          id: "apex-bar-chart",
        },
        xaxis: {
          categories: JSON.parse(this.chart_data).x_axis,
        },
      },
    };
  },
  computed: {
    series() {
      return JSON.parse(this.chart_data).series;
    },
  },
};
</script>
<style scoped>
#chart {
  max-width: 100%;
  margin: 35px auto;
}
</style>
