<form action="" method="post" id='modificationEvenement' name="formModificationEvenement">
    <fieldset class="m-5">
        <legend>Modification d'un évènement</legend>
        <div class="mb-3">
            <label class="form-label" for="nom">Nom</label>
            <input class="form-control" type="text" id="nom" name="nom" value="<?= $evenement->getNom(); ?>" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="date">Date</label>
            <input class="form-control" type="date" id="date" name="date" value="<?= $evenement->getDate(); ?>" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="heureDebut">Heure de début</label>
            <input class="form-control" type="time" id="heureDebut" name="heureDebut" min="00:00" max="23:59" value="<?= $evenement->getHeureDebut(); ?>" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="heureFin">Heure de fin</label>
            <input class="form-control" type="time" id="heureFin" name="heureFin" min="00:00" max="23:59" value="<?= $evenement->getHeureFin(); ?>" required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="cout">Coût</label>
            <input class="form-control" type="number" step="0.01" id="cout" name="cout" value="<?= $evenement->getCout(); ?>" required />
        </div>
        <input class="btn btn-success" type="submit" name="modificationEvenement">
    </fieldset>
</form>