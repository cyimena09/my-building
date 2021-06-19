$(document).ready(function () {

    /* *****************************************************************************************
      * ----------------------  METTRE A JOUR LE STATUT D'UN TICKET  ---------------------------
      *  *****************************************************************************************
      * */

    const selectTAG = document.getElementsByTagName("select");

    for (let i = 0; i < selectTAG.length; ++i) {
        // on ajoute un event listener sur tous les selects
        // et lorsqu'un changement de statut sera détecté on fera une mise à jour du statut dans la Db
        selectTAG[i].addEventListener('change', function (e) {
            // récupération des valeurs du formulaire
            const idTicket = selectTAG[i].id;
            const idStatus = selectTAG[i].value;
            const data = {
                idTicket: idTicket,
                idStatus: idStatus
            }

            $.post('/tickets/updateStatus/', data, function () {

            })
                .done(function (result) {
                    const message = "Le status a été mis à jour.";
                    const cssClass = 'bg-success';
                    animateNotification(message, cssClass)
                })
                .fail(function (error) {
                    console.log('error', error);
                    const message = "Le ticket n'a pas pu être mis à jour";
                    errorMessage(message);
                });
        });
    }

    /* *****************************************************************************************
 * ------------------------------  METTRE A JOUR UN TICKET ----------------------------------
 *  *****************************************************************************************
 * */

    $('form#form-update-ticket').on('submit', function (e) {
        e.preventDefault();

        // On récupère les valeurs du formulaire
        const idTicket = document.forms["form-update-ticket"]["idTicket"].value;
        const subject = document.forms["form-update-ticket"]["subject"].value;
        const description = document.forms["form-update-ticket"]["description"].value;

        // On vérifie que tous les champs ont été encodé
        if (subject === "" || description === "") {
            const message = "Veuillez encoder tous les champs !";
            const cssClass = 'bg-error';
            animateNotification(message, cssClass)
            return;
        }

        const data = {
            idTicket: idTicket,
            subject: subject,
            description: description,
        }

        $.post('/tickets/update', data, function () {

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