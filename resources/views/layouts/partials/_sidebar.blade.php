<div class="sidebar" data-active-color="rose" data-background-color="white">
    <!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
    <div class="logo text-left pl-3">
        <a href="{{ route('home') }}" class="simple-text logo-normal">
            {{ optional(request()->tenant())->name ?:config('app.name') }}
        </a>

    </div>
    <div class="sidebar-wrapper">
        <div class="user">

            <div class="photo">
                <img class="img" src="{{ asset('images/default-avatar.png') }}"/>
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>

                                @if(auth()->user())
                                    {{ auth()->user()->name }}
                                @else
                                    Sign in
                                @endif
                                <b class="caret"></b>
                            </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="">
                                <span class="sidebar-mini"> MP </span>
                                <span class="sidebar-normal"> My Profile </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="{{ route('simulator') }}">
                    <i class="material-icons">assessment</i>
                    <p> Evaluation </p>
                </a>
            </li>

            {{--<li class="nav-item ">--}}
                {{--<a data-toggle="collapse" href="#users" aria-expanded="false" class="nav-link">--}}
                    {{--<i class="material-icons">people</i>--}}
                    {{--<p> People--}}
                        {{--<b class="caret"></b>--}}
                    {{--</p>--}}
                {{--</a>--}}
                {{--<div class="collapse" id="users">--}}
                    {{--<ul class="nav">--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="">--}}
                                {{--<span class="sidebar-mini"> U </span>--}}
                                {{--<span class="sidebar-normal"> Users </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="">--}}
                                {{--<span class="sidebar-mini"> R </span>--}}
                                {{--<span class="sidebar-normal"> Roles </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item">--}}
                            {{--<a class="nav-link" href="">--}}
                                {{--<span class="sidebar-mini"> A </span>--}}
                                {{--<span class="sidebar-normal"> Abilities </span>--}}
                            {{--</a>--}}
                        {{--</li>--}}

                    {{--</ul>--}}
                {{--</div>--}}
            {{--</li>--}}




        </ul>
    </div>
</div>
