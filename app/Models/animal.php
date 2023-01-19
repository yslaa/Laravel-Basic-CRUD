<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class animal extends Model 
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "animals";

    protected $fillable = [ "animal_name", "animal_type", "age", "gender", "images", "customer_id","deleted_at"];

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}