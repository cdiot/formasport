

<h1>Aperçu des réunions</h1>
<?php if (isset($error)): ?>
<p class="guest-timeslot unavailable"><?php echo $error; ?></p>
<?php endif ?>
<?php foreach ($meetings as $meeting) : ?>
  <article class="meetings">
    <h2><?= $meeting->meeting_object ?></h2>
    <p>Organisé par <?= $meeting->instructor_civility . ' ' . $meeting->instructor_firstname . ' ' . $meeting->instructor_lastname ?>
      à <?= $meeting->meeting_location ?>.</p>
    <p><?= $meeting->meeting_description ?></p>
    <a href="index.php?controller=meetingcontrollers&task=find&q=<?= $meeting->meeting_id ?>">Voir les détails</a>
  </article>
  
<?php endforeach; ?>
</article>
