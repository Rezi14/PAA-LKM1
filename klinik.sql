-- Enum
CREATE TYPE user_role AS ENUM ('admin', 'doctor', 'patient');
CREATE TYPE queue_status AS ENUM ('waiting', 'examining', 'completed', 'cancelled');

-- Users
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role user_role NOT NULL DEFAULT 'patient',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

-- Polyclinics
CREATE TABLE polyclinics (
    id BIGSERIAL PRIMARY KEY,
    code VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

-- Doctors
CREATE TABLE doctors (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    polyclinic_id BIGINT NOT NULL REFERENCES polyclinics(id) ON DELETE CASCADE,
    specialization VARCHAR(255) NOT NULL,
    schedule VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

-- Patients
CREATE TABLE patients (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT REFERENCES users(id) ON DELETE SET NULL,
    medical_record_number VARCHAR(255) NOT NULL UNIQUE,
    national_id VARCHAR(255) NOT NULL UNIQUE,
    full_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

-- Queues
CREATE TABLE queues (
    id BIGSERIAL PRIMARY KEY,
    patient_id BIGINT NOT NULL REFERENCES patients(id) ON DELETE CASCADE,
    polyclinic_id BIGINT NOT NULL REFERENCES polyclinics(id) ON DELETE CASCADE,
    queue_number VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    status queue_status NOT NULL DEFAULT 'waiting',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

-- Examinations
CREATE TABLE examinations (
    id BIGSERIAL PRIMARY KEY,
    queue_id BIGINT NOT NULL REFERENCES queues(id) ON DELETE CASCADE,
    doctor_id BIGINT NOT NULL REFERENCES doctors(id) ON DELETE CASCADE,
    complaint TEXT NOT NULL,
    diagnosis TEXT,
    treatment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

-- Insert 15 Users
INSERT INTO users (name, email, password, role) VALUES
('Admin Klinik', 'admin@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('dr. Andi Wijaya', 'andi@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('drg. Budi Gunawan', 'budi@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('dr. Citra Lestari', 'citra@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('dr. Doni Pratama, Sp.M', 'doni@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('dr. Eka Sari, Sp.THT', 'eka@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('dr. Fina Mulyani, Sp.PD', 'fina@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('dr. Gilang Ramadhan, Sp.A', 'gilang@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor'),
('Fahrezi Angga Lesmana', 'fahrezi@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient'),
('M Rafli Hidayatullah', 'rafli@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient'),
('Nafariel Dwi Ambariyono', 'nafariel@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient'),
('Anwar Ibrahim Ahmad', 'anwar@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient'),
('Budi Santoso', 'budii@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient'),
('Siti Aminah', 'siti@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient'),
('Rina Melati', 'rina@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient');

-- Insert 7 Polyclinics
INSERT INTO polyclinics (code, name, description) VALUES
('POL-001', 'Poli Umum', 'Layanan kesehatan umum tingkat pertama'),
('POL-002', 'Poli Gigi', 'Layanan pemeriksaan dan perawatan gigi'),
('POL-003', 'Poli KIA', 'Kesehatan Ibu dan Anak'),
('POL-004', 'Poli Mata', 'Pemeriksaan kesehatan mata'),
('POL-005', 'Poli THT', 'Telinga, Hidung, dan Tenggorokan'),
('POL-006', 'Poli Penyakit Dalam', 'Layanan spesialis penyakit dalam'),
('POL-007', 'Poli Anak', 'Layanan kesehatan spesialis anak');

-- Insert 7 Doctors
INSERT INTO doctors (user_id, polyclinic_id, specialization, schedule) VALUES
(2, 1, 'Dokter Umum', 'Senin - Rabu (08:00 - 12:00)'),
(3, 2, 'Dokter Gigi', 'Selasa - Kamis (09:00 - 14:00)'),
(4, 3, 'Dokter Umum', 'Senin - Jumat (08:00 - 15:00)'),
(5, 4, 'Spesialis Mata', 'Rabu - Jumat (10:00 - 14:00)'),
(6, 5, 'Spesialis THT', 'Senin - Kamis (08:00 - 13:00)'),
(7, 6, 'Spesialis Penyakit Dalam', 'Selasa - Sabtu (09:00 - 15:00)'),
(8, 7, 'Spesialis Anak', 'Senin - Jumat (08:00 - 14:00)');

-- Insert 7 Patients
INSERT INTO patients (user_id, medical_record_number, national_id, full_name, phone_number) VALUES
(9, 'RM-2026-001', '3509012345670001', 'Fahrezi Angga Lesmana', '081234567890'),
(10, 'RM-2026-002', '3509012345670002', 'M Rafli Hidayatullah', '081234567891'),
(11, 'RM-2026-003', '3509012345670003', 'Nafariel Dwi Ambariyono', '081234567892'),
(12, 'RM-2026-004', '3509012345670004', 'Anwar Ibrahim Ahmad', '081234567893'),
(13, 'RM-2026-005', '3509012345670005', 'Budi Santoso', '081234567894'),
(14, 'RM-2026-006', '3509012345670006', 'Siti Aminah', '081234567895'),
(15, 'RM-2026-007', '3509012345670007', 'Rina Melati', '081234567896');

-- Insert 7 Queues
INSERT INTO queues (patient_id, polyclinic_id, queue_number, date, status) VALUES
(1, 1, 'A-001', CURRENT_DATE, 'completed'),
(2, 2, 'B-001', CURRENT_DATE, 'completed'),
(3, 3, 'C-001', CURRENT_DATE, 'completed'),
(4, 4, 'D-001', CURRENT_DATE, 'completed'),
(5, 5, 'E-001', CURRENT_DATE, 'completed'),
(6, 6, 'F-001', CURRENT_DATE, 'completed'),
(7, 7, 'G-001', CURRENT_DATE, 'completed');

-- Insert 7 Examinations
INSERT INTO examinations (queue_id, doctor_id, complaint, diagnosis, treatment) VALUES
(1, 1, 'Demam dan pusing sejak 2 hari', 'Infeksi Saluran Pernapasan Akut', 'Pemberian paracetamol dan vitamin'),
(2, 2, 'Gigi geraham bawah berlubang dan nyeri', 'Karies Dentis', 'Pembersihan karang gigi dan tambal sementara'),
(3, 3, 'Pemeriksaan kehamilan rutin bulan ke-5', 'Kehamilan Normal', 'Pemberian suplemen zat besi dan asam folat'),
(4, 4, 'Mata merah dan berair', 'Konjungtivitis', 'Pemberian tetes mata antibiotik'),
(5, 5, 'Telinga berdenging dan terasa penuh', 'Serumen Prop', 'Ekstraksi serumen (pembersihan telinga)'),
(6, 6, 'Nyeri ulu hati menjalar ke punggung', 'Sindrom Dispepsia', 'Pemberian antasida dan edukasi pola makan'),
(7, 7, 'Batuk berdahak pada anak', 'ISPA Anak', 'Pemberian sirup pereda batuk dan edukasi istirahat');