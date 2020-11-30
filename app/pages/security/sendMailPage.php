        <h1>Mot de passe oublié</h1>

    <p>Entrez votre adresse e-mail. Un lien vous permettant de recréer un mot de passe va vous être envoyé.</p>
    
    <form action="" method="POST">
        <?= $data['emailError']; ?>
        <label for='email'>Adresse e-mail : </label><input type="email" name="email" placeholder="ex : nom@domaine.fr" required/>
        <input type="submit" value="envoyer"/>
    </form>
