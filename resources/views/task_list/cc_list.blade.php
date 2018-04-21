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
                                <table class="table" id="tblMain">
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

                                        <tr :data-id="talent.id" :data-status="talent.status" :data-report="talent.report" :data-consultdate="talent.consultdate" :data-consultby="talent.consultby" v-bind:class="{'table-success':(['PROCEED'].indexOf(talent.status) !== -1), 'table-danger':([].indexOf(talent.status) !== -1), 'table-info':(['REPORT INSERT','WAIVE'].indexOf(talent.status) !== -1)}"
                                            v-for="(talent,index) in talents">
                                            <td class="text-center">@{{index+1}}</td>
                                            <td>
                                                <input type="checkbox" class="childChk" v-model="talent.isChecked" value="">
                                            </td>
                                            <td>@{{ talent.name }}</td>
                                            <td>@{{ talent.staff_id }}</td>
                                            <td>@{{ talent.talent_type }}</td>
                                            <td>@{{ talent.division.name }}</td>
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
                                                <button type="button" rel="tooltip" v-on:click="openReportWindow(talent)"  class="btn btn-default" data-original-title=""
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
                <h4 class="modal-title" style="font-weight:400">Add Report</h4>
            </div>
            <div class="modal-body">
                <div class="container col-md-12">
                    <div class="row">
                    <div class="col-md-12">
                            <div class="form-group label-floating ">
                                <label class="control-label">Report</label>
                                <textarea name="report" class="form-control" cols="30" rows="10" v-model="current_talent.report"></textarea>
                                <input type="hidden" id="hidCurrentid" value="">
                            </div>
                        </div>
                        <div class="col-md-12" >
                            <div class="form-group label-floating ">
                                <label class="control-label">Consulted by</label>
                                <input type="text" name="consultby" class="form-control" v-model="current_talent.consultby">
                            </div>
                        </div>
                        <div class="col-md-12" >
                            <div class="form-group label-floating ">
                                <label class="control-label">Consulted date</label>
                                <input type="text" id="consultdate" name="consultdate" class="form-control datetimepicker"  v-model="current_talent.consultdate"
                                           required="true">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="text_align:center">
                <button type="button" class="btn btn-success" style="width:150px" v-on:click="doInsertReport(current_talent.id)"   >Save</button>
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
                "REPORT": talents.filter(t => t.status === "REPORT INSERT").map(t=>({id:t.id,report:t.report,consultdate:t.consultdate,consultby:t.consultby})),
                "REJECTREMOVAL": talents.filter(t => t.status === "REJECTREMOVAL").map(t => t.id),
                "DROP": talents.filter(t => t.status === "DROP").map(t => t.id),
                "HIPO": talents.filter(t => t.status === "HIPO").map(t => t.id),
                "SUCCEED": talents.filter(t => t.status === "SUCCEED").map(t => t.id)
            };

            const apiUrl = {
                "WAIVE": "/task_list/career_conversation/waive",
                "PROCEED": "/task_list/career_conversation/proceed",
                "REPORT": "/task_list/reject",
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
                    const param = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
                    axios
                        .get('/task_list/get_career_conversation_list/'+param)
                        .then((res)=>{
                        this.talents =res.data.map(obj=>({
                            id:obj.id,
                            name:obj.talent_profiles.name,
                            staff_id:obj.talent_profiles.staff_id,
                            talent_type:obj.talent_type,
                            division:obj.talent_profiles.division.name,
                            isChecked:false,
                            status:""
                         }));
                        });
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
            app.current_talent = {};
        })


    });
    window.generic.mixins.push({
        data:function() {
            return {
                talents: {!! $talents !!}.map((obj)=>({
                    id:obj.id,
                    name:obj.talent_profiles.name,
                    staff_id:obj.talent_profiles.staff_id,
                    talent_type:obj.talent_type,
                    division:obj.talent_profiles.division.name,
                    isChecked:false,status:""
                    })),
                actions: {!!json_encode($actions) !!},
                current_talent: {},
            }
        },
        methods:{
                openReportWindow:function(talent){
                    $('#myModal').modal("show");
                    this.current_talent=talent;
                },
                doInsertReport:function(talent){
                    let selectedTalent = this.talents.find((e)=>e.id==talent.id);
                    selectedTalent=this.current_talent;
                    selectedTalent.status = "REPORT INSERT";
                    $('#myModal').modal("hide");
                }  
        }
    });
</script>
@endpush