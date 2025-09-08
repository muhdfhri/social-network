@extends('layouts.guest')
@section('title', 'Syarat dan Ketentuan')
@section('content')
    <div class="container mx-auto text-black font-medium py-4 px-4">
        <h2 class="text-blue-600 text-3xl font-bold text-center mb-6">Syarat dan Ketentuan</h2>

        <p class="mb-4 text-black font-bold text-lg">Selamat datang di Platform Jaringan Sosial Filkom - UNUSU!</p>

        <p class="mb-4">
            Syarat dan Ketentuan ini mengatur penggunaan Platform Jaringan Sosial Filkom - UNUSU,
            yang dikelola oleh Fakultas Ilmu Komputer Universitas Nahdlatul Ulama Sumatera Utara.
            Dengan mendaftar dan menggunakan platform ini, Anda dianggap telah membaca, memahami,
            dan menyetujui seluruh ketentuan yang berlaku. Jika Anda tidak setuju,
            harap tidak melanjutkan pendaftaran atau penggunaan layanan ini.
        </p>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">1. Definisi</h3>
        <ul class="list-disc pl-6 mb-6 space-y-2">
            <li><span class="font-semibold">"Platform"</span> adalah layanan daring bernama Platform Jaringan Sosial Filkom - UNUSU.</li>
            <li><span class="font-semibold">"Pengguna"</span> adalah individu yang terdaftar dan menggunakan Platform.</li>
            <li><span class="font-semibold">"Konten"</span> mencakup semua informasi, teks, gambar, video, atau materi lain yang diunggah oleh pengguna.</li>
            <li><span class="font-semibold">"Kami"</span> merujuk pada pengelola resmi Platform Jaringan Sosial Filkom - UNUSU.</li>
        </ul>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">2. Kelayakan Pendaftaran</h3>
        <ol class="list-decimal pl-6 mb-6 space-y-3">
            <li>Hanya mahasiswa, dosen, staf, dan alumni Fakultas Ilmu Komputer UNUSU yang berhak mendaftar.</li>
            <li>Pengguna wajib memberikan data yang benar, lengkap, dan terkini saat melakukan pendaftaran.</li>
            <li>Pendaftaran dengan data palsu atau tidak valid dapat mengakibatkan penolakan atau penghapusan akun.</li>
        </ol>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">3. Akun Pengguna</h3>
        <ul class="list-disc pl-6 mb-6 space-y-2">
            <li>Pengguna bertanggung jawab penuh atas keamanan akun dan kata sandinya.</li>
            <li>Segala aktivitas yang terjadi melalui akun menjadi tanggung jawab pemilik akun.</li>
            <li>Platform berhak menangguhkan atau menghapus akun yang melanggar ketentuan.</li>
        </ul>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">4. Privasi dan Keamanan Data</h3>
        <ul class="list-disc pl-6 mb-6 space-y-2">
            <li>Data pribadi digunakan untuk kepentingan akademik, kegiatan internal, dan komunikasi resmi.</li>
            <li>Kami menerapkan langkah keamanan untuk melindungi data pengguna.</li>
            <li>Data pribadi tidak akan dibagikan kepada pihak ketiga tanpa persetujuan, kecuali diwajibkan oleh hukum.</li>
        </ul>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">5. Konten dan Aktivitas Pengguna</h3>
        <ul class="list-disc pl-6 mb-6 space-y-2">
            <li>Pengguna bertanggung jawab penuh atas konten yang diunggah ke Platform.</li>
            <li>Dilarang mengunggah konten yang melanggar hukum, mengandung SARA, pornografi, kekerasan, atau melanggar hak cipta.</li>
            <li>Dilarang menggunakan Platform untuk penipuan, spam, atau aktivitas ilegal.</li>
        </ul>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">6. Hak Kekayaan Intelektual</h3>
        <p class="mb-6">
            Seluruh materi yang tersedia di Platform, termasuk teks, grafis, logo, ikon, dan kode,
            adalah milik Fakultas Ilmu Komputer UNUSU atau pihak yang memberikan lisensi,
            dan dilindungi oleh undang-undang hak cipta.
        </p>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">7. Perubahan dan Penghentian Layanan</h3>
        <p class="mb-6">
            Kami berhak mengubah, menangguhkan, atau menghentikan layanan Platform sewaktu-waktu
            dengan atau tanpa pemberitahuan terlebih dahulu.
        </p>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">8. Batasan Tanggung Jawab</h3>
        <p class="mb-6">
            Platform ini disediakan sebagaimana adanya tanpa jaminan apa pun, baik tersurat maupun tersirat.
            Kami tidak bertanggung jawab atas kerugian langsung, tidak langsung, insidental, atau konsekuensial
            yang timbul akibat penggunaan atau ketidakmampuan menggunakan Platform ini.
            Segala risiko penggunaan menjadi tanggung jawab pengguna.
        </p>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">9. Pembaruan Ketentuan</h3>
        <p class="mb-6">
            Ketentuan ini dapat diperbarui sewaktu-waktu. Versi terbaru akan dipublikasikan di halaman ini
            dan berlaku sejak tanggal pembaruan.
        </p>

        <h3 class="text-blue-600 text-xl font-semibold mt-6 mb-3">10. Kontak</h3>
        <div class="space-y-2">
            <p class="flex items-center"><i class="fas fa-university text-blue-600 mr-2"></i> Fakultas Ilmu Komputer</p>
            <p class="flex items-center"><i class="fas fa-school text-blue-600 mr-2"></i> Universitas Nahdlatul Ulama Sumatera Utara</p>
            <p class="flex items-center"><i class="fas fa-map-marker-alt text-blue-600 mr-2"></i> Jl. Gaperta Ujung No.2, Tj. Gusta, Kec. Medan Helvetia, Kota Medan, Sumatera Utara 20125</p>
        </div>
    </div>
@endsection
