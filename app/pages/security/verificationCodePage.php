    <?php if (isset($_SESSION['recoveryEmail'])) : ?>
    <h1>Récuperation du mots de passe pour <?= $_SESSION['recoveryEmail']; ?></h1>

<form action="" method="POST">
  <?= $data['codeError']; ?>
      <label for="code">Code de verification : </label>
      <input type="text" name="code">
      <br>
        <input type="submit" value="Vérifier le code" />
    </form>
    <?php else: ?>
        <?php Http::redirect('securitycontrollers', 'login'); ?>
    <?php endif; ?>
