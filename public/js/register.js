// Ce code permet d'enregistrer un utilisateur,
// on distingue 3 situations particulière. L'utilisateur qui s'inscrit doit choisir un role et en fonction de son choix
// des sous-formulaires différents s'affichent. Les 3 rôles sont 'LOCATAIRE', 'PROPRIETAIRE' et 'LOCATAIRE_PROPRIETAIRE'
// CAS LOCATAIRE : Un menu déroulant s'affiche et l'utilisateur choisi d'abord le batiment dans lequel il réside
// et ensuite son appartement
// CAS PROPRIETAIRE : Un premier menu demande à l'utilisateur de sélectionner l'appartement dans lequel se trouve
// son appartement et une fois son choix fait un second menu lui demande de sélectionner son appartement. L'utilisateur peut effectuer ce
// processus autant de fois qu'il le souhaite. Mais si un appartement a déjà été sélectionné, il n'est pas ajouté dans la liste.
// CAS LOCATAIRE_PROPRIETAIRE : Comprends les deux premiers cas réunis.
$(document).ready(function () {
    let radios = document.getElementsByName("role");
    let globalRole; // role de l'utilisateur
    let globalIdBuildingOwned; // identifiant de l'immeuble en cours de traitement
    let globalIdBuildingRented; // identifiant de l'immeuble en cours de traitement et que le locataire loue
    let globalIdApartment; // id de l'appartement en cours de traitement et que le locataire loue
    let apartmentOwnedList = []; // liste des appartements et des batiments sélectionné par l'utilisateur

    /* *****************************************************************************************
    * -----------------------  AFFICHE (CHOIX RESIDENCE) EN FONCTION DU ROLE CHOISI ---------------------------
    *  *****************************************************************************************
    * */

    for (let i = 0; i < radios.length; ++i) {
        radios[i].addEventListener('change', function (e) {

            // dans un premier temps on reset tout
            apartmentOwnedList = [];
            $('#js-section-result').empty();
            $('#js-ul').empty();
            $('#js-container-list-apartments').css('display', 'none');
            $('#js-add-btn').css('display', 'none');

            // récupération des valeurs du formulaire
            const role = radios[i].value;
            globalRole = role; // on conserve le role dans une variable

            $.get('/auth/sectionByRoleView/' + role, function () {

            })
                .done(function (result) {
                    if (result) {
                        $('#js-section-result').append(result);
                        dynamicMenu(); // on active le code qui permet de générer dynamiquement les appartements en fonction de l'immeuble choisi
                    }
                })
                .fail(function (error) {
                    console.log('error', error);
                });
        });
    }

    /* *****************************************************************************************
  * -----------------------   AFFICHE LISTE DES APPARTEMENTS --------------------------------
  *  *****************************************************************************************
  * */

    function dynamicMenu() {
        if (globalRole == 'LOCATAIRE') {
            const containerRented = document.getElementById('js-result-rented'); // container ou est affiché le menu déroulant des appartements
            let selectFkBuildingRented = document.getElementById("fkBuildingRented");

            // on ajoute un listener sur le choix de l'immeuble
            selectFkBuildingRented.addEventListener('change', function (e) {
                // on reset
                if (containerRented.children.length > 0) {
                    let child = containerRented.children[0];
                    child.remove();
                }

                containerRented.style.visibility = 'visible';

                const idBuilding = selectFkBuildingRented.value; // récupération de l'id de l'immeuble
                globalIdBuildingRented = idBuilding

                const data = {
                    idBuilding: idBuilding
                }

                $.post('/apartments/dropdown/', data, function () {

                })
                    .done(function (result) {
                        if (result) {
                            $('#js-result-rented').append(result) // on ajoute le menu des appartements (en fonction de l'identifiant du building indiqué
                            let mainElement = document.getElementById('js-result-rented');
                            let drop = mainElement.ownerDocument.getElementsByTagName('div');
                            drop.id = 'dropdown-apartment-rented'
                        }
                    })
                    .fail(function (error) {
                        console.log('error', error);
                    });
            });
        }

        if (globalRole == 'PROPRIETAIRE') {
            const containerRented = document.getElementById('js-result-owned');
            let selectFkBuildingRented = document.getElementById("fkBuildingOwned");

            selectFkBuildingRented.addEventListener('change', function (e) {

                // on reset
                if (containerRented.children.length > 0) {
                    let child = containerRented.children[0];
                    child.remove();
                }
                containerRented.style.visibility = 'visible';

                const idBuildingRented = selectFkBuildingRented.value; // récupération de l'id de l'immeuble
                globalIdBuildingRented = idBuildingRented

                const data = {
                    idBuilding: idBuildingRented
                }

                $.post('/apartments/dropdown/', data, function () {

                })
                    .done(function (result) {
                        if (result) {
                            $('#js-result-owned').append(result) // on ajoute le menu des appartements (en fonction de l'identifiant du building indiqué

                            addButton()
                            let mainElement = document.getElementById('js-result-owned');
                            let drop = mainElement.children[0].getElementsByTagName('select')[0]
                            drop.id = 'dropdown-apartment-owned';
                        }
                    })
                    .fail(function (error) {
                        console.log('error', error);
                    });
            });
        }


        // si role == PROPRIETAIRE_LOCATAIRE
        // il faudra gérer deux formulaires, un pour ajouter l'appartement loué et un autre pour ajouter les propriétés
        if (globalRole == 'PROPRIETAIRE_LOCATAIRE') {
            const containerRented = document.getElementById('js-result-rented');
            let selectFkBuildingRented = document.getElementById("fkBuildingRented");

            /* *****************************************************************************************
            * -----------------------   EVENT LORSQUE LAPPART EST LOUE --------------------------------
            *  *****************************************************************************************
            * */

            selectFkBuildingRented.addEventListener('change', function (e) {

                // on reset
                if (containerRented.children.length > 0) {
                    let child = containerRented.children[0];
                    child.remove();
                }

                //$('#dropdown-apartment-rented').remove(); // on retire l'ancienne liste si elle existe
                containerRented.style.visibility = 'visible';

                const idBuildingRented = selectFkBuildingRented.value; // récupération de l'id de l'immeuble
                globalIdBuildingRented = idBuildingRented

                const data = {
                    idBuilding: idBuildingRented
                }

                $.post('/apartments/dropdown/', data, function () {

                })
                    .done(function (result) {
                        if (result) {
                            $('#js-result-rented').append(result) // on ajoute le menu des appartements (en fonction de l'identifiant du building indiqué

                            let mainElement = document.getElementById('js-result-rented');
                            let drop = mainElement.ownerDocument.getElementsByTagName('div');
                            drop.id = 'dropdown-apartment-rented'

                            let tenantContainer;
                            let select;
                            // Il faut attribuer un identifiant à la balise select
                            // Si le role == 'LOCATAIRE' on ajoute l'id idRentedApartment

                            // on aura deux menus, le premier concerne la location et la seconde les propriétés

                            // location
                            tenantContainer = document.getElementById('tenant');
                            select = tenantContainer.ownerDocument.getElementsByTagName("select")[1]
                            select.id = 'idApartmentRented'; // on modifie l'id du menu déroulant des appartements

                        }
                    })
                    .fail(function (error) {
                        console.log('error', error);
                    });
            });

            /* *****************************************************************************************
           * -----------------------   EVENT LORSQUE LAPPART EST POSSEDE --------------------------------
           *  *****************************************************************************************
           * */

            const containerOwned = document.getElementById('js-result-owned');
            let selectFkBuildingOwned = document.getElementById("fkBuildingOwned");
            addButton(); // on active le bouton pour ajouter dans la liste

            // Etape 2 : on ajoute un listener sur l'immeuble possédé
            selectFkBuildingOwned.addEventListener('change', function (e) {
                // on reset
                if (containerOwned.children.length > 0) {
                    let child = containerOwned.children[0];
                    child.remove();
                }

                containerOwned.style.visibility = 'visible';

                const idBuildingOwned = selectFkBuildingOwned.value; // récupération de l'id de l'immeuble
                globalIdBuildingOwned = idBuildingOwned

                const data = {
                    idBuilding: idBuildingOwned
                }

                $.post('/apartments/dropdown/', data, function () {

                })
                    .done(function (result) {
                        if (result) {
                            $('#js-result-owned').append(result) // on ajoute le menu des appartements (en fonction de l'identifiant du building indiqué
                            let mainElement = document.getElementById('js-result-owned');
                            let drop = mainElement.ownerDocument.getElementsByTagName('div')[1];
                            drop.id = 'dropdown-apartment-owned'
                        }
                    })
                    .fail(function (error) {
                        console.log('error', error);
                    });
            });
        }

    }

    /* *****************************************************************************************
    * -----------------------  AJOUTE UN APPARTEMENT A LA LISTE  ---------------------------
    *  *****************************************************************************************
    * */

    function addButton() {
        // todo on devrait gérer l'ajout qu'ici et pas ailleurs
        const containerOwned = document.getElementById('js-result-owned');

        const addButton = document.getElementById('js-add-btn');
        const containerListApartment = document.getElementById('js-container-list-apartments');


        addButton.addEventListener('click', function (e) {
            const idBuilding = document.getElementById('fkBuildingOwned').value // on récupère le building
            const nameBuilding = $("#fkBuildingOwned option:selected").text();
            const idApart = containerOwned.children[0].getElementsByTagName('select')[0].value; // on récupère l'appartement
            const nameApart = $("#dropdown-apartment-owned option:selected").text();

            // on vérifie si les valeurs ne sont pas nulles
            if (idApart == "" || idBuilding == "") {
                return;
            }

            // on vérifie si l'appartement n'est pas déjà dans la liste
            for (let i = 0; i < apartmentOwnedList.length; i++) {
                if (apartmentOwnedList[i]['idApartment'] == idApart) {
                    return;
                }
            }

            let data = {
                isOwnerRequest: 1, // booléen qui indique si on ajoute une propriété ou une location (ici propriété)
                idBuilding: idBuilding,
                idApartment: idApart
            }
            // on crée et on affiche l'element
            apartmentOwnedList.push(data);


            let div = '      <div class="container">' +
                '                <div class="container-icon">' +
                '                    <i class="fas fa-building"></i>' +
                '                </div>' +
                '                <div class="container-text">' +
                '                    <p class="building"> <span>Immeuble</span> · <span>' + nameBuilding + '</span></p>' +
                '                    <p class="apartment"> <span>Appartement</span> · <span>' + nameApart + '</span></p>' +
                '                </div>' +
                '            </div>'

            $('#js-ul').append(div);
            containerListApartment.style.display = 'flex';
        });
    }

    /* *****************************************************************************************
    * ------------------------------  CREER UTILISATEUR -----------------------------------
    *  *****************************************************************************************
    * */

    const containerInfo = document.getElementById('js-quick-info');

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
        if (firstName == "" ||
            lastName == "" ||
            email == "" ||
            phone == "" ||
            gender == "" ||
            password == "" ||
            role == "" ||
            // address
            street == "" ||
            houseNumber == "" ||
            boxNumber == "" ||
            zip == "" ||
            city == "" ||
            country == "") {

            const message = "Veuillez encoder tous les champs !";
            errorMessage(message);
            return;
        }

        // vérification de la cohérence des valeurs
        if (!(role == "LOCATAIRE" || role == "PROPRIETAIRE" || role == "PROPRIETAIRE_LOCATAIRE")) {
            const message = "Le rôle n'est pas valide.";
            errorMessage(message);
            return;
        }

        const reg = new RegExp('^[0-9]+$');

        if(!reg.test(phone)) {
            const message = "Numéro de téléphone non valide.";
            errorMessage(message);
            return;
        }


        if (!(gender == "M" || gender == "F" || gender == "O")) {
            const message = "Le genre n'est pas valide.";
            errorMessage(message);
            return;
        }
        // Si le role est différent de propriétaire cela signifie que l'utilisateur loue au moins un appartement
        if (globalRole != 'PROPRIETAIRE') {
            let containerRented = document.getElementById('tenant')
            let fkBuilding = containerRented.ownerDocument.getElementsByTagName('select')[0].value;
            let fkApartment = containerRented.ownerDocument.getElementsByTagName('select')[1].value;

            let dataToPush = {
                isOwnerRequest: 0,
                idBuilding: fkBuilding,
                idApartment: fkApartment
            }
            apartmentOwnedList.push(dataToPush);
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
            request: apartmentOwnedList
        }

        $.post('/auth/register', data, function () {

        })
            .done(function (e) {
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