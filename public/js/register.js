$(document).ready(function () {

    /* *****************************************************************************************
    * ------------------------------  CREER UTILISATEUR -----------------------------------
    *  *****************************************************************************************
    * */

    let containerInfo = document.getElementById('js-container-info');

    $('form#form-create-user').on('submit', function (e) {
        e.preventDefault();

        // On récupère les valeurs du formulaire
        let role = document.forms["form-create-user"]["role"].value;
        let firstName = document.forms["form-create-user"]["firstName"].value;
        let lastName = document.forms["form-create-user"]["lastName"].value;
        let phone = document.forms["form-create-user"]["phone"].value;
        let email = document.forms["form-create-user"]["email"].value;
        let password = document.forms["form-create-user"]["password"].value;
        let gender = document.forms["form-create-user"]["gender"].value;
        // address
        let street = document.forms["form-create-user"]["street"].value;
        let houseNumber = document.forms["form-create-user"]["houseNumber"].value;
        let boxNumber = document.forms["form-create-user"]["boxNumber"].value;
        let zip = document.forms["form-create-user"]["zip"].value;
        let city = document.forms["form-create-user"]["city"].value;
        let country = document.forms["form-create-user"]["country"].value;

        // On vérifie que tous les champs ont été encodé
        if (role == "" ||
            firstName == "" ||
            lastName == "" ||
            phone == "" ||
            email == "" ||
            password == "" ||
            gender == "" ||
            street == "" ||
            houseNumber == "" ||
            boxNumber == "" ||
            zip == "" ||
            city == "" ||
            country == "") {

            containerInfo.style.display = 'block';
            containerInfo.innerText = "Veuillez encoder tous les champs !";
            return;
        } else {
            // une fois que tous les champs ont été encodé on vérifie la cohérence des valeurs
            // 1. Le role doit figurer parmi : TENANT, OWNER ou TENANT_OWNER
            if (!(role == "TENANT" || role == "OWNER" || role == "TENANT_OWNER")) {
                containerInfo.style.display = 'block';
                containerInfo.innerText = "Le rôle n'est pas valide.";
                return;
            }
            // 2. le genre doit être "M" ou "F"
            if (!(gender == "M" || gender == "F" || gender == "O")) {
                formError.style.display = 'block';
                formError.innerText = "Le genre n'est pas valide.";
                return;
            }
        }

        let data = {
            role: role,
            firstName: firstName ,
            lastName: lastName ,
            phone: phone,
            email: email,
            password: password,
            gender: gender,
            street: street ,
            houseNumber: houseNumber ,
            boxNumber: boxNumber,
            zip: zip,
            city: city,
            country: country,
        }

        $.post('/auth/register', data, function () {

        })
            .done(function (e) {
                const successMessage =  encodeURI('Félicitation, votre compte a bien été créé !');
                window.location = '/auth/login?success-message=' + successMessage;
            })
            .fail(function (error) {
                console.log('error', error);
            });
    });

});