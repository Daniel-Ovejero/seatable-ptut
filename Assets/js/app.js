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

    $('#btnUpdCompany').on('click', () => {
        let formDetail = $('#formCompany');
        let banType = ['hidden', 'button', 'submit'];
        let banId = ['nameInput', 'firstnameInput'];

        for (let i = 0; i < formDetail[0].length; i++) {
            let item = formDetail[0].elements[i];
            if (!banType.includes(item.type) && !banId.includes(item.id)) {
                $('#' + item.id).prop('disabled', false);
            }
        }

        $('#btnSaveCompany').removeClass('d-none');
    });

    $('.formAdmission').submit((event) => {
        event.preventDefault();
        let target = event.target;

        $.ajax({
            url: '../Actions/action-admission-update.php',
            type: 'POST',
            data: {
                'rowId' : target.row_id.value,
                'avis' : target.avis.value,
                'commentaire' : target.commentaire.value
            },
            success: () => {
                target.submitAdmis.hidden = true;
                target.avis.disabled = true
                target.commentaire.disabled = true;
            }
        });
    });

    $('.select-prof').change((event) => {
        let form = event.target.form;

        $.ajax({
            url: '../Actions/action-admission-update-prof.php',
            type: 'POST',
            dataType: 'json',
            data: {
                'rowId' : form.row_id.value,
                'prof' : form.profAdmiss.value,
                'lastProf' : form.prof_id.value
            }
        });
    });

    $('#switchAdmission').change((event) => {
        let activeAdmis = $('#switchAdmission').is(':checked');

        $('.select-prof').prop('disabled', activeAdmis);

        $.ajax({
            url: '../Actions/action-admission-active.php',
            type: 'POST',
            data: {
                'active' : activeAdmis
            },
            success: (data) => {
                if (data) {
                    let traites = JSON.parse(data);
                    $('.submit-admiss').each((key, value) => {
                        if (!traites.includes(value.id)) {
                            $('#'+value.id).prop('hidden', !activeAdmis);
                        }
                    });
                }
            }
        });
    });

});