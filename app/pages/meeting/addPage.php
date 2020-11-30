<h1>Créer une réunion</h1>

<?= $error['fieldsError']; ?>

      <form action="#" method="post" id="addMeeting">
 
        <?= $error['lenghtError']; ?>
        <label for="object"><span>Objet <span class="required">*</span></span><input type="text"
            placeholder="Objet de la réunion" name="object" id="object" value="" /></label>
        <label for="location"><span>Lieu <span class="required">*</span></span><input type="text" placeholder="Lieux"
            name="location" id="location" value="" /></label>
        <?= $error['formatError']; ?>
        <label for="description"><span>Description <span class="required">*</span></span><textarea
            placeholder="Description" name="description" id="description"></textarea></label>

        <h2>Invités des formateurs *</h2>
        <hr>
        <?= $error['guestError']; ?>

        <input type="hidden" id="nbGuest" name="nbGuest" value="0" />

        <button type="button" onclick='addGuest(<?php echo json_encode($listinviter); ?>);' class="btnAjoutForm">Ajouter un Formateur</button>
        <div id="guest"></div>


        <h2>Ajouter des créneaux horaires *</h2>
        <hr>
        <?= $error['dateError']; ?>

        <input type="hidden" id="nbDate" name="nbDate" value="0"></input>

        <button type="button" onclick='addTimeSlot();' class="btnAddDate">Ajouter un Creneaux</button>
        <div id="timeSlot"></div>

        <label><span> </span><input type="submit" name="submit" value="Confirmer" /></label>
      </form>
    
	
