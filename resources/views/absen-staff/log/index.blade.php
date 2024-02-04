<x-app-layout menuActive="logStaff">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">LOG ABSEN STAFF</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Log Absen</li>
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
                                    <th width="10" class="text-center" rowspan="2">No</th>

                                    <th width="200" class="text-center" rowspan="2">Kode Guru</th>
                                    <th class="text-center" rowspan="2">Tanggal Absen</th>
                                    <th class="text-center" colspan="2">Absen</th>
                                    <th class="text-center" rowspan="2">Lama Kerja</th>
                                </tr>
                                <tr>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $nomor = 1;
                                @endphp
                                @foreach ($absensi as $value)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>

                                        <td>{{ $value->kode_staff }}</td>

                                        <td>
                                            {{ $value->tanggal_absen }}
                                        </td>
                                        <td>
                                            @if ($value->absen_masuk == 1)
                                                <span class="badge badge-primary">Sudah</span>
                                                {{ $value->jam_masuk }}
                                            @else
                                                <span class="badge badge-danger">Belum</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($value->absen_keluar == 1)
                                                <span class="badge badge-primary">Sudah</span>
                                                {{ $value->jam_keluar }}
                                            @else
                                                <span class="badge badge-danger">Belum</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($value->absen_keluar == 0)
                                                <span class="badge badge-primary">Jam Kerja Sedang Berlangsung</span>
                                            @else
                                                @php
                                                    $totalDuration = \Carbon\Carbon::parse($value->jam_masuk)->diffInSeconds(\Carbon\Carbon::parse($value->jam_keluar));
                                                    
                                                @endphp
                                                <span style="font-size: 20px; font-weight: bold;">
                                                    {{ gmdate('H:i:s', $totalDuration); }}
                                                </span>
                                                
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
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
            });
        </script>
    @endsection

    @section('css')
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endsection

</x-app-layout>
