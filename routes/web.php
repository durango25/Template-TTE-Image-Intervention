<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\controllers_admin as admin;
use App\Http\Controllers\controllers_public as publik;

//[---ROUTE PUBLIC---]
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return redirect()->route('p.tte.index');
    })->name('p.index');

	Route::prefix('tte')->group(function () {
		Route::get('/', [publik\C_Public::class, 'index'])->name('p.tte.index');
		Route::any('check', [publik\C_Public::class, 'act_check'])->name('p.tte.check');
        Route::get('download', [publik\C_Public::class, 'download'])->name('p.tte.download');
    });
});
//[---END ROUTE PUBLIC---]

//[=======================================================================================================================================]

//[---ROUTE ADMIN---]
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
	//Route Dashboard
    Route::get('/', [admin\C_Dashboard::class, 'index'])->name('dashboard');

    //Route Module User
	Route::prefix('user')->group(function () {
		Route::get('/', [admin\C_User::class, 'index'])->name('user.index');
		Route::get('get_data', [admin\C_User::class, 'get_data'])->name('user.data');
		Route::post('tambah', [admin\C_User::class, 'act_insert'])->name('user.add');
		Route::post('konfirm_edit', [admin\C_User::class, 'confirm_edit'])->name('user.confirm-edit');
        Route::post('edit', [admin\C_User::class, 'act_update'])->name('user.edit');
		Route::post('konfirm_hapus', [admin\C_User::class, 'confirm_delete'])->name('user.confirm-delete');
		Route::post('hapus', [admin\C_User::class, 'act_delete'])->name('user.delete');
		Route::post('konfirm_detail', [admin\C_User::class, 'confirm_detail'])->name('user.confirm-detail');
		Route::post('konfirm_reset', [admin\C_User::class, 'confirm_reset'])->name('user.confirm-reset');
		Route::post('reset', [admin\C_User::class, 'act_reset_password'])->name('user.reset');
		Route::any('hapus_foto/{id}', [admin\C_User::class, 'act_delete_photo'])->name('user.delete-photo')->where('id', '[0-9]+');
    });

    //Route Module TTE
	Route::prefix('tte')->group(function () {
		Route::get('/', [admin\C_TTE::class, 'index'])->name('tte.index');
		Route::get('get_data', [admin\C_TTE::class, 'get_data'])->name('tte.data');
		Route::post('tambah', [admin\C_TTE::class, 'act_insert'])->name('tte.add');
		Route::post('konfirm_edit', [admin\C_TTE::class, 'confirm_edit'])->name('tte.confirm-edit');
		Route::post('edit', [admin\C_TTE::class, 'act_update'])->name('tte.edit');
		Route::post('konfirm_hapus', [admin\C_TTE::class, 'confirm_delete'])->name('tte.confirm-delete');
		Route::post('hapus', [admin\C_TTE::class, 'act_delete'])->name('tte.delete');
		Route::post('konfirm_detail', [admin\C_TTE::class, 'confirm_detail'])->name('tte.confirm-detail');
		Route::post('konfirm_reset', [admin\C_TTE::class, 'confirm_reset'])->name('tte.confirm-reset');
		Route::post('reset', [admin\C_TTE::class, 'act_reset'])->name('tte.reset');
        Route::get('import', [admin\C_TTE::class, 'view_import'])->name('tte.view-import');
        Route::post('preview_excel', [admin\C_TTE::class, 'preview_excel'])->name('tte.preview-excel');
        Route::post('import_excel', [admin\C_TTE::class, 'act_import_excel'])->name('tte.import-excel');
    });
});
//[---END ROUTE ADMIN---]

require __DIR__ . '/auth.php';

URL::forceScheme('https');
