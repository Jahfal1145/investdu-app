<?php

use App\Models\InvestmentCategory;
use App\Models\YesOrNoQuestion;

YesOrNoQuestion::truncate();

$categoriesData = [
    'Tabungan Berjangka' => [
        ["Apakah tabungan berjangka mengharuskan nasabah menabung secara rutin?", "Yes"],
        ["Apakah dana tabungan berjangka dapat ditarik bebas kapan saja tanpa syarat?", "No"],
        ["Apakah tabungan berjangka membantu seseorang lebih disiplin menabung?", "Yes"],
        ["Apakah tabungan berjangka termasuk produk perbankan?", "Yes"],
        ["Apakah tabungan berjangka memiliki jangka waktu tertentu?", "Yes"],
        ["Apakah keuntungan tabungan berjangka berasal dari bunga?", "Yes"],
        ["Apakah tabungan berjangka memiliki risiko lebih tinggi daripada saham?", "No"],
        ["Apakah pencairan sebelum jatuh tempo dapat dikenakan penalti?", "Yes"],
        ["Apakah tabungan berjangka cocok untuk tujuan keuangan tertentu?", "Yes"],
        ["Apakah tabungan berjangka termasuk investasi spekulatif?", "No"],
        ["Apakah setoran tabungan berjangka biasanya dilakukan secara otomatis?", "Yes"],
        ["Apakah tabungan berjangka dapat membantu menyiapkan dana pendidikan?", "Yes"],
        ["Apakah tabungan berjangka menawarkan keamanan yang relatif baik?", "Yes"],
        ["Apakah tabungan berjangka memberikan dividen seperti saham?", "No"],
        ["Apakah tabungan berjangka cocok bagi orang yang mengutamakan keamanan dana?", "Yes"],
        ["Apakah tabungan berjangka selalu memberikan keuntungan yang sangat besar?", "No"],
        ["Apakah bank biasanya menentukan jangka waktu tabungan berjangka sejak awal?", "Yes"],
        ["Apakah tabungan berjangka dapat digunakan untuk menyiapkan dana pernikahan?", "Yes"],
        ["Apakah tabungan berjangka memiliki likuiditas lebih tinggi daripada tabungan biasa?", "No"],
        ["Apakah tabungan berjangka merupakan instrumen keuangan yang relatif aman?", "Yes"],
    ],
    'Saham' => [
        ["Apakah saham menunjukkan kepemilikan dalam suatu perusahaan?", "Yes"],
        ["Apakah investor saham bisa memperoleh dividen?", "Yes"],
        ["Apakah saham diperdagangkan di bursa efek?", "Yes"],
        ["Apakah harga saham selalu tetap setiap hari?", "No"],
        ["Apakah saham memiliki potensi keuntungan yang tinggi?", "Yes"],
        ["Apakah saham memiliki risiko kerugian?", "Yes"],
        ["Apakah pemegang saham menjadi salah satu pemilik perusahaan?", "Yes"],
        ["Apakah saham cocok untuk investasi jangka panjang?", "Yes"],
        ["Apakah semua saham selalu menghasilkan keuntungan?", "No"],
        ["Apakah capital gain berasal dari kenaikan harga saham?", "Yes"],
        ["Apakah saham termasuk instrumen pasar modal?", "Yes"],
        ["Apakah investor saham perlu memahami risiko investasi?", "Yes"],
        ["Apakah harga saham dapat dipengaruhi kondisi ekonomi?", "Yes"],
        ["Apakah saham lebih aman daripada tabungan berjangka dalam hal risiko?", "No"],
        ["Apakah saham dapat mengalami kenaikan dan penurunan harga?", "Yes"],
        ["Apakah dividen berasal dari laba perusahaan?", "Yes"],
        ["Apakah investasi saham bebas dari risiko?", "No"],
        ["Apakah diversifikasi dapat membantu mengurangi risiko investasi saham?", "Yes"],
        ["Apakah saham hanya dapat dimiliki oleh perusahaan besar?", "No"],
        ["Apakah saham merupakan salah satu instrumen investasi yang populer?", "Yes"],
    ],
    'Reksa Dana' => [
        ["Apakah reksa dana merupakan wadah investasi bersama?", "Yes"],
        ["Apakah dana reksa dana dikelola oleh manajer investasi?", "Yes"],
        ["Apakah reksa dana cocok untuk investor pemula?", "Yes"],
        ["Apakah investor harus mengelola sendiri seluruh portofolio reksa dana?", "No"],
        ["Apakah reksa dana memiliki berbagai jenis sesuai profil risiko?", "Yes"],
        ["Apakah reksa dana pasar uang memiliki risiko relatif rendah?", "Yes"],
        ["Apakah reksa dana saham memiliki potensi keuntungan lebih tinggi?", "Yes"],
        ["Apakah reksa dana bebas dari risiko kerugian?", "No"],
        ["Apakah modal investasi reksa dana dapat dimulai dari jumlah kecil?", "Yes"],
        ["Apakah nilai investasi reksa dana dapat naik dan turun?", "Yes"],
        ["Apakah reksa dana membantu diversifikasi investasi?", "Yes"],
        ["Apakah reksa dana hanya dapat dibeli oleh perusahaan besar?", "No"],
        ["Apakah manajer investasi bertugas mengelola dana investor?", "Yes"],
        ["Apakah reksa dana pendapatan tetap banyak berinvestasi pada obligasi?", "Yes"],
        ["Apakah reksa dana termasuk instrumen investasi legal yang diawasi?", "Yes"],
        ["Apakah semua jenis reksa dana memiliki tingkat risiko yang sama?", "No"],
        ["Apakah investor perlu memahami tujuan investasinya sebelum memilih reksa dana?", "Yes"],
        ["Apakah reksa dana dapat digunakan untuk investasi jangka panjang?", "Yes"],
        ["Apakah reksa dana selalu memberikan keuntungan pasti?", "No"],
        ["Apakah reksa dana menjadi salah satu pilihan investasi yang populer?", "Yes"],
    ],
    'Obligasi' => [
        ["Apakah obligasi merupakan surat utang?", "Yes"],
        ["Apakah pemerintah dapat menerbitkan obligasi?", "Yes"],
        ["Apakah perusahaan dapat menerbitkan obligasi?", "Yes"],
        ["Apakah pendapatan obligasi disebut kupon?", "Yes"],
        ["Apakah obligasi selalu lebih berisiko daripada saham?", "No"],
        ["Apakah investor menerima pokok investasi saat jatuh tempo?", "Yes"],
        ["Apakah obligasi dapat menjadi sumber pendapatan tetap?", "Yes"],
        ["Apakah obligasi termasuk instrumen investasi?", "Yes"],
        ["Apakah obligasi memiliki risiko gagal bayar?", "Yes"],
        ["Apakah perubahan suku bunga dapat memengaruhi harga obligasi?", "Yes"],
        ["Apakah obligasi pemerintah umumnya dianggap relatif aman?", "Yes"],
        ["Apakah obligasi memberikan dividen seperti saham?", "No"],
        ["Apakah obligasi dapat digunakan untuk diversifikasi portofolio?", "Yes"],
        ["Apakah obligasi selalu memberikan keuntungan yang sangat tinggi?", "No"],
        ["Apakah kupon obligasi dibayarkan secara berkala?", "Yes"],
        ["Apakah obligasi memiliki tanggal jatuh tempo?", "Yes"],
        ["Apakah semua obligasi memiliki risiko yang sama?", "No"],
        ["Apakah obligasi cocok bagi investor yang menginginkan pendapatan stabil?", "Yes"],
        ["Apakah obligasi termasuk aset kripto?", "No"],
        ["Apakah investor perlu memperhatikan kualitas penerbit obligasi?", "Yes"],
    ],
    'Properti' => [
        ["Apakah rumah termasuk investasi properti?", "Yes"],
        ["Apakah tanah termasuk aset properti?", "Yes"],
        ["Apakah investasi properti dapat menghasilkan pendapatan sewa?", "Yes"],
        ["Apakah properti merupakan aset fisik?", "Yes"],
        ["Apakah investasi properti membutuhkan modal yang relatif besar?", "Yes"],
        ["Apakah nilai properti dapat meningkat seiring waktu?", "Yes"],
        ["Apakah lokasi memengaruhi nilai properti?", "Yes"],
        ["Apakah properti memiliki likuiditas yang tinggi seperti tabungan?", "No"],
        ["Apakah biaya perawatan menjadi salah satu pertimbangan investasi properti?", "Yes"],
        ["Apakah properti dapat digunakan sebagai jaminan pinjaman?", "Yes"],
        ["Apakah investasi properti bebas dari risiko?", "No"],
        ["Apakah apartemen termasuk jenis properti?", "Yes"],
        ["Apakah ruko termasuk investasi properti?", "Yes"],
        ["Apakah perkembangan infrastruktur dapat meningkatkan nilai properti?", "Yes"],
        ["Apakah properti dapat dijual dalam hitungan menit dengan mudah?", "No"],
        ["Apakah investor perlu menganalisis lokasi sebelum membeli properti?", "Yes"],
        ["Apakah properti cocok untuk investasi jangka panjang?", "Yes"],
        ["Apakah semua properti selalu mengalami kenaikan harga?", "No"],
        ["Apakah pajak dapat menjadi biaya dalam investasi properti?", "Yes"],
        ["Apakah properti termasuk salah satu instrumen investasi populer?", "Yes"],
    ],
    'Emas' => [
        ["Apakah emas sering digunakan sebagai penyimpan nilai?", "Yes"],
        ["Apakah emas dapat dibeli dalam bentuk batangan?", "Yes"],
        ["Apakah emas dapat dibeli dalam bentuk digital?", "Yes"],
        ["Apakah emas memberikan dividen seperti saham?", "No"],
        ["Apakah emas sering dianggap sebagai aset yang relatif aman?", "Yes"],
        ["Apakah harga emas dapat berubah?", "Yes"],
        ["Apakah emas dapat digunakan sebagai alat diversifikasi investasi?", "Yes"],
        ["Apakah emas memiliki likuiditas yang cukup tinggi?", "Yes"],
        ["Apakah emas bebas dari risiko penurunan harga?", "No"],
        ["Apakah emas sering diminati saat kondisi ekonomi tidak stabil?", "Yes"],
        ["Apakah emas termasuk aset fisik?", "Yes"],
        ["Apakah emas cocok untuk investasi jangka panjang?", "Yes"],
        ["Apakah emas menghasilkan kupon seperti obligasi?", "No"],
        ["Apakah inflasi dapat memengaruhi minat terhadap emas?", "Yes"],
        ["Apakah emas dapat dijual kembali ketika dibutuhkan?", "Yes"],
        ["Apakah harga emas selalu naik setiap hari?", "No"],
        ["Apakah emas merupakan salah satu investasi tradisional yang populer?", "Yes"],
        ["Apakah emas termasuk mata uang digital?", "No"],
        ["Apakah investor perlu memperhatikan harga pasar saat membeli emas?", "Yes"],
        ["Apakah emas dapat membantu menjaga nilai kekayaan dalam jangka panjang?", "Yes"],
    ],
    'Crypto' => [
        ["Apakah cryptocurrency merupakan aset digital?", "Yes"],
        ["Apakah crypto menggunakan teknologi blockchain?", "Yes"],
        ["Apakah Bitcoin termasuk cryptocurrency?", "Yes"],
        ["Apakah Ethereum termasuk cryptocurrency?", "Yes"],
        ["Apakah pasar crypto beroperasi selama 24 jam sehari?", "Yes"],
        ["Apakah harga crypto dapat berubah dengan cepat?", "Yes"],
        ["Apakah crypto memiliki risiko tinggi?", "Yes"],
        ["Apakah crypto selalu memberikan keuntungan?", "No"],
        ["Apakah blockchain digunakan untuk mencatat transaksi crypto?", "Yes"],
        ["Apakah crypto termasuk investasi yang volatil?", "Yes"],
        ["Apakah semua negara memiliki aturan yang sama mengenai crypto?", "No"],
        ["Apakah investor perlu memahami risiko sebelum membeli crypto?", "Yes"],
        ["Apakah crypto dapat mengalami penurunan harga yang signifikan?", "Yes"],
        ["Apakah aset crypto termasuk investasi tradisional seperti emas?", "No"],
        ["Apakah wallet digital digunakan untuk menyimpan crypto?", "Yes"],
        ["Apakah crypto dapat diperdagangkan secara online?", "Yes"],
        ["Apakah crypto bebas dari risiko keamanan?", "No"],
        ["Apakah teknologi blockchain memiliki penggunaan selain crypto?", "Yes"],
        ["Apakah crypto cocok bagi investor yang memahami risiko tinggi?", "Yes"],
        ["Apakah riset diperlukan sebelum berinvestasi di crypto?", "Yes"],
    ]
];

foreach ($categoriesData as $catName => $questions) {
    $category = InvestmentCategory::where('name', 'LIKE', '%' . $catName . '%')->first();
    
    if (!$category && $catName === 'Crypto') {
        $category = InvestmentCategory::where('slug', 'crypto')->first();
    }
    
    if ($category) {
        foreach ($questions as $q) {
            YesOrNoQuestion::create([
                'category_id' => $category->id,
                'question' => $q[0],
                'correct_answer' => $q[1],
                'explanation' => 'Penjelasan untuk jawaban ini akan segera ditambahkan.'
            ]);
        }
        echo "Berhasil menambahkan 20 pertanyaan untuk kategori: " . $category->name . "\n";
    } else {
        echo "Kategori tidak ditemukan: $catName\n";
    }
}
echo "Selesai!\n";
