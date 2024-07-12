<x-app-layout-v2 menuActive="Telegram User" title="Tambah Akun Telegram">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Tambah Akun Telegram</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                             <a href="{{ route('manage.tg') }}">Data User Telegram</a>
                         </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                 Tambah Akun Telegram
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
         <div class="col-12">
             @if (Session::has('sukses'))
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                     <b>Berhasil!!</b> {{ session('sukses') }}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
             @endif


             @if (Session::has('gagal'))
                 <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <b>Gagal!!</b> {{ session('gagal') }}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">×</span>
                     </button>
                 </div>
             @endif
         </div>
     </div>

     <div class="pd-20 card-box mb-30">
         <form method="POST" action="">
             @csrf
             @include('present-track-v2.superadmin.telegram-account.form')
             <button type="submit" class="btn btn-primary">Tambah Data</button>
         </form>
     </div>

    </div>
 </x-app-layout-v2>
