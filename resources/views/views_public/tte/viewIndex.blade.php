@extends('layouts/layout_public')

@section('page_title', 'Template Image TTE')

@section('module_title', 'Template Image TTE')

@section('breadcrumb')
    <li class="breadcrumb-item active"> </li>
@endsection

@section('content')
    @include('views_public.php_inc.alertNotification')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"> <i class="fas fa-search"></i> Masukkan NIK Anda dengan Benar (16 Digit & Tanpa Spasi) </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('p.tte.check') }}" method="post" id="form-check">
                        @csrf
                        <div class="form-group">
                            <!-- <label class="text-black"> NIK </label> -->
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK" maxlength="16" value="{{ isset($tte) ? $tte->nik : '' }}" required>
                        </div>
                        <button type="submit" name="submit" id="search-btn" class="btn btn-sm btn-primary" title="Cari Data"> <i class="fas fa-search"></i> Check </button>
                    </form>
                </div>
            </div>       
            <small class="help-block">Jika NIK Anda tidak ditemukan saat dilakukan pencarian, mohon maaf NIK Anda belum didaftarkan TTE.</small>
        </div>
    </div>

    @if (isset($success))
        <hr class="mt-4">
        <b class="text-primary"> - HASIL PENCARIAN - </b>
        <div class="row mt-2">
            <div class="col-md-4">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> <i class="fas fa-clipboard-list"></i> Detail Data </h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-condensed table-detail">
                            <tr>
                                <td> Nama </td>
                                <td> {{ $tte->name }} </td>
                            </tr>
                            <tr>
                                <td> NIP </td>
                                <td> {{ $tte->nip }} </td>
                            </tr>
                            <tr>
                                <td> NIK </td>
                                <td> {{ $tte->nik }} </td>
                            </tr>
                            <tr>
                                <td> Jabatan </td>
                                <td> {{ $tte->position_institusion }} </td>
                            </tr>
                        </table>
                    </div>
                    <form action="{{ route('p.tte.check') }}" method="post" id="form-add" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="nik" id="e_nik" class="form-control" value="{{ $tte->nik }}">
                            <div class="form-group">
                                <label> Ubah Jabatan <span class="text-danger">*</span> </label>
                                <textarea name="position_institusion" id="position_institusion" class="form-control @error('position_institusion') is-invalid @enderror" placeholder="Jabatan" maxlength="255" required>{{ old('position_institusion') ? old('position_institusion') : ($tte ? $tte->position_institusion : '') }}</textarea>
                                <small class="help-block"> 
                                    Contoh : <br>
                                    <code>
                                        - Kepala Dinas Pariwisata <br>
                                        - Camat Payung Sekaki <br>
                                        - Lurah Air Hitam <br>
                                    </code>
                                </small>
                                <div class="invalid-feedback"> {{ $errors->first('position_institusion') }} </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-sm btn-success" id="update-btn" title="Update Data"> <i class="fas fa-save"></i> Update </button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
            <div class="col-md-8">
                @if (!isset($warning))
                    @if ($number_of_downloads < 2)
                        <a href="{{ route('p.tte.download', ['nik' => $tte->nik]) }}">
                            <img src="{{ $file_source }}" class="img-fluid">
                            <small class="help-block"> Klik pada gambar untuk download. </small>
                        </a>
                    @else
                        <i class="text-info"> Gambar tidak dapat di download. <br> Mohon maaf, Limit download Anda sudah habis, silahkan hubungi Administrator ! </i>
                    @endif
                @endif
            </div>
        </div>
        <br>
    @endif
      
    <script> 
    $('#navTTE').addClass('active'); 

    var route_index = "{{ route('p.tte.index') }}";
    var route_data = "";
    var route_confirm_edit = "";
    var route_confirm_delete = "";
    var route_confirm_detail = "";
    var column_data = [];
    </script>
@endsection