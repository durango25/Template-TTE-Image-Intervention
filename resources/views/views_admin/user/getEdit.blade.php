@csrf
<input type="hidden" name="form" value="edit" required />
<input type="hidden" name="id" id="edit_id" value="{{ $_rowEdit->id }}" required />
<input type="hidden" name="unique_old" value="{{ $_rowEdit->email }}">

<div class="form-group">
    <label> Email <span class="text-danger">*</span> </label>
    <input type="email" name="email" id="email_e" class="form-control @error('email') is-invalid @enderror" placeholder="Email" 
    value="{{ old('email') ?? $_rowEdit->email }}" maxlength="255" required>
    <div class="invalid-feedback"> {{ $errors->first('email') }} </div>
</div>
<div class="form-group">
    <label> Nama Pengguna <span class="text-danger">*</span> </label>
    <input type="text" name="name" id="name_e" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Pengguna" 
    value="{{ old('name') ?? $_rowEdit->name }}" maxlength="255" required>
    <div class="invalid-feedback"> {{ $errors->first('name') }} </div>
</div>
<div class="form-group">
    <label> No. HP <span class="text-danger">*</span> </label>
    <input type="text" name="phone_number" id="phone_number_e" class="form-control @error('phone_number') is-invalid @enderror" placeholder="No. HP" 
    value="{{ old('phone_number') ?? $_rowEdit->phone_number }}" maxlength="15" required>
    <div class="invalid-feedback"> {{ $errors->first('phone_number') }} </div>
</div>
 <div class="form-group @error('level') is-invalid @enderror">
    <label> Level <span class="text-danger">*</span> </label>
    <select name="level" id="level_e" class="form-control select2 @error('level') is-invalid @enderror" required>
        <option value=""> [Pilih Level] </option>
        <option value="1" {{ $_rowEdit->level=='1'?'selected':'' }} > Super Admin </option>
        <option value="2" {{ $_rowEdit->level=='2'?'selected':'' }} > Middle Admin </option>
    </select>
    <div class="invalid-feedback"> {{ $errors->first('level') }} </div>
</div>

<div class="form-group">
    <label> Status Aktif <span class="text-danger">*</span> </label>
    <div>
        <div class="custom-control custom-radio">
            <input type="radio" name="status" class="custom-control-input" id="statusAktif" value="1"
            <?php
            if(old('status')) {
                if(old('status')==1) echo "checked";
            } else {
                if($_rowEdit->status==1) echo "checked";
            }
            ?> >
            <label for="statusAktif" class="custom-control-label text-normal"> Aktif </label>
        </div>           
        <div class="custom-control custom-radio">
            <input type="radio" name="status" class="custom-control-input" id="statusNonAktif" value="2"
            <?php
            if(old('status')) {
                if(old('status')==2) echo "checked";
            } else {
                if($_rowEdit->status==2) echo "checked";
            }
            ?> >
            <label for="statusNonAktif" class="custom-control-label text-normal"> Non Aktif </label>
        </div>
    </div>
    <div class="invalid-feedback"> {{ $errors->first('status') }} </div>
</div>
<div class="form-group">
    <label> Foto </label>
    @if ($_rowEdit->profile_photo_path)
        <center style="margin-bottom:4px;">
            <a onclick="event.preventDefault(); $('#form-photo').submit()" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Hapus Foto Permanen </a>
        </center>
        <form action="{{ route('user.delete-photo', [$_rowEdit->id]) }}" method="post" id="form-photo">
            @csrf
            <input type="hidden" name="id" value="{{ $_rowEdit->id }}" required />
            <input type="hidden" name="form" value="photo_delete" required />
        </form>
    @endif
    <div class="text-center">
        <div class="kv-avatar">
            <div class="file-loading">
                <input type="file" name="photo" id="photo_e" class="image-all-1mb form-control @error('photo') is-invalid @enderror"/>  
            </div>
        </div>
    </div>
    <div class="help-block"> 
        Maximal <code>1 Mb</code>. Format <code>JPG, JPEG, PNG, GIF</code>. <br>
        *Lewati jika gambar tidak berubah.
    </div>
    <div class="invalid-feedback"> {{ $errors->first('photo') }} </div>
</div>

        <!-- <div class="form-group">
            <label> Foto Baru </label>
            <div id="kv-img-all-1mb-edit-errors"></div>							
            <input type="file" name="photo" id="img-all-1mb-edit" class="file-loading form-control @error('photo') is-invalid @enderror"/>   
            <span class="help-block"> 
                Maksimal <code>1 Mb</code>. Format <code>JPG, JPEG, PNG, GIF</code>. <br>
                *Lewati jika gambar tidak berubah. 
            </span>
            <div class="invalid-feedback"> {{-- $errors->first('photo') --}} </div>
        </div> -->
</div>

<script>
$(function () {
    var initial = "{{ asset($_rowEdit->profile_photo_url) }}";
    var width = "100%"
    input_image_all_1mb(initial, width);
});
</script>