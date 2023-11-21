<x-app-layout menuActive="jurusan" menuOpen="master">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">TAMBAH DATA JURUSAN</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/jutrusan">Data Jurusan</a></li>
            <li class="breadcrumb-item active">Tambah Data Jurusan</li>
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


                    <form class="form-horizontal" action="/jurusan" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="kdJurusan" class="col-sm-2 col-form-label">Kode Jurusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kdJurusan" placeholder="Masukan Kode Jurusan" name="kdJurusan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_jurusan" class="col-sm-2 col-form-label">Nama Jurusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_jurusan" placeholder="Masukan Nama" name="nama_jurusan">
                                </div>
                            </div>                        
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Tambah Data</button>
                            <a href="/jurusan" class="btn btn-default float-right">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>