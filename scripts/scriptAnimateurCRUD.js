$(function() {
    $('table').DataTable();

    //creer un animateur
    $('#ajouterAnimateur').on('click',function (e) {
        let formAnimateur = $('#formAnimateur')
        if (formAnimateur[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: 'controleur/process.php',
                type: 'post',
                data: formAnimateur.serialize() + '&action=create',
                success: function (response) {
                    console.log(response)

                    $('#createModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Animateur ajouté avec succès !',
                      })
                    formAnimateur[0].reset();
                    
                }
            })
        }
    })

    //recup les animateurs 
    getAnimateurs()
    function getAnimateurs() {
        $.ajax({
            url : 'controleur/process.php',
            type : 'post',
            data : { action: 'fetch'},
            success : function (response) {
                $('#animateurTable').html(response);
                $('table').DataTable();
            }
        })
    }


} )