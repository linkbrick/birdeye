Vue.component('simulate-monthly', {
    template: `<div class="card">
                    <div class="card-header card-header-text" :class="'card-header-' + headerColor">
                        <div class="card-text">
                            <h2 class="card-title">{{ title }}</h2>
                            <p class="card-category">{{ subTitle }}</p>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th></th>
                                <th class="text-center" v-for="i in (1, totalMonth)">{{ displayMonth(i) }}</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Sales</td>
                                <td class="text-center" v-for="sale in salesData">{{ formatNumber(sale) }}</td>
                            </tr>
                            <tr>
                                <td>Target</td>
                                <td class="text-center" v-for="i in (1, totalMonth)">{{ formatNumber(target) }}</td>
                            </tr>
                            <tr>
                                <td>Variance</td>
                                <td class="text-center" v-for="sale in salesData">
                                    <button class="btn btn-round" :class="[ (sale - target) < 0 ?'btn-danger':' btn-success btn-sm' ]">
                                        {{ formatNumber(sale - target) }}
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-center" v-for="sale in salesData">
                                    <button class="btn btn-round" :class="[ (sale - target) < 0 ?'btn-danger':' btn-success btn-sm' ]">
                                        {{ ((sale - target)/target*100).toFixed(2) }}%
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>`,
    props: {
        title: {
            type: String,
            default: '',
        }, 
        subTitle: {
            type: String,
            default: '',
        }, 
        salesData: {
            type: [Array], 
            default: function () {
                return [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0
                ]
            }
        },
        target: {
            type: [String, Number], 
            defaut: 0,
        },
        groupThousand: {
            type: Boolean,
            default: true,
        },
        headerColor: {
            type: String,
            default: 'warning',
        },
    },
    data: function () {
        return {
            
        }
    },
    methods: {
        formatNumber: function(value){
            value = this.groupThousand?value/1000:(value*1).toFixed(2); 
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (this.groupThousand?' K':'');
        },
        displayMonth: function(v){
            v -= 1;
            return moment().set('month', v).format('MMM');
        },
    },
    computed:{
        totalMonth(){
            return this.salesData.length;
        }
    },
})