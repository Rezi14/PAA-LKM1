<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class KlinikSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $password = Hash::make('password');

        //  Insert 15 Users
        DB::table('users')->insert([
            ['name' => 'Admin Klinik', 'email' => 'admin@gmail.com', 'password' => $password, 'role' => 'admin', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'dr. Andi Wijaya', 'email' => 'andi@gmail.com', 'password' => $password, 'role' => 'doctor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'drg. Budi Gunawan', 'email' => 'budi@gmail.com', 'password' => $password, 'role' => 'doctor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'dr. Citra Lestari', 'email' => 'citra@gmail.com', 'password' => $password, 'role' => 'doctor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'dr. Doni Pratama, Sp.M', 'email' => 'doni@gmail.com', 'password' => $password, 'role' => 'doctor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'dr. Eka Sari, Sp.THT', 'email' => 'eka@gmail.com', 'password' => $password, 'role' => 'doctor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'dr. Fina Mulyani, Sp.PD', 'email' => 'fina@gmail.com', 'password' => $password, 'role' => 'doctor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'dr. Gilang Ramadhan, Sp.A', 'email' => 'gilang@gmail.com', 'password' => $password, 'role' => 'doctor', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fahrezi Angga Lesmana', 'email' => 'fahrezi@gmail.com', 'password' => $password, 'role' => 'patient', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'M Rafli Hidayatullah', 'email' => 'rafli@gmail.com', 'password' => $password, 'role' => 'patient', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Nafariel Dwi Ambariyono', 'email' => 'nafariel@gmail.com', 'password' => $password, 'role' => 'patient', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Anwar Ibrahim Ahmad', 'email' => 'anwar@gmail.com', 'password' => $password, 'role' => 'patient', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Budi Santoso', 'email' => 'budii@gmail.com', 'password' => $password, 'role' => 'patient', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Siti Aminah', 'email' => 'siti@gmail.com', 'password' => $password, 'role' => 'patient', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Rina Melati', 'email' => 'rina@gmail.com', 'password' => $password, 'role' => 'patient', 'created_at' => $now, 'updated_at' => $now],
        ]);

        //  Insert 7 Polyclinics
        DB::table('polyclinics')->insert([
            ['code' => 'POL-001', 'name' => 'Poli Umum', 'description' => 'Layanan kesehatan umum', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'POL-002', 'name' => 'Poli Gigi', 'description' => 'Layanan gigi', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'POL-003', 'name' => 'Poli KIA', 'description' => 'Kesehatan Ibu dan Anak', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'POL-004', 'name' => 'Poli Mata', 'description' => 'Kesehatan mata', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'POL-005', 'name' => 'Poli THT', 'description' => 'Telinga, Hidung, Tenggorokan', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'POL-006', 'name' => 'Poli Penyakit Dalam', 'description' => 'Spesialis penyakit dalam', 'created_at' => $now, 'updated_at' => $now],
            ['code' => 'POL-007', 'name' => 'Poli Anak', 'description' => 'Spesialis anak', 'created_at' => $now, 'updated_at' => $now],
        ]);

        //  Insert 7 Doctors
        DB::table('doctors')->insert([
            ['user_id' => 2, 'polyclinic_id' => 1, 'specialization' => 'Dokter Umum', 'schedule' => 'Senin - Rabu', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 3, 'polyclinic_id' => 2, 'specialization' => 'Dokter Gigi', 'schedule' => 'Selasa - Kamis', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 4, 'polyclinic_id' => 3, 'specialization' => 'Dokter Umum', 'schedule' => 'Senin - Jumat', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 5, 'polyclinic_id' => 4, 'specialization' => 'Spesialis Mata', 'schedule' => 'Rabu - Jumat', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 6, 'polyclinic_id' => 5, 'specialization' => 'Spesialis THT', 'schedule' => 'Senin - Kamis', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 7, 'polyclinic_id' => 6, 'specialization' => 'Spesialis Penyakit Dalam', 'schedule' => 'Selasa - Sabtu', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 8, 'polyclinic_id' => 7, 'specialization' => 'Spesialis Anak', 'schedule' => 'Senin - Jumat', 'created_at' => $now, 'updated_at' => $now],
        ]);

        //  Insert 7 Patients
        DB::table('patients')->insert([
            ['user_id' => 9, 'medical_record_number' => 'RM-2026-001', 'national_id' => '3509012345670001', 'full_name' => 'Fahrezi Angga Lesmana', 'phone_number' => '081234567890', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 10, 'medical_record_number' => 'RM-2026-002', 'national_id' => '3509012345670002', 'full_name' => 'M Rafli Hidayatullah', 'phone_number' => '081234567891', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 11, 'medical_record_number' => 'RM-2026-003', 'national_id' => '3509012345670003', 'full_name' => 'Nafariel Dwi Ambariyono', 'phone_number' => '081234567892', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 12, 'medical_record_number' => 'RM-2026-004', 'national_id' => '3509012345670004', 'full_name' => 'Anwar Ibrahim Ahmad', 'phone_number' => '081234567893', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 13, 'medical_record_number' => 'RM-2026-005', 'national_id' => '3509012345670005', 'full_name' => 'Budi Santoso', 'phone_number' => '081234567894', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 14, 'medical_record_number' => 'RM-2026-006', 'national_id' => '3509012345670006', 'full_name' => 'Siti Aminah', 'phone_number' => '081234567895', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => 15, 'medical_record_number' => 'RM-2026-007', 'national_id' => '3509012345670007', 'full_name' => 'Rina Melati', 'phone_number' => '081234567896', 'created_at' => $now, 'updated_at' => $now],
        ]);

        //  Insert 7 Queues
        DB::table('queues')->insert([
            ['patient_id' => 1, 'polyclinic_id' => 1, 'queue_number' => 'A-001', 'date' => $now->toDateString(), 'status' => 'completed', 'created_at' => $now, 'updated_at' => $now],
            ['patient_id' => 2, 'polyclinic_id' => 2, 'queue_number' => 'B-001', 'date' => $now->toDateString(), 'status' => 'completed', 'created_at' => $now, 'updated_at' => $now],
            ['patient_id' => 3, 'polyclinic_id' => 3, 'queue_number' => 'C-001', 'date' => $now->toDateString(), 'status' => 'completed', 'created_at' => $now, 'updated_at' => $now],
            ['patient_id' => 4, 'polyclinic_id' => 4, 'queue_number' => 'D-001', 'date' => $now->toDateString(), 'status' => 'completed', 'created_at' => $now, 'updated_at' => $now],
            ['patient_id' => 5, 'polyclinic_id' => 5, 'queue_number' => 'E-001', 'date' => $now->toDateString(), 'status' => 'completed', 'created_at' => $now, 'updated_at' => $now],
            ['patient_id' => 6, 'polyclinic_id' => 6, 'queue_number' => 'F-001', 'date' => $now->toDateString(), 'status' => 'completed', 'created_at' => $now, 'updated_at' => $now],
            ['patient_id' => 7, 'polyclinic_id' => 7, 'queue_number' => 'G-001', 'date' => $now->toDateString(), 'status' => 'completed', 'created_at' => $now, 'updated_at' => $now],
        ]);

        //  Insert 7 Examinations
        DB::table('examinations')->insert([
            ['queue_id' => 1, 'doctor_id' => 1, 'complaint' => 'Demam dan pusing', 'diagnosis' => 'ISPA', 'treatment' => 'Paracetamol', 'created_at' => $now, 'updated_at' => $now],
            ['queue_id' => 2, 'doctor_id' => 2, 'complaint' => 'Gigi berlubang', 'diagnosis' => 'Karies Dentis', 'treatment' => 'Tambal sementara', 'created_at' => $now, 'updated_at' => $now],
            ['queue_id' => 3, 'doctor_id' => 3, 'complaint' => 'Periksa kandungan', 'diagnosis' => 'Normal', 'treatment' => 'Vitamin', 'created_at' => $now, 'updated_at' => $now],
            ['queue_id' => 4, 'doctor_id' => 4, 'complaint' => 'Mata merah', 'diagnosis' => 'Konjungtivitis', 'treatment' => 'Obat tetes mata', 'created_at' => $now, 'updated_at' => $now],
            ['queue_id' => 5, 'doctor_id' => 5, 'complaint' => 'Telinga berdenging', 'diagnosis' => 'Serumen Prop', 'treatment' => 'Pembersihan', 'created_at' => $now, 'updated_at' => $now],
            ['queue_id' => 6, 'doctor_id' => 6, 'complaint' => 'Nyeri perut', 'diagnosis' => 'Dispepsia', 'treatment' => 'Antasida', 'created_at' => $now, 'updated_at' => $now],
            ['queue_id' => 7, 'doctor_id' => 7, 'complaint' => 'Batuk anak', 'diagnosis' => 'ISPA Anak', 'treatment' => 'Sirup batuk', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
