<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="public/css/style.css" />
  <title><?= $pageTitle ?> - FormaSPORT</title>
</head>

<body class="container">
  <header class="column navbar">
    <p class="navbar-logo">FormaSPORT</p>
  </header>

  <main>

    <section class="log">
      <?= $pageContent ?>
    </section>

  </main>

  <footer class="column">Les marques et droit d'auteur sont la propriété de leurs propriétaires respectifs | © 20xx Tous
    droits réservés |
    DIOT Christopher
  </footer>
  <script src="public/js/addGuest.js"></script>
  <script src="public/js/addTimeSlot.js"></script>
</body>

</html>