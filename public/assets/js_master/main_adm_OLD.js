$(function () {
	//Flat - Green color scheme for iCheck
	$('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass   : 'iradio_flat-green'
	});
	//Flat - Blue color scheme for iCheck
	$('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
		checkboxClass: 'icheckbox_flat-blue',
		radioClass   : 'iradio_flat-blue'
	});
	//Flat - Yellow color scheme for iCheck
	$('input[type="checkbox"].flat-yellow, input[type="radio"].flat-yellow').iCheck({
		checkboxClass: 'icheckbox_flat-yellow',
		radioClass   : 'iradio_flat-yellow'
	});
	//Flat - Red color scheme for iCheck
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
		checkboxClass: 'icheckbox_flat-red',
		radioClass   : 'iradio_flat-red'
    });

    //Minimal - Blue color scheme for iCheck
    $('input[type="checkbox"].minimal-blue, input[type="radio"].minimal-blue').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    })
    //Minimal - Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
    })
  
    
	//Date picker
	$('.form_date').datepicker({
		autoclose: true,
		language: "id",
		format: "dd-mm-yyyy",
		todayBtn: "linked",
		//clearBtn: 0,
		todayHighlight: 1,
		weekStart: 1
    });
    $('.form_date').datepicker('setDate', 'today');
    $('.form_date_edit').datepicker({
		autoclose: true,
		language: "id",
		format: "dd-mm-yyyy",
		todayBtn: "linked",
		//clearBtn: 0,
		todayHighlight: 1,
		weekStart: 1
    });
			
	//Year picker
	$('.form_year').datepicker({
		autoclose: 1,
		language: "id",
		//format: "dd-mm-yyyy",
		//todayBtn: "linked",
		//clearBtn: 0,
		//todayHighlight: 1,
		//weekStart: 1,
		viewMode: "years", 
		minViewMode: "years"
    });
    
    //Year picker
    $('.form_month').datepicker({
        autoclose: 1,
        language: "id",
        //format: "dd-mm-yyyy",
        //todayBtn: "linked",
        //clearBtn: 0,
        //todayHighlight: 1,
        //weekStart: 1,
        viewMode: "months", 
        minViewMode: "months"
    });
			
	//Timepicker
	$('.timepicker').timepicker({
		showInputs: true,
	});
		
    //Select filter
	$('.select2').select2();

    //SummerNote WYSIG
    $('.summernote').summernote({
        placeholder: 'Place some text here',
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font family', ['fontsize']], //'fontname', 'fontsizeunit', 
            ['font style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            //['font color', ['forecolor', 'backcolor']], //'color', 
            ['font color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video', 'table', 'hr']],
            ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
        ],
        // callbacks: {
        //     onPaste: function (e) {
        //         var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        //         e.preventDefault();
        //         document.execCommand('insertText', false, bufferText);
        //     }
        // }
        // callbacks: {
        //     // callback for pasting text only (no formatting)
        //     onPaste: function (e) {
        //         var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        //         e.preventDefault();
        //         bufferText = bufferText.replace(/\r?\n/g, '<br>');
        //         document.execCommand('insertHtml', false, bufferText);
        //     }
        // }
    });

	// file input image - all image - 5mb
	$("#img-all-5mb").fileinput({
		overwriteInitial: true,
		maxFileSize: 5120,
		showClose: false,
		showCaption: false,
		browseLabel: 'Browse',
		removeLabel: '',
		browseIcon: '<i class="fa fa-folder-open"></i>',
		removeIcon: '<i class="fa fa-remove"></i>',
		removeTitle: 'Cancel or reset changes',
		elErrorContainer: '#kv-img-all-5mb-errors',
		msgErrorClass: 'alert alert-danger alert-light',
		layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		allowedFileExtensions: ["jpg", "png", "jpeg", "gif", "JPG", "PNG", "JPEG", "GIF"],
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
        msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
    });

	// file input image - all image - 1mb
	$("#img-all-1mb").fileinput({
		overwriteInitial: true,
		maxFileSize: 1024,
		showClose: false,
		showCaption: false,
		browseLabel: 'Browse',
		removeLabel: '',
		browseIcon: '<i class="fa fa-folder-open"></i>',
		removeIcon: '<i class="fa fa-remove"></i>',
		removeTitle: 'Cancel or reset changes',
		elErrorContainer: '#kv-img-all-1mb-errors',
		msgErrorClass: 'alert alert-danger alert-light',
		layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		allowedFileExtensions: ["jpg", "png", "jpeg", "gif", "JPG", "PNG", "JPEG", "GIF"],
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
        msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
    });

	// file input image - all image - 500kb
	$("#img-all-500kb").fileinput({
		overwriteInitial: true,
		maxFileSize: 512,
		showClose: false,
		showCaption: false,
		browseLabel: 'Browse',
		removeLabel: '',
		browseIcon: '<i class="fa fa-folder-open"></i>',
		removeIcon: '<i class="fa fa-remove"></i>',
		removeTitle: 'Cancel or reset changes',
		elErrorContainer: '#kv-img-all-500kb-errors',
		msgErrorClass: 'alert alert-danger alert-light',
		layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		allowedFileExtensions: ["jpg", "png", "jpeg", "gif", "JPG", "PNG", "JPEG", "GIF"],
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
        msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
    });

    // file input image - png - 2mb
	$("#img-png-2mb").fileinput({
		overwriteInitial: true,
		maxFileSize: 2048,
		showClose: false,
		showCaption: false,
		browseLabel: 'Browse',
		removeLabel: '',
		browseIcon: '<i class="fa fa-folder-open"></i>',
		removeIcon: '<i class="fa fa-remove"></i>',
		removeTitle: 'Cancel or reset changes',
		elErrorContainer: '#kv-img-png-2mb-errors',
		msgErrorClass: 'alert alert-danger alert-light',
		layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		allowedFileExtensions: ["png", "PNG"],
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
        msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
    });

	// file input image - png - 200kb
	$("#img-png-200kb").fileinput({
		overwriteInitial: true,
		maxFileSize: 200,
		showClose: false,
		showCaption: false,
		browseLabel: 'Browse',
		removeLabel: '',
		browseIcon: '<i class="fa fa-folder-open"></i>',
		removeIcon: '<i class="fa fa-remove"></i>',
		removeTitle: 'Cancel or reset changes',
		elErrorContainer: '#kv-img-png-200kb-errors',
		msgErrorClass: 'alert alert-danger alert-light',
		layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		allowedFileExtensions: ["png", "PNG"],
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
        msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
    });

    // file input file - pdf - 10mb
    $("#file-pdf-10mb").fileinput({
        showUpload: false,
        showPreview: false,
        maxFileSize: 10240,
        browseLabel: 'Browse',
        removeLabel: '',
        browseIcon: '<i class="fa fa-folder-open"></i>',
        removeIcon: '<i class="fa fa-remove"></i>',
        browseClass: 'btn btn-info',
        //mainClass: "input-group-sm",
        elErrorContainer: '#kv-file-pdf-10mb-errors',
        msgErrorClass: 'alert alert-danger alert-light',
        //layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
        allowedFileExtensions: ["pdf", "PDF"],
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
        msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
    });

	// file input file - pdf - max size (65mb)
	$("#file-pdf-max").fileinput({		 
		showUpload: false,
		showPreview: false,
		maxFileSize: 66560, //40960
		browseLabel: 'Browse',
	    removeLabel: '',
	    browseIcon: '<i class="fa fa-folder-open"></i>',
	    removeIcon: '<i class="fa fa-remove"></i>',
		browseClass: 'btn btn-info',
		//mainClass: "input-group-sm",
		elErrorContainer: '#kv-file-pdf-max-errors',
		msgErrorClass: 'alert alert-danger alert-light',
		//layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
		allowedFileExtensions: ["pdf", "PDF"],
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
        msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
    });

	// file input file - all - max size (65mb)
	$("#file-all-max").fileinput({		 
		showUpload: false,
		showPreview: false,
		maxFileSize: 66560, //40960
		browseLabel: 'Browse',
	    removeLabel: '',
	    browseIcon: '<i class="fa fa-folder-open"></i>',
	    removeIcon: '<i class="fa fa-remove"></i>',
		browseClass: 'btn btn-info',
		//mainClass: "input-group-sm",
		elErrorContainer: '#kv-file-all-max-errors',
		msgErrorClass: 'alert alert-danger alert-light',
		//layoutTemplates: {main2: '{preview} {remove} {browse}'},		
		allowedFileExtensions: ["pdf", "rar", "zip", "jpg", "png", "jpeg", "gif", "PDF", "RAR", "ZIP", "JPG", "PNG", "JPEG", "GIF"],
        msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
        msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
    });

    //TIMING UNTUK ALERT
	setTimeout(function(){$("#alert").fadeIn('slow');}, 500);
	setTimeout(function(){$("#alert").fadeOut('slow');}, 10000);
    //END TIMING UNTUK ALERT
});
        
