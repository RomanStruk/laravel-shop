<script>
    import {HorizontalBar} from 'vue-chartjs'

    export default {
        extends: HorizontalBar,

        mounted() {
            this.renderChart({
                    labels: [''],

                    datasets: [
                        {
                            label: 'В наявсності',
                            data: [900],
                            backgroundColor: "#28a745",
                            hoverBackgroundColor: "#28a745"
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
