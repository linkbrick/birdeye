Vue.component('simulate-quarter', {
    template: `<div class="card">
                    <div class="card-header card-header-text" :class="'card-header-' + headerColor">
                        <div class="card-text">
                            <h2 class="card-title">{{ title }}</h2>
                            <p class="card-category">{{ subTitle }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Sales
                                <span class="badge badge-primary badge-pill">{{ formatNumber(sales)  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Target
                                <span class="badge badge-primary badge-pill">{{ formatNumber(target) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Variance
                                <span class="badge badge-pill" :class="[ variance < 0 ?'badge-danger badge-lg':'badge-success' ]">{{ formatNumber(variance) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                &nbsp;
                                <span class="badge badge-pill" :class="[ variance < 0 ?'badge-danger badge-lg':'badge-success' ]">
                                    {{ ((sales - target)/target*100).toFixed(2) }}%
                                </span>
                            </li>
                        </ul>
                        <ul class="list-group" v-if="quarter > moment().quarter() && adjustTarget > 0">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Adjusted Target
                                <span class="badge badge-primary badge-pill">{{ formatNumber(adjustTarget) }}</span>
                            </li>
                            <!--
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Adjusted Variance
                                <span class="badge badge-pill" :class="[ adjustVariance < 0 ?'badge-danger badge-lg':'badge-success' ]">{{ formatNumber(adjustVariance) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" v-if="sales > 0">
                                &nbsp;
                                <span class="badge badge-pill" :class="[ adjustVariance < 0 ?'badge-danger badge-lg':'badge-success' ]">
                                    {{ ((sales - adjustTarget)/adjustTarget*100).toFixed(2) }}%
                                </span>
                            </li>
                            -->
                        </ul>
                    </div>
                </div>`,
    props: {
        quarter: {
            type: Number,
            default: 1,
        },
        title: {
            type: String,
            default: '',
        }, 
        subTitle: {
            type: String,
            default: '',
        }, 
        sales: {
            type: [String, Number], 
            defaut: 0,
        },
        target: {
            type: [String, Number], 
            defaut: 0,
        },
        adjustTarget: {
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
        }
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
        moment(){
            return moment()
        },
    },
    computed:{
        variance(){
            return this.sales - this.target;
        },
        adjustVariance(){
            return this.sales - this.adjustTarget;
        }
    }
})