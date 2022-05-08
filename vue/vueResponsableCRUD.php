<section class="container py-5">
    <div class="row">
        <div class="col-lg-8 col-sm mb-5 mx-auto">
            <h1 class="fs-4 text-center lead text-primary">CRUD Responsable</h1>
        </div>
    </div>
    <div class="dropdown-divider border-warning"></div>
    <div class="row">
        <div class="col-md-6">
            <h5 class="fw-bold mb-0">Les Responsables</h5>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary btn-sm me-3 " data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="fas fa-folder-plus"></i> Nouveau Responsable
                </button>
                <a href="#" id="export" class="btn btn-success btn-sm"><i class="fas fa-table"></i> Exporter</a>
            </div>
        </div>
    </div>
    <div class="dropdown-divider border-warning"></div>
    <div class="row">
        <div class="table-responsive" id="orderTable">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Login</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Numéro de Téléphone</th>
                        <th scope="col">Date de Naissance</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < 100; $i++) : ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>
                                <a href="#" class="text-info me-2 infoBtn" title="Voir info"><i class="fas fa-info-circle"></i></a>
                                <a href="#" class="text-primary me-2 editBtn" title="Editer"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-danger me-2 deleteBtn" title="Supprimer"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>
                    <?php endfor; ?>

                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nouveau Responsable</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formResponsable">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="login" name="login">
                        <label for="login">Login</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="mdp" name="mdp">
                        <label for="login">Mot de passe</label>
                    </div>

                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nom" name="nom">
                                <label for="nom">Nom</label>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="prenom" name="prenom">
                                <label for="prenom">Prénom</label>
                            </div>
                        </div>

                    </div>

                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="datenaissance" name="datenaissance">
                            <label for="datenaissance">Date de naissance</label>
                        </div>
                    </div>



                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="rue" name="rue">
                                <label for="rue">Rue (Adresse)</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="numero" name="numero">
                                <label for="numero">Numéro (Adresse)</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="ville" name="ville">
                                <label for="ville">Ville (Adresse)</label>
                            </div>
                        </div>


                    </div>
                    
                    <!-- Meilleur : https://codepen.io/jackocnr/pen/EyPXed -->
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" id="numtel" name="numtel">
                            <label for="numtel">Numéro de Téléphone</label>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" id="email" name="email">
                            <label for="email">Email</label>
                        </div>
                    </div>





                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" name="ajouterResponsable" id="ajouterResponsable">Ajouter un responsable <i class="fas fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>