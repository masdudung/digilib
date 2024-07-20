<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .profile-image {
            text-align: center;
            padding: 20px;
            background-color: #eaeaea;
        }
        .profile-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .profile-info {
            padding: 20px;
            text-align: center;
        }
        .profile-info h2 {
            margin: 10px 0;
            font-size: 24px;
            color: #333;
        }
        .profile-info p {
            margin: 5px 0;
            font-size: 18px;
            color: #666;
        }
        .terms-condition {
            padding: 20px;
            text-align: center;
            background-color: #f4f4f4;
            margin-top: 20px;
        }
        .terms-condition h3 {
            margin: 10px 0;
            font-size: 20px;
            color: #333;
        }
        .terms-condition p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-image">
            <img src="https://api-digilib.moveidn.com/storage/images/profile.jpg" alt="Profile Image">
        </div>
        <div class="profile-info">
            <h2>Nama: Moch Mufiddin</h2>
            <p>NIM: 22500085</p>
        </div>
        <div class="terms-condition">
            <h3>Syarat dan Ketentuan Pemesanan Bahan Makanan</h3>
            <p>1. Pembeli harus berusia minimal 18 tahun.</p>
            <p>2. Pembeli harus mendaftar terlebih dahulu sebelum melakukan pemesanan.</p>
            <p>3. Pembeli harus membaca dan menyetujui syarat dan ketentuan ini sebelum melakukan pemesanan.</p>
            <p>4. Pembeli bertanggung jawab atas keakuratan data yang diberikan.</p>
            <p>5. Pembeli tidak boleh menggunakan platform ini untuk tujuan yang tidak sah.</p>
        </div>
    </div>