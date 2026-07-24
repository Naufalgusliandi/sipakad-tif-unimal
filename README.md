# 🎓 SIPAKAD - Sistem Informasi Portal Akademik Terpadu

**SIPAKAD** adalah aplikasi web berbasis framework Laravel yang dirancang untuk mengelola seluruh aktivitas akademik di lingkungan Program Studi Teknik Informatika Universitas Malikussaleh. Aplikasi ini menyediakan layanan pengelolaan data master akademik, jadwal perkuliahan, presensi, pengisian KRS, rekapitulasi KHS, hingga manajemen materi perkuliahan secara terintegrasi.

---

## 👨‍💻 Identitas Mahasiswa
* **Nama:** Naufal Gusliandi
* **NIM:** 230170161
* **Program Studi:** Teknik Informatika
* **Mata Kuliah:** Pemrograman Web Lanjut (A8)

---

## 🚀 Fitur Utama & Kriteria UAS
1. **Autentikasi Pengguna:** Login, Registrasi, dan Verifikasi Email / Google Login.
2. **Hak Akses Berbasis Role (Multi-Role):**
   * **Admin:** Pengelolaan Master Data (Mahasiswa, Dosen, Mata Kuliah, Kelas, Ruangan, Jadwal Kuliah).
   * **Dosen:** Pengelolaan Absensi, Input Nilai, dan Upload Materi Kuliah.
   * **Mahasiswa:** Akses Presensi, KHS, Unduh Materi, dan Pengisian KRS Manual.
3. **CRUD Lengkap:** Olah data penuh (*Create, Read, Update, Delete*) pada seluruh entitas akademik.
4. **Dashboard Statistik:** Ringkasan statistik realtime untuk setiap role.
5. **Export Laporan:** Fitur cetak/ekspor dokumen resmi akademik (KRS / KHS / Laporan) ke format PDF / Excel.
6. **Responsive Web Design:** Tampilan adaptif dan nyaman diakses melalui perangkat Desktop maupun Mobile (HP).
7. **REST API:** Endpoint API terproteksi beserta dokumentasi pengujian Postman.

---

## 🔑 Akun Demo Kredensial

