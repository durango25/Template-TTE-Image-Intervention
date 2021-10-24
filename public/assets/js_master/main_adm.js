$(function () {
    //DataTable
    dataTables();
    //Select2
    select2();
    //Datepicker
    datepicker();
    //SummerNote WYSIG
    editor();
    //File Input
    // input_img_all_1mb();
    //Masking Number for Money
    mask_money();

    //TIMING UNTUK ALERT
	setTimeout(function(){$("#alert").fadeIn('slow');}, 500);
	setTimeout(function(){$("#alert").fadeOut('slow');}, 10000);
    //END TIMING UNTUK ALERT
});

// DATATABLE 
var tabelDataTables;
var tabelDataTables_by_atr;
var tabelDataTables_SS;
function dataTables() {
	tabelDataTables = $("#tabelDataTables").DataTable({
		ajax: route_data,
        aLengthMenu: [[10, 25, 50, -1], [10 ,25, 50, "All"]],
		iDisplayLength: 10,
		processing : true,
		order: []
	});
    tabelDataTables_SS = $("#tabelDataTables_SS").DataTable({ //SERVERSIDE
        ajax: route_data,
        aLengthMenu: [[10, 25, 50, 100], [10 ,25, 50, 100]],
        iDisplayLength: 10,
        processing: true,
        serverSide: true,
        bStateSave: true,
        stateSaveCallback: function(settings,data) {
            localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
        },
        stateLoadCallback: function(settings) {
          return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
        },
        columns: column_data,
		order: [],
    });
}
function refresh_table() {
    tabelDataTables.ajax.reload(null, false);
    tabelDataTables_SS.ajax.reload(null, false);
    if ($("#tabelDataTables_by_atr").length > 0) {
        tabelDataTables_by_atr.ajax.reload(null, false);
    }
}

// SELECT2 FILTER
function select2() {
	$('.select2').select2();
}

// DATE PICKER
function datepicker() {
    //DatePicker
    $('#form-date, #form-date-edit').datetimepicker({
        // viewMode: 'years',
        locale: moment.locale(),
        format: 'DD-MM-YYYY',
        buttons: {
            showToday: true,
            showClear: true,
            showClose: true
        },
        icons: {
            today: 'fa fa-calendar-check',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        },
    });

    //TimePicker
    $('#form-time, #form-time-edit').datetimepicker({
        // viewMode: 'years',
        locale: moment.locale(),
        format: 'HH:mm',
        buttons: {
            showToday: true,
            showClear: true,
            showClose: true
        },
        icons: {
            today: 'fa fa-calendar-check',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        },
    });
}

// EDITOR SUMMERNOTE
function editor() {
    // YANG LAMA TANPA FILE MANAGER
    $('.summernote-no-lfm').summernote({
        placeholder: 'Ketik deskripsi di sini',
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

    // Define function to open filemanager window
    var lfm = function(options, cb) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/lfm';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
    };
    // Define LFM summernote button
    var LFMButton = function(context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<i class="note-icon-picture"></i> ',
            tooltip: 'Insert image with filemanager',
            click: function() {
                lfm({type: 'image', prefix: '/lfm'}, function(lfmItems, path) {
                    lfmItems.forEach(function (lfmItem) {
                        context.invoke('insertImage', lfmItem.url);
                    });
                });
            }
        });
        return button.render();
    };
  
    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('.summernote').summernote({
        placeholder: 'Ketik deskripsi di sini',
        height: 400,
        toolbar: [
            ['style', ['style']],
            ['font family', ['fontsize']], //'fontname', 'fontsizeunit', 
            ['font style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            //['font color', ['forecolor', 'backcolor']], //'color', 
            ['font color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'lfm', 'video', 'table', 'hr']],
            ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
            // ['popovers', ['lfm']],
        ],
        buttons: {
            lfm: LFMButton
        }
    });
    
    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('.summernote-min').summernote({
        placeholder: 'Place some text here',
        height: 400,
        toolbar: [
            ['font style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript',]],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'table', 'hr']],
            ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
        ],
    });
}

