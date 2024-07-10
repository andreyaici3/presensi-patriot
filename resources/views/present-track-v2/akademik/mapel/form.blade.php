<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label>Mata Pelajaran <sup class="text-danger">*</sup> </label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                name="name" placeholder="Masukan nama Mata Pelajaran"
                value="{{ old('name', isset($data) ? $data->name : '') }}">
            <span id="name-error" class="error invalid-feedback">
                {{ $errors->has('name') ? '*) ' . $errors->first('name') : '' }}</span>
        </div>
    </div>
</div>

