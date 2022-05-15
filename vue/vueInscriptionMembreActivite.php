<h1 class="mb-3">Inscription d'un membre à une activité.</h1>


<div class="d-flex justify-content-center">

    <select class="form-select" aria-label="Sélection du membre.">
        <option selected>Sélection du membre.</option>
        <?php
        if (!empty($membres)) {
            foreach ($membres as $membre) :
                echo "<option>" . $membre->getId() . "</option>";
            endforeach;
        } ?>
    </select>

    <select class="form-select" aria-label="Sélection de l'activité.">
        <option selected>Sélection de l'activité.</option>
        <?php
        if (!empty($activites)) {
            foreach ($activites as $activite) :
                echo "<option>" . $activite->getNom() . "</option>";
            endforeach;
        } ?>
    </select>

    <input class="btn btn-success" type="submit" name="inscriptionActivite">

</div>