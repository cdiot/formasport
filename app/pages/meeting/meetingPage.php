<h1>Consulter une reunion</h1>

<article class="meeting">

	<?php foreach ($meetings as $meeting) : ?>
		
		<h2><?= $meeting->meeting_object ?></h2>
		<p>Organisé par <?= $meeting->instructor_firstname. ' ' . $meeting->instructor_lastname ?>
			à <?= $meeting->meeting_location ?>.</p>
		<p><?= $meeting->meeting_description ?></p>
		<?php if (!empty($availabilityDates)) : ?>
		<a href="index.php?controller=meetingcontrollers&task=presence&q=<?= $meeting->meeting_id ?>">Indiquer sa présence</a>
	    <?php endif; ?>
	<?php endforeach; ?>


	<h3>La liste des invités</h3>
	<ul>
		<?php foreach ($guests as $guest) : ?>
			<li class="guest-timeslot"><?= $guest->instructor_civility . ' ' . $guest->instructor_firstname . ' ' . $guest->instructor_lastname ?></li>
		<?php endforeach; ?>
	</ul>

	<h3>Les créneaux horaires disponible</h3>
	<ul>
		<?php foreach ($timeSlots as $timeSlot) : ?>
			<li class="guest-timeslot">le <?= $timeSlot->meeting_date ?> de <?= $timeSlot->meeting_start . 'h à ' . $timeSlot->meeting_end ?>h</li>
		<?php endforeach; ?>
	</ul>

	<h3>Liste des commentaires</h3>
      <div class="messages">

      </div>
      <div id="user-inputs">
      
        <form action="index.php?controller=messagecontrollers&task=post" method="POST">
        
        <textarea placeholder="Entrez votre message..." name="content" id="content"></textarea>

          <input type="submit" />
        </form>
	  </div>
	  <script src="public/js/comment.js"></script>

</article>
