<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Helvetica, sans-serif;
            margin: none ;
            position: relative; /* Posisi relatif untuk watermark */
        }
        .container {
            max-width: 600px;
            margin: auto;
            border: none ;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px  rgba(255, 255, 255, 0.9);
            position: relative; /* Posisi relatif untuk menampung watermark */
            background: rgba(255, 255, 255, 0.9); /* Warna latar belakang dengan transparansi */
        }
        h1 {
            text-align: left; /* Ubah menjadi rata kiri */
        }
        .header {
            text-align: left; /* Ubah menjadi rata kiri */
            margin-bottom: 20px;
        }
        .logo {
            max-width: 100px;
            height: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: none; /* Hapus border */
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: none; /* Tambahkan border bawah */
        }
        th {
            background-color: #f2f2f2;
        }
      
        .footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: left; /* Ubah menjadi rata kiri */
            border-top: 1px solid #000; /* Opsional: garis atas untuk pemisah */
            padding-top: 10px;
        }
        @media (max-width: 600px) {
            body {
                margin: 10px;
            }
            .container {
                padding: 10px;
            }
            .logo {
                max-width: 80px;
            }
        }

        /* Watermark styling */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1; /* Transparansi */
            z-index: -1; /* Di belakang konten */
            pointer-events: none; /* Agar tidak mengganggu interaksi pengguna */
        }
    </style>
</head>
<body>
    <div class="container">
       <!-- Watermark logo -->
        <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/komputer 77.jpg'))) }}" 
     alt="Watermark" 
     style="width: 200px; height: auto; float: right; margin-left: 10px;">
    <h1>Invoice</h1>
    <p><strong>{{ $dataPerusahaan['nama'] }}</strong></p>
    <p style="font-size: 12px;">{{ $dataPerusahaan['alamat'] }}</p> <p style="font-size: 12px;">WhatsApp : {{ $dataPerusahaan['telepon'] }}</p>
    <p style="font-size: 12px;">Email:{{ $dataPerusahaan['email'] }}</p>
    <p style="font-size: 12px;">Website: {{ $dataPerusahaan['website'] }}</p>
    <hr style="border: none; border-top: 1px solid #000; margin-top: 10px;">
</div>
<table>
  

    </table>    
    <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jenis Paket</th>
                    <th>Harga</th>
                    <th>Tanggal Pembayaran</th>
                </tr>
            </thead>
            <tbody>
            
                @php
                    $total = 0; // Inisialisasi total
                @endphp
                @foreach ($pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $pembayaran->name }}</td>
                        <td>{{ $pembayaran->jenis_paket }}</td>
                        <td>Rp. {{ number_format($pembayaran->harga, 0, ',', '.') }}</td>
                        <td>{{ $pembayaran->created_at->format('d M Y') }}</td>
                    </tr>
                    @php
                        $total += $pembayaran->harga; // Tambahkan harga ke total
                    @endphp
                @endforeach
            </tbody>
        </table>

        <!-- Menambahkan Total Pembayaran -->
        <div class="footer">
            <p><strong>Total Pembayaran: Rp. {{ number_format($total, 0, ',', '.') }}</strong></p>
            <p>Semua transaksi telah tercatat dengan baik. Jika ada kesalahan, silakan hubungi customer service kami.</p>
        </div>
    </div>
  

</body>
</html>
