<x-app-layout menuActive="dashboard">
    @section('breadcrumb')
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div><!-- /.col -->
    @endsection

    <div class="row">
        <div class="col-12">

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4 class="card-title">Keadaan Kelas Hari Ini</h4>
                </div>
                <div class="card-body">
                    <div>
                        <div class="btn-group w-100 mb-2">
                            <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> SEMUA JURUSAN
                            </a>
                            @foreach ($jurusan as $value)
                                <a class="btn btn-info" href="javascript:void(0)" data-filter="{{ $value->id }}">
                                    {{ $value->kode_jurusan }} </a>
                            @endforeach
                        </div>
                        <div class="mb-2">
                            <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a>
                            <div class="float-right">
                                <select class="custom-select" style="width: auto;" data-sortOrder>
                                    <option value="index"> Sort by Position </option>
                                    <option value="sortData"> Sort by Custom Data </option>
                                </select>
                                <div class="btn-group">
                                    <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                                    <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="filter-container p-0 row">
                            @foreach ($kelas as $value)
                                @if ($value->status)
                                    <div class="filtr-item col-sm-2" data-category="{{ $value->jurusan->id }}"
                                        data-sort="red sample">
                                        <a href="https://via.placeholder.com/1200/00FF00/FFFFFF.png?text={{ $value->nama_kelas . ' - ' . $value->jurusan->kode_jurusan . ' - ' . $value->rombel }}"
                                            data-toggle="lightbox"
                                            data-title="Status Kelas {{ $value->nama_kelas . ' - ' . $value->jurusan->kode_jurusan . ' - ' . $value->rombel }}">
                                            <img src="https://via.placeholder.com/300/00FF00/FFFFFF?text={{ $value->nama_kelas . ' - ' . $value->jurusan->kode_jurusan . ' - ' . $value->rombel }}"
                                                class="img-fluid mb-2" alt="red sample" />
                                        </a>
                                    </div>
                                @else
                                    <div class="filtr-item col-sm-2" data-category="{{ $value->jurusan->id }}"
                                        data-sort="red sample">
                                        <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text={{ $value->nama_kelas . ' - ' . $value->jurusan->kode_jurusan . ' - ' . $value->rombel }}"
                                            data-toggle="lightbox"
                                            data-title="Status Kelas {{ $value->nama_kelas . ' - ' . $value->jurusan->kode_jurusan . ' - ' . $value->rombel }}">
                                            <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text={{ $value->nama_kelas . ' - ' . $value->jurusan->kode_jurusan . ' - ' . $value->rombel }}"
                                                class="img-fluid mb-2" alt="red sample" />
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                            {{-- <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=XTJKT-1"
                                    data-toggle="lightbox" data-title="sample 1 - white">
                                    <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2"
                                        alt="white sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox"
                                    data-title="sample 2 - black">
                                    <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2"
                                        alt="black sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3"
                                    data-toggle="lightbox" data-title="sample 3 - red">
                                    <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3"
                                        class="img-fluid mb-2" alt="red sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4"
                                    data-toggle="lightbox" data-title="sample 4 - red">
                                    <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4"
                                        class="img-fluid mb-2" alt="red sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox"
                                    data-title="sample 5 - black">
                                    <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2"
                                        alt="black sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox"
                                    data-title="sample 6 - white">
                                    <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2"
                                        alt="white sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox"
                                    data-title="sample 7 - white">
                                    <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2"
                                        alt="white sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox"
                                    data-title="sample 8 - black">
                                    <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2"
                                        alt="black sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9"
                                    data-toggle="lightbox" data-title="sample 9 - red">
                                    <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9"
                                        class="img-fluid mb-2" alt="red sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox"
                                    data-title="sample 10 - white">
                                    <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2"
                                        alt="white sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox"
                                    data-title="sample 11 - white">
                                    <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2"
                                        alt="white sample" />
                                </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox"
                                    data-title="sample 12 - black">
                                    <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2"
                                        alt="black sample" />
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('css')
        <link rel="stylesheet" href="/plugins/ekko-lightbox/ekko-lightbox.css">
    @endsection

    @section('js')
        <script src="/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>


        <script src="/plugins/filterizr/jquery.filterizr.min.js"></script>

        <script>
            $(function() {
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });

                $('.filter-container').filterizr({
                    gutterPixels: 3
                });
                $('.btn[data-filter]').on('click', function() {
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });
            })
        </script>
    @endsection

</x-app-layout>
