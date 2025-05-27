<?php
session_start();

$kullaniciAdiDogru = 'Wreek.co';
$sifreDogru = '225352';

if (isset($_POST['kullaniciAdi'], $_POST['sifre'])) {
    if ($_POST['kullaniciAdi'] === $kullaniciAdiDogru && $_POST['sifre'] === $sifreDogru) {
        $_SESSION['giris'] = true;
        header('Location: admin_panel.php');
        exit;
    } else {
        $hata = "Kullanıcı adı veya şifre yanlış!";
    }
}

if (isset($_GET['cikis'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8" />
<title>Admin Paneli Girişi</title>
<style>
body { font-family: Arial, sans-serif; background:#f2f2f2; padding:20px; }
.container { max-width: 400px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 4px; border: 1px solid #ccc; }
button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
button:hover { background: #0069d9; }
.message { margin: 10px 0; padding: 10px; border-radius: 4px; }
.error { background: #f8d7da; color: #721c24; }
</style>
</head>
<body>
<div class="container">
<h2>Admin Paneli Girişi</h2>
<?php if (!empty($hata)) echo '<div class="message error">'.$hata.'</div>'; ?>
<form method="post" action="">
<input type="text" name="kullaniciAdi" placeholder="Kullanıcı Adı" required />
<input type="password" name="sifre" placeholder="Şifre" required />
<button type="submit">Giriş Yap</button>
</form>
</div>
</body>
</html>
