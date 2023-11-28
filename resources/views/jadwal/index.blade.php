<x-app-layout menuActive="jadwal" menuOpen="master">
    @section('breadcrumb')
    <div class="col-sm-6">
        <h1 class="m-0">DATA JADWAL</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Data Jadwal</li>
        </ol>
    </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Guru</th>
                                    <th>Hari</th>
                                    <th>Jam Ke</th>

                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $value)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <span class="badge badge-md badge-primary">
                                            {{ $value->kode_guru }}
                                        </span> - {{ $value->guru->nama_guru}}

                                    </td>
                                    <td>{{ $value->master_jadwal->hari->nama }}</td>
                                    <td>
                                        <span class="badge badge-md badge-danger">
                                            {{ $value->master_jadwal->jam_ke }}
                                        </span> -
                                        <span class="badge badge-md badge-success">
                                            {{ $value->master_jadwal->jam->mulai . " s/d " .  $value->master_jadwal->jam->selesai}}
                                        </span>
                                    </td>


                                    <td>
                                        {{ $value->kelas->nama_kelas }} - {{ $value->kelas->jurusan->kode_jurusan }} - {{ $value->kelas->rombel }}
                                    </td>
                                    <td>
                                        <form action="/jadwal/delete/{{ $value->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Hari</th>
                                    <th>Kode Guru</th>
                                    <th>Hari</th>
                                    <th>Jam Ke</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <a href="/jadwal/create" class="btn btn-primary"><i class="fas fa-plus"></i> TAMBAH JADWAL</a>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    @endsection

    @section('css')
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endsection
</x-app-layout>