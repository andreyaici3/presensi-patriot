<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Nama T/A <sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                name="name" placeholder="Masukan Nama T/A"
                value="{{ old('name', isset($data) ? $data->name : '') }}">
            <span id="name-error" class="error invalid-feedback">
                {{ $errors->has('name') ? '*) ' . $errors->first('name') : '' }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2 col-sm-12">
        <div class="form-group">
            <label>Awal Tahun<sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('start_year') ? 'is-invalid' : '' }}" type="number"
                name="start_year" placeholder="Tahun Awal (ex. 2022)" min="1900" max="{{ date('Y') }}"
                value="{{ old('start_year', isset($data) ? $data->start_year : '') }}">
            <span id="start_year-error" class="error invalid-feedback">
                {{ $errors->has('start_year') ? '*) ' . $errors->first('start_year') : '' }}</span>
        </div>
    </div>
    <div class="col-md-2 col-sm-12">
        <div class="form-group">
            <label>Akhir Tahun<sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('end_year') ? 'is-invalid' : '' }}" type="number"
                name="end_year" placeholder="Tahun Akhir (ex. 2022)" min="1900" max="{{ date('Y') + 4}}"
                value="{{ old('end_year', isset($data) ? $data->end_year : '') }}">
            <span id="end_year-error" class="error invalid-feedback">
                {{ $errors->has('end_year') ? '*) ' . $errors->first('end_year') : '' }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description', isset($data) ? $data->description : '') }}</textarea>
        </div>
    </div>
</div>
