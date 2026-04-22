<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class DoctorController extends Controller
{
    use ApiResponse;

    public function index() {
        return $this->successResponse(Doctor::getAll(), 'Daftar dokter berhasil diambil');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id'        => 'required|integer|exists:users,id',
            'polyclinic_id'  => 'required|integer|exists:polyclinics,id',
            'specialization' => 'required|string|max:255',
            'schedule'       => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

        $data = Doctor::storeData($request->all());
        return $this->successResponse($data, 'Dokter berhasil ditambahkan', 201);
    }

    public function show($id) {
        try {
            return $this->successResponse(Doctor::getById($id), 'Detail dokter ditemukan');
        } catch (Exception $e) {
            return $this->errorResponse('Data dokter tidak ditemukan', 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'user_id'        => 'sometimes|required|integer|exists:users,id',
                'polyclinic_id'  => 'sometimes|required|integer|exists:polyclinics,id',
                'specialization' => 'sometimes|required|string|max:255',
                'schedule'       => 'sometimes|required|string'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422);
            }

            $data = Doctor::updateData($id, $request->all());
            return $this->successResponse($data, 'Data dokter berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal memperbarui, data dokter tidak ditemukan', 404);
        }
    }

    public function destroy($id) {
        try {
            Doctor::softDeleteData($id);
            return $this->successResponse(null, 'Dokter berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus, data dokter tidak ditemukan', 404);
        }
    }

    public function restore($id) {
        try {
            Doctor::restoreData($id);
            return $this->successResponse(null, 'Data dokter berhasil dikembalikan');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengembalikan, data tidak ditemukan di tempat sampah', 404);
        }
    }
}
