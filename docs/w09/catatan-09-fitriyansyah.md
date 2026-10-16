## 9.3 Read  → Break → Fix → Build
**Target akhir minggu**:  Dosen bisa mengunggah materi, mahasiswa bisa mengumpulkan tugas, dan tidak seorang pun bisa mengunduh berkas milik orang lain.

### READ

Unggah satu berkas materi:

1. Temukan berkas fisiknya di sistem berkas. Path lengkapnya apa?
2. Buka baris database yang bersangkutan. Bandingkan `file_path` dengan lokasi fisiknya.
3. Coba akses berkas itu langsung lewat browser dengan menebak URL-nya. Berhasil atau tidak? Kenapa?
4. Buka `config/filesystems.php.` Identifikasi disk `local` dan `public` — apa persis bedanya?
5. Jalankan `php artisan storage:link`. Apa yang dibuatnya? Kenapa materi Anda tidak boleh ada di sana?

### BREAK

| # | Yang dirusak | Yang dipelajari |
|---|--------------|-----------------|
| 1 | Pindahkan berkas submission ke `storage/app/public`, akses URL-nya tanpa login |  |
| 2 | Hapus `Gate::authorize()` dari endpoint download, akses submission orang lain |  |
| 3 |  Simpan berkas dengan `storeAs()` memakai nama asli, lalu dua akun mahasiswa berbeda mengunggah `tugas.pdf` dengan isi berbeda ke tugas yang sama |  |
| 4 | Unggah berkas PHP yang diganti namanya jadi `.pdf` dengan validasi `extensions`, lalu dengan `mimes` |  |
| 5 | Ubah `max:5120` menjadi `max:5`, unggah berkas 1 MB |  |
| 6 | Set `upload_max_filesize=1M` di php.ini, unggah berkas 3 MB dengan validasi `max:5120` |  |
| 7 | Hapus `updateOrCreate`, ganti `create`, kumpulkan tugas dua kali | |
| 8 | Hapus satu submission dari database lewat SQL langsung, cek folder storage | |

### Build
