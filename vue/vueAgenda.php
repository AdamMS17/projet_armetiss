<!-- TABLEAU DES SEANCES -->
<div class="m-5">
    <h1>Prochaines séances</h1>
    <table class="table table-striped">
        <thead>
            <th>Nom</th>
            <th>Jour</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Date</th>
        </thead>
        <tbody>
            <?php
            if (!empty($activites) && !empty($seances)) :
                foreach ($activites as $key => $activite) :
                    foreach ($seances[$key] as $seance) :
            ?>
                        <tr>
                            <td><?= $activite->getNom(); ?></td>
                            <td><?= $activite->getJour(); ?></td>
                            <td><?= $activite->getHeureDebut(); ?></td>
                            <td><?= $activite->getHeureFin(); ?></td>
                            <td><?= date("d-m-y", strtotime($seance->getDate_Seance())); ?></td>
                        </tr>
            <?php
                    endforeach;
                endforeach;
            endif;
            ?>
        </tbody>
    </table>
</div>


<!-- TABLEAU DES EVENEMENTS -->
<div class="m-5">
    <h1>Prochains évènements</h1>
    <table class="table table-striped">
        <thead>
            <th>Nom</th>
            <th>Date</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Coût</th>
        </thead>
        <tbody>
            <?php
            if (!empty($evenements)) {
                foreach ($evenements as $evenement) :
            ?>
                    <tr>
                        <td><?= $evenement->getNom(); ?></td>
                        <td><?= $evenement->getDate(); ?></td>
                        <td><?= $evenement->getHeureDebut(); ?></td>
                        <td><?= $evenement->getHeureFin(); ?></td>
                        <td><?= $evenement->getCout(); ?>€</td>
                    </tr>
            <?php
                endforeach;
            }
            ?>
        </tbody>
    </table>
</div>