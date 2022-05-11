<form action="" method="post" id='modifPayement' name="formModifPayement">
    <fieldset class="m-5">
        <legend>Modifier le payement d'un eleve pour une activite </legend>
        <div class="mb-3">
            <label class="form-label" for="nomPersonne">Selectionnez un eleve</label>
            <select name="eleve" id="eleve">
                <!--todo drop-down list avec les eleves -->
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="montantDuPayement">Nouveau montant total</label>
            <input class="form-control" type="number" id="montantDuPayement" name="montantDuPayement" required />
        </div>
                
        <input class="btn btn-success" type="submit" name="enregistrementModifPayement">
    </fieldset>
</form>