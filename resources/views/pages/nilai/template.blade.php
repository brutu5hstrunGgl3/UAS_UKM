<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .certificate {
            position: relative; /* Mengatur posisi relatif untuk elemen absolut di dalamnya */
            height: 670px; /* Sesuaikan dengan tinggi gambar sertifikat */
            width: 1000px; /* Sesuaikan dengan lebar gambar sertifikat */
            margin: 0 auto; /* Agar kontainer berada di tengah layar secara horizontal */
            border: 1px solid #ccc; /* Opsional: Tambahkan border untuk debugging */
        }
        .certificate img {
            width: 100%; /* Pastikan gambar memenuhi ukuran kontainer */
            height: 100%;
            object-fit: cover; /* Atur ke 'contain' jika Anda ingin gambar tidak terpotong */
            position: absolute;
            z-index: -1; /* Membuat gambar berada di belakang elemen lain */
        }
        .name {
            position: absolute;
            top: 50%; /* Atur posisi vertikal */
            left: 50%; /* Atur posisi horizontal */
            transform: translate(-50%, -50%);
            font-size: 50px; /* Ukuran font yang lebih besar agar terlihat jelas */
            font-weight: bold;
            color: #000; /* Warna teks hitam */
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <!-- Gambar sertifikat -->
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('sertifikat/sertifikat.jpg'))) }}" alt="Certificate Background">

        <!-- Nama Peserta -->
        <div class="name">
            {{ $data['name'] ?? 'Nama Tidak Tersedia' }}
        </div>
    </div>
</body>
</html>
