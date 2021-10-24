<?php

namespace App\Http\Controllers\controllers_public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

use App\Classes\StringClass;
use App\Models\M_TTE;

class C_Public extends Controller {

	public $url_route = "tte";
    public $url_view = "views_public/tte";

	public function __construct() {
	}

	//PAGE INDEX 
    public function index() {
    	return view($this->url_view.'/viewIndex');
    }

    //ACTION CHECK
    public function act_check(Request $request) {
        DB::beginTransaction();
		try { 
            $nik = $request->nik;
            if (!$nik) return redirect($this->url_route);

            $row = M_TTE::where('nik', $nik)->first();
            if ($row) {
                $number_of_downloads = $row->number_of_downloads;
                if (isset($request->position_institusion)) {
                    $row->update(['position_institusion' => $request->position_institusion]);
                }

                // Config image
                $path_template = public_path('assets/img/template.jpg');
                // $path_font = public_path('assets/fonts/ARIALBD.ttf');
                $path_font = '/usr/local/share/fonts/arial/ARIALBD.TTF';
                $size = 46;
                $left = 380;
                $start = 230;

                // Nip
                // $nip = substr_replace(substr_replace(substr_replace($row->nip, ' ', 15, null), ' ', 14, null), ' ', 8, null);
                $nip = $row->nip;
                // Position name
                $positionInstitution = trim($row->position_institusion);
                $positionName = wordwrap($positionInstitution, 39);
                $positionName = explode("\n", $positionName);
                // -- CAPEK CAPEK BUAT ALGORITMA TERNYATA WORDWRAP UDAH HANDLE, MASYAALLAH....
                // $positionName = new StringClass($positionInstitution, 39); //max 38 char
                // $positionName = $positionName->explode_string($positionInstitution);

                $image = Image::make($path_template);
                foreach($positionName as $key => $val) {
                    $image->text(strtoupper($val), $left, $start, function ($font) use ($path_font, $size) {
                        $font->file(realpath($path_font));
                        $font->size($size);
                    });
                    $start += 60;
                }
                $image->text(strtoupper($row->name), $left, 465, function ($font) use ($path_font, $size) {
                    $font->file(realpath($path_font));
                    $font->size($size);
                });
                $image->text(strtoupper('NIP. ' . $nip), $left, 520, function ($font) use ($path_font, $size) {
                    $font->file(realpath($path_font));
                    $font->size($size);
                });
                $sourceImage = (string) $image->encode('data-url');

                $data = [
                    'tte'                   => $row,
                    'file_source'           => $sourceImage,
                    'file_name'             => "IMG-".$row->nip,
                    'number_of_downloads'   => $number_of_downloads,
                ];
                
                if (count($positionName) > 3) {
                    DB::rollback(); 
                    return view($this->url_view.'/viewIndex', $data)->with(['success' => 'Data ditemukan !', 'warning' => 'Karakter yang Anda masukkan melebihi jumlah karakter yang telah ditentukan untuk gambar template. Lakukan penyingkatan jabatan !']);
                    // return back()->withInput(['nik' => '1471070601780021'])->with(['warning' => 'Karakter yang Anda masukkan melebihi jumlah karakter yang telah ditentukan untuk gambar template. Lakukan penyingkatan jabatan !']);
                    // return redirect($this->url_route)->with(['warning' => 'Karakter yang Anda masukkan melebihi jumlah karakter yang telah ditentukan untuk gambar template. Lakukan penyingkatan jabatan !']);
                }
                else {
                    DB::commit();
                    return view($this->url_view.'/viewIndex', $data)->with(['success' => 'Data ditemukan !']);
                }
            }
            else {
                return redirect($this->url_route)->with(['warning' => 'Mohon maaf NIK Anda belum didaftarkan TTE !']);
            }
		} 
		catch (\Exception $ex) {
            DB::rollback(); 
			return redirect($this->url_route)->with(['failed' => 'Gagal membuat image, '.$ex->getMessage()]);
        }
    }

    //ACTION DOWNLOAD (CUMA UNTUK BUAT PERHITUNGAN PEMBATASAN JUMLAH DOWNLOAD :v :LOL)
    public function download(Request $request) {
        DB::beginTransaction();
		try { 
            $nik = $request->nik;
            if (!$nik) return redirect($this->url_route);

            $row = M_TTE::where('nik', $nik)->first();
            if ($row) {
                $number_of_downloads = $row->number_of_downloads;
                if ($number_of_downloads < 2) {
                    $row->increment('number_of_downloads');
                    DB::commit();
                    
                    // Config image
                    $path_template = public_path('assets/img/template.jpg');
                    // $path_font = public_path('assets/fonts/ARIALBD.ttf');
                    $path_font = '/usr/local/share/fonts/arial/ARIALBD.TTF';
                    $size = 46;
                    $left = 380;
                    $start = 230;

                    // Nip
                    // $nip = substr_replace(substr_replace(substr_replace($row->nip, ' ', 15, null), ' ', 14, null), ' ', 8, null);
                    $nip = $row->nip;
                    // Position name
                    $positionInstitution = trim($row->position_institusion);
                    $positionName = wordwrap($positionInstitution, 39);
                    $positionName = explode("\n", $positionName);
                    // -- CAPEK CAPEK BUAT ALGORITMA TERNYATA WORDWRAP UDAH HANDLE, MASYAALLAH....
                    // $positionName = new StringClass($positionInstitution, 39); //max 38 char
                    // $positionName = $positionName->explode_string($positionInstitution);

                    $image = Image::make($path_template);
                    foreach($positionName as $key => $val) {
                        $image->text(strtoupper($val), $left, $start, function ($font) use ($path_font, $size) {
                            $font->file(realpath($path_font));
                            $font->size($size);
                        });
                        $start += 60;
                    }
                    $image->text(strtoupper($row->name), $left, 465, function ($font) use ($path_font, $size) {
                        $font->file(realpath($path_font));
                        $font->size($size);
                    });
                    $image->text(strtoupper('NIP. ' . $nip), $left, 520, function ($font) use ($path_font, $size) {
                        $font->file(realpath($path_font));
                        $font->size($size);
                    });
                    $sourceImage = (string) $image->encode('data-url');

                    $file_name = "IMG-".$row->nip;
                    $sourceImage = str_replace("data:image/jpeg;base64,", "", $sourceImage);
                    header('Content-Type: image/jpeg');
                    header('Content-Disposition: attachment; filename='.$file_name);
                    echo base64_decode($sourceImage);
                }
                else {
                    $data = [
                        'tte'                   => $row,
                        'file_source'           => '',
                        'file_name'             => "IMG-".$row->nip,
                        'number_of_downloads'   => $number_of_downloads,
                    ];
                    return view($this->url_view.'/viewIndex', $data)->with(['success' => 'Data ditemukan !', 'warning' => 'Mohon maaf, Limit download Anda sudah habis, silahkan hubungi Administrator !']);
                    // return redirect($this->url_route)->with(['warning' => 'Mohon maaf, Limit download Anda sudah habis, silahkan hubungi Administrator !']);
                }
            }
            else {
                return redirect($this->url_route)->with(['warning' => 'Mohon maaf NIK Anda belum didaftarkan TTE !']);
            }
		} 
		catch (\Exception $ex) {
            DB::rollback(); 
			return redirect($this->url_route)->with(['failed' => 'Gagal membuat image, '.$ex->getMessage()]);
        }
    }

}