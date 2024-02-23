<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

	protected $table = "books";

    protected $fillable = [
    	'name','author','description','image','status'
    ];

	protected $hidden = [
		'created_at','updated_at'
	];
}
