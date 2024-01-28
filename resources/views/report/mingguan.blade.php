<x-app-layout menuOpen="report" menuActive="mingguan">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">DATA REPORT MINGGUAN</h1>
            <h3><b>{{ $tanggal['awal'] }} - {{ $tanggal['akhir'] }}</b></h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Report Mingguan</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" name="filter">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal">Pilih Tanggal</label>
                                <input type="date" name="date" id="" class="form-control"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari Data
                            </button>
                            <button type="button" class="btn btn-danger" name="expdf"><i class="fas fa-file-pdf"></i> Export Pdf</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NIPP</th>
                                    <th>Kode - Nama Guru</th>
                                    <th>Persentasi Kehadiran</th>
                                    <th>Jumlah Jam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($report as $value)
                                    <tr>
                                        <td>{{ $value->nik }}</td>
                                        <td>
                                            <span class="badge badge-md badge-primary">
                                                {{ $value->kode_guru }}
                                            </span> - {{ $value->nama_guru }}

                                        </td>
                                        <td>
                                            <a href="/jadwal/{{ $value->kode_guru }}/filter">
                                                <span class="badge badge-primary">
                                                    @php
                                                        if ($value->jamTerpakai > 0) {
                                                            $sepersen = number_format(($value->jamTerpakai / $value->jamSeluruhnya) * 100, 2);
                                                        } else {
                                                            $sepersen = '0';
                                                        }

                                                    @endphp
                                                    {{ $sepersen . ' %' }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">{{ $value->jamTerpakai }} /
                                                {{ $value->jamSeluruhnya }} Jam
                                            </span> -
                                        </td>
                                        <td>
                                            <a href="/guru/{{ $value->id }}/view" class="btn btn-xs btn-success">
                                                <i class="fas fa-eye"></i>
                                                Detail
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
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $("button[name=expdf]").click(function(){
                    var component = $("form[name='filter']");
                    component.attr("action", "{{ route('report.mingguan.export') }}");
                    component.submit();
                })
            });
        </script>
    @endsection

    @section('css')
        <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    @endsection

</x-app-layout>
