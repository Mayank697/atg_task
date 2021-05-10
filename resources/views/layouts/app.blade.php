<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('home') }}">Dashboard</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script>
    $(document).ready(function(){
        $("#taskFormSubmit").on('click', function(){
            var user_id = $('#user_id').val();
            var task = $('#taskName').val();
            var status = $('#taskStatus').val();
            //send ajax 
            $.ajax({
                url: "api/todo/add",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    "API_KEY":"helloatg"
                },
                dataType: "json",
                data: {
                    "user_id":user_id,
                    "task":task,
                    "task_status":status
                },
                success: function(result) {
                    sessionStorage.setItem("message", "new task created successfully");
                    window.location.href = "{{ route('home')}}";
                },
                error: function(xhr, resp, text) {
                    console.log(xhr, resp, text);
                }
            })
        });

        $("#taskUpdateSubmit").on('click', function () {
            var task_id = $("#taskid").val();
            var status = $("#updstatus").val();

            $.ajax({
                url:"/api/todo/status",
                type:"POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                    "API_KEY":"helloatg"
                },
                dataType:"json",
                data: {
                    "task_id":task_id,
                    "status":status
                },
                success: function(result) {
                    sessionStorage.setItem("message", "task status updated successfully");
                    window.location.href = "{{ route('home')}}";
                },
                error: function(xhr, resp, text) {
                    console.log(xhr, resp, text);
                }
            })
        });

    });
    
    var data = sessionStorage.getItem('message');
    if(data != undefined) {
        $('#successMessage').html(data)
    }
    else{
        $("#successMessage").hide();
    }
    $(document).ready(function() {
        setTimeout(function() {
            $("#successMessage").hide();
            sessionStorage.removeItem('message');
        }, 3000);
    });
</script>
</html>
