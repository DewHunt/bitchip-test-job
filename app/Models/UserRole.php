<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

	protected $table = "user_roles";

    protected $fillable = [
    	'name','parent_role','level','order_by','status','permission','action_permission'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
