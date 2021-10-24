<?php

namespace App\Http\Controllers\controllers_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use YajraDataTables;

use App\Models\User;
use App\Http\Requests\R_User; 

class C_User extends Controller {

	public $url_route = "dashboard/user";
    public $url_view = "views_admin/user";
    public $path;

	public function __construct() {
        $this->path = public_path('storage/profile-photos/');
	}
	
	//PAGE INDEX (VIEW DATA)
    public function index() {
    	return view($this->url_view.'/viewData');
	}
	//GET DATA SHOW IT TO DATATABLES 
    public function get_data() {
        $data = User::all(['id', 'profile_photo_path', 'email', 'name', 'phone_number', 'level', 'status']);
        $datatable = YajraDataTables::of($data)->addIndexColumn()
                    ->addColumn('photo', function ($data) {
                        $photo = "
                        <a href='".$data->profile_photo_url."' data-toggle='lightbox' data-title='<i class=\"fas fa-image\"></i> ".ucwords($data->name)."' data-gallery='data-user'>
                            <img src='".$data->profile_photo_url."' class='img-fluid img-thumbnail' alt='".ucwords($data->name)."' width='200px'/>
                        </a>";
                        return $photo;
                    })
                    ->addColumn('level', function ($data) {
                        if ($data->level == 1)
                            $level = "<label class='badge badge-danger'>-Super Admin-</label> ";
                        else
                            $level = "<label class='badge badge-info'>-Middle Admin-</label> ";
                        return $level;
                    })
                    ->addColumn('status', function ($data) {
                        return $data->status=="1" ? "<span class='text-success' title='Aktif'><i class='fas fa-check-circle'></i></span>" : "<span class='text-danger' title='Non Aktif'><i class='fas fa-times-circle'></i></span>";
                    })
                    ->addColumn('action', function ($data) {
                        $id = $data->id;
                        if($data->level=='1' and (Auth::user()->level!='1' or Auth::user()->id==$data->id)) {
                            $editBtn = "";
                            $deleteBtn = "";
                        }
                        else {
                            $editBtn = 
                            "<li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalEdit' onclick=\"edit('".$id."')\"> <i class='fas fa-edit'></i> Edit </a> </li>";
                            $deleteBtn = 
                            "<li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalDelete' onclick=\"hapus('".$id."')\"> <i class='fas fa-trash'></i> Hapus </a> </li>";
                        }
                        $resetBtn =
                        "<li class='dropdown-divider'></li>
                        <li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalReset' onclick=\"resPs('".$id."')\"> <i class='fas fa-sync-alt'></i> Reset Password </a> </li>";
                        
                        $button = "
                        <div class='btn-group btn-group-sm'>
                            <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                                Action
                            </button>
                            <ul class='dropdown-menu'>
                                ".$editBtn."
                                ".$deleteBtn."
                                <li> <a class='dropdown-item' data-toggle='modal' data-target='#myModalDetail' onclick=\"detail('".$id."')\"> <i class='fas fa-search'></i> Detail </a> </li>
                                ".$resetBtn."
                            </ul>
                        </div>";
                        return $button;
                    })
                    ->rawColumns(['action', 'photo', 'level', 'status'])
                    ->make(true);

        return $datatable;
	}
	
