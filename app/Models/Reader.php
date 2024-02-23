<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    use HasFactory;

	protected $table = "readers";

    protected $fillable = [
    	'first_name','last_name','email','phone','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
