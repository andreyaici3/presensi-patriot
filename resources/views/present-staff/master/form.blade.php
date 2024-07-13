<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Nama Lengkap <sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                name="name" placeholder="Masukan Nama Lengkap"
                value="{{ old('name', isset($data) ? $data->name : '') }}">
            <span id="name-error" class="error invalid-feedback">
                {{ $errors->has('name') ? '*) ' . $errors->first('name') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Email <sup class="text-danger">*</sup></label>
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                name="email" placeholder="Masukan Email Staff"
                value="{{ old('email', isset($data) ? $data->email : '') }}">
            <span id="email-error" class="error invalid-feedback">
                {{ $errors->has('email') ? '*) ' . $errors->first('email') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>NIP <sup class="text-danger">*</sup></label>
            <input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="number"
                name="nip" placeholder="Masukan NIP Staff"
                value="{{ old('nip', isset($data) ? $data->nip : '') }}">
            <span id="nip-error" class="error invalid-feedback">
                {{ $errors->has('nip') ? '*) ' . $errors->first('nip') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Jabatan (Optional)</label>
            <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" type="text"
                name="position" placeholder="Masukan Jabatan"
                value="{{ old('position', isset($data) ? $data->position : '') }}">
            <span id="position-error" class="error invalid-feedback">
                {{ $errors->has('position') ? '*) ' . $errors->first('position') : '' }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Jenis Kelamin <sup class="text-danger">*</sup></label>
            <select name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
            </select>
            <span id="gender-error" class="error invalid-feedback">
                {{ $errors->has('gender') ? '*) ' . $errors->first('gender') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Nomor Hp (Optional)</label>
            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="number"
                name="phone" placeholder="Masukan Nomor Hp"
                value="{{ old('phone', isset($data) ? $data->phone : '') }}">
            <span id="phone-error" class="error invalid-feedback">
                {{ $errors->has('phone') ? '*) ' . $errors->first('phone') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>NIK (Optional)</label>
            <input class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}" type="number"
                name="nik" placeholder="Masukan NIK Staff"
                value="{{ old('nik', isset($data) ? $data->nik : '') }}">
            <span id="nik-error" class="error invalid-feedback">
                {{ $errors->has('nik') ? '*) ' . $errors->first('nik') : '' }}</span>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Tanggal Lahir (Optional)</label>
            <input autocomplete="off" class="form-control date-picker" name="birth_date" placeholder="Tanggal Lahir" type="text" value="{{ old('birth_date', isset($data) ? $data->birth_date : '') }}" />
            <span id="birth_date-error" class="error invalid-feedback">
                {{ $errors->has('birth_date') ? '*) ' . $errors->first('birth_date') : '' }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-12">
        <div class="form-group">
            <label>Tanggal Bergabung (Optional)</label>
            <input autocomplete="off" class="form-control date-picker" name="hire_date" placeholder="Tanggal Bergabung" type="text" value="{{ old('hire_date', isset($data) ? $data->hire_date : '') }}" />
            <span id="hire_date-error" class="error invalid-feedback">
                {{ $errors->has('hire_date') ? '*) ' . $errors->first('hire_date') : '' }}</span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Alamat Rumah</label>
            <textarea name="address" placeholder="Jl. Desa ....." class="form-control">{{ old('address', isset($data) ? $data->address : '') }}</textarea>
        </div>
    </div>
</div>



