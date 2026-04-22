<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'role'];

    // CRUD Logic
    public static function getAll()
    {
        return self::all();
    }

    public static function getById($id)
    {
        return self::findOrFail($id);
    }

    public static function storeData($data)
    {
        $data['password'] = Hash::make($data['password']);
        return self::create($data);
    }

    public static function updateData($id, $data)
    {
        $user = self::findOrFail($id);
        if (isset($data['password']))
            $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return $user;
    }

    public static function softDeleteData($id)
    {
        return self::findOrFail($id)->delete();
    }

    public static function restoreData($id)
    {
        $user = self::onlyTrashed()->findOrFail($id);
        return $user->restore();
    }
}
