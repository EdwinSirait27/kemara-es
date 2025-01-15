<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman dengan Watermark</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f4;
            position: relative;
        }

        .container {
            width: 80%;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/assets/watermark.png') center center no-repeat;
            background-size: 300px;
            opacity: 0.1;
            z-index: 0;
        }
    </style>
</head>
<body>
    <div class="watermark"></div>
    <div class="container">
        <h1>Judul Halaman</h1>
        <p>Ini adalah contoh halaman dengan watermark menggunakan gambar dari folder asset Laravel.</p>
    </div>
</body>
</html>
