import { Bar, mixins} from 'vue-chartjs'
export default {
    extends: Bar,
    mixins:[mixins.reactiveProp],
    props: ['chartData', 'options'],
    data: function(){
        return {}
    },
    mounted() {
        this.renderChart(this.chartdata, this.options)
    },
};
