<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuActionType extends Model
{
    use HasFactory;

	protected $table = "menu_action_types";

    protected $fillable = [
    	'action_id','name','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
