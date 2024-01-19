<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormFields extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "form_fields";

    protected $fillable = array('form_id','field_name','field_label','field_type','field_value','field_options','status');
}
