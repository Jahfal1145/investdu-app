<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investdu - Belajar Investasi</title>
    
    <style>
        .modal-overlay {
            display: none; /* Sembunyi by default */
            position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.7); 
            align-items: center; justify-content: center;
            backdrop-filter: blur(3px); 
        }
        .modal-content {
            background-color: #1a1e23; color: white; padding: 30px; border-radius: 12px; width: 400px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5); border: 1px solid #343a40;
            position: relative; animation: zoomIn 0.3s; 
        }
        .modal-close {
            position: absolute; right: 15px; top: 10px; color: #aaa;
            font-size: 24px; cursor: pointer; background: none; border: none;
        }
        .modal-close:hover { color: #dc3545; }
        
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px; color: #adb5bd; }
        .form-input { 
            width: 100%; padding: 10px; box-sizing: border-box; 
            background-color: #2b3035; border: 1px solid #495057; color: white; border-radius: 6px; 
            outline: none;
        }
        .form-input:focus { border-color: #0dcaf0; }

        @keyframes zoomIn { from {transform: scale(0.9); opacity: 0;} to {transform: scale(1); opacity: 1;} }
    </style>
</head>
<body style="font-family: sans-serif; margin: 0; padding: 0; background-color: #f4f6f9;">

    <nav style="display: flex; justify-content: space-between; align-items: center; background-color: #1a1e23; padding: 15px 30px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.2);">
        <a href="/" style="font-size: 24px; font-weight: bold; color: #0dcaf0; letter-spacing: 1px; text-decoration: none;">🌟 INVESTDU</a>
        <div style="display: flex; gap: 20px; align-items: center; font-size: 15px; font-weight: 600;">
            @auth
                <a href="/leaderboard" style="color: #ffc107; text-decoration: none;">🏆 Leaderboard</a>
                <a href="/berita" style="color: white; text-decoration: none;">📰 Berita</a>
                <a href="/bursa" style="color: white; text-decoration: none;">📈 Bursa</a>
                <a href="/portofolio" style="color: white; text-decoration: none;">💼 Portofolio</a>
                
                <div style="position: relative; display: inline-block; cursor: pointer;" onclick="toggleDropdown(event)">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid #495057;">
                        <span style="color: white;">▾</span>
                    </div>
                    <div id="profilMenu" style="display: none; position: absolute; right: 0; background-color: white; min-width: 180px; box-shadow: 0 8px 16px rgba(0,0,0,0.2); border-radius: 8px; margin-top: 15px; overflow: hidden; z-index: 100;">
                        <div style="padding: 15px; background-color: #f8f9fa; border-bottom: 1px solid #eee; color: black; font-size: 13px;">Hi, <b>{{ Auth::user()->username }}</b></div>
                        @if(Auth::user()->is_admin)
                            <a href="/admin" style="color: black; padding: 12px 16px; text-decoration: none; display: block; border-bottom: 1px solid #eee; background-color: #ffc107; font-weight: bold;">👑 Panel Admin</a>
                        @endif
                        <a href="#" onclick="openModal('profileModal')" style="color: black; padding: 12px 16px; text-decoration: none; display: block; border-bottom: 1px solid #eee;">👤 Profil Saya</a>
                        <a href="#" onclick="openModal('settingModal')" style="color: black; padding: 12px 16px; text-decoration: none; display: block; border-bottom: 1px solid #eee;">⚙️ Pengaturan</a>
                        <form action="/logout" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" style="width: 100%; text-align: left; background: none; border: none; color: #dc3545; padding: 12px 16px; font-weight: bold; cursor: pointer;">🚪 Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <a href="/login" style="color: white; text-decoration: none; font-weight: bold;">Login</a>
                <a href="/register" style="background-color: #0d6efd; color: white; text-decoration: none; padding: 8px 15px; border-radius: 5px; font-weight: bold;">Daftar Sekarang</a>
            @endguest
        </div>
    </nav>

    @if(session('success'))
        <div style="background-color: #d1e7dd; color: #0f5132; padding: 15px; text-align: center; font-weight: bold; margin: 20px;">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div style="background-color: #f8d7da; color: #842029; padding: 15px; text-align: center; font-weight: bold; margin: 20px;">❌ Gagal memperbarui: {{ $errors->first() }}</div>
    @endif

    @auth
    <div style="padding: 40px;">
        <h2>Selamat datang kembali, {{ Auth::user()->username }}! 👋</h2>
        <div style="background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-top: 20px;">
            <h3 style="margin-top: 0;">Berita Pasar Terkini 📰</h3>
            <p style="color: #6c757d;">(Area ini nanti akan diisi oleh NewsAPI...)</p>
        </div>
    </div>
    @endauth

    @guest
    <div style="text-align: center; padding: 80px 20px; background-color: #1a1e23; color: white;">
        <h1 style="font-size: 40px; color: #0dcaf0; margin-bottom: 10px;">Belajar Ekonomi Jadi Lebih Seru! 🎮</h1>
        <p style="font-size: 18px; color: #adb5bd; max-width: 600px; margin: 0 auto 30px auto;">Investdu adalah platform simulasi investasi yang dirancang khusus untuk pelajar...</p>
        <a href="/register" style="background-color: #ffc107; color: black; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold; font-size: 18px; margin-right: 10px;">Mulai Bermain Gratis</a>
    </div>
    @endguest

    @auth
        <div id="profileModal" class="modal-overlay" onclick="attemptCloseOverlay(event, 'profileModal')">
            <div class="modal-content" onclick="event.stopPropagation()" style="text-align: center;">
                <button class="modal-close" onclick="attemptCloseModal('profileModal')">&times;</button>
                
                <form id="profileForm" action="/user/profile/update" method="POST" onsubmit="isDirty = false;">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 25px; position: relative; display: inline-block;">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #0dcaf0;">
                        <label style="position: absolute; bottom: 0; right: 0; background-color: #343a40; border: 2px solid #1a1e23; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s;">
                            <span style="font-size: 16px;">📷</span>
                            <input type="file" style="display: none;" onchange="alert('Sabar gem! Fitur Upload Foto beneran akan kita coding di tahap selanjutnya ya! 😁')">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Username:</label>
                        <input type="text" name="username" value="{{ Auth::user()->username }}" class="form-input" required oninput="markDirty()">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email:</label>
                        <input type="email" value="{{ Auth::user()->email }}" class="form-input" readonly style="background-color: #343a40; color: #888; cursor: not-allowed;">
                    </div>

                    <div class="form-group" style="margin-bottom: 30px;">
                        <label class="form-label">Password Baru:</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah" class="form-input" oninput="markDirty()">
                    </div>

                    <button type="submit" style="width: 100%; background-color: #0dcaf0; color: black; border: none; padding: 12px; border-radius: 6px; font-weight: bold; font-size: 16px; cursor: pointer;">Simpan</button>
                </form>
            </div>
        </div>

        <div id="settingModal" class="modal-overlay" onclick="attemptCloseOverlay(event, 'settingModal')">
            <div class="modal-content" onclick="event.stopPropagation()">
                <button class="modal-close" onclick="attemptCloseModal('settingModal')">&times;</button>
                <h3 style="margin-top: 0; text-align: center; color: #ffc107;">⚙️ Pengaturan</h3>
                <p style="color: #adb5bd; text-align: center;">Fitur Pengaturan sedang dalam pengembangan...</p>
                <div style="text-align: center; margin-top: 20px;">
                    <button type="button" onclick="attemptCloseModal('settingModal')" style="background-color: #343a40; color: white; border: none; padding: 10px 18px; border-radius: 6px; cursor: pointer;">Tutup</button>
                </div>
            </div>
        </div>

        <div id="warningModal" class="modal-overlay" style="z-index: 1001;">
            <div class="modal-content" style="width: 320px; text-align: center; padding: 20px;">
                <h3 style="margin-top: 0; color: #ffc107;">⚠️ Tunggu Dulu!</h3>
                <p style="color: white;">Perubahan belum disimpan. Yakin mau keluar?</p>
                <div style="display: flex; gap: 10px; justify-content: center; margin-top: 25px;">
                    <button onclick="closeWarningModal()" style="background-color: #343a40; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold;">Kembali</button>
                    <button onclick="discardChanges()" style="background-color: #dc3545; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold;">Batal</button>
                </div>
            </div>
        </div>
    @endauth

    <script>
        let isDirty = false; // Sensor: Apakah ada yang diketik?

        // Menyalakan sensor kalau user ngetik sesuatu di form
        function markDirty() {
            isDirty = true;
        }

        function toggleDropdown(event) {
            event.stopPropagation();
            var menu = document.getElementById("profilMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        function openModal(modalId) {
            var menu = document.getElementById("profilMenu");
            if(menu) menu.style.display = "none";
            document.getElementById(modalId).style.display = "flex";
            isDirty = false; // Reset sensor tiap kali buka profil
        }

        // Fungsi Pintar: Ngecek sebelum popup ditutup
        function attemptCloseModal(modalId) {
            if (modalId === 'profileModal' && isDirty) {
                // Kalau lagi di form profil dan ada yang diketik, munculkan warning!
                document.getElementById('warningModal').style.display = 'flex';
            } else {
                // Kalau aman, langsung tutup
                document.getElementById(modalId).style.display = "none";
            }
        }

        // Kalau klik area gelap di luar form
        function attemptCloseOverlay(event, modalId) {
            if (event.target === document.getElementById(modalId)) {
                attemptCloseModal(modalId);
            }
        }

        // Tutup popup warning, kembali ke form profil
        function closeWarningModal() {
            document.getElementById('warningModal').style.display = 'none';
        }

        // Buang perubahan, tutup semuanya
        function discardChanges() {
            isDirty = false; // Matikan sensor
            document.getElementById('profileForm').reset(); // Kembalikan teks ke semula
            document.getElementById('warningModal').style.display = 'none';
            document.getElementById('profileModal').style.display = 'none';
        }

        window.onclick = function() {
            var menu = document.getElementById("profilMenu");
            if (menu && menu.style.display === "block") {
                menu.style.display = "none";
            }
        }
    </script>
</body>
</html>