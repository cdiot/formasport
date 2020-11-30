<h1>Consulter une reunion</h1>
<?= $error['emptyError']; ?>

<article class="meeting">

	<div class="disponibility-content">
		<h3>Indiquer ou modifié votre disponibilité *</h3>
		<?= $error['fieldsError']; ?>
		
		<form action="#" method="POST">

			<select name="timeSlot" class="menu" autofocus required>

			<?php foreach ($availabilityDates as $availabilityDate) : ?>
					<option value="<?= $availabilityDate->meeting_time_slot_id ?>">
						De <?= $availabilityDate->meeting_start . 'h à ' . $availabilityDate->meeting_end ?>h</option>
			<?php endforeach; ?>
			</select>

			<label for="presence"><span>Disponible</span><input type="checkbox" name="presence" value="1" /></label>

			<label for="presence"><span>Indisponible</span><input type="checkbox" name="presence" value="0" /></label>

			<label><span> </span><input type="submit" name="submit" value="Confirmer" /></label>

		</form>		
	</div>

</article>
