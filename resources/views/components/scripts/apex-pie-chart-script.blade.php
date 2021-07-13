<script>

    $(document).ready(function() {

        /* -- Apex Pie Chart -- */
        var options = {
            chart: {
                type: 'donut',
                width: 370,
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "60%",
                        labels: {
                            show: true,
                        }
                    },

                }
            },
            dataLabels: {
                enabled: false,
            },
            colors: ['#0080ff','#18d26b','#f7b400','#b751c3'],
            series: @json($series),
            labels: @json($labels),
            legend: {
                show: true,
                position: 'right'
            },
            responsive: [{
                breakpoint: 650,
                options: {
                     chart: {
                type: 'donut',
                width: 300,
            },
                    legend: {
                show: true,
                position: 'bottom'
            },
                },
            }]

        }
        var chart = new ApexCharts(
            document.querySelector("#"+"{{$cartDivId}}"),
            options
        );
        chart.render();
    });


</script>
