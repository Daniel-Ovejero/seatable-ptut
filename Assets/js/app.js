$(document).ready(() => {

    $('#btnUpdInfo').on('click', () => {
        $('#mailInput').prop('disabled', false);
        $('#phoneInput').prop('disabled', false);
        $('#addressInput').prop('disabled', false);
        $('#townInput').prop('disabled', false);
        $('#cpInput').prop('disabled', false);

        $('#btnSaveInfo').removeClass('d-none');
    });

});