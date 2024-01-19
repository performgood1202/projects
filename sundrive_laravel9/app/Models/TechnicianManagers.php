<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TechnicianManagers extends Model
{
    use HasFactory;

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }
}
