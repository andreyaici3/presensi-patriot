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


<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Program Keahlian <sup class="text-danger"></sup> </label>
            <input class="form-control {{ $errors->has('program_keahlian') ? 'is-invalid' : '' }}" type="text"
                name="program_keahlian" placeholder="Masukan Nama Jurusan"
                value="{{ old('program_keahlian', isset($data) ? $data->program_keahlian : '') }}">
            <span id="program_keahlian-error" class="error invalid-feedback">
                {{ $errors->has('program_keahlian') ? '*) ' . $errors->first('program_keahlian') : '' }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Konsentrasi Keahlian <sup class="text-danger"></sup> </label>
            <input class="form-control {{ $errors->has('konsentrasi_keahlian') ? 'is-invalid' : '' }}" type="text"
                name="konsentrasi_keahlian" placeholder="Masukan Nama Jurusan"
                value="{{ old('konsentrasi_keahlian', isset($data) ? $data->konsentrasi_keahlian : '') }}">
            <span id="konsentrasi_keahlian-error" class="error invalid-feedback">
                {{ $errors->has('konsentrasi_keahlian') ? '*) ' . $errors->first('konsentrasi_keahlian') : '' }}</span>
        </div>
    </div>
</div>



