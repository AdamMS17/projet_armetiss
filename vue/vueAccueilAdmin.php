<div class="m-5">
    <a href="?ajoutActivite=nouvelleActivite">
        Nouvelle activité
    </a>
</div>

<div class="m-5">
    <a href="?ajoutEvenement=nouvelEvenement">
        Nouvel évènement
    </a>
</div>

<!-- TABLEAU DES ACTIVITES -->
<div class="m-5">
    <table class="table table-striped">
        <thead>
            <th>Nom</th>
            <th>Jour</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
        </thead>
        <tbody>
            <?php
            if (!empty($activites)) {
                foreach ($activites as $activite) :
            ?>
                    <tr>
                        <td><?= $activite->getNom(); ?></td>
                        <td><?= $activite->getJour(); ?></td>
                        <td><?= $activite->getHeureDebut(); ?></td>
                        <td><?= $activite->getHeureFin(); ?></td>
                        <td>
                            <a href="?modActivite=<?= $idA = $activite->getId(); ?>">
                                modifier
                            </a>
                            <a href="?suppActivite=<?= $idA ?>">
                                supprimer
                            </a>
                        </td>
                    </tr>
            <?php
                endforeach;
            }
            ?>
        </tbody>
    </table>
</div>

<!-- TABLEAU DES EVENEMENTS -->
<div class="m-5">
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
                        <td>
                            <a href="?modEvenement=<?= $idE = $evenement->getId(); ?>">
                                modifier
                            </a>
                            <a href="?suppEvenement=<?= $idE ?>">
                                supprimer
                            </a>
                        </td>
                    </tr>
            <?php
                endforeach;
            }
            ?>
        </tbody>
    </table>
</div>

<div class="m-5">
    <a href="?ajoutPersonnel=ajoutPersonnel">
        Nouveau personnel
    </a>
</div>

<div class="m-5">
    <a href="?agenda=agenda">
        Consulter agenda
    </a>
</div>