<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    use ApiResponse;

    public function index() {
        return $this->successResponse(User::getAll(), 'Daftar pengguna berhasil diambil');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

        $data = User::storeData($request->all());
        return $this->successResponse($data, 'Pengguna berhasil ditambahkan', 201);
    }

    public function show($id) {
        try {
            return $this->successResponse(User::getById($id), 'Detail pengguna ditemukan');
        } catch (Exception $e) {
            return $this->errorResponse('Data pengguna tidak ditemukan', 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'name'     => 'sometimes|required|string|max:255',
                'email'    => 'sometimes|required|email|unique:users,email,'.$id,
                'password' => 'sometimes|required|string|min:6',
                'role'     => 'sometimes|required|string'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 422);
            }

            $data = User::updateData($id, $request->all());
            return $this->successResponse($data, 'Data pengguna berhasil diperbarui');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal memperbarui, data pengguna tidak ditemukan', 404);
        }
    }

    public function destroy($id) {
        try {
            User::softDeleteData($id);
            return $this->successResponse(null, 'Pengguna berhasil dihapus');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal menghapus, data pengguna tidak ditemukan', 404);
        }
    }

    public function restore($id) {
        try {
            User::restoreData($id);
            return $this->successResponse(null, 'Data pengguna berhasil dikembalikan');
        } catch (Exception $e) {
            return $this->errorResponse('Gagal mengembalikan, data tidak ditemukan di tempat sampah', 404);
        }
    }
}
