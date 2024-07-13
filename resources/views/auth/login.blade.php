<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Present Track</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('pt-v2/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('pt-v2/assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        @if (Session::has('sukses'))
                        <div class="alert alert-success" role="alert">
                            <b>Berhasil!!</b> {{ session('sukses') }}
                        </div>
                        @endif

                        @if (Session::has('gagal'))
                        <div class="alert alert-danger" role="alert">
                            <b>Gagal!!</b> {{ session('gagal') }}
                        </div>
                        @endif
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{ route('home') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('pt-v2/assets/images/logos/pt-v2-logo.png') }}" width="80%" alt="">
                                </a>
                                <p class="text-center">Masuk Untuk Melanjutkan</p>
                                <form method="post" action="{{ route('auth.authenticate') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">Alamat Email</label>
                                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="inputEmail" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" placeholder="masukan email disini">
                                        <span id="inputEmail-error" class="error invalid-feedback">
                                            {{ $errors->has('email') ? '*) ' . $errors->first('email') : '' }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <label for="inputPassword" class="form-label">Kata Sandi</label>
                                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="inputPassword" name="password" placeholder="masukan password disini">
                                        <span id="inputPassword-error" class="error invalid-feedback">
                                            {{ $errors->has('password') ? '*) ' . $errors->first('password') : '' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" name="remember" id="flexCheckChecked">
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Biarkan Saya Tetap Masuk
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Masuk</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('pt-v2/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('pt-v2/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
