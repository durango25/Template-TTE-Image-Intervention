<table class="table-condensed table-detail w-100" cellpadding="5">
	<tbody>        
        <tr class="text-primary text-bold">
            <td> ID Pengguna </td>
            <td> : </td>
            <td> [{{ $_rowDet->id }}] </td>
        </tr>
    	<tr>
            <td> Foto </td>
            <td> : </td>
            <td>
                <img src="{{ $_rowDet->profile_photo_url }}" class="img-thumbnail" width="100px">
            </td>
        </tr>
        <tr>
            <td> Email </td>
            <td> : </td>
            <td> {{ $_rowDet->email }}</td>
        </tr>
        <tr>
            <td> Nama Pengguna </td>
            <td> : </td>
            <td> {{ ucwords($_rowDet->name) }}</td>
        </tr>
        <tr>
            <td> No. HP </td>
            <td> : </td>
            <td> {{ $_rowDet->phone_number }}</td>
        </tr>
        <tr>
            <td> Role/Level </td>
            <td> : </td>
            <td> 
            @php
            $level = "<label class='badge badge-info'>-".$_rowDet->get_level($_rowDet)."-</label> ";
            @endphp
            {!! $level !!}
            </td>
        </tr>
        <tr>
            <td> Status Aktif </td>
            <td> : </td>
            <td> {!! $_rowDet->status=="1" ? "<span class='text-success'><i class='fas fa-check-circle'></i> Aktif </span>" : "<span class='text-danger'><i class='fas fa-times-circle'></i> Non Aktif </span>" !!}
        </tr>
        <tr> <td colspan="3"> <hr> </td> </tr>
        <tr>
            <td> Created by/at </td>
            <td> : </td>
            <td> [{{ $_rowDet->created_by }}-{{ $_rowDet->user_created_by?$_rowDet->user_created_by->name:"" }}] <br> {{ date('d-m-Y, H:i', strtotime($_rowDet->created_at)) }} </td>
        </tr>
        <tr>
            <td> Updated by/at </td>
            <td> : </td>
            <td> [{{ $_rowDet->updated_by }}-{{ $_rowDet->user_updated_by?$_rowDet->user_updated_by->name:"" }}] <br> {{ date('d-m-Y, H:i', strtotime($_rowDet->updated_at)) }} </td>
        </tr>
	</tbody>
</table>