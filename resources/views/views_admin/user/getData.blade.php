<?php
// $output = array('data' => array());
// $no = 1;  

// foreach ($_data as $row) {
//     $id = $row->id;

//     if($row->level=='1' and (Auth::user()->level!='1' or Auth::user()->id==$row->id)) {
//         $editBtn = "";
//         $deleteBtn = "";
//     }
//     else {
//         $editBtn = 
//         "<li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalEdit' onclick=\"edit('".$id."')\"> <i class='fas fa-edit'></i> Edit </a> </li>";
//         $deleteBtn = 
//         "<li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalDelete' onclick=\"hapus('".$id."')\"> <i class='fas fa-trash'></i> Hapus </a> </li>";
//     }
//     $resetBtn =
//     "<li class='dropdown-divider'></li>
//     <li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalReset' onclick=\"resPs('".$id."')\"> <i class='fas fa-sync-alt'></i> Reset Password </a> </li>";
    
//     $button = "
//     <div class='btn-group btn-group-sm'>
//         <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
//             Action
//         </button>
//         <ul class='dropdown-menu'>
//             ".$editBtn."
//             ".$deleteBtn."
//             <li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalDetail' onclick=\"detail('".$id."')\"> <i class='fas fa-search'></i> Detail </a> </li>
//             ".$resetBtn."
//         </ul>
//     </div>";

//     if ($row->level == 1)
//         $level = "<label class='badge badge-danger'>-Super Admin-</label> ";
//     else
//         $level = "<label class='badge badge-info'>-Middle Admin-</label> ";

//     $photo = "
//     <a href='".$row->profile_photo_url."' data-toggle='lightbox' data-title='<i class=\"fas fa-image\"></i> ".ucwords($row->name)."' data-gallery='data-user'>
//         <img src='".$row->profile_photo_url."' class='img-fluid img-thumbnail' alt='".ucwords($row->name)."' width='200px'/>
//     </a>";

// 	$output['data'][] = array( 
// 		$no++.".", 
//         // "<span class='text-primary'> [" . $row->id . "] </span>",
//         $photo,
//         $row->email,
//         ucwords($row->name),
//         $row->phone_number,
//         $level,
// 		$row->status=="1" ? "<span class='text-success' title='Aktif'><i class='fas fa-check-circle'></i></span>" : "<span class='text-danger' title='Non Aktif'><i class='fas fa-times-circle'></i></span>", 
// 		$button 
// 	);
// }
// echo json_encode($output);
?>