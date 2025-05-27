<?php
session_start();
if (!isset($_SESSION['giris']) || $_SESSION['giris'] !== true) {
    header('Location: admin.php');
    exit;
}

$dataFile = 'messages.json';
$mesajlar = [];

if (file_exists($dataFile)) {
    $json = file_get_contents($dataFile);
    $mesajlar = json_decode($json, true) ?: [];
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8" />
<title>Admin Paneli - Mesajlar</title>
<style>
body { font-family: Arial, sans-serif; background:#f2f2f2; padding:20px; }
.container { max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
h2 { margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; }
th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
th { background: #007bff; color: white; }
.logout { float: right; }
</style>
</head>
<body>
<div class="container">
<h2>Mesajlar
  <a href="admin.php?cikis=1" class="logout" style="color:#007bff; text-decoration:none; font-weight:bold;">Çıkış</a>
</h2>
<?php if (count($mesajlar) === 0): ?>
    <p>Henüz hiç mesaj gönderilmemiş.</p>
<?php else: ?>
<table>
<thead>
<tr>
<th>İsim (Gizli)</th>
<th>Mesaj</th>
<th>Tarih</th>
</tr>
</thead>
<tbody>
<?php foreach (array_reverse($mesajlar) as $m): ?>
<tr>
<td><?php echo htmlspecialchars($m['isim']); ?></td>
<td><?php echo nl2br(htmlspecialchars($m['mesaj'])); ?></td>
<td><?php echo htmlspecialchars($m['tarih']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
</div>
</body>
</html>
