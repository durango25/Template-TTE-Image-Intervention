@csrf
<h5> Reset password pengguna ? </h5>
<table class="table-condensed table-detail text-danger" cellpadding="5">
    <tr> 
        <td> Nama </td> <td> : </td>
        <td> {{ ucwords($_rowRes->name) }} </td>
    </tr>
    <tr>
        <td> Email </td> <td> : </td>
        <td> {{ $_rowRes->email }} </td>
    </tr>
</table>
<br>
<p> <i class="text-info"> *Password akan direset menjadi password default <code>-Pass123456-</code> </i> </p>
<input type="hidden" name="id" id="reset_id" value="{{ $_rowRes->id }}" required />