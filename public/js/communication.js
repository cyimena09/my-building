$(document).ready(function () {

    /* *****************************************************************************************
 * ------------------------------  METTRE A JOUR UN TICKET ----------------------------------
 *  *****************************************************************************************
 * */

    $('form#form-update-communication').on('submit', function (e) {
        e.preventDefault();

        // On récupère les valeurs du formulaire
        const idCommunication = document.forms["form-update-communication"]["idCommunication"].value;
        const subject = document.forms["form-update-communication"]["subject"].value;
        const message = document.forms["form-update-communication"]["message"].value;

        // On vérifie que tous les champs ont été encodé
        if (idCommunication == "" || subject == "" || message == "") {
            const message = "Veuillez encoder tous les champs !";
            const cssClass = 'bg-error';
            animateNotification(message, cssClass)
            return;
        }

        const data = {
            idCommunication: idCommunication,
            subject: subject,
            message: message,
        }

        $.post('/communications/update', data, function () {

        })
            .done(function (e) {
                const message = "Mise à jour réussie !";
                const cssClass = 'bg-success';
                animateNotification(message, cssClass)
                setTimeout(
                    () => {
                        window.location = '/communications';
                    }, 2500);
            })
            .fail(function (error) {
                console.log('error', error);
            });
    });

});