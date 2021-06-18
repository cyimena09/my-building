$(document).ready(function () {

    /* *****************************************************************************************
 * ------------------------------  METTRE A JOUR UN COMPTE ----------------------------------
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
        if (idUser === "" ||
            firstname === "" ||
            lastname === "" ||
            email === "" ||
            phone === "" ||
            gender === "") {

            const message = "Veuillez encoder tous les champs !";
            const cssClass = 'bg-error';
            animateNotification(message, cssClass)
            return;
        }

        const reg = new RegExp('^[0-9]+$');

        if (!reg.test(phone)) {
            const message = "Numéro de téléphone non valide.";
            errorMessage(message);
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

    /* *****************************************************************************************
    * ------------------------------  METTRE A JOUR UNE ADRESSE ----------------------------------
    *  *****************************************************************************************
    * */

    $('form#form-update-address').on('submit', function (e) {
        e.preventDefault();

        // On récupère les valeurs du formulaire
        const idAddress = document.forms["form-update-address"]["idAddress"].value;
        const street = document.forms["form-update-address"]["street"].value;
        const houseNumber = document.forms["form-update-address"]["houseNumber"].value;
        const boxNumber = document.forms["form-update-address"]["boxNumber"].value;
        const zip = document.forms["form-update-address"]["zip"].value;
        const city = document.forms["form-update-address"]["city"].value;
        const country = document.forms["form-update-address"]["country"].value;

        // On vérifie que tous les champs ont été encodé
        if (idAddress === "" ||
            street === "" ||
            houseNumber === "" ||
            zip === "" ||
            city === "" ||
            country === "") {

            const message = "Veuillez encoder tous les champs !";
            const cssClass = 'bg-error';
            animateNotification(message, cssClass)
            return;
        }

        const data = {
            idAddress: idAddress,
            street: street,
            houseNumber: houseNumber,
            boxNumber: boxNumber,
            zip: zip,
            city: city,
            country: country
        }

        $.post('/address/update', data, function () {

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