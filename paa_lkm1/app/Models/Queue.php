<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    use SoftDeletes;
    protected $fillable = ['patient_id', 'polyclinic_id', 'queue_number', 'date', 'status'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class);
    }

    public static function getAll()
    {
        return self::with(['patient', 'polyclinic'])->get();
    }

    public static function getById($id)
    {
        return self::with(['patient', 'polyclinic'])->findOrFail($id);
    }

    public static function storeData($data)
    {
        return self::create($data);
    }

    public static function updateData($id, $data)
    {
        $queue = self::findOrFail($id);
        $queue->update($data);
        return $queue;
    }

    public static function softDeleteData($id)
    {
        return self::findOrFail($id)->delete();
    }

    public static function restoreData($id)
    {
        $queue = self::onlyTrashed()->findOrFail($id);
        return $queue->restore();
    }
}
