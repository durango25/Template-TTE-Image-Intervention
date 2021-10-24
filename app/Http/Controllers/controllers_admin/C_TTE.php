<?php

namespace App\Http\Controllers\controllers_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
use YajraDataTables;
use Excel;

use App\Classes\StringClass;
use App\Models\M_TTE;
use App\Http\Requests\R_TTE; 
use App\Imports\TTEImport;

class C_TTE extends Controller {

	public $url_route = "dashboard/tte";
    public $url_view = "views_admin/tte";
    public $region = "Kota Pekanbaru";
    public $dir = "tmp";
    public $path;

	public function __construct() {
        $this->path = public_path('storage/'.$this->dir);
	}

	//PAGE INDEX (VIEW DATA)
    public function index() {
    	return view($this->url_view.'/viewData');
	}
	//GET DATA SHOW IT TO DATATABLES 
    public function get_data() {
        $data = M_TTE::all();
        $datatable = YajraDataTables::of($data)->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        $id = $data->id;
                        $button = "
                        <div class='btn-group btn-group-sm'>
                            <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                                Action
                            </button>
                            <ul class='dropdown-menu'>
                                <li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalEdit' onclick=\"edit('".$id."')\"> <i class='fas fa-edit'></i> Edit </a> </li>
                                <li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalDelete' onclick=\"hapus('".$id."')\"> <i class='fas fa-trash'></i> Hapus </a> </li>
                                <li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalDetail' onclick=\"detail('".$id."')\"> <i class='fas fa-search'></i> Detail </a> </li>
                                <li class='dropdown-divider'></li>
                                <li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalReset' onclick=\"resetDw('".$id."')\"> <i class='fas fa-sync-alt'></i> Reset Download </a> </li>
                            </ul>
                        </div>";
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        return $datatable;
	}
	
	//ACT INSERT
	public function act_insert(R_TTE $request) {
        DB::beginTransaction();
		try { 
            $data = [
                'name' => $request->name,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'position_institusion' => $request->position_institusion,
                'region' => $this->region,
			];
            M_TTE::create($data);
            DB::commit();
			return redirect($this->url_route)->with(['success' => 'Berhasil menyimpan data !']);
		} 
		catch (\Exception $ex) {
            DB::rollback(); 
			return redirect($this->url_route)->with(['failed' => 'Gagal menyimpan data, '.$ex->getMessage()]);
        }
    }

	//CONFIRM EDIT TO MODAL
	public function confirm_edit(Request $request) {
        $id = $request->id;
		$data['_rowEdit'] = M_TTE::findOrFail($id);
        return view($this->url_view.'/getEdit', $data);
	}
	//ACT UPDATE
	public function act_update(R_TTE $request) {
        DB::beginTransaction();
		try { 
            $id = $request->id;
            $data = [
                'name' => $request->name,
                'nip' => $request->nip,
                'nik' => $request->nik,
                'position_institusion' => $request->position_institusion,
                'region' => $this->region,
			];
            M_TTE::findOrFail($id)->update($data);
            DB::commit();
			return redirect($this->url_route)->with(['success' => 'Berhasil mengubah data !']);
		} 
		catch (\Exception $ex) {
            DB::rollback();
			return redirect($this->url_route)->with(['failed' => 'Gagal mengubah data, '.$ex->getMessage()]);
		}
	}

	//CONFIRM DELETE TO MODAL
	public function confirm_delete(Request $request) {
        $id = $request->id;
        $data['_rowDel'] = M_TTE::findOrFail($id);
		return view($this->url_view.'/getDelete', $data);
	}
	//ACT DELETE
	public function act_delete(Request $request) {
        DB::beginTransaction();
		try { 		
            $id = $request->id;
            M_TTE::findOrFail($id)->delete();
            DB::commit();
			return redirect($this->url_route)->with(['success' => 'Berhasil menghapus data !']);
		} 
		catch (\Exception $ex) { 
            DB::rollback();
			return redirect($this->url_route)->with(['failed' => 'Gagal menghapus data, '.$ex->getMessage()]);
		}
    }
    
