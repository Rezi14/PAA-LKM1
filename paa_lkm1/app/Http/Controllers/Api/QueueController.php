<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class QueueController extends Controller
{
    use ApiResponse;

    public function index() {
        return $this->successResponse(Queue::getAll(), 'Daftar antrian berhasil diambil');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'patient_id'    => 'required|integer|exists:patients,id',
            'polyclinic_id' => 'required|integer|exists:polyclinics,id',
            'queue_number'  => 'required|string',
            'date'          => 'required|date',
            'status'        => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

        $data = Queue::storeData($request->all());
        return $this->successResponse($data, 'Antrian berhasil dibuat', 201);
    }

    public function show($id) {
        try {
            return $this->successResponse(Queue::getById($id), 'Detail antrian ditemukan');
        } catch (Exception $e) {
            return $this->errorResponse('Data antrian tidak ditemukan', 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'patient_id'    => 'sometimes|required|integer|exists:patients,id',
                'polyclinic_id' => 'sometimes|required|integer|exists:polyclinics,id',
                'queue_number'  => 'sometimes|required|string',
                'date'          => 'sometimes|required|date',
                'status'        => 'sometimes|required|string'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422);
            }

            $data = Queue::updateData($id, $request->all());
            return $this->successResponse($data, 'Status antrian berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal memperbarui, data antrian tidak ditemukan', 404);
        }
    }

    public function destroy($id) {
        try {
            Queue::softDeleteData($id);
            return $this->successResponse(null, 'Antrian berhasil dibatalkan/dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus, data antrian tidak ditemukan', 404);
        }
    }

    public function restore($id) {
        try {
            Queue::restoreData($id);
            return $this->successResponse(null, 'Data antrian berhasil dikembalikan');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengembalikan, data tidak ditemukan di tempat sampah', 404);
        }
    }
}
