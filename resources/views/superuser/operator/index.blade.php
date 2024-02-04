<x-app-layout menuActive="operator">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">DATA OPERATOR</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Operator</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (Session::has('sukses'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                        {{ session('sukses') }}
                    </div>
                @endif

                @if (Session::has('gagal'))
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
                                    <th>Email</th>
                                    <th>Nama Guru</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($operator as $value)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->name }}</td>

                                        <td>
                                            @php
                                                switch ($value->role) {
                                                    case 'kepsek':
                                                        $role = 'Kepala Sekolah';
                                                        break;
                                                    case 'ict':
                                                        $role = 'Information Center';
                                                        break;
                                                    case 'user':
                                                        $role = 'Bid. Kurikulum';
                                                        break;
                                                    case 'wakasek':
                                                        $role = 'Wakasek';
                                                        break;
                                                    case 'bidSiswa':
                                                        $role = 'Bid. Kesiswaan';
                                                        break;
                                                    default:
                                                        $role = 'Tidak Ditemukan';
                                                        break;
                                                }
                                            @endphp

                                            {{ $role }}
                                        </td>

                                        <td>
                                            <a href="{{ route('superuser.operator.edit', ['id' => $value->id]) }}"
                                                class="btn btn-xs btn-primary">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            |
                                            <a onClick="hapus(this.dataset.id)" class="btn btn-xs btn-danger"
                                                data-id="{{ $value->id }}">
                                                <form
                                                    action="{{ route('superuser.operator.delete', ['id' => $value->id]) }}"
                                                    method="post" id="operatorDelete{{ $value->id }}">
                                                    @csrf
                                                    @method('delete')
                                                    <i class="fas fa-trash"></i>
                                                    Hapus
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
                <a href="{{ route('superuser.operator.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                    TAMBAH
                    OPERATOR</a>
            </div>
        </div>
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



        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "ordering": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


            });
        </script>

        <script>
            function hapus(id) {


                Swal.fire({
                    title: "Yakin Ingin Menghapus Operator?",
                    showDenyButton: true,
                    confirmButtonText: "Oke!",
                    denyButtonText: `Batal`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        var form = $("#operatorDelete" + id).submit();
                    } else if (result.isDenied) {
                        Swal.fire("Aksi Dibatalkan", "", "info");
                    }
                });
            }
        </script>
    @endsection

    @section('css')
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endsection

</x-app-layout>
