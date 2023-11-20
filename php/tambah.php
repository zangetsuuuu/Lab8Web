<?php
error_reporting(E_ALL);
include_once("koneksi.php");

if (isset($_POST["nama"])) {
    $nama = $_POST["nama"];
    $kategori = $_POST["kategori"];
    $harga_beli = $_POST["harga_beli"];
    $harga_jual = $_POST["harga_jual"];
    $stok = $_POST["stok"];
    $file_gambar = $_FILES["file_gambar"];
    $gambar = null;

    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;

        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    $sql = 'INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, 
        stok, gambar) ';
    $sql .= "VALUE ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";
    $result = mysqli_query($conn, $sql);
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Metrophobic" />
    <title>Tambah Barang</title>
    <style>
        body {
            font-family: 'Metrophobic', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input {
            margin-bottom: 15px;
        }

        label {
            margin-bottom: 5px;
            color: #333;
        }

        select,
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: "Metrophobic", sans-serif;
        }

        select {
            cursor: pointer;
        }

        .submit {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            width: 100%;
            margin-top: 16px;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Barang</h1>
        <div class="main">
            <form method="POST" action="tambah.php" enctype="multipart/form-data">
                <div class="input">
                    <label>Kategori</label>
                    <select name="kategori">
                        <option value="Komputer">Komputer</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Handphone">Handphone</option>
                    </select>
                </div>
                <div class="input">
                    <label>Harga Jual</label>
                    <input type="text" name="harga_jual">
                </div>
                <div class="input">
                    <label>Harga Beli</label>
                    <input type="text" name="harga_beli">
                </div>
                <div class="input">
                    <label>Stok</label>
                    <input type="text" name="stok">
                </div>
                <div class="input">
                    <label>File Gambar</label>
                    <input type="file" name="file_gambar">
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</body>
</html>