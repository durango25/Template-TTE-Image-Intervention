@csrf
<h5> Hapus data TTE ? </h5>
<table class="table-condensed table-detail text-danger" cellpadding="5">
    <tr> 
        <td> Nama </td> <td> : </td>
        <td> {{ ucwords($_rowDel->name) }} </td>
    </tr>
    <tr> 
        <td> NIK </td> <td> : </td>
        <td> {{ $_rowDel->nik }} </td>
    </tr>
</table>
<input type="hidden" name="id" id="delete_id" value="{{ $_rowDel->id }}" required />