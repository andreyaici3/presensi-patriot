<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Kode Jurusan <sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text"
                name="code" placeholder="Masukan Kode Jurusan"
                value="{{ old('code', isset($data) ? $data->code : '') }}">
            <span id="code-error" class="error invalid-feedback">
                {{ $errors->has('code') ? '*) ' . $errors->first('code') : '' }}</span>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Nama Jurusan <sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                name="name" placeholder="Masukan Nama Jurusan"
                value="{{ old('name', isset($data) ? $data->name : '') }}">
            <span id="name-error" class="error invalid-feedback">
                {{ $errors->has('name') ? '*) ' . $errors->first('name') : '' }}</span>
        </div>
    </div>
</div>


