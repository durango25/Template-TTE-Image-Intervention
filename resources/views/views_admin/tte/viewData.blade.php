@extends('layouts/layout_admin')

@section('page_title', 'Data TTE')

@section('module_title', 'Data TTE')

@section('breadcrumb')
    <li class="breadcrumb-item"> <a href="{{ route('tte.index') }}"> TTE </a> </li>
    <li class="breadcrumb-item active"> Data </li>
@endsection

@section('content')
    <style>
    .table td:first-child, .table td:nth-child(6) { text-align:center; }
    </style>

    @include('views_admin.php_inc.alertNotification')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title"> <i class="fas fa-clipboard-list"></i> Data TTE </h3>
                    <div class="float-right">
                        <a class="btn btn-success btn-sm" data-toggle="modal" href="#myModalAdd" title="Tambah Data"> <i class="fas fa-plus"></i> Tambah Data </a>
                        <a class="btn btn-info btn-sm" data-toggle="modal" href="#myModalImport" title="Import Data"> <i class="fas fa-upload"></i> Import Data </a>
                        <a class="btn btn-default btn-sm" onclick="refresh_table()" title="Refresh Tabel"> <i class="fas fa-sync-alt"></i> </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed table-hover" id="tabelDataTables_SS">
                            <thead>
                                <tr>
                                    <th width="5%"> No. </th>
                                    <th width="20%"> Nama </th>
                                    <th width="15%"> NIP </th>
                                    <th width="15%"> NIK </th>
                                    <th width="30%"> Jabatan & Instansi </th>
                                    <th width="7%"> Download </th>
                                    <th width="8%"> Aksi </th>
                                </tr>
                            </thead>
                        </table>
                    </div>	
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL POP UP ADD DATA -->
    <div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tte.add') }}" method="post" id="form-add" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fas fa-plus"></i> &nbsp; Tambah Data </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="form" value="add" required />
                        <div class="form-group">
                            <label> Nama <span class="text-danger">*</span> </label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" 
                            value="{{ old('name') }}" maxlength="255">
                            <div class="invalid-feedback"> {{ $errors->first('name') }} </div>
                        </div>
                        <div class="form-group">
                            <label> NIP <span class="text-danger">*</span> </label>
                            <input type="text" name="nip" id="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="NIP" 
                            value="{{ old('nip') }}" maxlength="18">
                            <div class="invalid-feedback"> {{ $errors->first('nip') }} </div>
                        </div>
                        <div class="form-group">
                            <label> NIK <span class="text-danger">*</span> </label>
                            <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" placeholder="NIK" 
                            value="{{ old('nik') }}" maxlength="16">
                            <div class="invalid-feedback"> {{ $errors->first('nik') }} </div>
                        </div>
                        <div class="form-group">
                            <label> Jabatan & Instansi </label>
                            <input type="text" name="position_institusion" id="position_institusion" class="form-control @error('position_institusion') is-invalid @enderror" placeholder="Jabatan & Instansi" 
                            value="{{ old('position_institusion') }}" maxlength="255">
                            <div class="invalid-feedback"> {{ $errors->first('position_institusion') }} </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="float-left text-info">
                            Atribut (<span class="text-danger">*</span>) = Wajib Diisi !
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-success" id="save-btn" title="Tambah Data"> <i class="fas fa-save"></i> Simpan </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" title="Batal"> <i class="fas fa-times"></i> Batal </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL POP UP ADD DATA -->

    <!-- MODAL POP UP IMPORT DATA -->
    <div class="modal fade" id="myModalImport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fas fa-upload"></i> &nbsp; Import Data </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tte.preview-excel') }}" method="post" id="form-preview" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="form" value="preview" required />
                        <table class="table-condensed" width="100%">
                            <tr>
                                <td colspan="2">
                                    <label class="text-black"> FILE EXCEL  (XLSX) <span class="text-danger">*</span> </label>
                                    <div id="kv-file-excel-errors" class="center-block" style="display:none;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td width="70%">     
                                    <div id="fileExcelError">     
                                        <div class="file-loading">
                                            <input type="file" name="file_excel" id="file_excel" class="form-control @error('attachment') is-invalid @enderror" required/> 
                                        </div> 
                                    </div>
                                </td>
                                <td width="">
                                    <button type="submit" name="preview" id="preview-btn" class="btn btn-warning btn-block" onclick="previewExcel()">
                                        <span class="fas fa-eye"></span> Preview
                                    </button>
                                </td>
                                <td width="">
                                    <a class="btn btn-default btn-block" href="{{ asset('download/format_excel_tte.xlsx') }}" download>
                                        <span class="fas fa-download"></span> Download Format Excel
                                    </a>
                                </td>
                            </tr>
                        </table>
                        <span class="help-block">Maximal <code>5 Mb</code>. Format <code>XLSX</code>. </span>
                        <hr>
                        <div class="table-responsive">
                            <div id="preview-result"></div>
                        </div>
                        <input type="hidden" name="post_preview" id="post_preview" value="post_preview">
                    </form>
                </div>
                <form action="{{ route('tte.import-excel') }}" method="post" id="form-import" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="form" value="preview" required />
                    <div class="modal-footer">
                        <div class="float-left text-info">
                            Atribut (<span class="text-danger">*</span>) = Wajib Diisi !
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-success" id="import-btn" title="Import Data"> <i class="fas fa-upload"></i> Import </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" title="Batal"> <i class="fas fa-times"></i> Batal </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL POP UP IMPORT DATA -->

    <!-- MODAL POP UP EDIT DATA -->
    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tte.edit') }}" method="post" id="form-edit" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fas fa-edit"></i> &nbsp; Konfirmasi Edit </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="edit-result"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="float-left text-info">
                            Atribut (<span class="text-danger">*</span>) = Wajib Diisi !
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-success" id="update-btn" disabled="disabled" title="Ubah Data"> <i class="fas fa-save"></i> Ubah </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" title="Batal"> <i class="fas fa-times"></i> Batal </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL POP UP EDIT DATA -->

    <!-- MODAL POP UP DELETE DATA -->
    <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tte.delete') }}" method="post" id="form-delete" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fas fa-trash"></i> &nbsp; Konfirmasi Hapus </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="delete-result"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="delete-btn" disabled="disabled" title="Hapus Data"> <i class="fas fa-trash"></i> Hapus </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" title="Batal"> <i class="fas fa-times"></i> Batal </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL POP UP DELETE DATA -->

    <!-- MODAL POP UP DETAIL -->
    <div class="modal fade" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" class="form-horizontal" id="form-detail">
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fas fa-search"></i> &nbsp; Konfirmasi Detail </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="detail-result"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" title="Tutup"> <i class="fas fa-times"></i> Tutup </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL POP UP DETAIL-->

    <!-- MODAL POP UP RESET DOWNLOAD -->
    <div class="modal fade" id="myModalReset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<form action="{{ route('tte.reset') }}" method="post" id="form-reset" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fas fa-search"></i> &nbsp; Konfirmasi Reset Download </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="reset-result"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" id="reset-btn" disabled="disabled"> <i class="fas fa-sync-alt"></i> Reset Download </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fas fa-times"></i> Batal </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL POP UP RESET DOWNLOAD -->

    <script> 
    $('#navTTE').addClass('active'); 

    var route_index = "{{ route('tte.index') }}";
    var route_data = "{{ route('tte.data') }}";
    var route_confirm_edit = "{{ route('tte.confirm-edit') }}";
    var route_confirm_delete = "{{ route('tte.confirm-delete') }}";
    var route_confirm_detail = "{{ route('tte.confirm-detail') }}";
    var route_confirm_reset = "{{ route('tte.confirm-reset') }}";
    var column_data = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
        { data: 'name', name: 'name'},
        { data: 'nip', name: 'nip'},
        { data: 'nik', name: 'nik'},
        { data: 'position_institusion', name: 'position_institusion'},
        { data: 'number_of_downloads', name: 'number_of_downloads'},
        { data: 'action', name: 'action', orderable: false, searchable: false},
    ];

    //FORM IMPORT DATA EXCEL ACTION
    $(document).ready(function() {
        // file input image
        $("#file_excel").fileinput({
            language: 'id',		
            theme: 'fas',
            overwriteInitial: true,
            showCaption: true,
            showPreview: false,
            showUpload: false,
            browseOnZoneClick: true,	
            elErrorContainer: '#kv-file-excel-errors',
            msgErrorClass: 'alert alert-danger alert-light',	 
            maxFileSize: 5120,
            allowedFileExtensions: ["xlsx", "XLSX"]
        });
    });

    function previewExcel(){
        $('.form-group').removeClass('has-error').removeClass('has-success');
        $('#preview-result').html('');
        $('#preview-result').after('');
        $('#import-btn').attr('disabled', 'disabled');
            
        var file_excel = $("#file_excel").val();

        if(file_excel != "") {
            $("#fileExcelError").find('.text-danger').remove();
            $("#fileExcelError").closest('.form-group').addClass('has-success');
            $('#fileExcelError').removeClass('has-error');	
        } else { 	
            $(".file-caption-name").html('<p class="text-danger text-italic">Tidak ada file yang dipilih !</p>');
            $('.file-caption-name').closest('.form-group').addClass('has-error');
            $('#fileExcelError').addClass('has-error');
        }
        
        if(file_excel != "") {
            $('#import-btn').attr('disabled', 'disabled');
		    $('#preview-result').html('<center><i class="fas fa-spinner fa-spin fa-2x"></i></center>');
            $("#form-preview").unbind('submit').bind('submit', function() {
                var form = $(this);
                var formData = new FormData(this);
                $.ajax({
                    url : form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    dataType: 'html',
                        cache: false,
                        contentType: false,
                        processData: false,
                    success:function(data) {
                        $('#preview-result').show();
                        $('#preview-result').html(data);
                        $('#preview-result').fadeIn('slow');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Ajax Error ! \nStatus: " + textStatus + "\nError: " + errorThrown + "\nPlease refresh page !"); 
                        document.location = route_index;
                    }
		        });	
                return false;
            });
        }
    }
    //END FORM IMPORT DATA EXCEL ACTION

    // FORM RESET Download ACTION
    function resetDw(id = null, mod = null, prm = null) {
	    if(id) {
            $('.form-group').removeClass('has-error').removeClass('has-success');
            $('#reset-result').html('');
            $('.modal-body').addClass('load-data'); 
            $('#reset-btn').attr('disabled', 'disabled');
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'post',
			    url : route_confirm_reset,
			    data : 'id='+ id +'&mod='+ mod +'&prm='+ prm,
                success:function(data) {
    				$('.modal-body').removeClass('load-data');
                    $('#reset-result').html(data); 
                    $('#reset-btn').removeAttr('disabled');
                }, 
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Ajax Error ! \nStatus: " + textStatus + "\nError: " + errorThrown + "\nPlease refresh page !"); 
                    document.location = route_index;
                }  
            }); 
        } else {
		    alert("Error, Data not found ! \nPlease refresh page !");
		    document.location = route_index;
        }
    } 
    // END FORM RESET PASSWORD ACTION
    </script>
@endsection