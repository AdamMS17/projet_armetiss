<h1 class="mb-3">Inscription d'un membre à un évènement.</h1>

<form action="" method="post" id='inscriptionEvenementForm' name="inscriptionEvenementForm">
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

        <select required class="form-select" aria-label="Sélection de l'évènement." name="evenement">
            <option selected value="">Sélection de l'évènement.</option>
            <?php
            if (!empty($evenements)) {
                foreach ($evenements as $evenement) :
                    echo "<option>" . $evenement->getId() . ": " . $evenement->getNom() . "</option>";
                endforeach;
            } ?>
        </select>

        <input class="btn btn-success" type="submit" name="inscriptionEvenement">

    </div>
</form>