$(document).ready(function () {

    /* *****************************************************************************************
   * ------------------------------  AJOUTER UN APPARTEMENT -----------------------------------
   *  *****************************************************************************************
   * */

    $('form#form-create-apartment').on('submit', function (e) {
        e.preventDefault();

        // On récupère les valeurs du formulaire
        const name = document.forms["form-create-apartment"]["name"].value;
        const idBuilding = document.forms["form-create-apartment"]["idBuilding"].value;

        // On vérifie que tous les champs ont été encodé
        if (name == "" || idBuilding == "") {
            const message = "Veuillez encoder tous les champs !";
            const cssClass = 'bg-error';
            animateNotification(message, cssClass)
            return;
        }

        const data = {
            name: name,
            idBuilding: idBuilding,
        }

        $.post('/apartments/create', data, function () {

        })
            .done(function (e) {
                const message = "L'apartement a été créé !";
                const cssClass = 'bg-success';
                animateNotification(message, cssClass);
                document.forms["form-create-apartment"]["name"].value = "";
            })
            .fail(function (error) {
                const message = "Une erreur est survenue, l'apartement n'a pas pu être créé.";
                const cssClass = 'bg-error';
                animateNotification(message, cssClass)
                console.log('error', error);
            });
    });

    /* *****************************************************************************************
  * ------------------------------  METTRE A JOUR UN APPARTEMENT -----------------------------------
  *  *****************************************************************************************
  * */

    $('form#form-update-apartment').on('submit', function (e) {
        e.preventDefault();

        // On récupère les valeurs du formulaire
        const idApartment = document.forms["form-update-apartment"]["idApartment"].value;
        const name = document.forms["form-update-apartment"]["name"].value;

        // On vérifie que tous les champs ont été encodé
        if (idApartment == "" || name == "") {
            const message = "Veuillez encoder tous les champs !";
            const cssClass = 'bg-error';
            animateNotification(message, cssClass)
            return;
        }

        const data = {
            idApartment: idApartment,
            name: name,
        }

        $.post('/apartments/update', data, function () {

        })
            .done(function (e) {
                console.log(e);
                const message = "L'apartement a été mis à jour !";
                const cssClass = 'bg-success';
                animateNotification(message, cssClass)
            })
            .fail(function (error) {
                console.log('error', error);
            });
    });

});