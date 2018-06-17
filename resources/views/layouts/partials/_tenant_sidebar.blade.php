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
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="material-icons">pie_chart</i>
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
                {{--<a class="nav-link" href="{{ route('entities.index') }}">--}}
                    {{--<i class="material-icons">store</i>--}}
                    {{--<p> Entities </p>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{ route('invoices.index') }}">--}}
                    {{--<i class="material-icons">{{ config("tablecolumns.invoices.icon") }}</i>--}}
                    {{--<p> Invoices </p>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{ route('account_receivables.index') }}">--}}
                    {{--<i class="material-icons">{{ config("tablecolumns.account_receivables.icon") }}</i>--}}
                    {{--<p> Account Receivable </p>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{ route('bills.index') }}">--}}
                    {{--<i class="material-icons">{{ config("tablecolumns.bills.icon") }}</i>--}}
                    {{--<p> Bills </p>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link" href="{{ route('account_payables.index') }}">--}}
                    {{--<i class="material-icons">{{ config("tablecolumns.account_payables.icon") }}</i>--}}
                    {{--<p> Account Payable </p>--}}
                {{--</a>--}}
            {{--</li>--}}

        </ul>
    </div>
</div>
