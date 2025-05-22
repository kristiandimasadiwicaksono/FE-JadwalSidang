# 📙 Aplikasi Jadwal Sidang

Aplikasi ini terdiri dari:

* **Backend** → [BE-Jadwal-Skripsi (CodeIgniter 4)](https://github.com/MuhammadAbiAM/BE-Jadwal-Skripsi.git)
* **Frontend** → Dibuat dari awal menggunakan **Laravel 10 + TailwindCSS**

---

## 🧹 Alur Instalasi

1. Clone dan siapkan **backend (CI4)**
2. Buat **frontend baru (Laravel 10)**
3. Install dan setup **Tailwind CSS**
4. Hubungkan frontend ke backend (integrasi API)
5. Jalankan dan uji aplikasi

---

## 💻 1. Setup Backend (CodeIgniter 4)

### 📦 Clone Repositori

```bash
git clone https://github.com/MuhammadAbiAM/BE-Jadwal-Skripsi.git
cd BE-Jadwal-Skripsi
```

### 📁 Salin File .env

```bash
cp env .env
```

### ⚙️ Konfigurasi Environment

Edit `.env` untuk menyesuaikan koneksi database:

```env
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = jadwal_sidang
database.default.username = root
database.default.password =
```

> Ganti nilai sesuai setup database lokalmu.

### 🛂 Import Database

1. Buat database baru: jadwal_sidang

2. Import file .sql yang disediakan (jika ada di repo)

3. Atau tambahkan tabel dosen secara manual:

```
CREATE TABLE `dosen` (
  `nidn` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_dosen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `program_studi` enum('D3 Teknik Elektronika','D3 Teknik Listrik','D3 Teknik Informatika','D3 Teknik Mesin','D4 Teknik Pengendalian Pencemaran Lingkungan','D4 Pengembangan Produk Agroindustri','D4 Teknologi Rekayasa Energi Terbarukan','D4 Rekayasa Kimia Industri','D4 Teknologi Rekayasa Mekatronika','D4 Rekayasa Keamanan Siber','D4 Teknologi Rekayasa Multimedia','D4 Akuntansi Lembaga Keuangan Syariah','D4 Rekayasa Perangkat Lunak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

INSERT INTO `dosen` (`nidn`, `nama_dosen`, `program_studi`, `email`) VALUES
('0000000000', 'asdaasdaw', 'D3 Teknik Listrik', 'ashiapman2112@gmail.comw'),
('1001001001', 'Hendra SaputrOW', 'D3 Teknik Informatika', 'hendra.saputra@gmail.comw'),
('1001001002', 'Laras Wulandari', 'D4 Rekayasa Perangkat Lunak', 'laras.wulandari@gmail.com'),
('1001001003', 'Bambang Wijaya', 'D4 Rekayasa Keamanan Siber', 'bambang.wijaya@gmail.com'),
('1001001004', 'Siti Nurhaliza', 'D4 Rekayasa Perangkat Lunak', 'siti.nurhaliza@gmail.com'),
('1001001005', 'Santika Dewi', 'D4 Rekayasa Keamanan Siber', 'santika.dewi@gmail.com');
```
### 📦 Install Dependency

```bash
composer install
```

### 🚀 Jalankan Server

```bash
php spark serve
```

> Akses di `http://localhost:8080`

### ➕ Endpoint Resource

`GET` `POST` `PUT` `Delete`


>Mahasiswa : `http://localhost:8080/mahasiswa`<br>
>Dosen : `http://localhost:8080/dosen`


## 🌐 2. Buat Frontend dari Awal (Laravel 10)

### 🧱 Buat Proyek Baru

```bash
composer create-project laravel/laravel:^10.0 FE-JadwalSidang
cd FE-JadwalSidang
```

### 🔑 Buat Key Aplikasi

```bash
cp .env.example .env
php artisan key:generate
```

### ⚙️ Ubah File `.env`

```env
APP_URL=http://localhost:8000
API_URL=http://localhost:8080
```

> `API_URL` bisa digunakan dalam kode JavaScript atau helper config.

---

## 🎨 3. Install dan Konfigurasi Tailwind CSS

### 📦 Install Tailwind CSS

```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

### ⚙️ Konfigurasi `tailwind.config.js`

```js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

### ✏️ Edit `resources/css/app.css`

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### 🚀 Build CSS

```bash
npm install
npm run dev
```

> Gunakan `npm run build` untuk mode production.

---

## 🔗 4. Konsumsi API dari Backend

Gunakan `axios` atau `fetch` di JavaScript.

### Contoh (Blade + JS):

```html
<script>
fetch("http://localhost:8080/mahasiswa")
  .then(res => res.json())
  .then(data => console.log(data));
</script>
```

> Pastikan backend sudah mengizinkan **CORS** agar permintaan dari `localhost:8000` bisa diterima.

### Mengaktifkan CORS di CI4 (jika belum):

Tambahkan ini di controller/middleware:

```php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
```

---

## ▶️ 5. Jalankan Laravel Frontend

```bash
php artisan serve
```

Akses di browser:

```
http://localhost:8000
```

---

## 🤭 Struktur Proyek Frontend (Laravel)

```
FE-JadwalSidang/
├── app/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
├── .env
└── tailwind.config.js
```

---

## 📌 Tips Tambahan

* Simpan endpoint API di file config (`config/api.php`) agar rapi
* Gunakan `vite.config.js` untuk modifikasi frontend
* Tambahkan autentikasi jika dibutuhkan oleh frontend

---

## 📝 Lisensi

Proyek ini open-source dan dapat digunakan untuk keperluan pembelajaran dan pengembangan.
