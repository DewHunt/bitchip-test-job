<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAction extends Model
{
    use HasFactory;

	protected $table = "menu_actions";

    protected $fillable = [
    	'parent_menu_id','menu_type_id','action_name','action_link','order_by','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
