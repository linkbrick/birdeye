@extends('layouts.material')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-profile">
                    <div class="card-avatar">
                        @if($user->getMedia('avatar')->count() > 0)
                            <img class="img" src="{{ $user->getMedia('avatar')->first()->getUrl()  }}" />
                        @else
                            <img class="img" src="{{ asset('images/default-avatar.png') }}" />
                        @endif
                    </div>
                    <div class="card-content text-left">
                        <div class="form-group">
                            <label class="label-control">Name</label> <br/>
                            @{{ name }}
                        </div>
                        <div class="form-group">
                            <label class="label-control">Email Address (login ID)</label> <br/>
                            @{{ email }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-9">
                <div class="nav-center">
                    <ul class="nav nav-pills nav-pills-primary nav-pills-icons" role="tablist">
                        <!--
            color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
        -->
                        <li>
                            <a href="#edit_profile" role="tab" data-toggle="tab">
                                <i class="material-icons">edit</i> Edit Profile
                            </a>
                        </li>
                        <li class="active">
                            <a href="#notification" role="tab" data-toggle="tab">
                                <i class="material-icons">notifications</i> Notification
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane" id="edit_profile">
                        @include('profiles.partials._edit_profile')
                    </div>
                    <div class="tab-pane active" id="notification">
                        @include('profiles.partials._user_notification')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        window.generic.mixins.push({
            data() {
                return {
                    name: {!! json_encode($user->name) !!},
                    email: {!! json_encode($user->email) !!}
                }
            },
            methods: {

            }
        });
    </script>
@endpush
