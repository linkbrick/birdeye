@extends('layouts.material') @section('content')
<div class="content">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-info">

                            <div class="card-icon">
                                <i class="material-icons">folder_shared</i>
                            </div>
                            <h4 class="card-title " style=" display: inline;">
                                <div style=" display: inline-block;">
                                    <input type="text" id="search" class="form-control" style="width:200px;height: 46px;" placeholder="Search Talent">
                                </div>
                                <div style="float:right;display: inline-block;">
                                    <div style=" display: inline;">
                                        <div style="display: inline-block;">
                                            <button class="btn btn-primary" id="btnNominate">Nominate
                                                <div class="ripple-container"></div>
                                            </button>
                                        </div>
                                        <div style="display: inline-block;margin-left:10px">
                                            <select class="selectpicker" name="action" id="actions" data-style="select-with-transition">
                                                <option value="0" selected disabled style="color:black">Status</option>
                                                <option :value="action.val" v-for="action in actions" style="color:black">@{{action.text}}</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>
                            </h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>
                                                <input type="checkbox" value="" id="parentChk">
                                            </th>
                                            <th>Name</th>
                                            <th>Staff ID</th>
                                            <th>Talent Type</th>
                                            <th>Division</th>
                                            <th>Role Tagged</th>
                                            <th>Status</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr :data-id="talent.id" :data-status="talent.status" v-bind:class="{'table-success':(['PROCEED'].indexOf(talent.status) !== -1), 'table-danger':(['WAIVE'].indexOf(talent.status) !== -1), 'table-info':(['REPORT INSERT'].indexOf(talent.status) !== -1)}"
                                            v-for="(talent,index) in talents">
                                            <td class="text-center">@{{index+1}}</td>
                                            <td>
                                                <input type="checkbox" class="childChk" v-model="talent.isChecked" value="">
                                            </td>
                                            <td>@{{ talent.name }}</td>
                                            <td>@{{ talent.staff_id }}</td>
                                            <td>@{{ talent.talent_type }}</td>
                                            <td>@{{ talent.division }}</td>
                                            <td></td>
                                            <td>@{{ talent.status }}</td>
                                            <td class="td-actions text-right">
                                                <input type="hidden" value="@talent.id">
                                                <button type="button" rel="tooltip" class="btn btn-default" data-original-title="" title="">
                                                    <i class="material-icons">person</i>
                                                </button>
                                                @if (app('request')->input('list') === "WAIVER")
                                                <button type="button" rel="tooltip" v-on:click="talent.status = 'PROCEED'" class="btn btn-default" data-original-title=""
                                                    title="Proceed">
                                                    <i class="material-icons">add</i>
                                                </button>
                                                <button type="button" rel="tooltip" v-on:click="talent.status = 'WAIVE'" class="btn btn-default" data-original-title="" title="Waive">
                                                    <i class="material-icons">cancel</i>
                                                </button>
                                                @endif 
                                                @if (app('request')->input('list') === "REPORT")
                                                <button type="button" rel="tooltip" v-on:click="talent.status = 'REPORT INSERT'" class="btn btn-default" data-original-title=""
                                                    title="Enter Report">
                                                    <i class="material-icons">assignment</i>
                                                </button>
                                                @endif {{--
                                                <button type="button" rel="tooltip" v-on:click="loadNomination"
                                                    class="btn btn-default" data-original-title="" title="">
                                                    <i class="material-icons">person_add</i>
                                                </button> --}}

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-success" style="float: right;" id="btnConfirm">Finalise
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="font-weight:400">New Nomination</h4>
            </div>
            <div class="modal-body">
                <div class="container col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group label-floating ">
                                <label class="control-label">Staff Name
                                    <small>*</small>
                                </label>
                                <input type="text" name="staffName" id="staffName" list="nameSuggestion" class="form-control" required="true" v-model="current_nomination.name">
                                <datalist id="nameSuggestion">
                                    <!--[if lte IE 9]><select data-datalist="nameSuggestion" ><![endif]-->
                                    <option :data-id="suggestion.id" :value="suggestion.name" v-for="suggestion in name_suggestions">
                                        <!--[if lte IE 9]></select><![endif]-->
                                </datalist>
                            </div>

                        </div>
                        <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                            <div class="form-group label-floating ">
                                <label class="control-label">Staff ID
                                </label>
                                <input type="text" name="staffId" class="form-control" v-model="current_nomination.staff_id">
                            </div>
                        </div>
                        <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                            <div class="form-group label-floating ">
                                <label class="control-label">Division

                                </label>
                                <input type="text" name="division" class="form-control" v-model="current_nomination.division_name">
                            </div>
                        </div>
                        <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                            <div class="form-group label-floating ">
                                <label class="control-label">Designation

                                </label>
                                <input type="text" name="designation" class="form-control" v-model="current_nomination.designation">
                            </div>
                        </div>
                        <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                            <div class="form-group label-floating ">
                                <label class="control-label">Grade

                                </label>
                                <input type="text" name="grade" class="form-control" v-model="current_nomination.grade">
                            </div>
                        </div>
                        <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                            <div class="form-group label-floating ">
                                <label class="control-label">Talent Type

                                </label>
                                <select name="talent_type" class="selectpicker" data-style="select-with-transition" v-model="current_nomination.talent_type">
                                    <option disabled selected value="">Please Select</option>
                                    @foreach($talenttypeDropDown as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                            <div class="form-group label-floating ">
                                <label class="control-label">Succession Role

                                </label>
                                <input type="text" name="successtionRole" class="form-control" v-model="current_nomination.role">
                            </div>
                        </div>
                        <div class="col-md-12" v-if="is_tag_role">
                            <div class="form-group label-floating ">
                                <label class="control-label">Tag Role

                                </label>
                                <select name="tag_role" class="selectpicker" data-style="select-with-transition" v-model="current_nomination.tag_role">
                                    <option disabled selected value="">Please Select</option>
                                    <option value="1">Test data 1</option>
                                    <option value="2">Test data 2</option>
                                    <option value="3">Test data 3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text_align:center">
                <span style="color:red;display:none;" id="info-text-red">Talent not found.</span>
                <span id="info-text"></span>
                <button type="button" class="btn btn-success" style="width:150px" v-on:click="doTagRole" v-if="is_tag_role">Tag Role</button>
                <button type="button" class="btn btn-success" style="width:150px" v-on:click="doDominate" v-if="is_ready_nominate">Nominate</button>
                <button type="button" class="btn btn-default" id="closeBtn" data-dismiss="modal" style="margin-right:15px;margin-left:10px;width:150px">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection @push('scripts')
<script type="text/javascript">
    $(function () {


        //search function event
        //    const input$ = Rx.Observable
        //    .fromEvent(document.getElementById('search'), 'keyup')
        //    .map(x => x.currentTarget.value)
        //    .debounceTime(700)
        //    .subscribe(x => sendValues(x));

        //checkbox event
        $("#parentChk").change(function () {
            const talent = app.talents;
            let iter = talent.length;
            while (iter--) {
                talent[iter].isChecked = $(this).prop('checked');
            }
        });
        $(".childChk").change(function () {
            $("#parentChk").prop('checked', $(".childChk:checked").length === $(".childChk").length)
        });
        $("#btnNominate").click(() => $('#myModal').modal("show"));



        $("#actions").change(function () {
            //get all selected id
            const talents = app.talents;
            let iter = talents.length;
            while (iter--) {
                if (talents[iter].isChecked === true) {
                    talents[iter].status = $(this).val();
                }
                talents[iter].isChecked = false;
            }
            $("#parentChk").prop('checked', false)
            $("#actions").first().val("0");
            $("#actions").selectpicker('refresh')
        })

        $("#btnConfirm").click(() => {
            const talents = app.talents;
            let iter = talents.length;
            let arrToAction = {
                "PROCEED": talents.filter(t => t.status === "PROCEED").map(t => t.id),
                "WAIVE": talents.filter(t => t.status === "WAIVE").map(t => t.id),
                "REPORT": talents.filter(t => t.status === "REPORT INSERT").map(t => t.id),
                "REJECTREMOVAL": talents.filter(t => t.status === "REJECTREMOVAL").map(t => t.id),
                "DROP": talents.filter(t => t.status === "DROP").map(t => t.id),
                "HIPO": talents.filter(t => t.status === "HIPO").map(t => t.id),
                "SUCCEED": talents.filter(t => t.status === "SUCCEED").map(t => t.id)
            };

            const apiUrl = {
                "WAIVE": "/task_list/career_conversation/waive",
                "PROCEED": "/task_list/career_conversation/proceed",
                "REJECT": "/task_list/reject",
                "REJECTREMOVAL": "/task_list/removal/approve",
                "DROP": "/task_list/removal/reject",
                "HIPO": "/task_list/removal/approve/tagToHIPO",
                "SUCCEED": "/task_list/removal/approve/update"
            };

            let actionToPerform = [];
            for (let [k, v] of Object.entries(arrToAction)) {
                if (v.length === 0) {
                    continue;
                }
                actionToPerform.push(Rx.Observable.from(axios.post(apiUrl[k], v)).retry(3));
            }
            Rx.Observable.forkJoin(
                ...actionToPerform
            ).subscribe(
                x => {
                    console.log(x);
                    swal({
                        title: 'Success',
                        text: x.map((c) =>
                            `${c.data.raffected} talent(s) affected in ${c.data.text} action`
                        ).join(),
                        type: 'success'
                    });

                },
                e => console.log(`onError: ${e}`),
                () => {
                    // location.reload();
                }
            );
        });


        $('#myModal').on('hide.bs.modal', function () {
            app.current_nomination = {};
            app.is_ready_nominate = false;
            app.name_suggestions = [];
            $("#info-text").text("");
            $("#info-text-red").hide();
            app.is_tag_role = false;
        })


    });
    window.generic.mixins.push({
        data() {
            return {
                talents: {!!json_encode($talents) !!},
                actions: {!!json_encode($actions) !!},
                modified_talents: [],
                name_suggestions: [],
                current_nomination: {},
                is_ready_nominate: false,
                is_tag_role: false
            }
        }
    });
</script>
@endpush