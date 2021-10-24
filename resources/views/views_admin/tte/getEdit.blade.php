@csrf
<input type="hidden" name="form" value="edit" required />
<input type="hidden" name="id" id="edit_id" value="{{ $_rowEdit->id }}" required />

<div class="form-group">
    <label> Nama <span class="text-danger">*</span> </label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" 
    value="{{ old('name') ?? $_rowEdit->name }}" maxlength="255">
    <div class="invalid-feedback"> {{ $errors->first('name') }} </div>
</div>
<div class="form-group">
    <label> NIP <span class="text-danger">*</span> </label>
    <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="NIP" 
    value="{{ old('nip') ?? $_rowEdit->nip }}" maxlength="18">
    <div class="invalid-feedback"> {{ $errors->first('nip') }} </div>
</div>
<div class="form-group">
    <label> NIK <span class="text-danger">*</span> </label>
    <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" 
    value="{{ old('nik') ?? $_rowEdit->nik }}" maxlength="16">
    <div class="invalid-feedback"> {{ $errors->first('nik') }} </div>
</div>
<div class="form-group">
    <label> Jabatan & Instansi </label>
    <input type="text" name="position_institusion" id="position_institusion" class="form-control @error('position_institusion') is-invalid @enderror" placeholder="Jabatan & Instansi" 
    value="{{ old('position_institusion') ?? $_rowEdit->position_institusion }}" maxlength="255">
    <div class="invalid-feedback"> {{ $errors->first('position_institusion') }} </div>
</div>