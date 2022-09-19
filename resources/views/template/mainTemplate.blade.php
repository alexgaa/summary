<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Summary Gamov AA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/summary.css')}}">
</head>
<body>
<header class="p-3 text-bg-dark mb-2 sticky-top">
        <div class="container" >
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <p class="mb-2 mb-md-0 justify-content-center"> GAA</p>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{route('main')}}" class="nav-link px-2 text-secondary">Home</a></li>
                    @auth
                        @if(auth()->user()->user_type === 1)
                            <li><a href="{{route('admin.index')}}" class="nav-link px-2 text-white">Admin</a></li>
                        @endif
                    @endauth
                    <li><a href="{{route('about')}}" class="nav-link px-2 text-white">About</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..." aria-label="Search">
                </form>

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
    <div class="row g-2 ">
        <div class="col-3 ">
            <div class="p-3 m-2 border bg-light rounded-3">
                Menu `<br><br><br>
            </div>
        </div>
        <div class="col-9">
            <div class="p-3 m-2 bg-light border rounded-3">
                @yield('content')
            </div>

        </div>
    </div>
</div>
{{--    <div class="b-example-divider"> </div>--}}
    <div class="container">
        <footer class="py-1 my-0">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="{{route('main')}}" class="nav-link px-2 text-muted">Home</a></li>
                @auth
                    @if(auth()->user()->user_type === 1)
                        <li class="nav-item"><a href="{{route('admin.index')}}" class="nav-link px-2 text-muted">Admin</a></li>
                       @endif
                @endauth
                <li class="nav-item"><a href="{{route('about')}}" class="nav-link px-2 text-muted">About</a></li>
            </ul>
            <p class="text-center text-muted">© 2022 Gamov Aleksey</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>
