# Data Kecamatan

File CSV untuk data kecamatan di Indonesia.

## Format File

File `kecamatan.csv` memiliki kolom-kolom berikut:

| Kolom | Tipe | Keterangan |
|-------|------|-----------|
| id | integer | ID unik kecamatan |
| kabupaten_id | integer | ID kabupaten/kota terkait |
| kode_kecamatan | string | Kode kecamatan |
| nama_kecamatan | string | Nama kecamatan |
| deskripsi | string | Deskripsi kecamatan (opsional) |
| status | boolean | Status kecamatan (true/false) |

## Contoh Data

```csv
id,kabupaten_id,kode_kecamatan,nama_kecamatan,deskripsi,status
1,1,01.01.01,Arongan Lambalek,Kecamatan di Kabupaten Aceh Besar,1
2,1,01.01.02,Blang Pidie,,1
3,2,01.02.01,Blang Pidie,Kecamatan di Kabupaten Aceh Barat,1
```

## Cara Menggunakan

1. **Isi data CSV**: Buka file `database/data/kecamatan.csv` dan isi dengan data kecamatan yang lengkap
   - Jangan hapus header row
   - Setiap baris adalah satu kecamatan
   - ID harus unik
   - kabupaten_id harus sesuai dengan ID kabupaten yang ada di database

2. **Jalankan Seeder**: Setelah data diisi lengkap, jalankan perintah:
   ```bash
   php artisan db:seed --class=KecamatanCSVSeeder
   ```

3. **Verifikasi Data**: Akses halaman admin reference kecamatan untuk verifikasi:
   ```
   http://localhost/admin/reference/kecamatan
   ```

## API Endpoints

Kecamatan juga memiliki API untuk digunakan di frontend:

### 1. Ambil Semua Kecamatan
```
GET /admin/reference/kecamatan/api/list
```

Response:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "kode_kecamatan": "01.01.01",
      "nama_kecamatan": "Arongan Lambalek",
      "kabupaten_id": 1
    }
  ]
}
```

### 2. Ambil Kecamatan Berdasarkan Kabupaten
```
GET /admin/reference/kecamatan/api/kabupaten/{kabupaten_id}
```

Response:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "kode_kecamatan": "01.01.01",
      "nama_kecamatan": "Arongan Lambalek"
    }
  ]
}
```

## Notes

- Seeder ini menggunakan `updateOrCreate()` sehingga data yang sudah ada akan diupdate jika ID-nya sama
- Status default adalah `true` jika tidak diberikan nilai
- Deskripsi bersifat opsional (nullable)
