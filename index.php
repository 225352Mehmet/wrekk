<?php
$basarili = '';
$hata = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isim = trim($_POST['isim'] ?? '');
    $mesaj = trim($_POST['mesaj'] ?? '');

    if ($isim && $mesaj) {
        // JSON dosyası ve mevcut mesajlar
        $dataFile = 'messages.json';
        $mesajlar = [];

        if (file_exists($dataFile)) {
            $json = file_get_contents($dataFile);
            $mesajlar = json_decode($json, true) ?: [];
        }

        // Yeni mesaj
        $yeniMesaj = [
            'isim' => htmlspecialchars($isim, ENT_QUOTES),
            'mesaj' => htmlspecialchars($mesaj, ENT_QUOTES),
            'tarih' => date('Y-m-d H:i:s'),
        ];

        // Mesaj ekle
        $mesajlar[] = $yeniMesaj;

        // Dosyaya yaz
        file_put_contents($dataFile, json_encode($mesajlar, JSON_PRETTY_PRINT));

        // Mail gönderimi
        $to = "mkoc78510@gmail.com";
        $subject = "Yeni Anonim Mesaj";
        $body = "İsim: {$yeniMesaj['isim']}\nMesaj:\n{$yeniMesaj['mesaj']}\nGönderilme Tarihi: {$yeniMesaj['tarih']}";
        $headers = "From: no-reply@wreek.co\r\nReply-To: no-reply@wreek.co\r\n";

        if (mail($to, $subject, $body, $headers)) {
            $basarili = "Mesajınız başarıyla gönderildi! İsim gizli tutulacaktır.";
        } else {
            $hata = "Mesaj kaydedildi fakat e-posta gönderilirken bir hata oluştu.";
        }
    } else {
        $hata = "Lütfen isim ve mesaj kısmını doldurunuz.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8" />
<title>Anonim Mesaj Gönder</title>
<style>
body { font-family: Arial, sans-serif; background:#f2f2f2; padding:20px; }
.container { max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
input, textarea { width: 100%; padding: 10px; margin: 10px 0; border-radius: 4px; border: 1px solid #ccc; }
button { padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; }
button:hover { background: #45a049; }
.message { margin: 10px 0; padding: 10px; border-radius: 4px; }
.success { background: #d4edda; color: #155724; }
.error { background: #f8d7da; color: #721c24; }
.info { font-size: 0.9em; color: #555; }
</style>
</head>
<body>
<div class="container">
<h2>Anonim Mesaj Gönder</h2>
<?php if ($basarili): ?>
  <div class="message success"><?= $basarili ?></div>
<?php endif; ?>
<?php if ($hata): ?>
  <div class="message error"><?= $hata ?></div>
<?php endif; ?>
<form method="post" action="">
<label>İsim (gizli kalacak)</label>
<input type="text" name="isim" maxlength="50" required placeholder="Adınız" />
<label>Mesajınız</label>
<textarea name="mesaj" rows="5" maxlength="500" required placeholder="Mesajınızı yazın"></textarea>
<button type="submit">Gönder</button>
<p class="info">İsminiz kimseyle paylaşılmayacaktır.</p>
</form>
</div>
</body>
</html>
