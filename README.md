# Deskripsi Project dan Domain

Project ini merupakan REST API yang dirancang untuk mengelola operasional pada domain kesehatan, khususnya manajemen klinik. Sistem ini mencakup pengelolaan data pengguna (admin/staf), poliklinik, jadwal dokter, pasien, sistem antrian, hingga rekam medis atau hasil pemeriksaan pasien.

Tujuan utama dari sistem ini adalah untuk mendigitalisasi proses administrasi klinik agar lebih terstruktur, efisien, dan mudah dikelola. Implementasi menggunakan database relasional dengan relasi antar tabel serta fitur keamanan seperti penggunaan **Eloquent ORM (parameterized queries)** untuk mencegah SQL Injection.

---

#  Teknologi yang Digunakan

* **Bahasa Pemrograman**: PHP 8.4.14
* **Framework**: Laravel (Latest Version)
* **Database**: PostgreSQL 16.12
* **Tools**:

  * Composer 2.8.12
  * Postman 12.7.0 (untuk pengujian API)

---

# Instalasi dan Menjalankan Project

## 1. Masuk ke folder tujuan

```bash
cd /d "D:\Semester 4\PAA"
```

## 2. Clone repository

```bash
git clone https://github.com/Rezi14/PAA-LKM1.git
cd PAA-LKM1
```

## 3. Install dependency

```bash
composer install
```

## 4. Konfigurasi environment

```bash
cp .env.example .env
```

## 5. Generate app key

```bash
php artisan key:generate
```

## 6. Jalankan server

```bash
php artisan serve
```

API dapat diakses di:

```
http://127.0.0.1:8000/api
```

---

# Cara Import Database

## Menggunakan Migration (Disarankan)

1. Pastikan PostgreSQL sudah terinstall dan berjalan
2. Buat database baru, misalnya:

```
klinik_db
```

3. Konfigurasi file `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=klinik_db
DB_USERNAME=postgres
DB_PASSWORD=password_anda
```

4. Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

---

## Menggunakan File SQL

* Import file `klinik.sql` melalui pgAdmin atau tools lainnya
* Jalankan query secara manual

---

# Format Response API

## Success

```json
{
  "status": "success",
  "message": "Success",
  "data": {}
}
```

## Error

```json
{
  "status": "error",
  "message": "Error message"
}
```

---

# Daftar Endpoint API

## 🔹 Users

| Method    | Endpoint                | Keterangan                               |
| --------- | ----------------------- | ---------------------------------------- |
| GET       | /api/users              | Mengambil seluruh data pengguna          |
| GET       | /api/users/{id}         | Mengambil detail spesifik satu pengguna  |
| POST      | /api/users              | Menambahkan pengguna baru                |
| PUT/PATCH | /api/users/{id}         | Memperbarui data pengguna                |
| DELETE    | /api/users/{id}         | Menghapus pengguna (Soft Delete)         |
| POST      | /api/users/{id}/restore | Mengembalikan data pengguna yang dihapus |


---

## 🔹 Polyclinics

| Method    | Endpoint                      | Keterangan                                 |
| --------- | ----------------------------- | ------------------------------------------ |
| GET       | /api/polyclinics              | Mengambil seluruh data poliklinik          |
| GET       | /api/polyclinics/{id}         | Mengambil detail satu poliklinik           |
| POST      | /api/polyclinics              | Menambahkan data poliklinik baru           |
| PUT/PATCH | /api/polyclinics/{id}         | Memperbarui data poliklinik                |
| DELETE    | /api/polyclinics/{id}         | Menghapus data poliklinik (Soft Delete)    |
| POST      | /api/polyclinics/{id}/restore | Mengembalikan data poliklinik yang dihapus |


---

## 🔹 Doctors

| Method    | Endpoint                  | Keterangan                             |
| --------- | ------------------------- | -------------------------------------- |
| GET       | /api/doctors              | Mengambil seluruh data dokter          |
| GET       | /api/doctors/{id}         | Mengambil detail satu dokter           |
| POST      | /api/doctors              | Menambahkan data dokter baru           |
| PUT/PATCH | /api/doctors/{id}         | Memperbarui data dokter                |
| DELETE    | /api/doctors/{id}         | Menghapus data dokter (Soft Delete)    |
| POST      | /api/doctors/{id}/restore | Mengembalikan data dokter yang dihapus |
   

---

## 🔹 Patients

| Method    | Endpoint                   | Keterangan                             |
| --------- | -------------------------- | -------------------------------------- |
| GET       | /api/patients              | Mengambil seluruh data pasien          |
| GET       | /api/patients/{id}         | Mengambil detail satu pasien           |
| POST      | /api/patients              | Menambahkan data pasien baru           |
| PUT/PATCH | /api/patients/{id}         | Memperbarui profil pasien              |
| DELETE    | /api/patients/{id}         | Menghapus data pasien (Soft Delete)    |
| POST      | /api/patients/{id}/restore | Mengembalikan data pasien yang dihapus |
 

---

## 🔹 Queues

| Method    | Endpoint                 | Keterangan                                         |
| --------- | ------------------------ | -------------------------------------------------- |
| GET       | /api/queues              | Mengambil seluruh riwayat/daftar antrian           |
| GET       | /api/queues/{id}         | Mengambil detail dari satu antrian                 |
| POST      | /api/queues              | Mendaftarkan/membuat nomor antrian baru            |
| PUT/PATCH | /api/queues/{id}         | Memperbarui status antrian                         |
| DELETE    | /api/queues/{id}         | Membatalkan/menghapus antrian (Soft Delete)        |
| POST      | /api/queues/{id}/restore | Mengembalikan data antrian yang dibatalkan/dihapus |


---

## 🔹 Examinations

| Method    | Endpoint                       | Keterangan                                    |
| --------- | ------------------------------ | --------------------------------------------- |
| GET       | /api/examinations              | Mengambil daftar semua catatan rekam medis    |
| GET       | /api/examinations/{id}         | Mengambil detail spesifik catatan pemeriksaan |
| POST      | /api/examinations              | Menambah hasil diagnosa/pemeriksaan           |
| PUT/PATCH | /api/examinations/{id}         | Memperbarui data pemeriksaan                  |
| DELETE    | /api/examinations/{id}         | Menghapus data pemeriksaan (Soft Delete)      |
| POST      | /api/examinations/{id}/restore | Mengembalikan rekam medis yang dihapus        |
 

---
