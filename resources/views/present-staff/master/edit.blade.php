<x-app-layout-v2 menuActive="Data Staff" menuOpen="Master Data" title="Edit Data Staff">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Tambah Data Staff</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                             <a href="{{ route('manage.staff') }}">Data Staff</a>
                         </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                 Edit Data
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
         <form method="POST" action="{{ route('manage.staff.edit', ['id' => $data->id]) }}">
             @csrf
             @method('PUT')
             @include('present-staff.master.form')
             <button type="submit" class="btn btn-primary">Simpan Data</button>
         </form>
     </div>

    </div>
 </x-app-layout-v2>
