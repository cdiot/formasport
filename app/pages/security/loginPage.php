      <div>
        <img src="public/image/Formasport.png" alt="image représentant le logo - Formasport">
        <h1>Se connecter</h1>
        <?php if (isset($error)) : ?>
          <p class="guest-timeslot unavailable"><?= $error; ?></p>
        <?php endif ?>

        <form ACTION="#" METHOD="POST">

          <label for="lastname">Pseudo *</label><input TYPE="TEXT" SIZE="30" NAME="lastname" placeholder="Nom" autofocus required />
          <?= $data['lastnameError']; ?>

          <label for="password">Mots de passe *</label><input TYPE="password" SIZE="30" NAME="password" placeholder="Mots de passe" required />
          <?= $data['passwordError']; ?>
          
          <p><a href="index.php?controller=meetingcontrollers&task=findAll">Mot de passe oublié ?</a></p>

          <label><input type="submit" name="connect" value="Se Connecter" /></label>

        </form>
      </div>