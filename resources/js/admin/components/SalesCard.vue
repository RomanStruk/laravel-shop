<template>

    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Продажі</h3>
                <a href="javascript:void(0);">View Report</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg">{{currency_short}}{{salesOverTime}}</span>
                    <span>Продажі за весь час</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <span :class="sinceLastMonth > 0 ? 'text-success':'text-danger'">
                      <i :class="sinceLastMonth > 0 ? 'fas fa-arrow-up': 'fas fa-arrow-down'"></i> {{sinceLastMonth}}%
                    </span>
                    <span class="text-muted">З минулого місяця</span>
                </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
                <chart-js :chart-data="dataCollection" :options="options" style="height: 200px;"></chart-js>
            </div>

            <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Цей місяць
                  </span>

                <span>
                    <i class="fas fa-square text-gray"></i> Минулий місяць
                  </span>
            </div>
        </div>
    </div>
    <!-- /.card -->
</template>

<script>
    import ChartJs from './ChartJsBar.js'
    export default {
        components: {
            ChartJs
        },
        data: function(){
            return {
                is_refresh:false,
                options : null,
                dataCollection: null,
                sinceLastMonth: 0,
                salesOverTime: 0,
            }
        },
        props:['currency_short'],
        mounted() {
            var mode      = 'index';
            var intersect = true;
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            };
            var currency_short = this.currency_short; // валюта
            this.options = {
                maintainAspectRatio: false,
                tooltips : {
                    mode     : mode,
                    intersect: intersect
                },
                hover : {
                    mode     : mode,
                    intersect: intersect
                },
                legend : {
                    display: false
                },
                scales : {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display      : true,
                            lineWidth    : '4px',
                            color        : 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks    : $.extend({
                            beginAtZero: true,

                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                if (value >= 1000) {
                                    value /= 1000;
                                    value += 'k';
                                }
                                return currency_short + value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display  : true,
                        gridLines: {
                            display: false
                        },
                        ticks : ticksStyle
                    }]
                }
            }
            this.loadData();
        },
        methods: {
            loadData: async function () {
                this.is_refresh = true;                             // заглушка під чаз завантаження
                await axios.get('/api/v1/dashboard/sales').then((response) => {
                    this.dataCollection = response.data.graph;
                    this.sinceLastMonth = response.data.sinceLastMonth;
                    this.salesOverTime = response.data.salesOverTime;
                }).catch(function (error) {
                    console.log(error);                             // debug error
                });
                this.is_refresh = false;                            // кінець заглушки під чаз завантаження
            },
        },
    };
</script>

<style >

</style>
