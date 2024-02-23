<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model
{
    use HasFactory;

    protected $table = "admin_settings";

    protected $fillable = [
        'title','developed_by','developer_site','logo','thumb_logo','fav_icon','status'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];
}
