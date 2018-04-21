@extends('layouts.material') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-info">

                            <div class="card-icon">
                                <i class="material-icons md-48">folder_shared</i>
                            </div>
                            <h4 class="card-title " style=" display: inline;">SP List (Nomination)</h4>

                        </div>
                        <div class="card-body ">
                            <ul class="nav nav-pills nav-pills-info" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#link1" role="tablist">
                                        Nomination
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link2" role="tablist">
                                        Removal
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tab-space">
                                <div class="tab-pane active show" id="link1">

                                </div>
                                <div class="tab-pane" id="link2">
                                    
                                </div>
                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

</div>
@endsection @push('scripts')