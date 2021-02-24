$(document).ready(() => {

    $('[data-toggle="tooltip"]').tooltip();

    $('#btnUpdInfo').on('click', () => {
        let formDetail = $('#formInfo');
        let banType = ['hidden', 'button', 'submit'];
        let banId = ['nameInput', 'firstnameInput'];

        for (let i = 0; i < formDetail[0].length; i++) {
            let item = formDetail[0].elements[i];
            if (!banType.includes(item.type) && !banId.includes(item.id)) {
                $('#' + item.id).prop('disabled', false);
            }
        }

        $('#btnSaveInfo').removeClass('d-none');
    });

    $('.formAdmission').submit((event) => {
        event.preventDefault();
        let target = event.target;

        $.ajax({
            url: '../Actions/action-admission-update.php',
            type: 'POST',
            dataType: 'json',
            data: {
                'rowId' : target.row_id.value,
                'avis' : target.avis.value,
                'commentaire' : target.commentaire.value
            }
        });
    });

});