<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_user_table', 'role_id', 'permission_id')->withPivot(['permission_id', 'role_id']);
    }
}
