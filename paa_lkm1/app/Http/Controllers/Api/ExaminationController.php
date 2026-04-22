<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ExaminationController extends Controller
{
    use ApiResponse;

    public function index() {
        return $this->successResponse(Examination::getAll(), 'Daftar rekam medis berhasil diambil');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'queue_id'  => 'required|integer|exists:queues,id',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'complaint' => 'required|string',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

        $data = Examination::storeData($request->all());
        return $this->successResponse($data, 'Data pemeriksaan berhasil disimpan', 201);
    }

    public function show($id) {
        try {
            return $this->successResponse(Examination::getById($id), 'Detail rekam medis ditemukan');
        } catch (Exception $e) {
            return $this->errorResponse('Data rekam medis tidak ditemukan', 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'queue_id'  => 'sometimes|required|integer|exists:queues,id',
                'doctor_id' => 'sometimes|required|integer|exists:doctors,id',
                'complaint' => 'sometimes|required|string',
                'diagnosis' => 'sometimes|required|string',
                'treatment' => 'sometimes|required|string'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422);
            }

            $data = Examination::updateData($id, $request->all());
            return $this->successResponse($data, 'Data rekam medis berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal memperbarui, data pemeriksaan tidak ditemukan', 404);
        }
    }

    public function destroy($id) {
        try {
            Examination::softDeleteData($id);
            return $this->successResponse(null, 'Data pemeriksaan berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus, data pemeriksaan tidak ditemukan', 404);
        }
    }

    public function restore($id) {
        try {
            Examination::restoreData($id);
            return $this->successResponse(null, 'Data pemeriksaan berhasil dikembalikan');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengembalikan, data tidak ditemukan di tempat sampah', 404);
        }
    }
}
