$(document).ready(() => {

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

});