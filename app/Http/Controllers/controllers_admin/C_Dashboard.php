<?php

namespace App\Http\Controllers\controllers_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\M_TTE;

class C_Dashboard extends Controller {

	public $url_route = "dashboard";
    public $url_view = "views_admin";

	public function __construct() {
	}

	//PAGE INDEX 
    public function index() {
    	return redirect()->route('tte.index');
    }

}
