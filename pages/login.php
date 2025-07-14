<form action="traitement-login.php" method="post">
    <label>Email</label>
    <input type="email" name="email">
    <label>Mot de passe</label>
    <input type="password" name="mdp">
    <input type="submit" value="Se connecter">

    <?php if (isset($_GET["error"])) { ?>
        <h6>Email/mot de passe invalide(s)</h6>
    <?php } ?>
</form>

<h6>Pas encore de compte ? </h6>
<a href="modele1.php?p=signup">S'inscrire</a>
