$(document).ready(function () {

    /* *****************************************************************************************
      * ----------------------  METTRE A JOUR LE STATUT D'UN TICKET  ---------------------------
      *  *****************************************************************************************
      * */

    const selectTAG = document.getElementsByTagName("select");
    const containerInfo = document.getElementById('js-quick-info');

    for (let i = 0; i < selectTAG.length; ++i) {
        // on ajoute un event listener sur tous les selects
        // et lorsqu'un changement de statut sera détecté on fera une mise à jour du statut dans la Db
        selectTAG[i].addEventListener('change', function (e) {
            // récupération des valeurs du formulaire
            const idTicket = selectTAG[i].id;
            const status = selectTAG[i].value;
            const data = {
                idTicket: idTicket,
                status: status
            }

            $.post('/ticket/updateStatus/', data, function () {

            })
                .done(function (result) {
                    // animation de la notification en bas à droite
                    containerInfo.innerText = "Le status a été mis à jour.";
                    containerInfo.classList.add("bg-success");
                    containerInfo.style.display = 'block';
                    // lorsque la notification apparait
                    setTimeout(
                        () => {
                            containerInfo.style.opacity = '1';
                            containerInfo.style.bottom = '0';
                        });

                    // lorsqu'elle disparait
                    setTimeout(
                        () => {
                            containerInfo.style.opacity = '0';
                            containerInfo.style.bottom = '-20px';
                        }, 2000);

                    // lorsqu'elle disparait (lanimation dure 4 secondes donc le 'display: none' doit attendre au moins ce délai
                    setTimeout(
                        () => {
                            containerInfo.style.display = 'none';
                        }, 2600);
                })
                .fail(function (error) {
                    console.log('error', error);
                });
        });
    }

});