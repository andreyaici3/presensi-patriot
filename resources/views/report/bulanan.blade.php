<x-app-layout menuOpen="report" menuActive="bulanan">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">DATA REPORT BULANAN</h1>
            <h3><b>{{ $tanggal['awal'] }} - {{ $tanggal['akhir'] }}</b></h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Report Bulanan</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-1 col-md-12">
                                    <div class="form-group">
                                        <label for="">Dari</label>
                                        <select name="start_month" class="form-control" id="">
                                            <option {{ (date('m') == '01') ? 'selected' : '' }} value="01">Januari</option>
                                            <option {{ (date('m') == '02') ? 'selected' : '' }} value="02">Februari</option>
                                            <option {{ (date('m') == '03') ? 'selected' : '' }} value="03">Maret</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '04') ? 'selected' : '' }} value="04">April</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '05') ? 'selected' : '' }} value="05">Mei</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '06') ? 'selected' : '' }} value="06">Juni</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '07') ? 'selected' : '' }} value="07">Juli</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '08') ? 'selected' : '' }} value="08">Agustus</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '09') ? 'selected' : '' }} value="09">September</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '10') ? 'selected' : '' }} value="10">Oktober</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '11') ? 'selected' : '' }} value="11">November</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '12') ? 'selected' : '' }} value="12">Desember</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-12">
                                    <div class="form-group">
                                        <label for="" class="text-white">Tahun</label>
                                        <select name="start_year" class="form-control" id="">
                                            <option {{ (date('Y') == '2023') ? 'selected' : '' }} value="2023">2023</option {{ (date('Y') == '2024') ? 'selected' : '' }}>
                                            <option {{ (date('Y') == '2024') ? 'selected' : '' }} value="2024">2024</option {{ (date('Y') == '2024') ? 'selected' : '' }}>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-12">
                                    <div class="form-group">
                                        <label for="">Sampai</label>
                                        <select name="end_month" class="form-control" id="">
                                            <option {{ (date('m') == '01') ? 'selected' : '' }} value="01">Januari</option>
                                            <option {{ (date('m') == '02') ? 'selected' : '' }} value="02">Februari</option>
                                            <option {{ (date('m') == '03') ? 'selected' : '' }} value="03">Maret</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '04') ? 'selected' : '' }} value="04">April</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '05') ? 'selected' : '' }} value="05">Mei</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '06') ? 'selected' : '' }} value="06">Juni</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '07') ? 'selected' : '' }} value="07">Juli</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '08') ? 'selected' : '' }} value="08">Agustus</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '09') ? 'selected' : '' }} value="09">September</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '10') ? 'selected' : '' }} value="10">Oktober</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '11') ? 'selected' : '' }} value="11">November</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                            <option {{ (date('m') == '12') ? 'selected' : '' }} value="12">Desember</option {{ (date('m') == '01') ? 'selected' : '' }}>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-12">
                                    <div class="form-group">
                                        <label for="" class="text-white">Tahun</label>
                                        <select name="end_year" class="form-control" id="">
                                            <option {{ (date('Y') == '2023') ? 'selected' : '' }} value="2023">2023</option {{ (date('Y') == '2024') ? 'selected' : '' }}>
                                            <option {{ (date('Y') == '2024') ? 'selected' : '' }} value="2024">2024</option {{ (date('Y') == '2024') ? 'selected' : '' }}>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <div class="form-group">
                                        <label for="" class="text-white">Submit</label>
                                        <br>
                                        <button name="filter" value="on" type="submit" class="btn btn-primary">Filter</button>
                                        <button type="submit" value="on" name="export" class="btn btn-success">Export PDF</button>
                                    </div>
                                </div>

                            </div>
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
                                                @if ($value->jamSeluruhnya != 0)
                                                    <span class="badge badge-primary">
                                                        @php
                                                            if ($value->jamTerpakai > 0) {
                                                                if ($value->jamSeluruhnya > 0){
                                                                    $sepersen = number_format(($value->jamTerpakai / $value->jamSeluruhnya) * 100, 2);
                                                                } else {
                                                                    $sepersen = number_format($value->jamTerpakai, 2);
                                                                }

                                                            } else {
                                                                $sepersen = '0';
                                                            }
                                                        @endphp
                                                        {{ $sepersen . ' %' }}
                                                    </span>
                                                    @else
                                                    <span class="badge badge-warning">
                                                        Tidak Ada Jam Mengajar
                                                    </span>
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">{{ $value->jamTerpakai }} /
                                                {{ $value->jamSeluruhnya }} Jam
                                            </span>
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
