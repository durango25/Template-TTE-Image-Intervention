<table class="table-condensed table-detail w-100" cellpadding="5">
	<tbody>
        <tr class="text-primary text-bold">
            <td> ID TTE </td>
            <td> : </td>
            <td> [{{ $_rowDet->id }}] </td>
        </tr>
        <tr>
            <td> Nama </td>
            <td> : </td>
            <td> {{ ucwords($_rowDet->name) }}</td>
        </tr>
        <tr>
            <td> NIP </td>
            <td> : </td>
            <td> {{ $_rowDet->nip }}</td>
        </tr>
        <tr>
            <td> NIK </td>
            <td> : </td>
            <td> {{ $_rowDet->nik }}</td>
        </tr>
        <tr>
            <td> Jabatan & Instansi </td>
            <td> : </td>
            <td> {{ $_rowDet->position_institusion }}</td>
        </tr>
        <!-- <tr> <td colspan="3"> <hr> </td> </tr>
        <tr>
            <td> Created by/at </td>
            <td> : </td>
            <td> [{{ $_rowDet->created_by }}-{{ $_rowDet->user_created_by?$_rowDet->user_created_by->name:"" }}] <br> {{ date('d-m-Y, H:i', strtotime($_rowDet->created_at)) }} </td>
        </tr>
        <tr>
            <td> Updated by/at </td>
            <td> : </td>
            <td> [{{ $_rowDet->updated_by }}-{{ $_rowDet->user_updated_by?$_rowDet->user_updated_by->name:"" }}] <br> {{ date('d-m-Y, H:i', strtotime($_rowDet->updated_at)) }} </td>
        </tr> -->
	</tbody>
</table>