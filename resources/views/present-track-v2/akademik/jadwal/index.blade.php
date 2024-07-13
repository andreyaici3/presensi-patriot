<x-app-layout-v2 menuActive="Data Jadwal" title="Data Jadwal">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Kelola Jadwal Pelajaran</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                 Jadwal Pelajaran
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
                                <label>Hari</label>
                                <select name="id_hari" id="" class="form-control">
                                    <option value="1">Senin</option>
                                    <option value="2">Selasa</option>
                                    <option value="3">Rabu</option>
                                    <option value="4">Kamis</option>
                                    <option value="5">Jumat</option>
                                    <option value="6">Sabtu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label class="text-white">Action</label>
                                <br>
                                <button type="submit" name="filter" class="btn btn-primary" value="true" >Filter</button>
                                <a href="{{ route('manage.schedules') }}" name="reset" class="btn btn-danger">Reset</a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
         </div>


        @foreach ($days as $day)
            <div class="card-box mb-30 pd-20">
                <div class="pd-20">
                    <h4 class="text-blue h4">Hari {{ $day->name }}</h4>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th rowspan="2">Waktu</th>
                                @foreach ($majors as $major)
                                    <th colspan="{{ $major->classes->count() }}">{{ $major->name }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($majors as $major)
                                    @foreach ($major->classes as $class)
                                        @if ($class->grade == 'X')
                                            <th>{{ $class->grade . "-" . $class->major->program_keahlian_acronym . "-" . $class->rombel_number }}</th>
                                        @else
                                            <th>{{ $class->grade . "-" . $class->major->konsentrasi_keahlian_acronym . "-" . $class->rombel_number }}</th>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($day->timeSlots as $timeSlot)
                                <tr>
                                    <td>{{ $timeSlot->start_time }} - {{ $timeSlot->end_time }} (Jam Ke: {{ $timeSlot->jam_ke }})</td>
                                    @foreach ($majors as $major)
                                        @foreach ($major->classes as $rombel)
                                            <td>
                                                <select id="slot-{{ $timeSlot->id }}-class-{{ $rombel->id }}" class="form-control change-schedulles" name="teacher_id[{{ $timeSlot->id }}][{{ $rombel->id }}]">
                                                    <option value="init">KD</option>
                                                    @foreach ($teachers as $teacher)
                                                        @php
                                                            $isSelected = false;

                                                            $schedule = $schedules->where('class_id', $rombel->id)
                                                                                    ->where('day_time_slot_id', $timeSlot->id)
                                                                                    ->where('teacher_id', $teacher->id)
                                                                                    ->first();
                                                            if ($schedule){
                                                                $isSelected = true;
                                                            }

                                                        @endphp
                                                        <option {{ $isSelected ? 'selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->kode_guru }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    @section('head')
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @endsection

    @section('js')
         <script src="{{ asset('pt-v2/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
         <script>
             $('document').ready(function() {
                 $('.data-table').DataTable().destroy();
                 $('.data-table').DataTable({
                    scrollX: true,
                     scrollCollapse: false,
                     autoWidth: true,
                     responsive: false,
                     pageLength: 20,
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

                var values = {};
                $('.change-schedulles').each(function() {
                    var selectId = $(this).attr('id');
                    values[selectId] = $(this).val();
                });

                // Event onchange untuk setiap select
                $('.change-schedulles').on('change', function() {
                    var selectId = $(this).attr('id');
                    var currentValue = $(this).val(); // Nilai saat ini
                    var previousValue = values[selectId]; // Nilai sebelumnya
                    values[selectId] = currentValue;

                    swal({
                        title: 'Konfirmasi Edit',
                        text: "Apakah Kamu Akan Mengubah Data Tersebut",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        confirmButtonText: 'Simpan Perubahan'
                    }).then(function (result) {
                        if (result.value){
                            var url = "{{ route('manage.schedules.saveChanges') }}";
                            axios.put(url, {
                                slot: selectId,
                                previous: previousValue,
                                currentValue: currentValue
                            })
                            .then(function (response) {
                                if (response.data == true){
                                    swal(
                                        {
                                            position: 'top-end',
                                            type: 'success',
                                            title: 'Perubahan berhasil Disimpan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }
                                    )
                                } else {
                                    swal(
                                        {
                                            position: 'top-end',
                                            type: 'error',
                                            title: 'Perubahan Gagal Disimpan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }
                                    )
                                }
                            })
                            .catch(function (error) {
                                swal(
                                        {
                                            position: 'top-end',
                                            type: 'error',
                                            title: 'Perubahan Gagal Disimpan',
                                            showConfirmButton: false,
                                            timer: 1500
                                        }
                                    )
                            });
                        } else if (result.dismiss){
                            document.getElementById(selectId).value = previousValue;
                            values[selectId] = previousValue;
                            swal(
                                {
                                    position: 'top-end',
                                    type: 'error',
                                    title: 'Perubahan Gagal Disimpan',
                                    showConfirmButton: false,
                                    timer: 1500
                                }
                            )
                        }
                    })
                });
             })
         </script>
     @endsection
 </x-app-layout-v2>