function input_image_all_1mb(initial) {
    $(".image-all-1mb").fileinput({
        language: 'id',
        theme: 'fas',
        overwriteInitial: true,
        showCaption: false,
        showPreview: true,
        showUpload: false,
        browseOnZoneClick: true,
        browseClass: 'btn btn-primary btn-sm',
        removeClass: 'btn btn-default btn-sm',
        maxFileSize: 1024,
        previewFileType: 'any',	
        allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'],
        defaultPreviewContent: '<img src="'+ initial +'" alt="Image" width="100%">',
        // allowedFileTypes: ['image'], //'html', 'text', 'video', 'audio', 'flash', 'object'
        // initialPreview: '<img src="../../assets/img/user.jpg" alt="Image" width="100%">',
    });
}
function input_image_png_1mb(initial, width) {
    $(".image-png-1mb").fileinput({
        language: 'id',
        theme: 'fas',
        overwriteInitial: true,
        showCaption: false,
        showPreview: true,
        showUpload: false,
        browseOnZoneClick: true,
        browseClass: 'btn btn-primary btn-sm',
        removeClass: 'btn btn-default btn-sm',
        maxFileSize: 1024,
        previewFileType: 'any',	
        allowedFileExtensions: ['png', 'PNG'],
        defaultPreviewContent: '<img src="'+ initial +'" alt="Image" width="'+ width +'">',
    });
}
function input_image_png_1mb_dua(initial, width) {
    $(".image-png-1mb-dua").fileinput({
        language: 'id',
        theme: 'fas',
        overwriteInitial: true,
        showCaption: false,
        showPreview: true,
        showUpload: false,
        browseOnZoneClick: true,
        browseClass: 'btn btn-primary btn-sm',
        removeClass: 'btn btn-default btn-sm',
        maxFileSize: 1024,
        previewFileType: 'any',	
        allowedFileExtensions: ['png', 'PNG'],
        defaultPreviewContent: '<img src="'+ initial +'" alt="Image" width="'+ width +'">',
    });
}
function input_image_png_2mb(initial, width) {
    $(".image-png-2mb").fileinput({
        language: 'id',
        theme: 'fas',
        overwriteInitial: true,
        showCaption: false,
        showPreview: true,
        showUpload: false,
        browseOnZoneClick: true,
        browseClass: 'btn btn-primary btn-sm',
        removeClass: 'btn btn-default btn-sm',
        maxFileSize: 2048,
        previewFileType: 'any',	
        allowedFileExtensions: ['png', 'PNG'],
        defaultPreviewContent: '<img src="'+ initial +'" alt="Image" width="'+ width +'">',
    });
}
function input_image_all_5mb(initial) {
    $(".image-all-5mb").fileinput({
        language: 'id',
        theme: 'fas',
        overwriteInitial: true,
        showCaption: false,
        showPreview: true,
        showUpload: false,
        browseOnZoneClick: true,
        browseClass: 'btn btn-primary btn-sm',
        removeClass: 'btn btn-default btn-sm',
        maxFileSize: 5120,
        previewFileType: 'any',	
        allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF'],
        defaultPreviewContent: '<img src="'+ initial +'" alt="Image" width="100%">',
    });
}
function input_file_pdf_10mb() {
    $(".file-pdf-10mb").fileinput({
        language: 'id',
        theme: 'fas',
        overwriteInitial: true,
        showCaption: true,
        showPreview: true,
        showUpload: false,
        browseOnZoneClick: true,
        // mainClass: "input-group-sm",
        // browseClass: 'btn btn-primary btn-sm',
        // removeClass: 'btn btn-default btn-sm',
        maxFileSize: 10240,
        previewFileType: 'any',	
        allowedFileExtensions: ["pdf", "PDF"],
    });
    $("#file-pdf-10mb").fileinput({
        language: 'id',
        theme: 'fas',
        overwriteInitial: true,
        showCaption: true,
        showPreview: false,
        showUpload: false,
        browseOnZoneClick: true,
		elErrorContainer: '#kv-file-pdf-10mb-errors',
		msgErrorClass: 'alert alert-danger alert-light',
        maxFileSize: 10240,
        previewFileType: 'any',	
        allowedFileExtensions: ["pdf", "PDF"],
    });
}
        
function mask_money() {
	$(".mask-money").inputmask('decimal', {
        'rightAlign': false,
		'alias': 'numeric',
		'groupSeparator': '.',
		'autoGroup': true,
		'digits': 2,
		'radixPoint': ",",
		'digitsOptional': true,
		'allowMinus': false,
		//'prefix': 'Rp. ',
		// 'placeholder': ''
	});
}

// FORM INPUT ACTION
function add(id = null, mod = null, prm = null) {
    if(id) {
		$('.form-group').removeClass('has-error').removeClass('has-success');
        $('#add-result').html('');
        $('#add-result').addClass('load-data'); 
        $('#save-btn').attr('disabled', 'disabled');
        $.ajax({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'post',
            url : route_confirm_add,
			data : 'id='+ id +'&mod='+ mod +'&prm='+ prm,
            success:function(data) {
                $('#add-result').removeClass('load-data');
                $('#add-result').html(data); 
                $('#save-btn').removeAttr('disabled');
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
// END FORM INPUT ACTION

// FORM EDIT ACTION
function edit(id = null, mod = null, prm = null) {
	if(id) {
		$('.form-group').removeClass('has-error').removeClass('has-success');
		// $('#edit-result').html('');
		// $('.modal-body').addClass('load-data'); 
		$('#edit-result').html('<center><i class="fa fa-spinner fa-spin fa-2x"></i></center>');
		$('#update-btn').attr('disabled', 'disabled');
		$.ajax({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			type : 'post',
			url : route_confirm_edit,
			data : 'id='+ id +'&mod='+ mod +'&prm='+ prm,
			success:function(data) {
				// $('.modal-body').removeClass('load-data');
				$('#edit-result').html(data); 
				$('#update-btn').removeAttr('disabled');
                select2();
                datepicker();
                editor();
                mask_money();
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
// END FORM EDIT ACTION

// FORM DELETE ACTION
function hapus(id = null, mod = null, prm = null) {
	if(id) {
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('#delete-result').html('<center><i class="fa fa-spinner fa-spin fa-2x"></i></center>');
		$('#delete-btn').attr('disabled', 'disabled');
		$.ajax({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			type : 'post',
			url : route_confirm_delete,
			data : 'id='+ id +'&mod='+ mod +'&prm='+ prm,
			success:function(data) {
				$('#delete-result').html(data); 
				$('#delete-btn').removeAttr('disabled');
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
// END FORM DELETE ACTION

// FORM DETAIL ACTION
function detail(id = null, mod = null, prm = null) {
	if(id) {
		$('#detail-result').html('<center><i class="fa fa-spinner fa-spin fa-2x"></i></center>');
		$.ajax({
            headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			type : 'post',
			url : route_confirm_detail,
			data : 'id='+ id +'&mod='+ mod +'&prm='+ prm,
			success : function(data){
				$('#detail-result').html(data); 
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
// END FORM DETAIL ACTION