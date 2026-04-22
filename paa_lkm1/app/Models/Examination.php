<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examination extends Model
{
    use SoftDeletes;
    protected $fillable = ['queue_id', 'doctor_id', 'complaint', 'diagnosis', 'treatment'];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public static function getAll()
    {
        return self::with(['queue', 'doctor'])->get();
    }

    public static function getById($id)
    {
        return self::with(['queue', 'doctor'])->findOrFail($id);
    }

    public static function storeData($data)
    {
        return self::create($data);
    }

    public static function updateData($id, $data)
    {
        $exam = self::findOrFail($id);
        $exam->update($data);
        return $exam;
    }

    public static function softDeleteData($id)
    {
        return self::findOrFail($id)->delete();
    }

    public static function restoreData($id)
    {
        $exam = self::onlyTrashed()->findOrFail($id);
        return $exam->restore();
    }
}
