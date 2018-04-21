@extends('layouts.material') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-primary">

                            <div class="card-icon">
                                <i class="material-icons">forum</i>
                            </div>
                            <h4 class="card-title " style=" display: inline;">Career Conversation / Waiver</h4>

                        </div>
                        <div class="card-body ">

                            <ul class="nav nav-pills nav-pills-info" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#link1" role="tablist">
                                        Waiver
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link2" role="tablist">
                                        Enter Report
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link3" role="tablist">
                                        Concurrence
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#link4" role="tablist">
                                        Outcome
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content tab-space">
                                <div class="tab-pane active show" id="link1">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>

                                                    <th>Division Group</th>

                                                    <th>HOD</th>
                                                    <th>Status</th>
                                                    <th>Date Submitted</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr :data-id="talent.id" v-for="(talent,index) in app_talents">
                                                    <td class="text-center">@{{index+1}}</td>
                                                    <td>
                                                        <span class="clickable" v-on:click="goToSpList(talent.id,'WAIVER')">@{{ talent.name }}</span>
                                                        <i class="material-icons" v-if="talent.is_new">fiber_new</i>
                                                    </td>

                                                    <td>@{{ talent.head_of_division }}</td>
                                                    <td>@{{ talent.status }}</td>
                                                    <td>@{{ talent.nomination_date }}</td>
                                                    <td class="td-actions text-right">
                                                        <input type="hidden" value="@talent.id">

                                                        <button type="button" rel="tooltip" class="btn btn-primary" data-original-title="" title="" v-on:click="goToSpList(talent.id,'WAIVER')">
                                                            <i class="material-icons">perm_contact_calendar</i>
                                                        </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="link2">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Division Group</th>

                                                    <th>HOD</th>
                                                    <th>Status</th>
                                                    <th>Date Submitted</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr :data-id="talent.id" v-for="(talent,index) in pro_talents">
                                                    <td class="text-center">@{{index+1}}</td>

                                                   <td>
                                                        <span class="clickable" v-on:click="goToSpList(talent.id,'REPORT')">@{{ talent.name }}</span>
                                                        <i class="material-icons" v-if="talent.is_new">fiber_new</i>
                                                    </td>

                                                    <td>@{{ talent.head_of_division }}</td>
                                                    <td>@{{ talent.status }}</td>
                                                    <td>@{{ talent.nomination_date }}</td>
                                                    <td class="td-actions text-right">
                                                        <input type="hidden" value="@talent.id">
                                                         <button type="button" rel="tooltip" class="btn btn-primary" data-original-title="" title="" v-on:click="goToSpList(talent.id,'REPORT')">
                                                                <i class="material-icons">perm_contact_calendar</i>
                                                        </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="link3">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                     <th>Division Group</th>

                                                    <th>HOD</th>
                                                    <th>Status</th>
                                                    <th>Date Submitted</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr :data-id="talent.id" v-for="(talent,index) in add_talents">
                                                    <td class="text-center">@{{index+1}}</td>
                                                    <td>
                                                        <span class="clickable"  v-on:click="goToSpList(talent.id,'CONCURRENCE')">@{{ talent.name }}</span>
                                                        <i class="material-icons" v-if="talent.is_new">fiber_new</i>
                                                    </td>

                                                    <td>@{{ talent.head_of_division }}</td>
                                                    <td>@{{ talent.status }}</td>
                                                    <td>@{{ talent.nomination_date }}</td>
                                                    <td class="td-actions text-right">
                                                        <input type="hidden" value="@talent.id">
                                                         <button type="button" rel="tooltip" class="btn btn-primary" data-original-title="" title="" v-on:click="goToSpList(talent.id,'CONCURRENCE')">
                                                                <i class="material-icons">perm_contact_calendar</i>
                                                        </button>

                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="link4">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                     <th>Division Group</th>

                                                    <th>HOD</th>
                                                    <th>Status</th>
                                                    <th>Date Submitted</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr :data-id="talent.id" v-for="(talent,index) in con_talents">
                                                    <td class="text-center">@{{index+1}}</td>
                                                    <td>
                                                        <span class="clickable" v-on:click="goToSpList(talent.id,'OUTCOME')">@{{ talent.name }}</span>
                                                        <i class="material-icons" v-if="talent.is_new">fiber_new</i>
                                                    </td>

                                                    <td>@{{ talent.head_of_division }}</td>
                                                    <td>@{{ talent.status }}</td>
                                                    <td>@{{ talent.nomination_date }}</td>
                                                    <td class="td-actions text-right">
                                                        <input type="hidden" value="@talent.id">
                                                         <button type="button" rel="tooltip" class="btn btn-primary" data-original-title="" title="" v-on:click="goToSpList(talent.id,'OUTCOME')">
                                                                <i class="material-icons">perm_contact_calendar</i>
                                                        </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
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

</div>
@endsection @push('scripts')
<script type="text/javascript">

   window.generic.mixins.push({
            data() {
                return {
                    app_talents:  {!! json_encode($resultApprove)  !!},
                    pro_talents:  {!! json_encode($resultProceed)  !!},
                    add_talents:  {!! json_encode($resultAddreport)  !!},
                    con_talents:  {!! json_encode($resultConcur)  !!}
                }
            },
            methods: {
                goToSpList:function(id,action){
                    window.location.href = `{{ route('task_list.cc_group_list') }}/${id}?list=${action}`;
                }
            }
        });


</script>
@endpush