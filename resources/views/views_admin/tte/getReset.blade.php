@csrf
<h5> Reset pembatasan jumlah download ? </h5>
<table class="table-condensed table-detail text-danger" cellpadding="5">
    <tr> 
        <td> Nama </td> <td> : </td>
        <td> {{ ucwords($_rowRes->name) }} </td>
    </tr>
    <tr> 
        <td> NIK </td> <td> : </td>
        <td> {{ $_rowRes->nik }} </td>
    </tr>
</table>
<br>
<p> <i class="text-info"> *Pembatasan jumlah download akan di-reset kembali menjadi 0. </i> </p>
<input type="hidden" name="id" id="reset_id" value="{{ $_rowRes->id }}" required />