<x-app-layout menuActive="akunStaff" menuOpen="masterStaff">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">DATA AKUN STAFF</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Akun Staff</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                @if (session('sukses'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                        {{ session('sukses') }}
                    </div>
                @endif

                @if (session('gagal'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
                        {{ session('gagal') }}
                    </div>
                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($akun as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <span class="badge badge-primary">{{ $value->guru->kode_guru }}
                                            </span> -
                                            {{ $value->guru->nama_guru }}
                                        </td>
                                        <td>{{ $value->email }}</td>
                                        <td>
                                            @if ($value->session_android != null)
                                                <span class="badge badge-danger">LOCKED</span>
                                            @else
                                                <span class="badge badge-primary">UNLOCKED</span>
                                            @endif
                                        <td>
                                            @if ($value->session_android)
                                                <a class="btn btn-xs btn-danger" onclick="">
                                                    <form action="{{ route('akun.reset', ['id' => $value->id]) }}"
                                                        method="post" id="form{{ $value->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        RESET AKUN
                                                    </form>
                                                </a>
                                            @endif

                                            <a class="btn btn-xs btn-danger btn-reset-akun" onclick="deleteAkun()">
                                                <form action="{{ route('wakasek.staff.akun.delete', ['id_akun' => $value->id]) }}"
                                                    method="post" id="formDelete">
                                                    @csrf
                                                    @method('delete')
                                                    HAPUS AKUN
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    <i class="fas fa-plus"></i> TAMBAH AKUN STAFF
                </button>
            </div>
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <form action="{{ route('wakasek.staff.akun.create') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Akun Staff</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Staff">Nama Staff</label>
                                        <select class="form-control select2" style="width: 100%;" name="email">
                                            @foreach ($user as $value)
                                                <option value="{{ $value->email }}">{{ $value->nama_guru }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>


    <div class="msg">

    </div>

    @section('js')
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="/plugins/jszip/jszip.min.js"></script>
        <script src="/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/plugins/select2/js/select2.full.min.js"></script>


        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('.select2').select2()
            });
        </script>

        <script>

            function deleteAkun(){
                Swal.fire({
                    title: "Yakin Hapus Data Akun Staff?",
                    showDenyButton: true,
                    confirmButtonText: "Oke!",
                    denyButtonText: `Batal`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var form = $("#formDelete").submit();
                    } else if (result.isDenied) {
                        Swal.fire("Data Tidak Dihapus", "", "info");
                    }
                });
            }

            
        </script>
    @endsection

    @section('css')
        <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endsection

</x-app-layout>
