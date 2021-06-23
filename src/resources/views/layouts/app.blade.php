<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (auth()->check())
    <meta name="api-token" content="{{ auth()->user()->api_token }}">
    @endif

    <title>
        {{ config('app.name', '') }}
        {{ __('app.route_' . Route::currentRouteName(), ["collection_name" => $collection->name ?? '']) }}
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="/js/lang.js"></script> --}}

    <link rel="shortcut icon" type="image/png"
        href="{{ asset('storage/favicon.png') }}" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    @include('partials.debug_inc')

    <div id="app">
        <nav
            class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand"
                    href="@if(Auth::user()){{ route('portfolio') }}@else{{ route('landing') }}@endif">
                    <img src="{{ asset('storage/logo.png') }}" alt="">
                    {{ config('app.name', '') }} <sup><em
                            class="text-muted">β</em></sup>
                </a>
                <button class="navbar-toggler" type="button"
                    data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse"
                    id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            @if(isset($collection))
                            <a class="nav-link"
                                href="{{ route('collection.show', [$collection]) }}">
                                @else
                                <a class="nav-link" href="/">
                                    @endif
                                    {{ str_replace("|","",__('app.route_' . Route::currentRouteName(), ["collection_name" => $collection->name ?? ''])) }}
                                </a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown"
                                class="nav-link dropdown-toggle"
                                href="#" role="button"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?s=25&d={{ urlencode(asset('storage/logo.png')) }}"
                                    alt="" class="rounded-circle">
                                {{ Auth::user()->name }} <span
                                    class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right text-right"
                                aria-labelledby="navbarDropdown">


                                <a class="dropdown-item"
                                    href="{{ route('profile.show')}}">
                                    {{ __('app.profile') }}
                                    <fa icon="user" class="text-left">
                                    </fa>
                                </a>
                                <a class="dropdown-item"
                                    href="{{ route('portfolio') }}">
                                    {{ __('app.portfolio') }}
                                    <fa icon="home"></fa>
                                </a>
                                <a class="dropdown-item"
                                    href="https://docs.lltl.be/"
                                    target="_blank">
                                    Documentation
                                    <fa icon="file-alt"></fa>
                                </a>
                                {{-- <a class="dropdown-item" href="{{ route('announcement')}}">
                                {{ __('app.announcement') }}
                                <fa icon="bullhorn"></fa>
                                </a> --}}
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                    {{ __('app.logout') }}
                                    <fa icon="sign-out-alt"></fa>
                                </a>

                                <form id="logout-form"
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>

                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">

            @include('flash::message')

            @yield('content')
        </main>

    </div>

    <footer class="footer">

        <div class="text-center small">

            Project by <a
                href="{{ config('core_settings.lltl_url') }}"
                alt="LLTL ULiège" target="_blank">
                <em>{{ config('core_settings.project_name') }}</em>
            </a>
            <a href="http://labos.ulg.ac.be/cris/" alt="Cris ULiège"
                target="_blank">CRIS</a>
            from <a href="{{ config('core_settings.promotor_url') }}"
                alt="">{{ config('core_settings.promotor_name') }}</a>
            <br />
            <span class="text-dark">2019-{{ date('Y') }}</span> - <a
                href="{{ config('core_settings.license_url') }}">GPLv3
                License</a> | <a
                href="{{ config('core_settings.git_source_code') }}">Source
                code on GitHub</a> |
            <a href="https://docs.lltl.be/" target="_blank">Docs</a> |

            <a href="https://github.com/tintamarre/corpus/issues"
                target="_blank">Help</a>

        </div>
    </footer>

    @include('partials.js_translations')

</body>

</html>
