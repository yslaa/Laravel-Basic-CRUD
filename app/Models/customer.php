<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class customer extends Model
{
    use HasFactory;

    // use SoftDeletes;

    // protected $dates = ["deleted_at"];

    protected $table = "customers";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    protected $fillable = ["first_name", "last_name", "phone_number", "images"];
}
