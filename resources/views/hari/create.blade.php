<x-app-layout menuOpen="master" menuActive="hari">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">TAMBAH DATA GURU</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/hari">Data Hari</a></li>
            <li class="breadcrumb-item active">Tambah Data Hari</li>
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


                    <form class="form-horizontal" action="/hari" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="hari" class="col-sm-2 col-form-label">Kode Guru</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="hari" placeholder="Masukan Nama Hari" name="hari">
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