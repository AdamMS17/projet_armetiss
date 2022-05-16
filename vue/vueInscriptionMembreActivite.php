<h1 class="mb-3">Inscription d'un membre à une activité.</h1>

<form action="" method="post" id='inscriptionActiviteForm' name="inscriptionActiviteForm">
    <div class="d-flex justify-content-center">

        <select required class="form-select" aria-label="Sélection du membre." name="personne">
            <option selected value="">Sélection du membre.</option>
            <?php

            if (!empty($personnes)) {
                foreach ($personnes as $personne) :
                    echo "<option>" . $personne->getId() . ": "
                        . $personne->getNom() .  " " . $personne->getPrenom() . "</option>";
                endforeach;
            } ?>
        </select>

        <select required class="form-select" aria-label="Sélection de l'activité." name="activite">
            <option selected value="">Sélection de l'activité.</option>
            <?php
            if (!empty($activites)) {
                foreach ($activites as $activite) :
                    echo "<option>" . $activite->getId() . ": " . $activite->getNom() . "</option>";
                endforeach;
            } ?>
        </select>

        <input required type="number" step="0.01" name="montant" min="0">
        <input class="btn btn-success" type="submit" name="inscriptionActivite">

    </div>
</form>