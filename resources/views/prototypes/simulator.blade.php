@extends('layouts.tenant')
@push('styles')
@endpush
@section('content')
<div  class="content" id="simulator">
    <div class="container-fluid">
        <div class="jumbotron" style="background-color:white">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <h2 class="text-center">Sales Target Insight</h2>
                    <h5 class="description">Adjust the bar to visualize the sales summary</h5>
                </div>
            </div>
            <!-- div class="row justify-content-md-center">
                <div class="col col-lg-5">
                    <select class="selectpicker" v-model="company" 
                            data-style="select-with-transition"
                            title="Please select a filter" data-size="7" >
                        <option value="all" style="color:black" >All</option>
                        <option value="liwida" style="color:black" >Liwida</option>
                        <option value="lwd" style="color:black" >LWD</option>
                    </select>
                </div>
                <div class="col col-lg-1">
                    <a href="#" class="btn btn-primary btn-link" @click="company = ''">Clear</a>
                </div>
            </div -->
            <div class="row justify-content-md-center">
                <div class="col col-lg-6">
                    <slider :slider-value.sync="salesTarget" :slider-min="slider.min" :slider-max="slider.max" :slider-step="slider.step" @updatevalue="updatevalue" @end="recalculate" ref="mySlider"></slider>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    <h3>YTD Sales : </h3>
                </div>
                <div class="col col-lg-2">
                    <h3>@{{ formatNumber(totalSales) }}</h3>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    <h3>Yearly Target : </h3>
                </div>
                <div class="col col-lg-2">
                    <h3><input v-model="formatSalesTarget" @change="refreshSlider"> </h3>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    <h3>Variance : </h3>
                </div>
                <div class="col col-lg-2">
                    <h3>
                        <button class="btn btn-round" :class="[ (totalSales - salesTarget) < 0 ?'btn-danger':' btn-success btn-sm' ]">
                            @{{ formatNumber((totalSales - salesTarget).toFixed(2)) }}
                        </button>
                    </h3>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    <h3>&nbsp;</h3>
                </div>
                <div class="col col-lg-2">
                    <h3>
                        <button class="btn btn-round" :class="[ (totalSales - salesTarget) < 0 ?'btn-danger':' btn-success btn-sm' ]">
                            @{{ ((totalSales - salesTarget)/salesTarget*100).toFixed(2) }}%
                        </button>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6" v-for="i in (1,4)">
                <simulate-quarter 
                    :quarter="i"
                    :title="'Q' + i"
                    sub-title=''
                    :sales=getQuarterSales(i)
                    :target="quarterTarget"
                    :adjust-target="adjustedTarget"
                    :group-thousand="groupThousand"></simulate-quarter>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <simulate-monthly 
                    header-color='info'
                    title="Monthly Summary"
                    sub-title=''
                    :sales-data=monthlySales
                    :target="monthlyTarget"
                    :group-thousand="groupThousand"></simulate-quarter>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!--    Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('js/nouislider.min.js') }}"></script>
<script src="{{ asset('js/components/slider.js') }}"></script>
<script src="{{ asset('js/components/simulate-quarter.js') }}"></script>
<script src="{{ asset('js/components/simulate-monthly.js') }}"></script>
<script>
    
    //var moment = require('moment');

    new Vue({
        el: '#simulator',
        data:{
            company: '',
            groupThousand: false,
            salesTarget: 1000000,
            slider: {
                min: 1000000,
                max: 100000000,
                step: 50000
            },
            monthlySales_test: [
                11111,
                22222,
                33333,
                44444,
                54444,
                65555,
                77777,
            ],
            salesData: @json(config("sampledata.sales.2018"))
        },
        methods: {
            updatevalue: function(value){
                this.salesTarget = value;
            },
            refreshSlider: function(){
                this.$refs.mySlider.refreshSlider();
            },
            recalculate: function(value){
                console.log(value);
            },
            formatNumber: function(value){
                value = this.groupThousand?value/1000:value;
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (this.groupThousand?' K':'');
            },
            moment(){
                return moment()
            },
            getQuarterSales: function(value){
                sales = this.monthlySales[(value*3)-3] + this.monthlySales[(value*3)-2] + this.monthlySales[(value*3)-1];
                return (sales >= 0)?sales:0;
            },
            adjustedTarget2(q){
                if(q < moment().quarter()){
                    return 0;
                }else if(q == moment().quarter()){
                    return (this.salesTarget - this.totalSales)/(5-q);
                }else{
                    return (this.salesTarget - this.totalSales)/(4 - moment().quarter() + 1);
                }
            },
        },
        computed:{
            formatSalesTarget: {
                // getter
                get: function () {
                    return this.formatNumber(this.salesTarget);
                },
                // setter
                set: function (newValue) {
                    this.salesTarget = newValue.replace(/[, Kk]/g,'') * (this.groupThousand?1000:1);
                    //this.salesTarget = newValue * (this.groupThousand?1000:1);
                    
                }
            },
            quarterTarget(){
                return this.salesTarget/4;
            },
            adjustedTarget(){
                return (this.salesTarget - this.totalSales)/(4 - moment().quarter());
            },
            monthlyTarget(){
                return this.salesTarget/12;
            },
            totalSales(){
                let yearlySales = 0;
                this.monthlySales.forEach(function(value)  {
                    yearlySales += value;
                });
                return yearlySales;
            },
            monthlySales(){
                return Object.values(this.salesData);
            }
        },
        /*
        filters: {
            formatNumber: {
                read: function (value) {
                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },
                write: function (value) {
                    var number = +value.replace(/[^\d.]/g, '');
                    return isNaN(number) ? 0 : number;
                }
            }
        }
        */
    });
</script>
@endpush