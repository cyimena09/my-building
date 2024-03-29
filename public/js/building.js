$(document).ready(function () {

    /* *****************************************************************************************
   * ------------------------------  METTRE A JOUR UN IMMEUBLE -----------------------------------
   *  *****************************************************************************************
   * */

    $('form#form-update-building').on('submit', function (e) {
        e.preventDefault();
        // On récupère les valeurs du formulaire
        const idBuilding = document.forms["form-update-building"]["idBuilding"].value;
        const name = document.forms["form-update-building"]["name"].value;
        // address
        const fkAddress = document.forms["form-update-building"]["fkAddress"].value;
        const street = document.forms["form-update-building"]["street"].value;
        const houseNumber = document.forms["form-update-building"]["houseNumber"].value;
        const zip = document.forms["form-update-building"]["zip"].value;
        const city = document.forms["form-update-building"]["city"].value;
        const country = document.forms["form-update-building"]["country"].value;

        // On vérifie que tous les champs ont été encodé
        if (name === "" ||
            fkAddress === "" ||
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
            idBuilding: idBuilding,
            name: name,
            fkAddress: fkAddress,
            street: street,
            houseNumber: houseNumber,
            zip: zip,
            city: city,
            country: country
        }

        $.post('/buildings/update', data, function () {

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