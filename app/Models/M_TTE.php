<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_TTE extends Model {

    use HasFactory;
    
	protected $table = "tte";
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
}
