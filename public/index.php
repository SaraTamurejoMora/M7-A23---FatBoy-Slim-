<?php
require __DIR__ . '/../vendor/autoload.php';
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface      as Response;
use Slim\Factory\AppFactory;

$app = AppFactory::create();
$app->addRoutingMiddleware();

$pdo = new PDO('sqlite:' . __DIR__ . '/../Slim/data/biografias.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$app->get('/', function (Request $req, Response $res) use ($pdo) {
    $stmt = $pdo->query("SELECT * FROM biografias");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '<!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Biografías Musicales</title>
        <link rel="icon" href="favicon.png" type="image/png">
      <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
      <header>
        <h1>Biografías de Artistas y Grupos</h1>
      </header>
      <main class="container">
    ';

    foreach ($rows as $row) {
        $id = (int)$row['id'];
        $nombre = htmlspecialchars($row['nombre_grupo']);
        $bio = nl2br(htmlspecialchars($row['biografia']));
        $img = htmlspecialchars($row['imagen']);
        $año = (int)$row['año_debut'];

        $html .= "
        <a href=\"artist.php?id={$id}\" class=\"card-link\">
            <article class=\"card\">
            <img src=\"{$img}\" alt=\"Foto de {$nombre}\">
            <div class=\"card-body\">
                <h2>{$nombre}</h2>
                <p class=\"year\">Debut: {$año}</p>
                <p class=\"bio\">{$bio}</p>
            </div>
            </article>
        </a>
        ";
    }

    $html .= '
      </main>
    </body>
    </html>
    ';

    $res->getBody()->write($html);
    return $res->withHeader('Content-Type','text/html');
});

$app->run();
