$(function() {
    $('table').DataTable();

    //creer un responsable
    $('#ajouterResponsable').on('click',function (e) {
        let formResponsable = $('#formResponsable')
        if (formResponsable[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: 'controleur/process.php',
                type: 'post',
                data: formResponsable.serialize() + '&action=create',
                success: function (response) {
                    console.log(response)

                    $('#createModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Responsable ajouté avec succès !',
                      })
                    formResponsable[0].reset();
                    
                }
            })
        }
    })

    //recup les responsables 
    getResponsables()
    function getResponsables() {
        $.ajax({
            url : 'controleur/process.php',
            type : 'post',
            data : { action: 'fetch'},
            success : function (response) {
                $('#responsableTable').html(response);
                $('table').DataTable(); 
            }
        })
    }


} )