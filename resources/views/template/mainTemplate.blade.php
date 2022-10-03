<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Summary Gamov AA</title>
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/summary.css')}}">
</head>
<body>
<header class="p-3 bg-dark mb-2 sticky-top">
        <div class="container" >
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <p class="mb-2 mb-md-0 justify-content-center"> GAA</p>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{route('main')}}" class="nav-link px-2 text-secondary">Home</a></li>
                    @auth
                            <li><a href="{{route('admin.index')}}" class="nav-link px-2 text-white">Constructor</a></li>
                    @endauth
                    <li><a href="{{route('about')}}" class="nav-link px-2 text-white">About</a></li>
                </ul>
                <div class="text-end">
                    @auth
                        <a href="{{route('logout')}}" type="button" class="btn btn-warning me-2">Logout</a>
                    @else
                        <a href="{{route('registerUser.create')}}" type="button" class="btn btn-outline-light me-2">Registration</a>
                        <a href="{{route('login.create')}}" type="button" class="btn btn-outline-light me-2">Login</a>
                    @endauth

                </div>
            </div>
        </div>
    </header>

<div class="container-fluid pb-2">
    <div class="row g-2">
        <div class="col-3">
            <div id='menu-left' class="p-3 m-2 border bg-light rounded-3">
                @yield('menu-left')
            </div>
        </div>
        <div class="col-9">
            <div id='center-content' class="p-3 m-2 bg-light border rounded-3">
                @yield('content')
            </div>

        </div>
    </div>
</div>
    <div class="container">
        <footer class="py-1 my-0">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="{{route('main')}}" class="nav-link px-2 text-muted">Home</a></li>
                @auth
                    <li class="nav-item"><a href="{{route('admin.index')}}" class="nav-link px-2 text-muted">Constructor Summary </a></li>
                @endauth
                <li class="nav-item"><a href="{{route('about')}}" class="nav-link px-2 text-muted">About</a></li>
            </ul>
            <p class="text-center text-muted">© 2022 Gamov Aleksey</p>
        </footer>
    </div>









<!-- Вариант 1: Bootstrap в связке с Popper -->

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>--}}
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{asset('js/my_js.js')}}"></script>

</body>
</html>
