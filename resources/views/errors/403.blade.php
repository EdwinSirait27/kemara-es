<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/Shield_Logos__SMAK_KESUMA (1).ico')}}">
    <title>Ups...</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .error-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .error-code {
            font-size: 7rem;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .error-message {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: #2980b9;
        }
        .error-image {
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">403</div>
        <div class="error-message">Akses Ditolak.</div>
        <a href="javascript:void(0);" onclick="window.history.back();" class="back-link">Kembali</a>

    </div>
</body>
</html>