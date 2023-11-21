<x-app-layout menuActive="guru" menuOpen="master">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">TAMBAH DATA GURU</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/guru">Data Guru</a></li>
            <li class="breadcrumb-item active">Tambah Data Guru</li>
        </ol>
    </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Mohon Isikan Data dengan Benar</h3>
                    </div>


                    <form class="form-horizontal" action="/guru" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="kdGuru" class="col-sm-2 col-form-label">Kode Guru</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="kdGuru" placeholder="Masukan Kode Guru" name="kdGuru">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nik" class="col-sm-2 col-form-label">Nomor Induk Kependudukan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="nik" placeholder="Masukan Kode NIK" name="nik">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Lengkap" name="nama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                                </div>
                            </div>
                        
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Tambah Data</button>
                            <a href="/guru" class="btn btn-default float-right">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>