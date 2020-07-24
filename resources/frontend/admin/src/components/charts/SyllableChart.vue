<script>
    import {HorizontalBar } from 'vue-chartjs'

    export default {
        extends: HorizontalBar,
        props:['datasets'],
        watch:{
            datasets: {
                handler() {
                    this.showRenderChart()
                },
                deep: true,
            },
        },
        methods: {
            showRenderChart() {
                this.renderChart({
                        labels: ['', '', ''],

                        datasets: [
                            {
                                label: 'Поставка',
                                data: [this.datasets.imported, 0, 0],
                                backgroundColor: "#007bff",
                                hoverBackgroundColor: "#007bff"
                            }, {
                                label: 'В наявсності',
                                data: [0, this.datasets.remains, 0],
                                backgroundColor: "#28a745",
                                hoverBackgroundColor: "#28a745"
                            }, {
                                label: 'Доступно для замовлення',
                                data: [0, 0, this.datasets.countAvailableRemains],
                                backgroundColor: "#17a2b8",
                                hoverBackgroundColor: "#17a2b8"
                            }, {
                                label: 'Обробляється',
                                data: [0, 0, this.datasets.countProcessed],
                                backgroundColor: "#ffc107",
                                hoverBackgroundColor: "#ffc107"
                            }
                        ]
                    },
                    {
                        maintainAspectRatio:false, //розмір

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
                                display: true

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
                            display: true
                        },

                        pointLabelFontFamily: "Quadon Extra Bold",
                        scaleFontFamily: "Quadon Extra Bold",
                    }
                )
            },
        },
        created() {

        }
    }
</script>
