<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/datakelembaban.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    {{-- header --}}
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">
                <img src="{{ asset('image/logo.png') }}" alt="" width="100">
            </a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        <a class="navbar-brand me-auto" href="#">
                            <img src="{{ asset('image/logo.png') }}" alt="" width="100">
                        </a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-5">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" aria-current="page" href="/owner/datakelembaban">Data
                                Kelembaban</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="#">List Tugas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3 active" href="">Data Karyawan</a>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('image/profile.png') }}" alt="" width="40px">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-item userdropdown">
                            <img src="{{ asset('image/profile.png') }}" alt="" width="40px">&nbsp
                            {{ $user->name }}
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item isidropdown1" href="/owner/profil"><img
                                    src="{{ asset('image/profile.png') }}" alt=""
                                    width="20px">&nbsp&nbspProfile
                                <span>></span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item isidropdown2 mt-2" href="/logout"><img
                                    src="{{ asset('image/logout.png') }}" alt=""
                                    width="20px">&nbsp&nbspLogout
                                <span>></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    {{-- header end --}}

    {{-- content --}}


</body>
