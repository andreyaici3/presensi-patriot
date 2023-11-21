
<x-app-layout menuActive="waktu" menuOpen="master">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">EDIT DATA JAM</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/waktu">Data JAM</a></li>
            <li class="breadcrumb-item active">Edit Data JAM</li>
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


                    <form class="form-horizontal" action="/waktu/{{ $jam->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="Mulai" class="col-sm-2 col-form-label">Mulai</label>
                                <div class="col-sm-2">
                                    <input type="time" id="24h" class="form-control" name="mulai" value="{{ $jam->mulai }}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="selesai" class="col-sm-2 col-form-label">Selesai</label>
                                <div class="col-sm-2">
                                    <input type="time" name="selesai" id="24h" class="form-control" value="{{ $jam->selesai }}"/>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Simpan Data</button>
                            <a href="/waktu" class="btn btn-default float-right">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>