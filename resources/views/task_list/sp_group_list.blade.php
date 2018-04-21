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
                                   <div class="table-responsive">
                        <table class="table" >
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
                              <tbody >

                         <tr :data-id="talent.id" v-for="(talent,index) in talents">
                                <td class="text-center">@{{index+1}}</td>
                               
                                <td><span class="clickable" v-on:click="goToSpApprovalList(talent.id)">@{{ talent.name }}</span><i class="material-icons" v-if="talent.is_new">fiber_new</i></td>
                               
                                <td>@{{ talent.head_of_division }}</td>
                                <td>@{{ talent.status }}</td>
                                <td>@{{ talent.nomination_date }}</td>
                                <td class="td-actions text-right">
                                    <input type="hidden" value="@talent.id">
                                    
                                   <button type="button" rel="tooltip" class="btn btn-primary" data-original-title="" title="" v-on:click="goToSpApprovalList(talent.id)">
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
                        <table class="table" >
                          <thead>
                              <tr>
                                  <th class="text-center">#</th>
                                  <th>Division Group</th>
                                  <th>HOD</th>
                                  <th>Status</th>
                               
                                  <th class="text-right">Actions</th>
                              </tr>
                          </thead>
                              <tbody >
                         <tr :data-id="talent.id" v-for="(talent,index) in talentsRemove">
                                <td class="text-center">@{{index+1}}</td>
                               
                                <td><span class="clickable" v-on:click="goToSpRemovalList(talent.id)">@{{ talent.name }}</span><i class="material-icons" v-if="talent.is_new">fiber_new</i></td>
                               
                                <td>@{{ talent.head_of_division }}</td>
                                <td>@{{ talent.status }}</td>
                          
                                <td class="td-actions text-right">
                                    <input type="hidden" value="@talent.id">
                                    
                                   <button type="button" rel="tooltip" class="btn btn-primary" data-original-title="" title="" v-on:click="goToSpRemovalList(talent.id)">
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
@endsection
@push('scripts')
 <script type="text/javascript">
 $(function(){



     

        
 });

   window.generic.mixins.push({
            data:function() {
                return {
                    talents:  {!! json_encode($resultnew)  !!},
                    talentsRemove:  {!! json_encode($resultremove)  !!}
                }
            },
            methods: {
                goToSpApprovalList:function(id){
                    window.location.href = `{{ route('task_list.sp_group_list') }}/${id}?list=APPROVAL`;
                },
                goToSpRemovalList:function(id){
                    window.location.href = `{{ route('task_list.sp_group_list') }}/${id}?list=REMOVAL`;
                }
            }
        });


    </script>
@endpush