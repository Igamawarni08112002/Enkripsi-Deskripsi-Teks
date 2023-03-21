<?php

// Inisialisasi Variable
$pswd = "";
$code = "";
$error = "";
$valid = true;
$color = "#FF0000";

// Jika Salah Satu Tombol Dengan Type Submit Di Tekan
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// declare encrypt and decrypt funtions
	require_once('proses.php');
	
	// Set Variable
	$pswd = $_POST['pswd'];
	$code = $_POST['code'];
	
	// Cek Jika Nilai Di Kunci / Key Masih Kosong Maka
	if (empty($_POST['pswd']))
	{
		// Tampilkan Pesan Error Dengan Menggunakan Variable Error Yang Sudah Di Deklarasikan Sebelumnya
		$error = "Key / Kunci Tidak Boleh Kosong !";
		$valid = false;
	}
	
	// Cek Jika Nilai Di Teks Yang Ingin Di Enkripsi / Deskripsi Masih Kosong Maka
	else if (empty($_POST['code']))
	{
		// Tampilkan Pesan Error Dengan Menggunakan Variable Error Yang Sudah Di Deklarasikan Sebelumnya
		$error = "Teks Yang Ingin Di Olah Tidak Boleh Kosong !";
		$valid = false;
	}
	
	// Cek Jika Nilai Di Kunci / Key Maka
	else if (isset($_POST['pswd']))
	{
		// Cek Jika Nilai Di Kunci / Key Terdapat Angka Maka atau Tidak Sama Dengan Huruf Maka
		if (!ctype_alpha($_POST['pswd']))
		{
			$error = "Key / Kunci Tidak Boleh Mengandung Angka !";
			$valid = false;
		}
	}
	
	// Jika Inputan Valid Maka
	if ($valid)
	{
		// Cek Jika Tombol Dengan Name encrypt Di Tekan, Maka
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($pswd, $code);
			$error = "Teks Berhasil Di Enkripsi !";
			$color = "#526F35";
		}
			
		// Cek Jika Tombol Dengan Name decrypt Di Tekan, Maka
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($pswd, $code);
			$error = "Teks Berhasil Di Deskripsi !";
			$color = "#526F35";
		}
	}
}

?>

<html>

<head>
    <title>Kriptografi - Algoritma Enigma</title>
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="gaya/style.css">
</head>

<body>
    <br><br><br>
    <form action="index.php" method="post">
        <table cellpadding="5" align="center" cellpadding="2" border="7">
            <caption>
                <hr><b>Algoritma Enigma - Enkripsi & Deskripsi</b>
                <hr>
            </caption>
            <tr>
                <td align="center">Kunci / Key : <input type="text" name="pswd" id="pass"
                        value="<?php echo htmlspecialchars($pswd); ?>" /></td>
            </tr>
            <tr>
                <td align="center"><textarea id="box" name="code"><?php echo htmlspecialchars($code); ?></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="encrypt" class="button" value="Enkripsi Teks" onclick="validate(1)"
                        style="cursor:pointer;" />
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="decrypt" class="button" value="Deskripsi Teks" onclick="validate(2)"
                        style="cursor:pointer;" />
                </td>
            </tr>
            <tr>
                <td align="center">Kriptografi | Copyright &copy; 2023 By Iga Mawarni</td>
            </tr>
            <tr>
                <td>
                    <center>
                        <div style="color: <?php echo htmlspecialchars($color) ?>">
                            <?php echo htmlspecialchars($error) ?></div>
                    </center>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>