	//ACT INSERT
	public function act_insert(R_User $request) {
        DB::beginTransaction();
		try { 
            //Photo upload
            $photo = $request->file('photo');
            if($photo != null) {
                $slug = Str::slug($request->name); 
                $photo_ext = $photo->getClientOriginalExtension();   
                $photo_name = mt_rand(10000,99999)."-user-".$slug.".".$photo_ext; //(15 root) + 16 + (255 name) = 286
            }
            $data = [
                'email' => $request->email,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'level' => $request->level,
                'password' => Hash::make($request->password),
                'profile_photo_path' => $photo ? "profile-photos/".$photo_name : null,
                'status' => 1,
    			'created_by' => Auth::user()->id,
    			'updated_by' => Auth::user()->id,
			];
            User::create($data);
            //Move upload photo
            if($photo != null) {
                $photo->move($this->path, $photo_name);
            }
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
		$data['_rowEdit'] = User::findOrFail($id);
        return view($this->url_view.'/getEdit', $data);
	}
	//ACT UPDATE
	public function act_update(R_User $request) {
        DB::beginTransaction();
		try { 
            $id = $request->id;
            //Get old data
            $rowOld = User::findOrFail($id);
            $photo_old = $rowOld->profile_photo_path;
            
			//Photo upload
            $photo = $request->file('photo');
            if($photo != null) {
                $slug = Str::slug($request->name); 
                $photo_ext = $photo->getClientOriginalExtension();   
                $photo_name = mt_rand(10000,99999)."-user-".$slug.".".$photo_ext; 
            }
            $data = [
                'email' => $request->email,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'level' => $request->level,
                'status' => $request->status,
    			'updated_by' => Auth::user()->id,
			];
            if ($photo != null)
                $data['profile_photo_path'] = "profile-photos/".$photo_name; 
            if ($request->email != $request->unique_old)
                $data['email_verified_at'] = null;
            
            $rowOld->update($data);

			if($photo != null) {
                //Move upload photo
                $photo->move($this->path, $photo_name);
                //Delete old photo
                $photo_path_old = public_path('storage/'.$photo_old);
                if (File::exists($photo_path_old)) File::delete($photo_path_old);
            }
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
        $data['_rowDel'] = User::findOrFail($id);
		return view($this->url_view.'/getDelete', $data);
	}
	//ACT DELETE
	public function act_delete(Request $request) {
        DB::beginTransaction();
		try { 		
            $id = $request->id;
            //Get old data
            $rowOld = User::findOrFail($id);
            $photo_old = $rowOld->profile_photo_path;

            $rowOld->delete();
            
			//Delete old photo
            $photo_path_old = public_path('storage/'.$photo_old);
            if (File::exists($photo_path_old)) File::delete($photo_path_old);
            
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
        $data['_rowDet'] = User::findOrFail($id);
		return view($this->url_view.'/getDetail', $data);
    }
    
	//KONFIRMASI RESET PASSWORD KE MODAL
	public function confirm_reset(Request $request) {
        $id = $request->id;
        $data['_rowRes'] = User::findOrFail($id);
		return view($this->url_view.'/getReset', $data);
	}
	//ACT RESET PASSWORD
	public function act_reset_password(Request $request) {
        DB::beginTransaction();
		try { 		
            $id = $request->id;
            $data = [
                'password' => Hash::make("-Pass123456-"),
            ];	
            User::findOrFail($id)->update($data);
            DB::commit();
			return redirect($this->url_route)->with(['success' => 'Berhasil me-reset password !']);
		} 
		catch (\Exception $ex) { 
            DB::rollback();
			return redirect($this->url_route)->with(['failed' => 'Gagal me-reset password, '.$ex->getMessage()]);
		}
    }

    //ACT DELETE PHOTO
    public function act_delete_photo(Request $request) {
        DB::beginTransaction();
		try { 		
            $id = $request->id;
            //Get old data
            $rowOld = User::findOrFail($id);
            $photo_old = $rowOld->profile_photo_path;

            $data = [
                'profile_photo_path' => null
            ];
            $rowOld->update($data);

            //Delete old photo
            $photo_path_old = public_path('storage/'.$photo_old);
            if (File::exists($photo_path_old)) File::delete($photo_path_old);

            DB::commit();
			return redirect($this->url_route)->with(['success' => 'Berhasil menghapus foto !']);
		} 
		catch (\Exception $ex) { 
            DB::rollback();
			return redirect($this->url_route)->with(['failed' => 'Gagal menghapus foto, '.$ex->getMessage()]);
		}
    }
    
}