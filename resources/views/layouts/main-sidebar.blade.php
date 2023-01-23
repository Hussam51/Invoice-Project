<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon-white.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ URL::asset('assets/img/faces/6.jpg') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    @auth


                    <h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name }}</h4>
                    <span class="mb-0 text-muted">{{Auth::user()->email }}</span>
                    @endauth
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category"> {{ __('invoices.Invoices_system')}}</li>
            <li class="slide">
                <a class="side-menu__item" href="{{url('/home')}} "><svg
                        xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3" />
                        <path
                            d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
                    </svg><span class="side-menu__label">{{ __('invoices.Main')}}</span></a>
            </li>


            @can('invoices')
                <li class="side-item side-item-category">{{ __('invoices.Invoices')}}</li>

                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />
                            <path
                                d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />

                        </svg>

                          @can('invoices')


                        <span class="side-menu__label">{{__('invoices.Invoices')}}</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">


                                @can('invoice-list')


                            <li><a class="slide-item" href="{{ url('/' . ($page = 'invoices')) }}"> {{__('invoices.List')}}</a></li>

                                 @endcan


                               @can('invoices-paid')


                            <li><a class="slide-item" href="{{ route('invoices.paid')}}"> {{__('invoices.Paid')}}</a> </li>
                               @endcan

                               @can('invoices-unpaid')
                            <li><a class="slide-item" href="{{ route('invoices.unpaid')}}">
                                    {{__('invoices.Unpaid')}}</a>
                            </li>
                               @endcan

                               @can('invoices-partially-paid')
                            <li><a class="slide-item" href="{{ route('invoices.partially_paid')}}">
                                    {{__('invoices.Partially_paid')}}</a>
                            </li>
                                 @endcan

                                 @can('invoices-archivement')
                            <li><a class="slide-item" href="{{ route('invoices.archivment')}}"> {{__('invoices.Archivement')}}</a></li>
                                  @endcan
                    </ul>
                    @endcan
                </li>

                @endcan

            @can('reports')
                <li class="side-item side-item-category">{{__('reports.Reports')}}</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3" />
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z" />
                        </svg><span class="side-menu__label">{{__('reports.Reports')}}</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        @can('invoice-list-report')

                            <li><a class="slide-item" href="{{ url('/' . ($page = 'report_invoices')) }}"> {{__('reports.Invoices')}}</a>
                            </li>
                        @endcan

                           @can('user-list-report')


                            <li><a class="slide-item" href="{{ route('report.customers') }}"> {{__('reports.Users')}}</a>
                            </li>
                            @endcan

                    </ul>
                </li>
           @endcan
           @can('users')

                <li class="side-item side-item-category">{{__('users.Users')}}</li>
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><svg
                            xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3" />
                            <path
                                d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z" />
                        </svg><span class="side-menu__label">{{__('users.Users')}}</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                               @can('user-list')

                            <li><a class="slide-item" href="{{route('users.index')}}">{{__('users.List')}} </a></li>

                                @endcan

                            @can('role-user-list')

                            <li><a class="slide-item" href="{{ route('roles.index') }}"> {{__('roles.Users')}}</a></li>

                            @endcan
                    </ul>
                </li>
              @endcan


                            @can('sections')
                            <li><a class="slide-item" href="{{ route('sections.index') }}">>  {{__('sections.Sections')}}</a></li>
                            @endcan

                            @can('products')
                          <li> <a class="slide-item" href="{{ url('/' . $page = 'products') }}">>  {{__('products.Products')}}</a></li>
                            @endcan

                    <br>



        </ul>
    </div>
</aside>
<!-- main-sidebar -->
