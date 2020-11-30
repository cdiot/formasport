    <?php if (isset($_SESSION['recoveryEmail'], $_SESSION['token'])) : ?>
    <h1>Récuperation du mots de passe pour <?= $_SESSION['recoveryEmail']; ?></h1>

<form action="" method="POST">

      <label for="password">Nouveau mot de passe : </label>
      <input type="password" name="password" id="newPassword">
      <?= $data['passwordError']; ?>
      <br>
      <label for="confirmPassword">Vérification du nouveau mot de passe : </label>
      <input type="password" name="confirmPassword" id="newPasswordVerification">
      <?= $data['confirmPasswordError']; ?>
      
      <br>
        <input type="submit" value="Changer votre mot de passe" />
</form>
    <?php else: ?>
        <?php Http::redirect('securitycontrollers', 'login'); ?>
    <?php endif; ?>