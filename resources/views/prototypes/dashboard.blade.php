@extends('layouts.tenant')
@push('styles')
    <style>
        #sales_comparison {
            width	: 100%;
            height	: 400px;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid" >

        <div class="jumbotron" style="background-color:white">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto text-center">
                <h2 class="text-center">Dashboard</h2>
                <h5 class="description">This chart consists LIWIDA and LWD.</h5>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <select class="selectpicker"  name="action" id="actions"
                        data-style="select-with-transition"
                        title="Please select a filter" data-size="7"  data-live-search="true" >
                    <option value="all" style="color:black" >All</option>
                    <option value="all" style="color:black" >Liwida</option>
                    <option value="all" style="color:black" >LWD</option>


                </select>
            </div>
            <div class="col col-lg-1">
                <a href="#" class="btn btn-primary btn-link">Filter</a>
            </div>
            <div class="col col-lg-1">
                <a href="#" class="btn btn-primary btn-link">Clear</a>
            </div>
        </div>
        </div>
        {{--Begin:Sales + Purchases--}}
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card card-chart">
                    <div class="card-header card-header-primary" data-header-animation="true">
                        <div class="ct-chart" id="dailySalesChart"></div>
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <button type="button" class="btn btn-info btn-link fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>
                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Daily Sales
                                <span class="badge badge-primary badge-pill">{{ formatCurrency( $sales["daily"] )  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Weekly Sales
                                <span class="badge badge-primary badge-pill">{{ formatCurrency( $sales["weekly"] )   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Sales
                                <span class="badge badge-primary badge-pill">{{ formatCurrency( $sales["monthly"] )   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Yearly Sales
                                <span class="badge badge-primary badge-pill">{{ formatCurrency( $sales["yearly"] )   }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 2 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card card-chart">
                    <div class="card-header card-header-success" data-header-animation="true">
                        <div class="ct-chart" id="dailyPurchaseChart"></div>
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>
                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Daily Purchases
                                <span class="badge badge-success badge-pill">{{ formatCurrency( $purchases['daily'] )  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Weekly Purchases
                                <span class="badge badge-success badge-pill">{{ formatCurrency( $purchases['weekly'] )   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Purchases
                                <span class="badge badge-success badge-pill">{{ formatCurrency( $purchases['monthly'] )   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Yearly Purchases
                                <span class="badge badge-success badge-pill">{{ formatCurrency( $purchases['yearly'] )   }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--End:Sales + Purchases--}}

        {{--Begin:Yearly Sales comparison chart--}}
        <div class="row">
            <div class="col-12">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">weekend</i>
                        </div>
                       <div class="card-body">
                           <div id="sales_comparison"></div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        {{--End:Yearly Sales comparison chart--}}

        {{--Begin:Yearly Sales Analytics--}}
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">weekend</i>
                        </div>
                        <p class="card-category">2018 June</p>
                        <h3 class="card-title">{{ formatCurrency( $sales["monthly"] )   }}</h3>
                        <p class="card-category">2018 May</p>
                        <h3 class="card-title">{{ formatCurrency( $sales["last-month"] )   }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">warning</i>
                            <a href="#pablo">Increase / Decrease...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">equalizer</i>
                        </div>
                        <p class="card-category">2018 June</p>
                        <h3 class="card-title">{{ formatCurrency( $sales["monthly"] )   }}</h3>
                        <p class="card-category">2017 June</p>
                        <h3 class="card-title">{{ formatCurrency( $sales["last-year-month"] )   }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">local_offer</i> Tracked from Google Analytics
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
                        </div>
                        <p class="card-category">2018 YTD</p>
                        <h3 class="card-title">{{ formatCurrency( $sales["yearly"] )   }}</h3>
                        <p class="card-category">2017 YTD</p>
                        <h3 class="card-title">{{ formatCurrency( $sales["last-year-todate"] )   }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i> Last 24 Hours
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{--End:Yearly Sales Analytics--}}

        {{--Begin:Sales + Purchases--}}
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card card-chart">
                    <div class="card-header card-header-primary" data-header-animation="true">
                        <div class="ct-chart" id="dailyCashInChart"></div>
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <!-- <button type="button" class="btn btn-info btn-link fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button> -->
                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Daily Payment Received
                                <span class="badge badge-primary badge-pill">{{ formatCurrency( $cashin["daily"] )  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Weekly Payment Received
                                <span class="badge badge-primary badge-pill">{{ formatCurrency( $cashin["weekly"] )   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Payment Received
                                <span class="badge badge-primary badge-pill">{{ formatCurrency( $cashin["monthly"] )   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Yearly Payment Received
                                <span class="badge badge-primary badge-pill">{{ formatCurrency( $cashin["yearly"] )   }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 2 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card card-chart">
                    <div class="card-header card-header-success" data-header-animation="true">
                        <div class="ct-chart" id="dailyCashOutChart"></div>
                    </div>
                    <div class="card-body">
                        <div class="card-actions">
                            <!-- <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button> -->
                            <button type="button" class="btn btn-info btn-link" rel="tooltip" data-placement="bottom" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="Change Date">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Daily Amount Disbursed
                                <span class="badge badge-success badge-pill">{{ formatCurrency( $cashout["daily"] )  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Weekly Amount Disbursed
                                <span class="badge badge-success badge-pill">{{ formatCurrency( $cashout["weekly"] )   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Amount Disbursed
                                <span class="badge badge-success badge-pill">{{ formatCurrency( $cashout["monthly"] )   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Yearly Amount Disbursed
                                <span class="badge badge-success badge-pill">{{ formatCurrency( $cashout["yearly"] )   }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--End:Sales + Purchases--}}
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/chartist.min.js') }}"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <script type="text/javascript">

    var weeklySales = [];
    var weeklyPurchases = [];
    var weeklyCashIn = [];
    var weeklyCashOut = [];

    @foreach($sales["week"] as $day=>$amt)
    weeklySales.push("{{ $amt/1000 }}");
    @endforeach

    @foreach($purchases["week"] as $day=>$amt)
    weeklyPurchases.push("{{ $amt/1000 }}");
    @endforeach

    @foreach($cashin["week"] as $day=>$amt)
    weeklyCashIn.push("{{ $amt/1000 }}");
    @endforeach

    @foreach($cashout["week"] as $day=>$amt)
    weeklyCashOut.push("{{ $amt/1000 }}");
    @endforeach

    $(document).ready(function() {
        //console.log(Setting.initDashboardPageCharts());
        //Setting.initMaterialWizard();

        // Javascript method's body can be found in assets/js/demos.js
        Setting.initDashboardPageCharts();

        Setting.initCharts();

        var chart = AmCharts.makeChart("sales_comparison", {
            "type": "serial",
            "theme": "light",
            "legend": {
                "useGraphSettings": true
            },
            "dataProvider": [
                @foreach($sales["last-year-monthly-sales"] as $mth=>$amt)
                {
                    "month": "{{ date('M', strtotime('2018-'.$mth.'-1')) }}",
                    "2017": "{{ formatCurrency($amt/10000) }}",
                    "2018": "{{ isset($sales['this-year-monthly-sales'][$mth])? formatCurrency($sales['this-year-monthly-sales'][$mth]/10000) : 0 }}"
                },
                @endforeach
            ],
            "valueAxes": [{
                "integersOnly": true,
                "maximum": 200,
                "minimum": 1,
                "reversed": false,
                "axisAlpha": 0,
                "dashLength": 5,
                "gridCount": 10,
                "position": "left",
                "title": "10,000"
            }],
            "startDuration": 0.5,
            "graphs": [{
                "balloonText": "2018 [[category]]: [[value]]",
                "bullet": "round",
                "title": "2018",
                "valueField": "2018",
                "fillAlphas": 0
            }, {
                "balloonText": "2017 [[category]]: [[value]]",
                "bullet": "round",
                "title": "2017",
                "valueField": "2017",
                "fillAlphas": 0
            }],
            "chartCursor": {
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "month",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "fillAlpha": 0.05,
                "fillColor": "#000000",
                "gridAlpha": 0,
                "position": "top"
            },
            "export": {
                "enabled": true,
                "position": "bottom-right"
            }
        });


    });
</script>
@endpush
