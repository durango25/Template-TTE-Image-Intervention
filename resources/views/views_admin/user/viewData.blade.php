@extends('layouts/layout_admin')

@section('page_title', 'Data User')

@section('module_title', 'Data User')

@section('breadcrumb')
    <li class="breadcrumb-item"> <a href="{{ route('user.index') }}"> User </a> </li>
    <li class="breadcrumb-item active"> Data </li>
@endsection

@section('content')
    <style>
    .table td:first-child, .table td:nth-child(6), .table td:nth-child(7) { text-align:center; }
    .invalid-feedback { display:block; }
    /* .file-preview-thumbnails, .file-drop-zone, .file-preview-frame, 
    .kv-avatar .file-input { display: table-cell; width:100%; } */
    </style>

    @include('views_admin.php_inc.alertNotification')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header with-border">
                    <h3 class="card-title"> <i class="fas fa-clipboard-list"></i> Data User </h3>
                    <div class="float-right">
                        <a class="btn btn-success btn-sm" data-toggle="modal" href="#myModalAdd" title="Tambah Data"> <i class="fas fa-plus"></i> Tambah Data </a>
                        <a class="btn btn-default btn-sm" onclick="refresh_table()" title="Refresh Tabel"> <i class="fas fa-sync-alt"></i> </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed table-hover" id="tabelDataTables_SS">
                            <thead>
                                <tr>
                                    <th width="5%"> No. </th>
                                    <th width="10%"> Foto </th>
                                    <th width="20%"> Email </th>
                                    <th width="35%"> Nama </th>
                                    <th width="5%"> No. HP </th>
                                    <th width="20%"> Level </th>
                                    <th width="15%"> Status Aktif </th>
                                    <th width="10%"> Aksi </th>
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
                <form action="{{ route('user.add') }}" method="post" id="form-add" enctype="multipart/form-data">
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
                            <label> Email <span class="text-danger">*</span> </label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" 
                            value="{{ old('email') }}" maxlength="255">
                            <div class="invalid-feedback"> {{ $errors->first('email') }} </div>
                        </div>
                        <div class="form-group">
                            <label> Nama User <span class="text-danger">*</span> </label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama User" 
                            value="{{ old('name') }}" maxlength="255">
                            <div class="invalid-feedback"> {{ $errors->first('name') }} </div>
                        </div>
                        <div class="form-group">
                            <label> No. HP <span class="text-danger">*</span> </label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="No. HP" 
                            value="{{ old('phone_number') }}" maxlength="15">
                            <div class="invalid-feedback"> {{ $errors->first('phone_number') }} </div>
                        </div>
                         <div class="form-group @error('level') is-invalid @enderror">
                            <label> Level <span class="text-danger">*</span> </label>
                            <select name="level" id="level" class="form-control select2 @error('level') is-invalid @enderror">
                                <option value=""> [Pilih Level] </option>
                                <option value="1" {{ old('level')=='1'?'selected':'' }} > Super Admin </option>
                                <option value="2" {{ old('level')=='2'?'selected':'' }} > Middle Admin </option>
                            </select>
                            <div class="invalid-feedback"> {{ $errors->first('level') }} </div>
                        </div>
                        <div class="form-group">
                            <label> Password <span class="text-danger">*</span> </label>
                            <input type="text" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" 
                            value="{{ old('password') ? old('password') : '-Pass123456-' }}" maxlength="20">
                            <div class="invalid-feedback"> {{ $errors->first('password') }} </div>
                        </div>
                        <div class="form-group">
                            <label> Foto </label>
                            <div class="text-center">
                                <div class="kv-avatar">
                                    <div class="file-loading">
                                        <input type="file" name="photo" id="photo" class="image-all-1mb form-control @error('photo') is-invalid @enderror"/>  
                                    </div>
                                </div>
                            </div>
                            <div class="help-block"> Maximal <code>1 Mb</code>. Format <code>JPG, JPEG, PNG, GIF</code>. </div>
                            <div class="invalid-feedback"> {{ $errors->first('photo') }} </div>
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
    
    <!-- MODAL POP UP EDIT DATA -->
    <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<form action="{{ route('user.edit') }}" method="post" id="form-edit" enctype="multipart/form-data">
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
                            <button type="submit" class="btn btn-success" id="updateBtn" disabled="disabled" title="Ubah Data"> <i class="fas fa-save"></i> Ubah </button>
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
				<form action="{{ route('user.delete') }}" method="post" id="form-delete" enctype="multipart/form-data">
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
						<button type="submit" class="btn btn-danger" id="deleteBtn" disabled="disabled" title="Hapus Data"> <i class="fas fa-trash"></i> Hapus </button>
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

    <!-- MODAL POP UP RESET PASSWORD -->
    <div class="modal fade" id="myModalReset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<form action="{{ route('user.reset') }}" method="post" id="form-reset" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title"> <i class="fas fa-search"></i> &nbsp; Konfirmasi Reset Password </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="reset-result"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning" id="resetBtn" disabled="disabled"> <i class="fas fa-sync-alt"></i> Reset Password </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fas fa-times"></i> Batal </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL POP UP RESET PASSWORD -->

    <script> 
    $('#navDataUser').addClass('active'); 

    var route_index = "{{ route('user.index') }}";
    var route_data = "{{ route('user.data') }}";
    var route_confirm_edit = "{{ route('user.confirm-edit') }}";
    var route_confirm_delete = "{{ route('user.confirm-delete') }}";
    var route_confirm_detail = "{{ route('user.confirm-detail') }}";
    var route_confirm_reset = "{{ route('user.confirm-reset') }}";
    var column_data = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
        { data: 'photo', name: 'photo', orderable: false, searchable: false},
        { data: 'email', name: 'email'},
        { data: 'name', name: 'name'},
        { data: 'phone_number', name: 'phone_number'},
        { data: 'level', name: 'level'},
        { data: 'status', name: 'status'},
        { data: 'action', name: 'action', orderable: false, searchable: false},
    ];

    $(function () {
        var initial = "{{ asset('assets/img/user.jpg') }}";
        var width = "100%"
        input_image_all_1mb(initial, width);
    });

    // FORM RESET PASSWORD ACTION
    function resPs(id = null, mod = null, prm = null) {
	    if(id) {
            $('.form-group').removeClass('has-error').removeClass('has-success');
            $('#reset-result').html('');
            $('.modal-body').addClass('load-data'); 
            $('#resetBtn').attr('disabled', 'disabled');
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
                    $('#resetBtn').removeAttr('disabled');
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