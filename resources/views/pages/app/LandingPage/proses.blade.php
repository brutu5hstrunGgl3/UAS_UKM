<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];
    
    // Konfigurasi email (ganti dengan email Anda)
    $to = "admin@techlearn.com";
    $subject = "Pesan Baru dari Website";
    
    $message = "Nama: " . $nama . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Pesan:\n" . $pesan;
    
    $headers = "From: " . $email;
    
    // Kirim email
    mail($to, $subject, $message, $headers);
    
    // Redirect kembali ke halaman utama
    header("Location: index.html?status=success");
    exit();
}
?>