<h1 class="mb-3">Inscription d'un membre à une activité ou un évènement.</h1>


<div class="d-flex justify-content-center">

    <select class="form-select" aria-label="Sélection du membre.">
        <option selected>Sélection du membre.</option>
    </select>
    <select class="form-select" aria-label="Sélection de l'activité.">
        <option selected>Sélection de l'activité.</option>
    </select>
    <select class="form-select" aria-label="Sélection de l'évènement.">
        <option selected>Sélection de l'évènement.</option>
    </select>
    <input type="number" step="0.01">
    <input class="btn btn-success" type="submit" name="inscription">
</div>

<?php
if (!empty($membres)) {
    foreach ($membres as $membre) :
        echo $membre->getId().", ";
    endforeach;
}else echo 'rien';
if (!empty($activites)) {
    foreach ($activites as $activite) :
        echo $activite->getNom().", ";
    endforeach;
}else echo 'rien';
if (!empty($evenements)) {
    foreach ($evenements as $evenement) :
        echo $evenement->getNom().", ";
    endforeach;
}else echo 'rien';
?>