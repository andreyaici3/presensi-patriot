<x-app-layout menuActive="operator">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">TAMBAH DATA OPERATOR</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/guru">Data Operator</a></li>
            <li class="breadcrumb-item active">Tambah Data Operator</li>
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


                    <form class="form-horizontal" action="{{ route('operator.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama Operator</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder="Masukan Nama Guru" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" placeholder="password" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role" id="role" class="form-control">
                                        <option value="kepsek">Kepala Sekolah</option>
                                        <option value="ict">Information Center</option>
                                        <option value="user">Kurikulum</option>
                                    </select>
                                </div>
                            </div>
                    

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Tambah Data</button>
                            <a href="{{ route('operator.index') }}" class="btn btn-default float-right">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>