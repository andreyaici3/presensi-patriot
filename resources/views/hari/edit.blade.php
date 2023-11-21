<x-app-layout menuOpen="master" menuActive="master-jadwal">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">TAMBAH DATA HARI</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/hari">Data Hari</a></li>
            <li class="breadcrumb-item active">Edit Data Hari</li>
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


                    <form class="form-horizontal" action="/hari/{{ $hari->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="hari" placeholder="Masukan Nama Hari" name="hari" value="{{ $hari->nama }}">
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Simpan Data</button>
                            <a href="/hari" class="btn btn-default float-right">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>