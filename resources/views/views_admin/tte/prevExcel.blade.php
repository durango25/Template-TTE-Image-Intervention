<?php
echo "
<table class='table table-bordered table-condensed table-preview' id='tabelPreview'>
    <thead>
        <tr>
            <th colspan='20' class='text-center'> PREVIEW DATA </th>
        </tr>
        <tr>
            <th width=''> No </th>
            <th width=''> Nama </th>
            <th width=''> NIP </th>
            <th width=''> NIK </th>
            <th width=''> Jabatan & Instansi </th>
        </tr>
    </thead>
    <tbody>";	
    $numrow = 1;
    $kosong = 0;
    $no = 1;
    foreach ($_dataExcel as $row) {
        // $nama = trim($row['nama']);
        // $nip = str_replace("'", "", trim($row['nip']));	
        // $nik = str_replace("'", "", trim($row['nik']));	
        // $jabatan = trim($row['jabatan']); 

        $nama = trim($row[1]);
        $nip = str_replace("'", "", trim($row[2]));	
        $nik = str_replace("'", "", trim($row[3]));	
        $jabatan = trim($row[4]); 
        
        if ($nama=="" and $nip=="" and $nik=="" and $jabatan=="") continue;

		//Baris 1 skip, karna header kolom
		if ($numrow > 1) {
            //Validasi apakah semua data telah diisi
            $nama_td = (!empty($nama))? "" : " style='background: #E07171;'";
            $nip_td = "";
            $nik_td = (!empty($nik))? "" : " style='background: #E07171;'";
            $jataban_td = "";

            //Jika salah satu data ada yang kosong, Tambah 1 variabel $kosong
            if ($nama=="" or $nik=="") //Nip, Jabatan boleh null
                $kosong++; 

            echo "
            <tr>
                <td> ".$no++." </td>
                <td ".$nama_td."> ".$nama." </td>
                <td ".$nip_td."> ".$nip." </td>
                <td ".$nik_td."> ".$nik." </td>
                <td ".$jataban_td."> ".$jabatan." </td>
            </tr>";
        }
        $numrow++;
    }
    echo "
    </tbody>
</table>";
    
if ($kosong > 0) {
    echo "<i class='text-danger'> Ada ".$kosong." baris data yang masih kosong / bermasalah ! </i>";
} 
else {
    echo "
    <script>
    $(document).ready(function() {
        $('#import-btn').removeAttr('disabled');
        $('#import-btn').removeClass('disabled');
    });
    </script>";
}
?>

<script>
var tabelPreview
$(document).ready(function() {
	tabelPreview = $("#tabelPreview").DataTable({
        "iDisplayLength": 10,
		"ordering": false,
		"bProcessing" : true,
		'order': []		
	});
});
</script>