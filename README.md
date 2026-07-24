# SIPAKAD - Sistem Informasi Portal Akademik Terpadu

**SIPAKAD** adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola aktivitas akademik Program Studi Teknik Informatika Universitas Malikussaleh, mencakup manajemen data master, perkuliahan, absensi, pengisian KRS, KHS, hingga unduh materi perkuliahan.

---

## Identitas Mahasiswa
* **Nama:** Naufal Gusliandi
* **NIM:** 230170161
* **Program Studi:** Teknik Informatika
* **Mata Kuliah:** Pemrograman Web Lanjut (A8)

---

## Fitur Utama & Kriteria UAS
1. **Autentikasi Pengguna:** Login, Registrasi, dan Verifikasi Email / Google Login.
- **Login**
* Laptop
![Login Page](screenshoot/Login%20(Laptop).png)
* Mobile
![Login Page1](screenshoot/login%20(hp).jpg)

- **Registrasi**
* Laptop
![Register Page](screenshoot/register%20(laptop).png)
* Mobile
![Register Pagel](screenshoot/register%20(hp).jpg)

- **Verifikasi Email**
* Laptop
![Verifikasi Page](screenshoot/verifikasi-email%20(laptop).png)
* Mobile
![Verifikasi Page1](screenshoot/verifikasi-email%20(hp).jpg)

2. **Hak Akses Berbasis Role (Multi-Role):**
   * **Admin:** Pengelolaan Master Data (Mahasiswa, Dosen, Mata Kuliah, Kelas, Ruangan, Jadwal Kuliah).
   * Laptop
   ![Admin Page](screenshoot/dashboard-admin%20(laptop).png)
   * Mobile
   ![Akses Admin](screenshoot/menu-navbar-admin%20(hp).jpg)

   * **Dosen:** Pengelolaan Absensi, Input Nilai, dan Upload Materi Kuliah.
   * Laptop
   ![Dosen Page](screenshoot/dashboard-dosen%20(laptop).png)
   * Mobile
   ![Akses Dosen](screenshoot/menu-navbar-dosen%20(hp).jpg)

   * **Mahasiswa:** Akses Presensi, KHS, Unduh Materi, dan Pengisian KRS Manual.
   * Laptop
   ![Mahasiswa Page](screenshoot/dashboard-mahasiswa%20(hp).jpg)
   * Mobile
   ![Akses Mahasiswa](screenshoot/menu-navbar-mahasiswa.jpg)

3. **CRUD Lengkap:** Olah data penuh pada seluruh entitas akademik.
4. **Dashboard Statistik:** Ringkasan statistik realtime untuk setiap role.
**Dashboard Admin**
* Mobile
![Dashboard Admin](screenshoot/dashboard-admin%20(hp).jpg)
* Laptop
![Dashboard Admin1](screenshoot/dashboard-admin%20(laptop).png)

**Dashboard Dosen**
* Mobile
![Dashboard Dosen](screenshoot/dashboard-dosen%20(hp).jpg)
* Laptop
![Dashboard Dosen1](screenshoot/dashboard-dosen%20(laptop).png)

**Dashboard Mahasiswa**
* Mobile
![Dashboard Mahasiswa](screenshoot/dashboard-mahasiswa%20(hp).jpg)
* Laptop
![Dashboard Mahasiswa1](screenshoot/dashboard-mahasiswa%20(laptop).png)

5. **Export Laporan:** Fitur cetak/ekspor dokumen resmi akademik (KRS / KHS / Laporan) ke format PDF / Excel.
**KHS**
* Mobile
![KHS Page](screenshoot/khs%20(laptop).jpg)
* Laptop
![KHS Page](screenshoot/khs%20(laptop).png)
* Laptop
![KHS-PDF Page](screenshoot/cetak-khs-pdf%20(laptop).png)
* Mobile
![KHS-PDF Page1](screenshoot/cetak-khs-pdf%20(hp).jpg)

**KRS**
* Laptop
![KRS Page](screenshoot/isi-krs%20%20(laptop).png)
* Mobile
![KRS Page](screenshoot/isi-krs%20(hp).jpg)
* Laptop
![KRS-PDF Page](screenshoot/cetak-krs%20(laptop).png)
* Mobile
![KRS-PDF Page1](screenshoot/cetak-khs-pdf%20(hp).jpg)

**Data Mahasiswa**
* Laptop
![Data Mahasiswa Page](screenshoot/data-mahasiswa%20(laptop).png)
* Mobile
![Data Mahasiswa Page](screenshoot/data-mahasiswa%20(hp).jpg)
* Laptop
![MHS-Excel Page](screenshoot/eksport-excel-data%20mahasiswa%20(laptop).png)
* Mobile
![MHS-Excel Page1](screenshoot/eksport-excel-data%20mahasiswa%20(hp).jpg)

6. **Responsive Web Design:** Tampilan adaptif dan nyaman diakses melalui perangkat Desktop maupun Mobile (HP).
** Laptop
![Presensi Page](screenshoot/kelola-absensi%20(laptop).png)
** Mobile
![Presensi Page](screenshoot/kelola-absensi%20(hp).jpg)

7. **REST API:** Endpoint API terproteksi beserta dokumentasi pengujian Postman.
![Rest Api Page](screenshoot/postman-api.png)

---

## 🔑 Akun Demo
| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@unimal.ac.id` | `password123` |
| **Dosen** | `dosen@unimal.ac.id` | `password123` |
| **Mahasiswa** | `mahasiswa@mhs.unimal.ac.id` | `password123` |

---

## 🛠️ Cara Instalasi & Menjalankan Proyek

### 1. Clone Repository
```bash
git clone [https://github.com/Naufalgusliandi/sipakad-tif-unimal](https://github.com/Naufalgusliandi/sipakad-tif-unimal)
cd sipakad