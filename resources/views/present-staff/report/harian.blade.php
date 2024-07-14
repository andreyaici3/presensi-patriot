<x-app-layout-v2 menuOpen="Report Data Staff" title="Laporan Harian Staff" menuActive="Laporan Harian Staff" >
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Laporan Harian Staff</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Laporan Harian Staff
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

         <div class="row">
             <div class="col-12">
                 @if (Session::has('sukses'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <b>Berhasil!!</b> {{ session('sukses') }}
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">×</span>
                         </button>
                     </div>
                 @endif


                 @if (Session::has('gagal'))
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <b>Gagal!!</b> {{ session('gagal') }}
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">×</span>
                         </button>
                     </div>
                 @endif
             </div>
         </div>

         <div class="card-box pd-20 mb-30">
            <div class="pd-20">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input class="form-control date-picker" placeholder="Pilih Tanggal" name="tanggal" type="text" value="{{ request()->tanggal ?? now()->format('d M Y') }}" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="text-white">Action</label>
                                <br>
                                <button type="submit" name="export" class="btn btn-success" value="true">Export PDF</button>
                                <button type="submit" name="filter" class="btn btn-primary" value="true" >Filter</button>
                                <a href="{{ route('manage.report.harianStaff') }}" name="reset" class="btn btn-danger">Reset</a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
         </div>

         <div class="card-box mb-30 pd-20">
            <div class="pd-20">
                <h4>Laporan {{ $rentang }}</h4>
            </div>
             <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No</th>
                            <th>NIP</th>
                            <th>Nama Staff</th>
                            <th>Lama Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $nomor = 1;
                        @endphp
                        @foreach ($absen as $key => $value)
                            <tr>
                                <td class="table-plus">{{ $nomor++ }}</td>
                                <td>{{ $value->nip }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->total_work_duration }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @section('js')
         <script src="{{ asset('pt-v2/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
         <script>
             $('document').ready(function() {
                 $('.data-table').DataTable().destroy();
                 $('.data-table').DataTable({
                     scrollCollape: true,
                     pageLength: 100,
                     scrollX:true,
                     autoWidth: false,
                     responsive: false,
                     columnDefs: [{
                         targets: "datatable-nosort",
                         orderable: false,
                     }],
                     "lengthMenu": [
                         [10, 25, 50, -1],
                         [10, 25, 50, "All"]
                     ],

                     "language": {
                         "info": "_START_-_END_ of _TOTAL_ entries",
                         searchPlaceholder: "Search",
                         paginate: {
                             next: '<i class="ion-chevron-right"></i>',
                             previous: '<i class="ion-chevron-left"></i>'
                         }
                     },
                 });
             })

         </script>
     @endsection
 </x-app-layout-v2>
