### READ

1. Berkas mana yang menangani POST login? Method apa?
2. Di baris mana `Auth::attempt()` atau setaranya dipanggil?
3. Temukan `session()->regenerate()`. Kenapa ia ada di situ?
4. Di mana kata sandi di-hash? Cari cast `hashed` di model `User`.
5. Buka DevTools → Cookies sebelum dan sesudah login. Bandingkan nilai cookie session.
6. Logout, lalu tekan tombol back. Apa yang terjadi? Kenapa?

### Jawban
1. POST login ditangani oleh route di [routes/web.php]:
   ```php
   Route::post('/login', [AuthController::class, 'login']);
   ```
   Method yang dipanggil adalah `login(Request $request)` di [app/Http/Controllers/AuthController.php].

2. `Auth::attempt()` dipanggil di [app/Http/Controllers/AuthController.php]. Kodenya:
   ```php
   if (Auth::attempt($credentials, $request->boolean('remember'))) {
   ```
   Jadi, Laravel mencoba autentikasi user berdasarkan email dan password yang dikirim dari form login.

3. `session()->regenerate()` ada di [app/Http/Controllers/AuthController.php]:
   ```php
   $request->session()->regenerate();
   ```
   Fungsinya adalah membuat ID sesi baru setelah login berhasil. Ini mencegah serangan session fixation, yaitu saat attacker memaksa user memakai session ID lama yang sudah diketahui.

4. Hash password ada di model [app/Models/User.php]:
   ```php
   protected function casts(): array
   {
       return [
           'email_verified_at' => 'datetime',
           'password' => 'hashed',
       ];
   }
   ```
   Artinya field `password` otomatis diperlakukan sebagai password yang sudah di-hash oleh Laravel.

5. Di DevTools → Cookies, sebelum login cookie `laravel_session` belum terautentikasi atau masih berisi session ID lama. Setelah login berhasil, nilai cookie session berubah menjadi session ID baru karena `session()->regenerate()` membuat sesi baru. Jadi cookie session berubah dari ID lama ke ID baru yang terhubung ke user yang sudah login.

6. Setelah logout lalu menekan tombol back, browser biasanya menampilkan halaman yang pernah dibuka sebelumnya dari cache, tetapi halaman itu tidak bisa dipakai karena sesi sudah dihapus/invalidate. Di logout, Laravel menjalankan:
   ```php
   Auth::logout();
   $request->session()->invalidate();
   $request->session()->regenerateToken();
   ```
   di [Github/app/Http/Controllers/AuthController.php]. Artinya user sudah tidak terautentikasi lagi, dan server akan mengarahkan kembali ke halaman login jika mencoba mengakses route yang dilindungi. Back button tidak bisa mempertahankan login karena session sudah invalid.