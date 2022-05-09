$(function() {
    $('table').DataTable();

    //creer un membre
    $('#ajouterMembre').on('click',function (e) {
        let formMembre = $('#formMembre')
        if (formMembre[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: 'controleur/process.php',
                type: 'post',
                data: formMembre.serialize() + '&action=create',
                success: function (response) {
                    console.log(response)

                    $('#createModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Membre ajouté avec succès !',
                      })
                    formMembre[0].reset();
                    
                }
            })
        }
    })

    //recup les membres 
    getMembre()
    function getMembre() {
        $.ajax({
            url : 'controleur/process.php',
            type : 'post',
            data : { action: 'fetch'},
            success : function (response) {
                $('#membreTable').html(response);
                $('table').DataTable();
            }
        })
    }


} )