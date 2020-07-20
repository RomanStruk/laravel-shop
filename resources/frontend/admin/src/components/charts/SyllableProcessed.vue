<script>
    import {HorizontalBar} from 'vue-chartjs'

    export default {
        extends: HorizontalBar,

        mounted() {
            this.renderChart({
                    labels: [''],

                    datasets: [
                        {
                            label: 'Доступно для замовлення',
                            data: [850],
                            backgroundColor: "#17a2b8",
                            hoverBackgroundColor: "#17a2b8"
                        }, {
                            label: 'Обробляється',
                            data: [49],
                            backgroundColor: "#ffc107",
                            hoverBackgroundColor: "#ffc107"
                        }
                    ]
                },
                {
                    maintainAspectRatio:false,
                    tooltips: {
                        enabled: false
                    },
                    hover: {
                        animationDuration: 0
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true,
                                fontFamily: "'Open Sans Bold', sans-serif",
                                fontSize: 11
                            },
                            scaleLabel: {
                                display: false
                            },
                            gridLines: {
                                display: false,
                            },
                            stacked: true,
                            display: false

                        }],
                        yAxes: [{
                            ticks: {
                                fontFamily: "'Open Sans Bold', sans-serif",
                                fontSize: 11
                            },
                            gridLines: {
                                display: false,
                                color: "#fff",
                                zeroLineColor: "#fff",
                                zeroLineWidth: 0
                            },
                            stacked: true,
                            display: false

                        }]
                    },
                    legend: {
                        display: false
                    },
                    pointLabelFontFamily: "Quadon Extra Bold",
                    scaleFontFamily: "Quadon Extra Bold",
                }
            )
        }
    }
</script>
