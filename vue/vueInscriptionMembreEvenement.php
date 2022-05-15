<h1 class="mb-3">Inscription d'un membre à un évènement.</h1>


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

    <select class="form-select" aria-label="Sélection de l'évènement.">
        <option selected>Sélection de l'évènement.</option>
        <?php
        if (!empty($evenements)) {
            foreach ($evenements as $evenement) :
                echo "<option>" . $evenement->getNom() . "</option>";
            endforeach;
        } ?>
    </select>

    <input class="btn btn-success" type="submit" name="inscriptionEvenement">
    
</div>