| Role | Email | Password | Hak Akses Utama |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@unimal.ac.id` | `password123` | Kelola Master Data & Sistem |
| **Dosen** | `dosen@unimal.ac.id` | `password123` | Kelola Absensi, Nilai, & Materi |
| **Mahasiswa** | `mahasiswa@mhs.unimal.ac.id` | `password123` | Akses KRS, KHS, Presensi, & Materi |

---

## 📸 Dokumentasi Fitur & Antarmuka Aplikasi

### 1. Autentikasi & Verifikasi Akun

#### 🔑 Halaman Login
| Tampilan Desktop (Laptop) | Tampilan Mobile (HP) |
| :---: | :---: |
| ![Login Laptop](screenshoot/Login%20(Laptop).png) | ![Login HP](screenshoot/login%20(hp).jpg) |

#### 📝 Halaman Registrasi
| Tampilan Desktop (Laptop) | Tampilan Mobile (HP) |
| :---: | :---: |
| ![Register Laptop](screenshoot/register%20(laptop).png) | ![Register HP](screenshoot/register%20(hp).jpg) |

#### ✉️ Halaman Verifikasi Email
| Tampilan Desktop (Laptop) | Tampilan Mobile (HP) |
| :---: | :---: |
| ![Verifikasi Laptop](screenshoot/verifikasi-email%20(laptop).png) | ![Verifikasi HP](screenshoot/verifikasi-email%20(hp).jpg) |

---

### 2. Hak Akses Berbasis Role (Multi-Role)

#### 🛡️ Role Admin (Master Data)
| Tampilan Desktop (Laptop) | Navigation Menu Mobile (HP) |
| :---: | :---: |
| ![Admin Laptop](screenshoot/dashboard-admin%20(laptop).png) | ![Admin HP](screenshoot/menu-navbar-admin%20(hp).jpg) |

#### 👨‍🏫 Role Dosen (Aktivitas Akademik)
| Tampilan Desktop (Laptop) | Navigation Menu Mobile (HP) |
| :---: | :---: |
| ![Dosen Laptop](screenshoot/dashboard-dosen%20(laptop).png) | ![Dosen HP](screenshoot/menu-navbar-dosen%20(hp).jpg) |

#### 🎓 Role Mahasiswa (Panel Mahasiswa)
| Tampilan Desktop (Laptop) | Navigation Menu Mobile (HP) |
| :---: | :---: |
| ![Mahasiswa Laptop](screenshoot/dashboard-mahasiswa%20(laptop).png) | ![Mahasiswa HP](screenshoot/menu-navbar-mahasiswa.jpg) |

---

### 3. Dashboard Statistik Realtime

#### 📊 Dashboard Admin
| Tampilan Desktop (Laptop) | Tampilan Mobile (HP) |
| :---: | :---: |
| ![Dashboard Admin Laptop](screenshoot/dashboard-admin%20(laptop).png) | ![Dashboard Admin HP](screenshoot/dashboard-admin%20(hp).jpg) |

#### 📊 Dashboard Dosen
| Tampilan Desktop (Laptop) | Tampilan Mobile (HP) |
| :---: | :---: |
| ![Dashboard Dosen Laptop](screenshoot/dashboard-dosen%20(laptop).png) | ![Dashboard Dosen HP](screenshoot/dashboard-dosen%20(hp).jpg) |

#### 📊 Dashboard Mahasiswa
| Tampilan Desktop (Laptop) | Tampilan Mobile (HP) |
| :---: | :---: |
| ![Dashboard Mahasiswa Laptop](screenshoot/dashboard-mahasiswa%20(laptop).png) | ![Dashboard Mahasiswa HP](screenshoot/dashboard-mahasiswa%20(hp).jpg) |

---

### 4. Ekspor Laporan Akademik (PDF & Excel)

#### 📄 Kartu Hasil Studi (KHS) & Export PDF
| Halaman KHS (Laptop) | Hasil Export PDF (Laptop) | Hasil Export PDF (Mobile) |
| :---: | :---: | :---: |
| ![KHS Laptop](screenshoot/khs%20(laptop).png) | ![Cetak KHS PDF Laptop](screenshoot/cetak-khs-pdf%20(laptop).png) | ![Cetak KHS PDF HP](screenshoot/cetak-khs-pdf%20(hp).jpg) |

#### 📄 Kartu Rencana Studi (KRS) & Export PDF
| Form Isi KRS (Laptop) | Form Isi KRS (Mobile) | Hasil Export PDF (Laptop) |
| :---: | :---: | :---: |
| ![KRS Laptop](screenshoot/isi-krs%20%20(laptop).png) | ![KRS HP](screenshoot/isi-krs%20(hp).jpg) | ![Cetak KRS PDF Laptop](screenshoot/cetak-krs%20(laptop).png) |

#### 📊 Data Master Mahasiswa & Export Excel
| Kelola Data Mahasiswa (Laptop) | Kelola Data Mahasiswa (Mobile) | Hasil Export Excel (Laptop) | Hasil Export Excel (Mobile) |
| :---: | :---: | :---: | :---: |
| ![Data MHS Laptop](screenshoot/data-mahasiswa%20(laptop).png) | ![Data MHS HP](screenshoot/data-mahasiswa%20(hp).jpg) | ![Excel MHS Laptop](screenshoot/eksport-excel-data%20mahasiswa%20(laptop).png) | ![Excel MHS HP](screenshoot/eksport-excel-data%20mahasiswa%20(hp).jpg) |

---

### 5. Desain Web Responsif (Desktop vs Mobile)

| Tampilan Kelola Absensi (Desktop) | Tampilan Kelola Absensi (Mobile) |
| :---: | :---: |
| ![Absensi Laptop](screenshoot/kelola-absensi%20(laptop).png) | ![Absensi HP](screenshoot/kelola-absensi%20(hp).jpg) |

---

### 6. Pengujian REST API (Postman)

![Rest API Test Result](screenshoot/postman-api.png)

---

## 🛠️ Cara Instalasi & Menjalankan Proyek

### 1. Clone Repository
```bash
git clone [https://github.com/Naufalgusliandi/sipakad-tif-unimal.git](https://github.com/Naufalgusliandi/sipakad-tif-unimal.git)
cd sipakad