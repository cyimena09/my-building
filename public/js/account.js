$(document).ready(function () {

    /* *****************************************************************************************
 * ------------------------------  METTRE A JOUR UN TICKET ----------------------------------
 *  *****************************************************************************************
 * */

    $('form#form-update-account').on('submit', function (e) {
        e.preventDefault();

        // On récupère les valeurs du formulaire
        const idUser = document.forms["form-update-account"]["idUser"].value;
        const firstname = document.forms["form-update-account"]["firstname"].value;
        const lastname = document.forms["form-update-account"]["lastname"].value;
        const email = document.forms["form-update-account"]["email"].value;
        const phone = document.forms["form-update-account"]["phone"].value;
        const gender = document.forms["form-update-account"]["gender"].value;

        // On vérifie que tous les champs ont été encodé
        if (idUser == "" ||
            firstname == "" ||
            lastname == "" ||
            email == "" ||
            phone == "" ||
            gender == "") {

            const message = "Veuillez encoder tous les champs !";
            const cssClass = 'bg-error';
            animateNotification(message, cssClass)
            return;
        }

        const data = {
            idUser: idUser,
            firstname: firstname,
            lastname: lastname,
            email: email,
            phone: phone,
            gender: gender
        }

        $.post('/auth/update', data, function () {

        })
            .done(function (e) {
                const message = "Mise à jour réussie !";
                const cssClass = 'bg-success';
                animateNotification(message, cssClass)
            })
            .fail(function (error) {
                console.log('error', error);
            });
    });

});