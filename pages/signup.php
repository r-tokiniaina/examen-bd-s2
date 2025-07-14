<form action="traitement-signup.php" method="post" enctype="multipart/form-data">
    <label>Nom</label>
    <input type="text" name="nom">
    <label>Date de naissance</label>
    <input type="date" name="date_de_naissance">
    <label>Genre</label>
    <select name="genre">
        <option value="M">Maculin</option>
        <option value="F">Feminin</option>
    </select>
    <label>Email</label>
    <input type="email" name="email">
    <label>Ville</label>
    <input type="text" name="ville">
    <label>Mot de passe</label>
    <input type="password" name="mdp">
    <label>Photo de profil</label>
    <input type="file" name="image_profil">

    <input type="submit" value="Se connecter">
</form>

<h6>Vous avez deja un compte ? </h6>
<a href="modele1.php?p=login">Se connecter</a>
