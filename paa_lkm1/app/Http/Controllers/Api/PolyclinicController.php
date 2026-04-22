<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Polyclinic;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PolyclinicController extends Controller
{
    use ApiResponse;

    public function index() {
        return $this->successResponse(Polyclinic::getAll(), 'Daftar poliklinik berhasil diambil');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:polyclinics,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

        $data = Polyclinic::storeData($request->all());
        return $this->successResponse($data, 'Poliklinik berhasil ditambahkan', 201);
    }

    public function show($id) {
        try {
            $data = Polyclinic::getById($id);
            return $this->successResponse($data, 'Detail poliklinik ditemukan');
        } catch (Exception $e) {
            return $this->errorResponse('Data poliklinik tidak ditemukan', 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'sometimes|required|string|unique:polyclinics,code,'.$id,
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422);
            }

            $data = Polyclinic::updateData($id, $request->all());
            return $this->successResponse($data, 'Poliklinik berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal memperbarui, data poliklinik tidak ditemukan', 404);
        }
    }

    public function destroy($id) {
        try {
            Polyclinic::softDeleteData($id);
            return $this->successResponse(null, 'Poliklinik berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus, data poliklinik tidak ditemukan', 404);
        }
    }

    public function restore($id) {
        try {
            Polyclinic::restoreData($id);
            return $this->successResponse(null, 'Data poliklinik berhasil dikembalikan');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengembalikan, data tidak ditemukan di tempat sampah', 404);
        }
    }
}
