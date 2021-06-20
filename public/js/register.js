$(document).ready(function () {
    const LOCATAIRE = 'Locataire';
    const PROPRIETAIRE = 'Propriétaire';
    const PROPRIETAIRE_RESIDENT = 'Propriétaire Résident';

    let globalRole; // role de l'utilisateur
    let globalRoleText;
    let apartmentsList = []; // liste des appartements et des batiments sélectionné par l'utilisateur

    /* *****************************************************************************************
    *  AFFICHE LE SOUS FORMULAIRE DE SELECTION DU BUILDING EN FONCTION DU ROLE DE L'UTILISATEUR
    *  *****************************************************************************************
    * */

    let radiosContainer = document.getElementById('radios');
    let radios = document.getElementsByName("role");
    // écoute le choix du role de l'utilisateur dans le formulaire pour lui afficher le/les sous formulaire(s) adéquat
    for (let i = 0; i < radios.length; ++i) {
        radios[i].addEventListener('change', function () {
            globalRoleText = radiosContainer.getElementsByTagName('label')[i].innerText;
            apartmentsList = [];
            $('#js-section-result').empty();
            globalRole = radios[i].value;
            $.get('/auth/sectionByRoleView/' + globalRole, function () {

            })
                .done(function (result) {
                    // result contient le formulaire qui permet d'ajouter soit un locataire, un propriétaire
                    // ou un proprietaire_resident qui est une combinaison du formulaire locataire et propriétaire
                    if (result) {
                        $('#js-section-result').append(result);
                        formManager(); // on active le code qui permet de générer dynamiquement les appartements en fonction de l'immeuble choisi
                    }
                })
                .fail(function (error) {
                    console.log('error', error);
                });
        });
    }

    /**
     * S'occupe d'exécuter l'initalisation de formulaire sous certaines conditions.
     * Cette fonction est nécessaire car lorsque l'on est propriétaire résident il faut exécuter deux formulaires
     */
    function formManager() {
        if (globalRoleText === LOCATAIRE) {
            initForm(LOCATAIRE);
        } else if (globalRoleText === PROPRIETAIRE) {
            initForm(PROPRIETAIRE);
        } else if (globalRoleText === PROPRIETAIRE_RESIDENT) {
            initForm(LOCATAIRE);
            initForm(PROPRIETAIRE);
        }
    }

    /**
     * Initialise le formulaire adéquat en fonction du role entré en paramètre
     * @param role
     */
    function initForm(role) {
        let fkBuilding;
        let jsResult;

        if (role === LOCATAIRE) {
            jsResult = 'js-result-rented'; // id du container dans lequel est affiché les appartements
            fkBuilding = 'fkBuildingRented'; // id de la balise select qui contient la liste des immeubles
        } else if (role === PROPRIETAIRE) {
            jsResult = 'js-result-owned';
            fkBuilding = 'fkBuildingOwned';
        }

        const resultRented = document.getElementById(jsResult);
        let selectFkBuildingRented = document.getElementById(fkBuilding);

        // on ajoute un listener sur le choix de l'immeuble
        selectFkBuildingRented.addEventListener('change', function () {
            // on reset s'il y avait déjà du contenu, pour éviter les doublons
            if (resultRented.children.length > 0) {
                let child = resultRented.children[0];
                child.remove();
            }

            // on reset l'eventlistener du bouton pour éviter une double detection
            const button = document.getElementById('js-add-btn');
            button.removeEventListener("click", addOnList);

            resultRented.style.visibility = 'visible';
            const globalIdBuildingRented = selectFkBuildingRented.value; // récupération de l'id de l'immeuble pour récupérer ses appartements
            const data = {
                idBuilding: globalIdBuildingRented
            }

            $.post('/apartments/dropdown/', data, function () {

            })
                .done(function (result) {
                    if (result) {
                        $('#' + jsResult).append(result) // on ajoute le menu des appartements (en fonction de le l'immeuble.

                        // un propriétaire peut avoir plusieurs appartements
                        // donc on lui ajoute un bouton qui permet d'ajouter dans une liste plusieurs appartement
                        if (role === PROPRIETAIRE) {
                            addButton();
                            // les id servent a différencier le formulaire.
                            // Est ce qu'on ajoute un appart en location ou en propriété
                            let resultOwned = document.getElementById(jsResult);
                            let dropDownApartment = resultOwned.children[0].getElementsByTagName('select')[0]
                            dropDownApartment.id = 'dropdown-apartment-owned';
                        }
                    }
                })
                .fail(function (error) {
                    console.log('error', error);
                });
        });
    }

    /* *****************************************************************************************
    * -----------------------  AJOUTE UN APPARTEMENT A LA LISTE  ---------------------------
    *  *****************************************************************************************
    * */

    function addButton() {
        const addButton = document.getElementById('js-add-btn');
        addButton.addEventListener('click', addOnList);
    }

    function addOnList() {
        const containerOwned = document.getElementById('js-result-owned');
        const idBuilding = document.getElementById('fkBuildingOwned').value // on récupère le building
        const nameBuilding = $("#fkBuildingOwned option:selected").text();
        const idApart = containerOwned.children[0].getElementsByTagName('select')[0].value; // on récupère l'appartement
        const nameApart = $("#dropdown-apartment-owned option:selected").text();

        // on vérifie si les valeurs ne sont pas nulles
        if (idApart === "" || idBuilding === "") {
            const message = "Aucun appartement n'a été sélectionné."
            errorMessage(message);
            return;
        }

        // on vérifie si l'appartement n'est pas déjà dans la liste
        for (let i = 0; i < apartmentsList.length; i++) {
            if (apartmentsList[i]['idApartment'] === idApart) {
                const message = "L'appartement est déjà dans la liste."
                errorMessage(message);
                return;
            }
        }

        let data = {
            isOwnerRequest: 1, // booléen qui indique si on ajoute une propriété ou une location (ici propriété)
            idBuilding: idBuilding,
            idApartment: idApart
        }
        apartmentsList.push(data);

        let div = '      <div class="container">' +
            '                <div class="container-icon">' +
            '                    <i class="fas fa-building"></i>' +
            '                </div>' +
            '                <div class="container-text">' +
            '                    <p class="building"> <span>Immeuble :</span><span style="font-weight: bold">' + nameBuilding + '</span></p>' +
            '                    <p class="apartment"> <span>Appartement :</span><span style="font-weight: bold">' + nameApart + '</span></p>' +
            '                </div>' +
            '            </div>'

        $('#js-ul').append(div);
    }

    /* *****************************************************************************************
    * ------------------------------  CREER UTILISATEUR -----------------------------------
    *  *****************************************************************************************
    * */

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

        // Address
        const street = document.forms["form-create-user"]["street"].value;
        const houseNumber = document.forms["form-create-user"]["houseNumber"].value;
        const boxNumber = document.forms["form-create-user"]["boxNumber"].value;
        const zip = document.forms["form-create-user"]["zip"].value;
        const city = document.forms["form-create-user"]["city"].value;
        const country = document.forms["form-create-user"]["country"].value;

        // On vérifie que tous les champs ont été encodé
        if (firstName === "" ||
            lastName === "" ||
            email === "" ||
            phone === "" ||
            gender === "" ||
            password === "" ||
            role === "" ||
            // address
            street === "" ||
            houseNumber === "" ||
            zip === "" ||
            city === "" ||
            country === "") {

            const message = "Veuillez encoder tous les champs !";
            errorMessage(message);
            return;
        }

        const reg = new RegExp('^[0-9]+$');

        if (!reg.test(phone)) {
            const message = "Numéro de téléphone non valide.";
            errorMessage(message);
            return;
        }

        if (!(gender === "M" || gender === "F" || gender === "O")) {
            const message = "Le genre n'est pas valide.";
            errorMessage(message);
            return;
        }

        // Si le role est différent de propriétaire cela signifie que l'utilisateur loue au moins un appartement
        if (globalRoleText !== PROPRIETAIRE) {
            let containerRented = document.getElementById('tenant')
            let fkBuilding = containerRented.ownerDocument.getElementsByTagName('select')[0].value;
            let fkApartment = containerRented.ownerDocument.getElementsByTagName('select')[1].value;

            let dataToPush = {
                isOwnerRequest: 0,
                idBuilding: fkBuilding,
                idApartment: fkApartment
            }
            apartmentsList.push(dataToPush);
        }

        const data = {
            firstName: firstName,
            lastName: lastName,
            email: email,
            phone: phone,
            gender: gender,
            password: password,
            role: role,
            // address
            street: street,
            houseNumber: houseNumber,
            boxNumber: boxNumber,
            zip: zip,
            city: city,
            country: country,
            request: apartmentsList
        }

        $.post('/auth/register', data, function () {

        })
            .done(function () {
                const successMessage = encodeURI('Félicitation, votre compte a bien été créé !');
                window.location = '/?success-message=' + successMessage;
            })
            .fail(function (error) {
                console.log('error', error);
                const message = "Une erreure est survenue.";
                errorMessage(message)
            });
    });

});