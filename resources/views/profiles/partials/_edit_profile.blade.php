<div class="card">
<form id="profile" method="post" action="{{ route('profiles.update',['profile' => $user->id]) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="card-content text-left">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group label-floating">
                    <label class="control-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" v-model="name">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Email Address (login ID)</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" v-model="email">
                </div>
                <div class="form-group label-floating ">
                    <label for="password" class="control-label">New Password</label>

                    <input id="password" type="password" class="form-control" name="password">
                </div>
                <div class="form-group label-floating ">
                    <label for="password-confirm" class="control-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
                <legend>Avatar</legend>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail img-circle">
                        <img src="{{ asset('images/placeholder.jpg') }}" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                    <div>
                                                    <span class="btn btn-round btn-rose btn-file">
                                                        <span class="fileinput-new">Add Photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="attachment" accept="image/*"/>
                                                    </span>
                        <br />
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-fill btn-primary pull-right" >Save</button>
        </div>
    </div>
</form>
</div>
