@extends('layouts.material')

@section('content')
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
                                        <input type="text" id="search" class="form-control" style="width:200px;height: 46px;" placeholder="Search Talent" >
                                    </div>
                                    <div style="float:right;display: inline-block;">
                                        <div style=" display: inline;">
                                            <div style="display: inline-block;"><button class="btn btn-primary" id="btnNominate" >Nominate<div class="ripple-container"></div></button></div>
                                            <div  style="display: inline-block;margin-left:10px">
                                                <select class="selectpicker"  name="action" id="actions"
                                                        data-style="select-with-transition">
                                                    <option value="0" selected disabled style="color:black">Status</option>
                                                    <option :value="action.val" v-for="action in actions" style="color:black" >@{{action.text}}</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                </h4>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" >
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th><input type="checkbox" value="" id="parentChk"></th>
                                            <th>Name</th>
                                            <th>Staff ID</th>
                                            <th>Talent Type</th>
                                            <th>Division</th>
                                            <th>Role Tagged</th>
                                            <th>Status</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody >

                                        <tr :data-id="talent.id" :data-status="talent.statustobe" :data-tag-role="talent.tag_role" v-bind:class="{'table-success':(['APPROVE','DROP','NOMINATE'].indexOf(talent.statustobe) !== -1), 'table-danger':(['REMOVE','REJECT','REJECTREMOVAL'].indexOf(talent.statustobe) !== -1), 'table-info':(['HIPO','SUCCEED'].indexOf(talent.statustobe) !== -1)}"  v-for="(talent,index) in talents">
                                            <td class="text-center">@{{index+1}}
                                            </td>
                                            <td><input type="checkbox" class="childChk" v-model="talent.isChecked" value=""></td>
                                            <td>@{{ talent.name }}</td>
                                            <td>@{{ talent.staff_id }}</td>
                                            <td>@{{ talent.talent_type }}</td>
                                            <td>@{{ talent.division.name }}</td>
                                            <td></td>
                                            <td>@{{ talent.status }}</td>
                                            <td class="td-actions text-right">
                                                <input type="hidden" value="@talent.id">
                                                <button type="button" rel="tooltip" class="btn btn-default" v-on:click="talent.statustobe = 'NEW'" data-original-title="" title="">
                                                    <i class="material-icons">person</i>
                                                </button>

                                                @if(request()->user()->isAn('HOD'))
                                                    <button type="button" rel="tooltip" v-on:click="talent.statustobe = 'REMOVE'" class="btn btn-default" data-original-title="" title="remove">
                                                        <i class="material-icons">delete</i>
                                                    </button>

                                                        <button type="button" rel="tooltip" v-on:click="talent.statustobe = 'NOMINATE'" class="btn btn-default" data-original-title="" title="nominate">
                                                            <i class="material-icons">add</i>
                                                        </button>
                                                 @endif 
                                                @if(request()->user()->isAn('HCM'))
                                                    @if (app('request')->input('list') === "APPROVAL")
                                                    <button type="button" rel="tooltip" v-on:click="talent.statustobe = 'APPROVE'" class="btn btn-default" data-original-title="" title="approve">
                                                            <i class="material-icons">add</i>
                                                        </button>
                                                <button type="button" rel="tooltip" v-on:click="talent.statustobe = 'REJECT'" class="btn btn-default" data-original-title="" title="reject">
                                                            <i class="material-icons">cancel</i>
                                                        </button>   
                                                     @endif 
                                                    @if (app('request')->input('list') === "REMOVAL")
                                                        <button type="button" rel="tooltip" v-on:click="talent.statustobe = 'REJECTREMOVAL'" class="btn btn-default" data-original-title="" title="reject">
                                                            <i class="material-icons">cancel</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" v-on:click="talent.statustobe = 'DROP'" class="btn btn-default" data-original-title="" title="drop">
                                                            <i class="material-icons">info_outline</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" v-on:click="talent.statustobe = 'HIPO'" class="btn btn-default" data-original-title="" title="tag HIPO">
                                                            <i class="material-icons">label_outline</i>
                                                        </button>
                                                        <button type="button" rel="tooltip" v-on:click="loadNomination(talent.id)" class="btn btn-default" data-original-title="" title="tag successor role">
                                                            <i class="material-icons">person_add</i>
                                                        </button>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-success" style="float: right;" id="btnConfirm">Finalise<div class="ripple-container" ></div></button>
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
                    <h4 class="modal-title" style="font-weight:400" v-if="is_tag_role">Tag Role</h4>
                    <h4 class="modal-title" style="font-weight:400"  v-if="!is_tag_role">New Nomination</h4>
                </div>
                <div class="modal-body">
                    <div class="container col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating ">
                                    <label class="control-label">Staff Name
                                        <small>*</small>
                                    </label>
                                    <input type="text" name="staffName" id="staffName" list="nameSuggestion" class="form-control" required="true" v-model="current_nomination.name" >
                                    <datalist id="nameSuggestion" >
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
                                    <input type="text" name="staffId" class="form-control"  v-model="current_nomination.staff_id" >
                                </div>
                            </div>
                            <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                                <div class="form-group label-floating ">
                                    <label class="control-label">Division

                                    </label>
                                    <input type="text" name="division" class="form-control"  v-model="current_nomination.division_name" >
                                </div>
                            </div>
                            <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                                <div class="form-group label-floating ">
                                    <label class="control-label">Designation

                                    </label>
                                    <input type="text" name="designation" class="form-control"  v-model="current_nomination.designation" >
                                </div>
                            </div>
                            <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                                <div class="form-group label-floating ">
                                    <label class="control-label">Grade

                                    </label>
                                    <input type="text" name="grade" class="form-control"  v-model="current_nomination.grade" >
                                </div>
                            </div>
                            <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                                <div class="form-group label-floating ">
                                    <label class="control-label">Talent Type

                                    </label>
                                    <select name="talent_type" class="selectpicker"
                                            data-style="select-with-transition"  v-model="current_nomination.talent_type">
                                        <option disabled selected value="" >Please Select</option>
                                        @foreach($talenttypeDropDown as $key => $value)
                                            <option value="{{$key}}" >{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" v-if="is_ready_nominate||is_tag_role">
                                <div class="form-group label-floating ">
                                    <label class="control-label">Succession Role

                                    </label>
                                    <input type="text" name="successtionRole" class="form-control"  v-model="current_nomination.role" >
                                </div>
                            </div>
                            <div class="col-md-12" v-if="is_tag_role">
                                <div class="form-group label-floating ">
                                    <label class="control-label">Tag Role </label>
                                    <select name="tag_role" class="selectpicker"
                                            data-style="select-with-transition"  v-model="current_nomination.tag_role">
                                        <option disabled selected value="" >Please Select</option>
                                        <option value="1" >Test data 1</option>
                                        <option value="2" >Test data 2</option>
                                        <option value="3" >Test data 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text_align:center">
                    <span style="color:red;display:none;" id="info-text-red">Talent not found.</span>
                    <span  id="info-text"></span>
                    <button type="button" class="btn btn-success" style="width:150px" v-on:click="doTagRole(current_nomination.id)" v-if="is_tag_role">Tag Role</button>
                    <button type="button" class="btn btn-success" style="width:150px" v-on:click="doDominate" v-if="is_ready_nominate">Nominate</button>
                    <button type="button" class="btn btn-default" id="closeBtn" data-dismiss="modal" style="margin-right:15px;margin-left:10px;width:150px">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function(){


            //search function event
            //    const input$ = Rx.Observable
            //    .fromEvent(document.getElementById('search'), 'keyup')
            //    .map(x => x.currentTarget.value)
            //    .debounceTime(700)
            //    .subscribe(x => sendValues(x));

            //checkbox event
            $("#parentChk").change(function(){
                const talent = app.talents;
                let iter = talent.length;
                while (iter--) {
                    talent[iter].isChecked=$(this).prop('checked');
                }
            });
            $(".childChk").change(function(){
                $("#parentChk").prop('checked',$(".childChk:checked").length===$(".childChk").length)
            });
            $("#btnNominate").click(()=>$('#myModal').modal("show"));



            $("#actions").change(function(){
                //get all selected id
                const talents = app.talents;
                let iter = talents.length;
                while (iter--) {
                    if (talents[iter].isChecked===true){
                        talents[iter].status=$(this).val();
                    }
                    talents[iter].isChecked=false;
                }
                $("#parentChk").prop('checked',false)
                $("#actions").first().val("0");
                $("#actions").selectpicker('refresh')
            })

            $("#btnConfirm").click(()=>{
                const talents = app.talents;
            let iter = talents.length;
            let arrToAction = {
                "NOMINATE":talents.filter(t=>t.statustobe==="NOMINATE").map(t=>t.id),
                "NEW":talents.filter(t=>t.statustobe==="NEW").map(t=>t.id),
                "REMOVE":talents.filter(t=>t.statustobe==="REMOVE").map(t=>t.id),
            "APPROVE":talents.filter(t=>t.statustobe==="APPROVE").map(t=>t.id),
            "REJECT":talents.filter(t=>t.statustobe==="REJECT").map(t=>t.id),
            "REJECTREMOVAL":talents.filter(t=>t.statustobe==="REJECTREMOVAL").map(t=>t.id),
            "DROP":talents.filter(t=>t.statustobe==="DROP").map(t=>t.id),
            "HIPO":talents.filter(t=>t.statustobe==="HIPO").map(t=>t.id),
            "SUCCEED":talents.filter(t=>t.statustobe==="SUCCEED").map(t=>({id:t.id,tag_role:t.tag_role}))
        };

            const apiUrl={
                "NOMINATE":"/task_list/nominate",
                "NEW":"/task_list/approve_sp",
                "REMOVE":"/task_list/remove",
                "APPROVE":"/task_list/approve",
                "REJECT":"/task_list/reject",
                "REJECTREMOVAL":"/task_list/removal/approve",
                "DROP":"/task_list/removal/reject",
                "HIPO":"/task_list/removal/approve/tagToHIPO",
                "SUCCEED":"/task_list/removal/approve/update_SP"
            };

            let actionToPerform = [];
            for (let [k, v] of Object.entries(arrToAction)) {
                if (v.length === 0){
                    continue;
                }
                actionToPerform.push(Rx.Observable.from(axios.post(apiUrl[k],v)).retry(3));
            }
            Rx.Observable.forkJoin(
                ...actionToPerform
        ).subscribe(
                x => {
                console.log(x);
            swal({
                title: 'Success',
                text: x.map((c)=>`${c.data.raffected} talent(s) affected in ${c.data.text} action`).join(),
                type: 'success'
        });

        },
            e => console.log(`onError: ${e}`),
                () =>{
                const param = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
                Rx.Observable.from(axios.get('/task_list/get_nomination_list/'+param)).retry(3).subscribe(
                    res=> {app.talents =res.data.map((obj)=>({
                    id:obj.id,
                    name:obj.talent_profiles.name,
                    staff_id:obj.talent_profiles.staff_id,
                    talent_type:obj.talent_type,
                    division:obj.talent_profiles.division.name,
                    isChecked:false,status:obj.status,statustobe:""
                    }))},
                    e=> { },
                ()=> { }
            )
            }
        );
        });

            //modal event
            //name suggestion
            const nameSuggest$ = Rx.Observable
                .fromEvent(document.getElementById('staffName'), 'keyup')
                .map(x => x.currentTarget.value)
        .do(x=> {app.is_ready_nominate=false; $("#info-text").text(x.length<=3?"Please type more...":""),$("#info-text-red").hide()})
        .filter(x => x.length>3)
        .do(x=>{
                if ($("#nameSuggestion>option").map(function() {return this.value;}).get().indexOf(x)!==-1){
                const id = $(`#nameSuggestion>option[value='${$.escapeSelector(x)}']`).first().data("id");
                app.current_nomination.talent_id=id;
                $("#info-text").text("Loading...");
                Rx.Observable.from(axios.get(`/getSPDetailsByID/${id}`))
                    .retry(3)
                    .subscribe(
                        res=>{
                    app.current_nomination=res.data;
                app.is_ready_nominate=true;
                setTimeout(function(){$("[name='staffId']").focus();},100);
            },
                e=> {
                    app.current_nomination={};
                    console.log(e);
                    swal("Failed", "Something is wrong!", "error");
                },
                ()=> $("#info-text").text("")
            )
            }
        })
        .debounceTime(700)
                .subscribe(x =>{
                //if select a name from datalist
                if ($("#nameSuggestion>option").map(function() {return this.value;}).get().indexOf(x)===-1){
                //if try to
                $("#info-text").text("Loading...");
                Rx.Observable.from(axios.get(`/getSuggestionByName/${encodeURI(x)}`))
                    .retry(3)
                    .subscribe(
                        res=>{app.name_suggestions=res.data; $("#info-text-red").toggle(res.data.length===0);},
                e=> { app.name_suggestions=[];swal("Failed", "Something is wrong!", "error"); },
                ()=> $("#info-text").text("")
            )
            }

        });

            $('#myModal').on('hide.bs.modal', function () {
                app.current_nomination={};
                app.is_ready_nominate=false;
                app.name_suggestions=[];
                $("#info-text").text("");
                $("#info-text-red").hide();
                app.is_tag_role=false;
            })


        });

        window.generic.mixins.push({
            data:function() {
                return {
                    talents:  {!! $talents  !!}.map((obj)=>({
                    id:obj.id,
                    name:obj.talent_profiles.name,
                    staff_id:obj.talent_profiles.staff_id,
                    talent_type:obj.talent_type,
                    division:obj.talent_profiles.division.name,
                    isChecked:false,status:obj.status,statustobe:""
                    })),
                    actions: {!! json_encode($actions)  !!},
                    modified_talents :[],
                    name_suggestions : [],
                    current_nomination:{},
                    is_ready_nominate:false,
                    is_tag_role:false
                }
            },
            methods: {
                doDominate:function(){
                    loadingSpinner.show();
                    const name = $("#staffName").val();
                    const tid = $(`#nameSuggestion>option[value='${$.escapeSelector(name)}']`).first().data("id");
                    $("#info-text").text("Saving...");
                    Rx.Observable.from(axios.post('/talent_list_nominate', {...app.current_nomination,talent_id:tid}))
                .retry(3)
                        .subscribe(
                            res=> {
                        const param = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
                    axios
                        .get('/task_list/get_nomination_list/'+param)
                        .then((res)=>{
                        this.talents =res.data.map((obj)=>({
                    id:obj.id,
                    name:obj.talent_profiles.name,
                    staff_id:obj.talent_profiles.staff_id,
                    talent_type:obj.talent_type,
                    division:obj.talent_profiles.division.name,
                    isChecked:false,status:obj.status,statustobe:""
                    }))
                })
                },
                    e=> { swal("Failed", "Something is wrong!", "error"); loadingSpinner.hide();},
                    ()=> {
                        swal({
                            title: 'Success',
                            text: 'Nominate Successfully',
                            type: 'success',
                            timer: 1000
                        });
                        loadingSpinner.hide();
                        $('#myModal').modal("hide");
                    })


                },loadNomination:function(id){
                    Rx.Observable.from(axios.get(`/task_list/removal/approve/update/${id}`))
                        .retry(3)
                        .subscribe(
                            res=>{
                        this.current_nomination = res.data;
                    this.current_nomination.id = id;
                    this.is_tag_role=true;
                    $('#myModal').modal("show");
                },
                    e=> { this.current_nomination={};swal("Failed", "Something is wrong!", "error");  $('#myModal').modal("hide");},
                    ()=> $("#info-text").text("")
                )
                },
                doTagRole:function(id){
                    const selectedTalent = this.talents.find((e)=>e.id==id);
                    selectedTalent.tag_role=this.current_nomination.tag_role;
                    selectedTalent.statustobe = "SUCCEED";
                    $('#myModal').modal("hide");
                }
            },watch: {
                current_nomination: {
                    handler: function(newValue) {
                        setTimeout(()=>$('.selectpicker').selectpicker('refresh'),100)
                    }
                },
                is_tag_role: {
                    handler: function(newValue) {
                        setTimeout(()=>$('.selectpicker').selectpicker('refresh'),100)
                    }
                }
            }
        });


    </script>
@endpush
