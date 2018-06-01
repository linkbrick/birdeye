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

        {{--Begin:Sales + Purchases--}}
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card card-chart">
                    <div class="card-header card-header-primary" data-header-animation="true">
                        <div class="ct-chart" id="websiteViewsChart"></div>
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
                                <span class="badge badge-primary badge-pill">{{ formatCurrency(rand (200000*100, 1000000*100) / 100)  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Weekly Sales
                                <span class="badge badge-primary badge-pill">{{ formatCurrency(rand (200000*5*100, 1000000*5*100) / 100)   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Sales
                                <span class="badge badge-primary badge-pill">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Yearly Sales
                                <span class="badge badge-primary badge-pill">{{ formatCurrency(rand (200000*365*100, 1000000*365*100) / 100)   }}</span>
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
                        <div class="ct-chart" id="dailySalesChart"></div>
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
                                <span class="badge badge-success badge-pill">{{ formatCurrency(rand (200000*100, 1000000*100) / 100)  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Weekly Purchases
                                <span class="badge badge-success badge-pill">{{ formatCurrency(rand (200000*5*100, 1000000*5*100) / 100)   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Purchases
                                <span class="badge badge-success badge-pill">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Yearly Purchases
                                <span class="badge badge-success badge-pill">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</span>
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
                        <h3 class="card-title">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</h3>
                        <p class="card-category">2018 May</p>
                        <h3 class="card-title">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</h3>
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
                        <h3 class="card-title">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</h3>
                        <p class="card-category">2017 June</p>
                        <h3 class="card-title">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</h3>
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
                        <h3 class="card-title">{{ formatCurrency(rand (200000*180*100, 1000000*180*100) / 100)   }}</h3>
                        <p class="card-category">2017 YTD</p>
                        <h3 class="card-title">{{ formatCurrency(rand (200000*180*100, 1000000*180*100) / 100)   }}</h3>
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
                        <div class="ct-chart" id="websiteViewsChart1"></div>
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
                                Daily Payment Received
                                <span class="badge badge-primary badge-pill">{{ formatCurrency(rand (200000*100, 1000000*100) / 100)  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Weekly Payment Received
                                <span class="badge badge-primary badge-pill">{{ formatCurrency(rand (200000*5*100, 1000000*5*100) / 100)   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Payment Received
                                <span class="badge badge-primary badge-pill">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Yearly Payment Received
                                <span class="badge badge-primary badge-pill">{{ formatCurrency(rand (200000*365*100, 1000000*365*100) / 100)   }}</span>
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
                        <div class="ct-chart" id="dailySalesChart1"></div>
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
                                Daily Amount Disbursed
                                <span class="badge badge-success badge-pill">{{ formatCurrency(rand (200000*100, 1000000*100) / 100)  }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Weekly Amount Disbursed
                                <span class="badge badge-success badge-pill">{{ formatCurrency(rand (200000*5*100, 1000000*5*100) / 100)   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Amount Disbursed
                                <span class="badge badge-success badge-pill">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Yearly Amount Disbursed
                                <span class="badge badge-success badge-pill">{{ formatCurrency(rand (200000*30*100, 1000000*30*100) / 100)   }}</span>
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


    $(document).ready(function() {

        console.log(Setting.initDashboardPageCharts());
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
            "dataProvider": [{
                "year": 1930,
                "italy": 1,
                "germany": 5,
                "uk": 3
            }, {
                "year": 1934,
                "italy": 1,
                "germany": 2,
                "uk": 6
            }, {
                "year": 1938,
                "italy": 2,
                "germany": 3,
                "uk": 1
            }, {
                "year": 1950,
                "italy": 3,
                "germany": 4,
                "uk": 1
            }, {
                "year": 1954,
                "italy": 5,
                "germany": 1,
                "uk": 2
            }, {
                "year": 1958,
                "italy": 3,
                "germany": 2,
                "uk": 1
            }, {
                "year": 1962,
                "italy": 1,
                "germany": 2,
                "uk": 3
            }, {
                "year": 1966,
                "italy": 2,
                "germany": 1,
                "uk": 5
            }, {
                "year": 1970,
                "italy": 3,
                "germany": 5,
                "uk": 2
            }, {
                "year": 1974,
                "italy": 4,
                "germany": 3,
                "uk": 6
            }, {
                "year": 1978,
                "italy": 1,
                "germany": 2,
                "uk": 4
            }],
            "valueAxes": [{
                "integersOnly": true,
                "maximum": 6,
                "minimum": 1,
                "reversed": true,
                "axisAlpha": 0,
                "dashLength": 5,
                "gridCount": 10,
                "position": "left",
                "title": "Place taken"
            }],
            "startDuration": 0.5,
            "graphs": [{
                "balloonText": "place taken by Italy in [[category]]: [[value]]",
                "bullet": "round",
                "hidden": true,
                "title": "Italy",
                "valueField": "italy",
                "fillAlphas": 0
            }, {
                "balloonText": "place taken by Germany in [[category]]: [[value]]",
                "bullet": "round",
                "title": "Germany",
                "valueField": "germany",
                "fillAlphas": 0
            }, {
                "balloonText": "place taken by UK in [[category]]: [[value]]",
                "bullet": "round",
                "title": "United Kingdom",
                "valueField": "uk",
                "fillAlphas": 0
            }],
            "chartCursor": {
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "year",
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