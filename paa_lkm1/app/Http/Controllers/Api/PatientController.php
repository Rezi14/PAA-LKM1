<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PatientController extends Controller
{
    use ApiResponse;

    public function index() {
        return $this->successResponse(Patient::getAll(), 'Daftar pasien berhasil diambil');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id'               => 'required|integer|exists:users,id',
            'medical_record_number' => 'required|string|unique:patients,medical_record_number',
            'national_id'           => 'required|string|unique:patients,national_id',
            'full_name'             => 'required|string|max:255',
            'phone_number'          => 'required|string|max:20'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

        $data = Patient::storeData($request->all());
        return $this->successResponse($data, 'Pasien berhasil didaftarkan', 201);
    }

    public function show($id) {
        try {
            return $this->successResponse(Patient::getById($id), 'Detail pasien ditemukan');
        } catch (Exception $e) {
            return $this->errorResponse('Data pasien tidak ditemukan', 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'user_id'               => 'sometimes|required|integer|exists:users,id',
                'medical_record_number' => 'sometimes|required|string|unique:patients,medical_record_number,'.$id,
                'national_id'           => 'sometimes|required|string|unique:patients,national_id,'.$id,
                'full_name'             => 'sometimes|required|string|max:255',
                'phone_number'          => 'sometimes|required|string|max:20'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422);
            }

            $data = Patient::updateData($id, $request->all());
            return $this->successResponse($data, 'Data pasien berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal memperbarui, data pasien tidak ditemukan', 404);
        }
    }

    public function destroy($id) {
        try {
            Patient::softDeleteData($id);
            return $this->successResponse(null, 'Pasien berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus, data pasien tidak ditemukan', 404);
        }
    }

    public function restore($id) {
        try {
            Patient::restoreData($id);
            return $this->successResponse(null, 'Data pasien berhasil dikembalikan');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengembalikan, data tidak ditemukan di tempat sampah', 404);
        }
    }
}
