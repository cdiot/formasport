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
    <nav>
      <ul class="navbar-links">
        <li><a href="index.php?controller=meetingcontrollers&task=findAll">Accueil</a></li>
        <li><a href="index.php?controller=meetingcontrollers&task=add">Réunion</a></li>
        <li><a href="index.php?controller=securitycontrollers&task=logout">Déconnexion</a></li>
      </ul>
    </nav>
  </header>

  <main class="column">

    <aside class="row sidebar">
      <p class="sidebar-user">
        <?php foreach ($profil as $user) : ?>
          <span>Bonjour, <?= $user->instructor_civility . ' ' . $user->instructor_firstname . ' ' . $user->instructor_lastname ?></span>
          <span><?= $user->instructor_email ?></span>
          <span><?= $user->instructor_libelle ?></span>
        <?php endforeach; ?>
      </p>

      <nav class="row sidebar-links">
        <ul>
          <li><a href="index.php?controller=meetingcontrollers&task=findAll">Toutes les réunions</a></li>
          <li><a href="index.php?controller=meetingcontrollers&task=findWithOrganisator">Vos réunions</a></li>
          <li><a href="index.php?controller=meetingcontrollers&task=findWithInvite">Réunion invité</a></li>
        </ul>
      </nav>
    </aside>

    <section class="row">
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