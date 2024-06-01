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
    <link href="{{ asset('css/gantiprofil.css') }}" rel="stylesheet">
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
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-5">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" aria-current="page" href="/kepalakandang/datakelembaban">Data
                                Kelembaban</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="/kepalakandang/listtugas">List Tugas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="/kepalakandang/datakaryawan">Data Karyawan</a>
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
                            <a class="dropdown-item isidropdown1" href="/kepalakandang/profil"><img
                                    src="{{ asset('image/profile.png') }}" alt=""
                                    width="30px">&nbsp&nbspProfile
                                <span>></span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item isidropdown2 mt-2" href="/logout"><img
                                    src="{{ asset('image/logout.png') }}" alt="" width="30px">&nbsp&nbspLogout
                                <span>></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    {{-- header end --}}

    <!-- content -->
    <div class="container-fluid content">
        <div class="container containerprofil">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('image/profile.png') }}" alt="" width="200px" class="gambar">
                </div>
                <div class="col-md-7">
                    <div class="formgantiprofil">
                        <div class="alert">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ implode(', ', $errors->all()) }}
                                </div>
                            @endif
                        </div>
                        <form action="" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputNama3" class="col-sm-4 col-form-label"><i class="fa-solid fa-user"></i>
                                    Masukkan Nama Baru</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="username" name="username"
                                        value="{{ old('username') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label"><i
                                        class="fa-solid fa-envelope"></i> Masukkan Email Baru</label>
                                <div class="col-sm-6">
                                    <input type="" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNomorhp3" class="col-sm-4 col-form-label"><i
                                        class="fa-solid fa-phone"></i> Masukkan Nomor Baru</label>
                                <div class="col-sm-6">
                                    <input type="" class="form-control" id="nomerhp" name="nomerhp"
                                        value="{{ old('nomerhp') }}" required>
                                </div>
                            </div>
                            <div class="">
                                <button type="button" class="btn-batal"><a href="/kepalakandang/profil">Batal</a></button>
                                <input type="submit" class="submit" value="Konfirmasi Perubahan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content end -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/gantiprofil.js') }}"></script>
</body>

</html>
