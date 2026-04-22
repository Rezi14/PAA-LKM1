<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'medical_record_number', 'national_id', 'full_name', 'phone_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
        return self::create($data);
    }

    public static function updateData($id, $data)
    {
        $patient = self::findOrFail($id);
        $patient->update($data);
        return $patient;
    }

    public static function softDeleteData($id)
    {
        return self::findOrFail($id)->delete();
    }

    public static function restoreData($id)
    {
        $patient = self::onlyTrashed()->findOrFail($id);
        return $patient->restore();
    }
}
