<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">

        body {
            background: #f4f4f4;
        }

        .banner {
            background: #a770ef;
            background-image: url(https://smkpatriot-kng.sch.id/media_library/image_sliders/549b1815dc9edc3f11e7021c91c184a2.jpg);
            background: -webkit-linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
            background: linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b);
        }

    </style>
    <title>MONITOR KELAS</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="px-lg-5">

          <!-- For demo purpose -->
          <div class="row py-5">
            <div class="col-lg-12 mx-auto">
              <div class="text-white p-5 shadow-sm rounded banner text-center">
                <h1 class="display-6">SMK MODEL PATRIOT IV CIAWIGEBANG</h1>
                <p class="lead">Monitor Kelas - {{ Carbon\Carbon::now()->translatedFormat('l, j F Y'); }} </p>
                <p class="lead">Created by <a href="" class="text-reset">
                              Andrey Andriansyah, S.Kom</a>
                </p>
              </div>
            </div>
          </div>
          <!-- End -->

          @foreach ($majors as $major)
            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h1>{{ Str::upper($major->name) }}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($major->classes as $class)
                    @php
                        $scheduleExists = false;
                        foreach ($class->scheduless as $schedule) {
                            if ($schedule->timeSlot->day->name === $hariSekarang &&
                                Carbon\Carbon::now()->between($schedule->timeSlot->start_time, $schedule->timeSlot->end_time)) {
                                $scheduleExists = true;
                                $teacher_id = $schedule->teacher->id;
                                $classes_id = $schedule->class_id;
                                $guru = $schedule->teacher->first_name . " " . $schedule->teacher->last_name;
                                $ket = "Jam Ke: ".$schedule->timeSlot->jam_ke . " => " . $schedule->timeSlot->start_time . " s/d " . $schedule->timeSlot->end_time;
                                 $status = App\Models\Attendance::where([
                                    ["teacher_id", "=", $teacher_id],
                                    ["class_id", "=", $classes_id],
                                ])->whereDate('attendance_time', Carbon\Carbon::now()->toDateString());

                                break;
                            }
                        }
                    @endphp
                    <!-- Gallery item -->
                    <div class="col-sm-3 mb-4">
                        <div class="bg-white rounded shadow-sm">
                            @if($scheduleExists)
                                @php
                                    $attendances = $class->attendance;
                                @endphp

                                @foreach ($class->scheduless as $schedule)
                                    @php
                                        $timeSlot = $schedule->timeSlot;
                                        $isCurrentTimeSlot = $currentDate->between(Carbon\Carbon::parse($timeSlot->start_time), Carbon\Carbon::parse($timeSlot->end_time));
                                        $isAlreadyAttended = $attendances->contains(function ($attendance) use ($schedule) {
                                            return $attendance->schedule_id == $schedule->id;
                                        });
                                    @endphp
                                @endforeach

                                @switch(@$status->get()[$status->get()->count()-1]->status)
                                    @case('present')
                                        <img src="{{ asset('pt-v2/assets/images/logos/present.jpg') }}" alt="" class="img-fluid card-img-top">
                                        @break
                                    @case('sick')
                                        <img src="{{ asset('pt-v2/assets/images/logos/sick.jpg') }}" alt="" class="img-fluid card-img-top">
                                        @break
                                    @case('permission')
                                        <img src="{{ asset('pt-v2/assets/images/logos/permission.jpg') }}" alt="" class="img-fluid card-img-top">
                                        @break
                                    @default
                                        <img src="{{ asset('pt-v2/assets/images/logos/no_absen.jpg') }}" alt="" class="img-fluid card-img-top">
                                        @break
                                @endswitch

                                <div class="p-4">
                                <h4>
                                    <a href="#" class="text-dark"><b>{{ $guru }}</b></a>
                                </h4>
                                    @if ($class->grade == 'X')
                                        <h6 class="mb-4">
                                            <i>{{ $class->grade . " " . $class->major->program_keahlian_acronym . " " . $class->rombel_number }}</i>
                                        </h6>
                                    @else
                                        <h6 class="mb-4">
                                            <i>{{ $class->grade . " " . $class->major->konsentrasi_keahlian_acronym . " " . $class->rombel_number }}</i>
                                        </h6>
                                    @endif
                                @php
                                    $hasil = \App\Models\Schedulles::getSchedullesByToday($classes_id, $teacher_id);
                                @endphp

                                @foreach ($hasil->get() as $jdw)
                                    <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mb-1">
                                        <p class="small mb-0"><i class="fa fa-picture-o mr-2"></i><span class="font-weight-bold">{{ "Jam Ke: ". $jdw->timeSlot->jam_ke . " - " .$jdw->timeSlot->start_time }} - {{ $jdw->timeSlot->end_time }}</span></p>

                                        @switch(@$jdw->attendance->status)
                                            @case("present")
                                                <div class="badge badge-success px-3 rounded-pill font-weight-normal">Hadir</div>
                                                @break
                                            @case("late")
                                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">Telat</div>
                                                @break
                                            @case("sick")
                                                <div class="badge badge-info px-3 rounded-pill font-weight-normal">Sakit</div>
                                                @break
                                            @case("permission")
                                                <div class="badge badge-warning px-3 rounded-pill font-weight-normal">Izin</div>
                                                @break
                                            @default
                                                <div class="badge badge-danger px-3 rounded-pill font-weight-normal">Belum Hadir</div>
                                                @break
                                        @endswitch
                                    </div>
                                @endforeach
                                </div>
                            @else
                            <img src="{{ asset('pt-v2/assets/images/logos/no_schedule.jpg') }}" alt="" class="img-fluid card-img-top">
                                <div class="p-4">
                                <h4> <a href="#" class="text-dark"><b>Tidak Ada Jadwal</b></a></h4>
                                @if ($class->grade == 'X')
                                    <h6 class="mb-4">
                                        <i>{{ $class->grade . "-" . $class->major->program_keahlian_acronym . "-" . $class->rombel_number }}</i>
                                    </h6>
                                @else
                                    <h6 class="mb-4">
                                        <i>{{ $class->grade . "-" . $class->major->konsentrasi_keahlian_acronym . "-" . $class->rombel_number }}</i>
                                    </h6>
                                @endif
                                <p class="text-danger mb-0"><i>Silahkan Hubungi Adminisitrator Untuk Mengetahui Penyebab Tidak Ada Jadwal</i></p>

                                </div>
                            @endif

                        </div>
                    </div>
                    <!-- End -->
                @endforeach
            </div>
          @endforeach
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
