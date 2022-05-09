<form action="" method="post" id='ajoutPayement' name="formAjoutPayement">
    <fieldset class="m-5">
        <legend>Ajouter un nouveau payement pour une activite </legend>
        <div class="mb-3">
            <label class="form-label" for="nomPersonne">Selectionnez un eleve</label>
            <input class="form-control" type="text" id="idEleve" name="idEleve" required /> 
        </div>
        <div class="mb-3">
            <label class="form-label" for="activite">Selectionnez l'activite </label>
            <select name="activite" id="activite">
                <!--todo drop-down list avec toutes les activites -->
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="montantDuPayement">Montant du payement</label>
            <input class="form-control" type="text" id="montantDuPayement" name="montantDuPayement" required />
        </div>
                

        <input class="btn btn-success" type="submit" name="enregistrementActivite">
    </fieldset>
</form>