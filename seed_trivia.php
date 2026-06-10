<?php
use App\Models\InvestmentCategory;
use App\Models\TriviaQuestion;

// Kosongkan tabel trivia terlebih dahulu agar bersih
TriviaQuestion::truncate();

$questionsData = [
    'Tabungan Berjangka' => [
        ["Apa yang dimaksud dengan tabungan berjangka?", "Tabungan yang dapat ditarik kapan saja", "Tabungan dengan setoran rutin dan jangka waktu tertentu", "Investasi saham di bank", "Pinjaman dari bank", "B"],
        ["Tujuan utama tabungan berjangka adalah...", "Spekulasi harga aset", "Membeli saham perusahaan", "Membantu disiplin menabung", "Menghindari pajak", "C"],
        ["Setoran tabungan berjangka biasanya dilakukan...", "Secara otomatis dan rutin", "Setiap 10 tahun", "Hanya sekali saat pembukaan rekening", "Saat nasabah ingin saja", "A"],
        ["Salah satu keunggulan tabungan berjangka adalah...", "Risiko sangat tinggi", "Keamanan dana yang relatif baik", "Harga berubah setiap detik", "Tidak diawasi pemerintah", "B"],
        ["Suku bunga tabungan berjangka umumnya...", "Sama dengan saham", "Lebih rendah dari obligasi pemerintah", "Lebih tinggi dari tabungan biasa", "Selalu 0%", "C"],
        ["Dana tabungan berjangka biasanya dapat dicairkan...", "Kapan saja tanpa syarat", "Setelah jatuh tempo", "Setiap hari", "Setiap jam kerja", "B"],
        ["Jika dicairkan sebelum jatuh tempo, biasanya...", "Mendapat bonus", "Mendapat dividen", "Dikenakan penalti", "Mendapat saham gratis", "C"],
        ["Tabungan berjangka cocok untuk...", "Trading harian", "Tujuan keuangan tertentu", "Membeli kripto", "Spekulasi pasar", "B"],
        ["Produk tabungan berjangka ditawarkan oleh...", "Bursa efek", "Bank", "Dealer mobil", "Koperasi saja", "B"],
        ["Risiko tabungan berjangka dibanding saham adalah...", "Lebih rendah", "Sama tinggi", "Lebih tinggi", "Tidak ada risiko sama sekali", "A"],
        ["Contoh tujuan tabungan berjangka adalah...", "Dana pendidikan", "Trading forex harian", "Spekulasi harga minyak", "Membeli NFT", "A"],
        ["Tabungan berjangka membantu seseorang...", "Boros", "Disiplin keuangan", "Berutang lebih banyak", "Menghindari menabung", "B"],
        ["Jangka waktu tabungan berjangka...", "Tidak ditentukan", "Ditentukan sejak awal", "Selalu 100 tahun", "Hanya 1 bulan", "B"],
        ["Tabungan berjangka termasuk instrumen...", "Berisiko tinggi", "Relatif aman", "Spekulatif", "Ilegal", "B"],
        ["Keuntungan utama tabungan berjangka berasal dari...", "Kupon", "Dividen", "Bunga", "Royalti", "C"],
        ["Nasabah tabungan berjangka biasanya memiliki...", "Target keuangan tertentu", "Tujuan bermain saham", "Kewajiban membeli obligasi", "Kewajiban membeli emas", "A"],
        ["Siapa yang cocok menggunakan tabungan berjangka?", "Investor agresif", "Penabung yang mengutamakan keamanan", "Trader profesional", "Spekulan pasar", "B"],
        ["Salah satu kekurangan tabungan berjangka adalah...", "Sulit dibuka", "Keuntungan relatif rendah", "Tidak ada bunga", "Tidak aman", "B"],
        ["Tabungan berjangka lebih cocok untuk jangka...", "Pendek hingga menengah", "1 hari", "1 jam", "Tidak terbatas", "A"],
        ["Tabungan berjangka berbeda dengan tabungan biasa karena...", "Tidak memakai bank", "Ada batasan penarikan dana", "Tidak memiliki bunga", "Harus membeli saham", "B"]
    ],
    'Saham' => [
        ["Saham menunjukkan...", "Kepemilikan perusahaan", "Pinjaman bank", "Sertifikat tanah", "Tabungan", "A"],
        ["Keuntungan dari kenaikan harga saham disebut...", "Kupon", "Dividen", "Capital Gain", "Bunga", "C"],
        ["Saham diperdagangkan di...", "Bank", "Bursa Efek", "Pegadaian", "Kantor Pos", "B"],
        ["Pemegang saham disebut...", "Debitur", "Kreditur", "Investor", "Nasabah pinjaman", "C"],
        ["Dividen adalah...", "Pajak saham", "Pembagian laba perusahaan", "Denda investasi", "Bunga bank", "B"],
        ["Harga saham dapat berubah karena...", "Kinerja perusahaan", "Sentimen pasar", "Kondisi ekonomi", "Semua benar", "D"],
        ["Saham memiliki potensi keuntungan...", "Tinggi", "Rendah", "Nol", "Tetap", "A"],
        ["Risiko saham adalah...", "Tidak bisa dijual", "Harga dapat turun", "Tidak ada dividen", "Tidak memiliki pemilik", "B"],
        ["Investasi saham cocok untuk...", "Jangka panjang", "Menit ke menit saja", "Tidak punya tujuan", "Menabung harian", "A"],
        ["Saham termasuk investasi...", "Berisiko rendah", "Berisiko menengah", "Berisiko tinggi", "Tanpa risiko", "C"],
        ["Diversifikasi berarti...", "Menaruh semua dana pada satu saham", "Menyebar investasi ke beberapa aset", "Menjual seluruh aset", "Meminjam uang", "B"],
        ["Investor saham sebaiknya memahami...", "Analisis perusahaan", "Kondisi pasar", "Risiko investasi", "Semua benar", "D"],
        ["Saham dapat memberikan...", "Dividen", "Capital Gain", "Keduanya", "Tidak keduanya", "C"],
        ["Pemilik saham memiliki...", "Sebagian kepemilikan perusahaan", "Kendali atas negara", "Hak atas tanah pemerintah", "Rekening bank khusus", "A"],
        ["Saham biasanya dibeli melalui...", "Sekuritas", "Rumah sakit", "Sekolah", "Pegadaian", "A"],
        ["Tujuan diversifikasi adalah...", "Menambah risiko", "Mengurangi risiko", "Menghilangkan keuntungan", "Menutup rekening", "B"],
        ["Saham cocok bagi investor...", "Konservatif sekali", "Agresif hingga moderat", "Tidak suka risiko", "Tidak ingin keuntungan", "B"],
        ["Dividen berasal dari...", "Kerugian perusahaan", "Laba perusahaan", "Pajak negara", "Utang perusahaan", "B"],
        ["Pasar saham dapat mengalami...", "Kenaikan", "Penurunan", "Fluktuasi", "Semua benar", "D"],
        ["Saham termasuk instrumen pasar...", "Modal", "Uang", "Properti", "Komoditas", "A"]
    ],
    'Reksa Dana' => [
        ["Reksa dana adalah...", "Wadah penghimpunan dana investor", "Jenis tabungan", "Pinjaman online", "Mata uang digital", "A"],
        ["Dana reksa dana dikelola oleh...", "Bank Indonesia", "Manajer Investasi", "Presiden", "Notaris", "B"],
        ["Reksa dana cocok untuk...", "Investor pemula", "Hanya investor profesional", "Anak kecil tanpa izin", "Perusahaan saja", "A"],
        ["Reksa dana pasar uang memiliki risiko...", "Tinggi", "Sangat tinggi", "Relatif rendah", "Tidak terbatas", "C"],
        ["Reksa dana saham berinvestasi terutama pada...", "Emas", "Saham", "Properti", "Deposito", "B"],
        ["Reksa dana pendapatan tetap berfokus pada...", "Obligasi", "Kripto", "Tanah", "Saham asing saja", "A"],
        ["Keuntungan reksa dana adalah...", "Dikelola profesional", "Diversifikasi", "Mudah diakses", "Semua benar", "D"],
        ["NAB (Nilai Aktiva Bersih) dalam reksa dana adalah...", "Harga per unit penyertaan", "Pajak tahunan", "Biaya admin", "Modal manajer investasi", "A"],
        ["Diversifikasi pada reksa dana berarti...", "Menyebar investasi ke berbagai instrumen", "Membeli satu jenis saham", "Menyimpan uang di bawah kasur", "Meminjam uang untuk investasi", "A"],
        ["Jenis reksa dana yang cocok untuk jangka panjang adalah...", "Reksa dana pasar uang", "Reksa dana saham", "Reksa dana campuran", "Deposito", "B"],
        ["Profil risiko investor konservatif lebih cocok memilih...", "Reksa dana saham", "Reksa dana pasar uang", "Saham gorengan", "Kripto", "B"],
        ["Manajer investasi bertugas untuk...", "Mengelola dana investor", "Menyimpan uang nasabah", "Memberikan pinjaman", "Membayar pajak penghasilan", "A"],
        ["Reksa dana campuran berinvestasi pada...", "Emas dan perak", "Saham dan obligasi", "Tanah dan bangunan", "Uang tunai saja", "B"],
        ["Reksa dana dapat dicairkan...", "Kapan saja pada hari kerja bursa", "Setelah 10 tahun", "Hanya saat pensiun", "Setiap tanggal 1 saja", "A"],
        ["Keuntungan reksa dana pasar uang dibanding tabungan biasa adalah...", "Pajak yang lebih besar", "Potensi return sedikit lebih tinggi", "Risiko sangat tinggi", "Tidak bisa dicairkan", "B"],
        ["Risiko utama berinvestasi di reksa dana adalah...", "Tidak bisa dijual", "Penurunan nilai aktiva bersih (NAB)", "Bank ditutup", "Uang fisik hilang", "B"],
        ["Proses pembelian reksa dana disebut...", "Redemption", "Subscription", "Switching", "Trading", "B"],
        ["Proses penjualan kembali reksa dana disebut...", "Subscription", "Redemption", "Switching", "Dividen", "B"],
        ["Tujuan utama investasi reksa dana adalah...", "Mencapai tujuan keuangan", "Bermain judi", "Memperoleh utang", "Membayar tagihan listrik", "A"],
        ["Reksa dana diawasi oleh...", "Kepolisian", "Otoritas Jasa Keuangan (OJK)", "Kementerian Pendidikan", "Rukun Tetangga", "B"]
    ],
    'Obligasi' => [
        ["Obligasi adalah...", "Surat utang", "Saham", "Emas", "Properti", "A"],
        ["Penerbit obligasi dapat berupa...", "Pemerintah", "Perusahaan", "Keduanya", "Sekolah", "C"],
        ["Pendapatan dari obligasi disebut...", "Dividen", "Kupon", "Royalti", "Bonus", "B"],
        ["Pada saat jatuh tempo investor menerima...", "Pokok investasi", "Mobil", "Saham gratis", "Emas", "A"],
        ["Kupon obligasi biasanya dibayarkan...", "Setiap hari", "Secara berkala", "Hanya di akhir tahun", "Hanya saat beli", "B"],
        ["Obligasi yang diterbitkan oleh pemerintah Indonesia disebut...", "SUN (Surat Utang Negara)", "BPKB", "Sertifikat Deposito", "Saham", "A"],
        ["Obligasi korporasi diterbitkan oleh...", "Pemerintah daerah", "Perusahaan", "Bank sentral", "Individu", "B"],
        ["Risiko gagal bayar (default risk) pada obligasi artinya...", "Harga obligasi naik", "Penerbit gagal membayar", "Investor tidak mau membeli", "Investor bangkrut", "B"],
        ["Obligasi pemerintah biasanya memiliki risiko gagal bayar yang...", "Sangat tinggi", "Sangat rendah", "Tidak bisa ditebak", "Sama dengan saham", "B"],
        ["Hubungan antara harga obligasi dan suku bunga adalah...", "Berbanding lurus", "Berbanding terbalik", "Tidak berhubungan", "Sama-sama naik", "B"],
        ["Jika suku bunga acuan naik, maka harga obligasi di pasar sekunder biasanya...", "Naik", "Turun", "Tetap", "Tidak stabil", "B"],
        ["Obligasi Ritel Indonesia (ORI) dapat dibeli oleh...", "WNA saja", "Perusahaan asing", "WNI Individu", "Semua benar", "C"],
        ["Jatuh tempo obligasi adalah...", "Tanggal pembayaran dividen", "Tanggal pengembalian dana pokok", "Tanggal pembelian", "Tanggal pajak", "B"],
        ["Salah satu tujuan investasi obligasi adalah...", "Mendapat penghasilan tetap", "Spekulasi harian", "Membeli perusahaan", "Menjadi presiden", "A"],
        ["Surat Berharga Syariah Negara (SBSN) juga dikenal dengan sebutan...", "Obligasi konvensional", "Sukuk", "Reksadana", "Kripto", "B"],
        ["Kupon obligasi dapat berupa...", "Fixed rate dan floating rate", "Saham dan kas", "Emas dan perak", "Barang dan jasa", "A"],
        ["Mengapa obligasi disebut instrumen pendapatan tetap?", "Harganya tidak berubah", "Memberikan return pasti/terjadwal", "Pembelinya tetap", "Diawasi OJK", "B"],
        ["Risiko likuiditas pada obligasi terjadi jika...", "Sulit menjual sebelum jatuh tempo", "Obligasi mudah dijual", "Bunga terlalu tinggi", "Penerbit bangkrut", "A"],
        ["Diversifikasi portofolio dengan obligasi bertujuan untuk...", "Menambah fluktuasi", "Menurunkan risiko total", "Membeli aset kripto", "Menghilangkan pajak", "B"],
        ["Obligasi cocok untuk investor dengan profil risiko...", "Sangat agresif", "Moderat", "Spekulatif", "Penjudi", "B"]
    ],
    'Properti' => [
        ["Contoh investasi properti adalah...", "Rumah", "Tanah", "Apartemen", "Semua benar", "D"],
        ["Keuntungan properti dapat berasal dari...", "Sewa", "Kenaikan harga aset", "Keduanya", "Tidak keduanya", "C"],
        ["Properti termasuk aset...", "Fisik", "Digital", "Virtual", "Kripto", "A"],
        ["Likuiditas investasi properti tergolong...", "Sangat tinggi", "Rendah", "Menengah", "Nol", "B"],
        ["Keuntungan pasif dari investasi properti adalah...", "Harga tanah naik", "Pendapatan sewa", "Biaya renovasi", "Pajak bangunan", "B"],
        ["Kenaikan nilai properti dalam jangka panjang disebut...", "Capital Gain", "Dividen", "Kupon", "Bunga", "A"],
        ["Faktor yang paling mempengaruhi harga properti adalah...", "Lokasi", "Warna cat", "Jumlah pohon", "Nama pemilik", "A"],
        ["Properti dapat menjadi lindung nilai terhadap...", "Inflasi", "Penurunan gaji", "Kehilangan pekerjaan", "Kenaikan harga pulsa", "A"],
        ["Salah satu biaya dalam investasi properti adalah...", "Pajak Bumi dan Bangunan (PBB)", "Dividen", "Kupon tahunan", "Biaya sekuritas", "A"],
        ["Membeli tanah kosong untuk investasi mengharapkan...", "Pendapatan sewa harian", "Kenaikan harga masa depan", "Kupon bulanan", "Bunga bank", "B"],
        ["Renovasi pada properti bertujuan untuk...", "Menurunkan harga jual", "Meningkatkan nilai jual/sewa", "Membayar pajak", "Merusak bangunan", "B"],
        ["Kerugian berinvestasi properti adalah...", "Sulit dijual cepat", "Tahan inflasi", "Harga cenderung naik", "Bisa disewakan", "A"],
        ["Investasi properti sebaiknya menggunakan dana...", "Pinjaman jangka pendek", "Uang belanja harian", "Dana jangka panjang", "Uang darurat", "C"],
        ["Pendapatan dari sewa kos-kosan disebut...", "Passive income", "Active income", "Capital loss", "Inflasi", "A"],
        ["Faktor eksternal yang menaikkan harga properti adalah...", "Pembangunan infrastruktur", "Bangunan bocor", "Cat terkelupas", "Pemilik sakit", "A"],
        ["Investasi properti memerlukan modal awal yang...", "Sangat kecil", "Besar", "Gratis", "Nol", "B"],
        ["Developer properti adalah...", "Pihak yang menyewa rumah", "Pihak pengembang properti", "Pembeli rumah", "Agen asuransi", "B"],
        ["Surat bukti kepemilikan tertinggi pada properti di Indonesia adalah...", "SHM (Sertifikat Hak Milik)", "HGB", "Akta Jual Beli", "KTP", "A"],
        ["KPR (Kredit Pemilikan Rumah) adalah fasilitas dari...", "Pasar Modal", "Bank", "Pegadaian", "Koperasi", "B"],
        ["Risiko dari properti yang disewakan adalah...", "Penyewa kosong/tidak bayar", "Harga rumah naik", "Dapat capital gain", "Tidak dikenakan PBB", "A"]
    ],
    'Emas' => [
        ["Emas sering digunakan sebagai...", "Penyimpan nilai", "Surat utang", "Saham", "Obligasi", "A"],
        ["Investasi emas dapat dilakukan dalam bentuk...", "Batangan", "Koin", "Emas digital", "Semua benar", "D"],
        ["Salah satu keunggulan emas adalah...", "Likuiditas tinggi", "Risiko ekstrem", "Tidak bisa dijual", "Tidak bernilai", "A"],
        ["Emas sering dianggap sebagai 'Safe Haven' yang berarti...", "Tempat berenang", "Aset aman saat krisis", "Mudah dicuri", "Aset spekulatif", "B"],
        ["Emas batangan yang umum di Indonesia diproduksi oleh...", "PT ANTAM", "PT PLN", "Bank Indonesia", "Bursa Efek", "A"],
        ["Harga emas sangat dipengaruhi oleh...", "Harga beras", "Kondisi ekonomi global & inflasi", "Harga mobil", "Cuaca", "B"],
        ["Saat inflasi tinggi, harga emas cenderung...", "Turun", "Naik", "Tetap", "Hilang nilainya", "B"],
        ["Keuntungan utama emas dibanding properti adalah...", "Pajaknya murah", "Likuiditas lebih tinggi", "Ada pendapatan sewa", "Bisa ditinggali", "B"],
        ["Kelemahan emas sebagai investasi adalah...", "Tidak memberikan pasif income", "Mudah berkarat", "Sulit dijual", "Harganya selalu turun", "A"],
        ["Satuan berat emas biasanya menggunakan...", "Liter", "Meter", "Gram atau Troy Ounce", "Celcius", "C"],
        ["Emas digital memungkinkan investor membeli emas dengan...", "Emas asli via pos", "Modal kecil via aplikasi", "Kartu kredit palsu", "Fotokopi KTP", "B"],
        ["Risiko investasi emas fisik adalah...", "Harga turun ke nol", "Kehilangan/pencurian", "Gagal bayar", "Delisting", "B"],
        ["Karat adalah satuan untuk mengukur...", "Berat emas", "Kemurnian emas", "Harga emas", "Warna emas", "B"],
        ["Emas 24 karat berarti...", "Campuran 24 logam", "Emas murni (99.9%)", "Emas imitasi", "Emas berumur 24 tahun", "B"],
        ["Perbedaan emas perhiasan dan emas batangan adalah...", "Perhiasan tidak bisa dijual", "Batangan tanpa ongkos bikin mahal", "Batangan lebih ringan", "Perhiasan 100% murni", "B"],
        ["'Buyback' dalam investasi emas berarti...", "Membeli emas bekas", "Harga jual kembali ke toko", "Beli pakai pinjaman", "Beli cicilan", "B"],
        ["Spread pada emas adalah...", "Perbedaan harga beli & buyback", "Keuntungan per bulan", "Jarak antar toko", "Pajak emas", "A"],
        ["Emas sangat cocok digunakan untuk tujuan...", "Jangka pendek", "Jangka panjang & perlindungan", "Spekulasi bulanan", "Trading menit", "B"],
        ["Harga emas dunia umumnya dinilai dalam mata uang...", "Rupiah", "Dolar AS (USD)", "Euro", "Yen", "B"],
        ["Diversifikasi menggunakan emas disarankan sekitar...", "100% total aset", "5% - 10% portofolio", "0%", "90% portofolio", "B"]
    ],
    'Crypto' => [
        ["Cryptocurrency adalah...", "Mata uang digital berbasis blockchain", "Saham digital", "Properti digital", "Surat utang digital", "A"],
        ["Teknologi utama yang digunakan crypto adalah...", "Blockchain", "Bluetooth", "WiFi", "NFC", "A"],
        ["Contoh cryptocurrency adalah...", "Bitcoin", "Ethereum", "Keduanya", "Obligasi", "C"],
        ["Pasar crypto beroperasi...", "24 jam sehari", "Hanya jam kantor", "Hanya hari kerja", "Hanya malam hari", "A"],
        ["Risiko utama crypto adalah...", "Volatilitas tinggi", "Harga selalu tetap", "Tidak bisa dijual", "Tidak ada risiko", "A"],
        ["Tempat digital untuk menyimpan aset kripto disebut...", "Bank account", "Wallet (Dompet Kripto)", "Brankas besi", "Laci meja", "B"],
        ["Orang/entitas yang memverifikasi transaksi kripto disebut...", "Teller", "Miner (Penambang) / Validator", "Manajer investasi", "Direktur bank", "B"],
        ["Ethereum berbeda dengan Bitcoin karena memiliki fitur...", "Smart Contract", "Emas fisik", "Dividen bulanan", "Kantor pusat", "A"],
        ["Altcoin adalah singkatan dari...", "Alternate Coin", "All Time Coin", "Always Coin", "Aluminum Coin", "A"],
        ["Aset kripto yang nilainya dipatok uang fiat (Dolar) disebut...", "Shitcoin", "Stablecoin", "Memecoin", "Bitcoin", "B"],
        ["Penurunan harga aset kripto secara drastis/lama disebut...", "Bull market", "Crypto winter (Bear market)", "Halving", "Staking", "B"],
        ["Decentralized Finance (DeFi) adalah...", "Bank sentral kripto", "Keuangan tanpa perantara", "OJK kripto", "Perusahaan asuransi", "B"],
        ["Cara mengamankan dompet kripto adalah kerahasiaan...", "Username", "Private Key / Seed Phrase", "Public Key", "Alamat email", "B"],
        ["Jika Seed Phrase atau Private Key hilang, maka...", "Bisa minta reset", "Akses aset hilang permanen", "Akun ditutup sementara", "OJK mengganti dana", "B"],
        ["Halving pada Bitcoin adalah...", "Pengurangan hadiah miner (tiap 4 tahun)", "Harga Bitcoin dibagi dua", "Pajak 50%", "Pembagian Bitcoin gratis", "A"],
        ["Risiko berinvestasi di aset kripto antara lain...", "Keamanan & volatilitas tinggi", "Harga stabil", "Terjamin pemerintah", "Tidak bisa ditransfer", "A"],
        ["Proses mendapat kripto dengan mengunci aset disebut...", "Mining", "Staking", "Trading", "Holding", "B"],
        ["Bursa perdagangan kripto (Exchange) berfungsi untuk...", "Mencetak uang kertas", "Jual beli aset kripto", "Menambang emas", "Menerbitkan obligasi", "B"],
        ["Karena risiko kripto sangat tinggi, disarankan memakai...", "Uang sekolah anak", "Uang pinjol", "Uang dingin", "Uang DP rumah", "C"],
        ["Diversifikasi investasi di kripto dapat dilakukan dengan...", "All-in satu koin", "Beli koin fundamental kuat", "Beli memecoin saja", "Margin 100x", "B"]
    ]
];

$insertedCount = 0;

foreach ($questionsData as $categoryName => $questions) {
    $category = InvestmentCategory::where('name', $categoryName)->first();
    if ($category) {
        foreach ($questions as $q) {
            TriviaQuestion::create([
                'category_id' => $category->id,
                'question' => $q[0],
                'option_a' => $q[1],
                'option_b' => $q[2],
                'option_c' => $q[3],
                'option_d' => $q[4],
                'correct_answer' => $q[5],
            ]);
            $insertedCount++;
        }
    }
}

echo "Berhasil menghapus soal lama dan menambahkan $insertedCount soal baru!\n";
