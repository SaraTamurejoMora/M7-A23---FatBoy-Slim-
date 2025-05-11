<?php
declare(strict_types=1);

$pdo = new PDO('sqlite:' . __DIR__ . '/../Slim/data/biografias.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM biografias WHERE id = :id");
$stmt->execute([':id' => $id]);
$artist = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$artist) {
    http_response_code(404);
    echo "<h1>Artista no encontrado</h1><p><a href=\"index.php\">Volver al listado</a></p>";
    exit;
}

$nombre      = htmlspecialchars($artist['nombre_grupo']);
$imagen      = htmlspecialchars($artist['imagen']);
$anio        = (int)$artist['año_debut'];
$integrantes = nl2br(htmlspecialchars($artist['integrantes']));
$genero      = htmlspecialchars($artist['genero_musical']);
$bio         = nl2br(htmlspecialchars($artist['biografia']));
$discos      = nl2br(htmlspecialchars($artist['discos']));
$canciones   = nl2br(htmlspecialchars($artist['canciones_famosas']));
$premios     = nl2br(htmlspecialchars($artist['premios']));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $nombre ?></title>
  <link rel="icon" href="favicon.png" type="image/png">
  <link rel="stylesheet" href="css/styles.css">
  <style>
    /* Ajustes rápidos si hiciera falta */
    .detail { max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
    .detail-img { width:100%; height:auto; border-radius:8px; }
    .detail-info { background:#fff; padding:1.5rem; margin-top:1.5rem; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    .back-link { display:inline-block; margin-bottom:1rem; color:#007BFF; }
    .back-link:hover { text-decoration:underline; }
  </style>
</head>
<body>
  <header>
    <h1><?= $nombre ?></h1>
    <p><a href="/" class="back-link">&larr; Volver al listado</a></p>
  </header>
  <main class="detail">
    <img src="<?= $imagen ?>" alt="Foto de <?= $nombre ?>" class="detail-img">
    <div class="detail-info">
      <p><strong>Año de debut:</strong> <?= $anio ?></p>
      <p><strong>Integrantes:</strong><br><?= $integrantes ?></p>
      <p><strong>Género:</strong> <?= $genero ?></p>
      <h2>Biografía</h2><p><?= $bio ?></p>
      <h2>Discografía</h2><p><?= $discos ?></p>
      <h2>Canciones famosas</h2><p><?= $canciones ?></p>
      <h2>Premios</h2><p><?= $premios ?></p>
    </div>
  </main>
</body>
</html>