	//CONFIRM DETAIL TO MODAL
	public function confirm_detail(Request $request) {
        $id = $request->id;
        $data['_rowDet'] = M_TTE::findOrFail($id);
		return view($this->url_view.'/getDetail', $data);
    }
    
	//CONFIRM RESET DOWNLOAD TO MODAL
	public function confirm_reset(Request $request) {
        $id = $request->id;
        $data['_rowRes'] = M_TTE::findOrFail($id);
		return view($this->url_view.'/getReset', $data);
	}
	//ACT RESET DOWNLOAD
	public function act_reset(Request $request) {
        DB::beginTransaction();
		try { 		
            $id = $request->id;
            $data = [
                'number_of_downloads' => 0,
            ];	
            M_TTE::findOrFail($id)->update($data);
            DB::commit();
			return redirect($this->url_route)->with(['success' => 'Berhasil me-reset pembatasan jumlah download !']);
		} 
		catch (\Exception $ex) { 
            DB::rollback();
			return redirect($this->url_route)->with(['failed' => 'Gagal me-reset, '.$ex->getMessage()]);
		}
    }

	//PREVIEW EXCEL IMPORT DATA
	public function preview_excel(Request $request) {
		try { 
            //File upload
            $file = $request->file('file_excel');
            $file_ext = $file->getClientOriginalExtension();   
            $file_name = "file_tmp_import_tte.".$file_ext;

            //Delete old file if exist 
            $file_path_old = $this->path.'/'."file_tmp_import_tte.".$file_ext;
            if (File::exists($file_path_old)) File::delete($file_path_old);

            //Move upload file
            $file->move($this->path, $file_name);

            // (new TTEImport)->import($this->path.'/'.$file_name, null, \Maatwebsite\Excel\Excel::CSV);
            // (new TTEImport)->import($this->path.'/'.$file_name);

            $data['_dataExcel'] = Excel::toArray(new TTEImport, $this->path.'/'.$file_name)[0];
            return view($this->url_view.'/prevExcel', $data);
            // return $data['_dataExcel'];
        } 
        catch (\Exception $ex) {
            return redirect($this->url_route)->with(['failed' => 'Gagal preview, '.$ex->getMessage()]);
        }
    }
	//ACT IMPORT DATA
    public function act_import_excel(Request $request) {
        DB::beginTransaction();
		try { 
            ini_set("memory_limit", "2048M");
            $file_name = "file_tmp_import_tte.xlsx";
            $_dataExcel = Excel::toArray(new TTEImport, $this->path.'/'.$file_name)[0];

            $numrow = 1; $import_succ = 0; $import_fail = 0;
            foreach ($_dataExcel as $row) {
                $nama = trim($row[1]);
                $nip = str_replace("'", "", trim($row[2]));	
                $nik = str_replace("'", "", trim($row[3]));	
                $jabatan = trim($row[4]);

                if ($nama=="" and $nip=="" and $nik=="" and $jabatan=="") continue;

                //Baris 1 skip, karna header kolom
                if ($numrow > 1) {
                    $data = [
                        'name' => $nama != '' ? $nama : null,
                        'nip' => $nip != '' ? str_replace("'", "", $nip) : null,
                        'nik' => $nik != '' ? str_replace("'", "", $nik) : null,
                        'position_institusion' => $jabatan != '' ? $jabatan : null,
                        'region' => $this->region,
                    ];
                    $sqlIns = M_TTE::create($data);          
                    if ($sqlIns)
                        $import_succ++;
                    else
                        $import_fail++;
                }
                $numrow++;
            }
            if ($import_fail == 0) {
                DB::commit();
                return redirect($this->url_route)->with(['success' => 'Berhasil meng-import '.$import_succ.' data !']);
            }
            else {
                DB::rollback();
                return redirect($this->url_route)->with(['failed' => 'Gagal, CEK KEMBALI FILE EXCEL !']);
            }
        }
		catch (\Exception $ex) {
            DB::rollback();
			return redirect($this->url_route)->with(['failed' => 'Gagal meng-import data, '.$ex->getMessage()]);
		}	
    }

}
