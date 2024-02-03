<x-app-layout menuActive="masterStaff" menuOpen="masterStaff">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">DATA MASTER STAFF</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Data Master Staff</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if (Session::has('sukses'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Horee!!</h5>
                        {{ session('sukses') }}
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
                                    <th>NIPP</th>
                                    <th>Nama Staff</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $urut = 1;
                                @endphp
                                @foreach ($staffs as $staff)
                                    <tr>
                                        <td>{{ $urut++ }}</td>
                                        <td>{{ $staff->nik }}</td>
                                        <td>{{ $staff->nama_guru }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td>
                                            <a href="{{ route("wakasek.staff.edit", ["id_staff" => $staff->id]) }}" class="btn btn-xs btn-primary">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            |
                                            <form action="{{ route('wakasek.staff.update', ["id_staff" => $staff->id]) }}" style="display: inline-block;"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Yakin Ingin Menghapus Data')" type="submit" class="btn btn-xs btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col-3">
                <a href="{{ route('wakasek.staff.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> TAMBAH
                    STAFF</a>
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
                    "buttons": ["copy"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>
    @endsection

    @section('css')
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endsection

</x-app-layout>