// DATATABLE 
var tabelDataTables;
$(document).ready(function() {
	tabelDataTables = $("#tabelDataTables").DataTable({
		'ajax': base_url+'/'+url1+'/'+url2+'/get_data',
        "aLengthMenu": [[10, 25, 50, -1], [10 ,25, 50, "All"]],
		"iDisplayLength": 10,
		"bProcessing" : true,
		'order': []
	});
});
function refresh_table() {
    tabelDataTables.ajax.reload(null, false);
}
// END DATATABLE

// FORM EDIT ACTION
function edit(id = null, token = null) {
	if(id && token) {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
			
		$('#edit-result').html('');
		$('.modal-body').addClass('load-data'); 
		$('#updateBtn').attr('disabled', 'disabled');
			
		$.ajax({
			type : 'post',
			url : base_url+'/'+url1+'/'+url2+'/konfirm_edit',
			data :  'id='+ id +'&_token='+ token,
			success:function(data) {
				$('.modal-body').removeClass('load-data');
				$('#edit-result').html(data); 
				$('#updateBtn').removeAttr('disabled');
                $('.select2').select2();

                //Date picker
                $('.form_date').datepicker({
                    autoclose: true,
                    language: "id",
                    format: "dd-mm-yyyy",
                    todayBtn: "linked",
                    //clearBtn: 0,
                    todayHighlight: 1,
                    weekStart: 1
                });
                $('.form_date').datepicker('setDate', 'today');
                $('.form_date_edit').datepicker({
                    autoclose: true,
                    language: "id",
                    format: "dd-mm-yyyy",
                    todayBtn: "linked",
                    //clearBtn: 0,
                    todayHighlight: 1,
                    weekStart: 1
                });

                // file input image - all image - 5mb (untuk edit, jika halaman sama dengan halaman input)
                $("#img-all-5mb-edit").fileinput({
                    overwriteInitial: true,
                    maxFileSize: 1024,
                    showClose: false,
                    showCaption: false,
                    browseLabel: 'Browse',
                    removeLabel: '',
                    browseIcon: '<i class="fa fa-folder-open"></i>',
                    removeIcon: '<i class="fa fa-remove"></i>',
                    removeTitle: 'Cancel or reset changes',
                    elErrorContainer: '#kv-img-all-5mb-edit-errors',
                    msgErrorClass: 'alert alert-danger alert-light',
                    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
                    allowedFileExtensions: ["jpg", "png", "jpeg", "gif", "JPG", "PNG", "JPEG", "GIF"],
                    msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
                    msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
                });
                
                // file input image - all image - 1mb (untuk edit, jika halaman sama dengan halaman input)
                $("#img-all-1mb-edit").fileinput({
                    overwriteInitial: true,
                    maxFileSize: 1024,
                    showClose: false,
                    showCaption: false,
                    browseLabel: 'Browse',
                    removeLabel: '',
                    browseIcon: '<i class="fa fa-folder-open"></i>',
                    removeIcon: '<i class="fa fa-remove"></i>',
                    removeTitle: 'Cancel or reset changes',
                    elErrorContainer: '#kv-img-all-1mb-edit-errors',
                    msgErrorClass: 'alert alert-danger alert-light',
                    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
                    allowedFileExtensions: ["jpg", "png", "jpeg", "gif", "JPG", "PNG", "JPEG", "GIF"],
                    msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
                    msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
                });

                // file input image - all image - 500kb (untuk edit, jika halaman sama dengan halaman input)
                $("#img-all-500kb-edit").fileinput({
                    overwriteInitial: true,
                    maxFileSize: 512,
                    showClose: false,
                    showCaption: false,
                    browseLabel: 'Browse',
                    removeLabel: '',
                    browseIcon: '<i class="fa fa-folder-open"></i>',
                    removeIcon: '<i class="fa fa-remove"></i>',
                    removeTitle: 'Cancel or reset changes',
                    elErrorContainer: '#kv-img-all-500kb-edit-errors',
                    msgErrorClass: 'alert alert-danger alert-light',
                    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
                    allowedFileExtensions: ["jpg", "png", "jpeg", "gif", "JPG", "PNG", "JPEG", "GIF"],
                    msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
                    msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
                });

                // file input image - png - 200kb (untuk edit, jika halaman sama dengan halaman input)
                $("#img-png-200kb-edit").fileinput({
                    overwriteInitial: true,
                    maxFileSize: 200,
                    showClose: false,
                    showCaption: false,
                    browseLabel: '',
                    removeLabel: '',
                    browseIcon: '<i class="fa fa-folder-open"></i> Browse',
                    removeIcon: '<i class="fa fa-remove"></i> Remove',
                    removeTitle: 'Cancel or reset changes',
                    elErrorContainer: '#kv-img-png-200kb-edit-errors',
                    msgErrorClass: 'alert alert-danger alert-light',
                    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
                    allowedFileExtensions: ["png", "PNG"],
                    msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
                    msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
                });

                // file input file - pdf - 10mb (untuk edit, jika halaman sama dengan halaman input)
                $("#file-pdf-10mb-edit").fileinput({
                    showUpload: false,
                    showPreview: false,
                    maxFileSize: 10240,
                    browseLabel: 'Browse',
                    removeLabel: '',
                    browseIcon: '<i class="fa fa-folder-open"></i>',
                    removeIcon: '<i class="fa fa-remove"></i>',
                    browseClass: 'btn btn-info',
                    //mainClass: "input-group-sm",
                    elErrorContainer: '#kv-file-pdf-10mb-edit-errors',
                    msgErrorClass: 'alert alert-danger alert-light',
                    //layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
                    allowedFileExtensions: ["pdf", "PDF"],
                    msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
                    msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
                });

                // file input file - pdf - max size (65mb) (untuk edit, jika halaman sama dengan halaman input)
                $("#file-pdf-max-edit").fileinput({		 
                    showUpload: false,
                    showPreview: false,
                    maxFileSize: 66560, //40960
                    browseLabel: 'Browse',
                    removeLabel: '',
                    browseIcon: '<i class="fa fa-folder-open"></i>',
                    removeIcon: '<i class="fa fa-remove"></i>',
                    browseClass: 'btn btn-info',
                    //mainClass: "input-group-sm",
                    elErrorContainer: '#kv-file-pdf-max-edit-errors',
                    msgErrorClass: 'alert alert-danger alert-light',
                    //layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
                    allowedFileExtensions: ["pdf", "PDF"],
                    msgSizeTooLarge: 'File "{name}" (<b>{size} KB</b>) melebihi batas maximum unggah. Batas maximum : <b>{maxSize} KB</b>.',
                    msgInvalidFileExtension: 'File "{name}" tidak valid. Ekstensi yang diperbolehkan hanya : <b>"{extensions}"</b>.'
                });

                //Year picker
                $('.form_year').datepicker({
                    autoclose: 1,
                    language: "id",
                    //format: "dd-mm-yyyy",
                    //todayBtn: "linked",
                    //clearBtn: 0,
                    //todayHighlight: 1,
                    //weekStart: 1,
                    viewMode: "years", 
                    minViewMode: "years"
                });

                //SummerNote WYSIG (untuk edit, jika halaman sama dengan halaman input)
                $('.summernote').summernote({
                    placeholder: 'Place some text here',
                    height: 400,
                    toolbar: [
                        ['style', ['style']],
                        ['font family', ['fontsize']], //'fontname', 'fontsizeunit', 
                        ['font style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                        //['font color', ['forecolor', 'backcolor']], //'color', 
                        ['font color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                        ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
                    ],
                });
			}, //.-end success function
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert("Ajax Error ! \nStatus: " + textStatus + "\nError: " + errorThrown + "\nPlease refresh page !"); 
				document.location = base_url+'/'+url1+'/'+url2;
			}  //.-end error function
		}); //.-end ajax
	} else {
		alert("Error, Data not found ! \nPlease refresh page !");
		document.location = base_url+'/'+url1+'/'+url2;
	}
} //.-end function 
// END FORM EDIT ACTION

// FORM DELETE ACTION
function hapus(id = null, token = null) {
	if(id && token) {
		$(".text-danger").remove();
		$('.form-group').removeClass('has-error').removeClass('has-success');
			
		$('#delete-result').html('');
		$('.modal-body').addClass('load-data'); 
		$('#deleteBtn').attr('disabled', 'disabled');
			
		$.ajax({
			type : 'post',
			url : base_url+'/'+url1+'/'+url2+'/konfirm_hapus',
			data :  'id='+ id +'&_token='+ token,
			success:function(data) {
				$('.modal-body').removeClass('load-data');
				$('#delete-result').html(data); 
				$('#deleteBtn').removeAttr('disabled');
			}, //.-end success function
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert("Ajax Error ! \nStatus: " + textStatus + "\nError: " + errorThrown + "\nPlease refresh page !"); 
				document.location = base_url+'/'+url1+'/'+url2;
			}  //.-end error function
		}); //.-end ajax
	} else {
		alert("Error, Data not found ! \nPlease refresh page !");
		document.location = base_url+'/'+url1+'/'+url2;
	}
} //.-end function 
// END FORM DELETE ACTION

// FORM DETAIL ACTION
function detail(id = null, token = null) {
	if(id && token) {
		$('#detail-result').html('');
		$('.modal-body').addClass('load-data'); 
		$.ajax({
			type : 'post',
			url : base_url+'/'+url1+'/'+url2+'/konfirm_detail',
			data :  'id='+ id +'&_token='+ token,
			success : function(data){
				$('.modal-body').removeClass('load-data');
				$('#detail-result').html(data); 
			}, //.-end success function
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert("Ajax Error ! \nStatus: " + textStatus + "\nError: " + errorThrown + "\nPlease refresh page !"); 
				document.location = base_url+'/'+url1+'/'+url2;
			}  //.-end error function
		}); //.-end ajax
	} else {
		alert("Error, Data not found ! \nPlease refresh page !");
		document.location = base_url+'/'+url1+'/'+url2;
	}
} //.-end function
// END FORM DETAIL ACTION