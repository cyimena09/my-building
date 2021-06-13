$(document).ready(function () {

    /* *****************************************************************************************
      * -----------------------  AFFICHE LISTE DES APPARTEMENTS --------------------------------
      *  *****************************************************************************************
      * */

        const select = document.getElementById('fkBuilding'); // element declencheur
    const container = document.getElementById('js-result'); // container du resultat


        select.addEventListener('click', function(e) {
            $('#dropdown-apartment').remove(); // on retire l'ancienne liste si elle existe
            container.style.visibility = 'visible';

            const idBuilding = select.value; // récupération de l'id de l'immeuble

            const data = {
                idBuilding: idBuilding
            }

            $.post('/apartment/dropdown/', data, function () {

            })
                .done(function (result) {
                    if (result) {
                        $('#js-result').append(result) // on ajoute l'animal dans le container
                    }
                })
                .fail(function (error) {
                    console.log('error', error);
                });
        });


    /* *****************************************************************************************
    * ------------------------------  CREER UTILISATEUR -----------------------------------
    *  *****************************************************************************************
    * */

    const containerInfo = document.getElementById('js-container-info');

    $('form#form-create-user').on('submit', function (e) {
        e.preventDefault();

        // On récupère les valeurs du formulaire
        const role = document.forms["form-create-user"]["role"].value;
        const firstName = document.forms["form-create-user"]["firstName"].value;
        const lastName = document.forms["form-create-user"]["lastName"].value;
        const phone = document.forms["form-create-user"]["phone"].value;
        const email = document.forms["form-create-user"]["email"].value;
        const password = document.forms["form-create-user"]["password"].value;
        const gender = document.forms["form-create-user"]["gender"].value;

        // si on ne peut pas récupérer le fkApartment c'est qu'aucun immeuble n'a été sélectionné
        let fkApartment;
        try {
            fkApartment = document.forms["form-create-user"]["fkApartment"].value;
        } catch (error) {
            containerInfo.style.display = 'block';
            containerInfo.innerText = "Veuillez choisir une résidence.";
            return;
        }

        // On vérifie que tous les champs ont été encodé
        if (role == "" ||
            firstName == "" ||
            lastName == "" ||
            phone == "" ||
            email == "" ||
            password == "" ||
            gender == "" ||
            fkApartment == "") {

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

        const data = {
            firstName: firstName ,
            lastName: lastName ,
            email: email,
            phone: phone,
            gender: gender,
            role: role,
            fkApartment: fkApartment,
            password: password
        }

        $.post('/auth/register', data, function () {

        })
            .done(function (e) {
                const successMessage =  encodeURI('Félicitation, votre compte a bien été créé !');
                window.location = '/auth/loginView?success-message=' + successMessage;
            })
            .fail(function (error) {
                console.log('error', error);
            });
    });

});