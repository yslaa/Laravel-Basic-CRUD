<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class personnel extends Model
{
    use HasFactory;

    // use SoftDeletes;

    // protected $dates = ["deleted_at"];

    protected $table = "personnels";

    protected $primaryKey = "id";

    protected $guarded = ["id"];

    protected $fillable = ["first_name", "last_name", "phone_number", "images"];
}
