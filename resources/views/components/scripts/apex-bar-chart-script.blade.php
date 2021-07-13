<script>

            $(document).ready(function() {

                     var options = {
        chart: {
            height: 300,
            type: 'bar',
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '25%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        colors: ['#0080ff', '#e33f45'],
        series: [{
            name: "{{$firstBarLabel}}",
            data: @json($firstBarData)
        }, {
            name: "{{$secondBarLabel}}",
                data: @json($secondBarData)
        }],
        legend: {
            show: false,
        },
        xaxis: {
            categories: @json($xaxisData),
            axisBorder: {
                show: true,
                color: 'rgba(0,0,0,0.05)'
            },
            axisTicks: {
                show: true,
                color: 'rgba(0,0,0,0.05)'
            }
        },
        grid: {
            row: {
                colors: ['transparent', 'transparent'], opacity: .2
            },
            borderColor: 'rgba(0,0,0,0.05)'
        },
        fill: {
            opacity: 1,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    // return "$ " + val + " thousands"
                    return  val
                }
            }
        }
    }
    var chart = new ApexCharts(
        document.querySelector("#"+"{{$cartDivId}}"),
        options
    );
    chart.render();

            });


</script>
