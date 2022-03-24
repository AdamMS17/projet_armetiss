<?php
if (isset($modification))
    if ($modification = true) :
?>
<?
    else:
?>

<?
    endif;
?>


<form action="" method="post" id='modificationActivite' name="formModificationActivite">
    <fieldset class="m-5">
        <legend>Modification d'une activité</legend>
        <div class="mb-3">
            <label class="form-label" for="nom">Nom</label>
            <input class="form-control" type="text" id="nom" name="nom" <? if (isset($modification)) if ($modification = true) : ?> value="<?= $activite->getNom(); ?>" <?php endif; ?> required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="jour">Jour</label>
            <input class="form-control" type="text" id="jour" name="jour" list="jours" <? if (isset($modification)) if ($modification = true) : ?> value="<?= $activite->getJour(); ?>" <?php endif; ?> required />
            <datalist id="jours">
                <option> Lundi
                <option> Mardi
                <option> Mercredi
                <option> Jeudi
                <option> Vendredi
                <option> Samedi
                <option> Dimanche
            </datalist>
        </div>
        <div class="mb-3">
            <label class="form-label" for="heureDebut">Heure de début</label>
            <input class="form-control" type="time" id="heureDebut" name="heureDebut" min="07:00" max="21:00" <? if (isset($modification)) if ($modification = true) : ?> value="<?= $activite->getHeureDebut(); ?>" <?php endif; ?> required />
        </div>
        <div class="mb-3">
            <label class="form-label" for="heureFin">Heure de fin</label>
            <input class="form-control" type="time" id="heureFin" name="heureFin" min="07:00" max="21:00" <? if (isset($modification)) if ($modification = true) : ?> value="<?= $activite->getHeureFin(); ?>" <?php endif; ?> required />
        </div>

        <input class="btn btn-success" type="submit" name="modificationActivite">
    </fieldset>
</form>