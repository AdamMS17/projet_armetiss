<form action="" method="post" id='ajoutPayement' name="formAjoutPayement">
    <fieldset class="m-5">
        <legend>Ajouter un nouveau payement pour une activite </legend>
        <div class="mb-3">
            <label class="form-label" for="nomPersonne">Selectionnez un eleve</label>
            <select name="eleve" id="eleve">
                <!--todo drop-down list avec les eleves -->
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="montantDuPayement">Montant du payement</label>
            <input class="form-control" type="number" id="montantDuPayement" name="montantDuPayement" required />
        </div>
                
        <input class="btn btn-success" type="submit" name="enregistrementAjoutPayement">
    </fieldset>
</form>