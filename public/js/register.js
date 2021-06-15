$(document).ready(function () {
let passage = 0
    let globalRole; // role de l'utilisateur
    let globalIdBuildingOwned; // identifiant de l'immeuble en cours de traitement
    let globalIdBuildingRented; // identifiant de l'immeuble en cours de traitement et que le locataire loue
    let globalIdApartment; // id de l'appartement en cours de traitement et que le locataire loue
    let apartmentOwnedList = []; // liste des appartements et des batiments sélectionné par l'utilisateur

    /* *****************************************************************************************
    * -----------------------  AFFICHE (CHOIX RESIDENCE) EN FONCTION DU ROLE CHOISI ---------------------------
    *  *****************************************************************************************
    * */

    let radios = document.getElementsByName("role");

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
                $('#dropdown-apartment-rented').remove(); // on retire l'ancienne liste si elle existe
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
                            let drop  = mainElement.ownerDocument.getElementsByTagName('div');
                            drop.id = 'dropdown-apartment-rented'

                            // on donne un id a l'appartement

                            let tenantContainer;
                            let select;
                            // Il faut attribuer un identifiant à la balise select
                            // Si le role == 'LOCATAIRE' on ajoute l'id idRentedApartment
                            tenantContainer = document.getElementById('tenant');
                            select = tenantContainer.ownerDocument.getElementsByTagName("select")
                            select.id = 'idApartmentRented';


                        }
                    })
                    .fail(function (error) {
                        console.log('error', error);
                    });
            });
        }

        // si role == PROPRIETAIRE_LOCATAIRE
        // il faudra gérer deux formulaires, un pour ajouter la location et un autre pour ajouter les propriétés
        if (globalRole == 'PROPRIETAIRE_LOCATAIRE') {
            const containerRented = document.getElementById('js-result-rented');
            let selectFkBuildingRented = document.getElementById("fkBuildingRented");

            /* *****************************************************************************************
            * -----------------------   EVENT LORSQUE LAPPART EST LOUE --------------------------------
            *  *****************************************************************************************
            * */

            selectFkBuildingRented.addEventListener('change', function (e) {

                // on reset
                if (containerRented.children.length > 0 ){
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
                            let drop  = mainElement.ownerDocument.getElementsByTagName('div');
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

                            console.log(select)
                            // on distingue les id des dropdowns
                            //let dropdownRented = tenantContainer.ownerDocument.getElementById('dropdown-apartment');
                            //dropdownRented.id = 'dropdown-apartment-rented';



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
                if (containerOwned.children.length > 0 ){
                    let child = containerOwned.children[0];
                    child.remove();
                }



                //console.log($('#dropdown-apartment-owned'))
                //$('#dropdown-apartment-owned').remove(); // on retire l'ancienne liste si elle existe
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
                            //mainElement.children.id = 'dropdown-apartment-owned'
                            //let e  = mainElement.firstChild
                            //e.style.border = 'solid red 1px'


                            let drop  = mainElement.ownerDocument.getElementsByTagName('div')[1];
                            //console.log(drop)
                            drop.id = 'dropdown-apartment-owned'

                            let tenantContainer;
                            let select;
                            // Il faut attribuer un identifiant à la balise select
                            // Si le role == 'LOCATAIRE' on ajoute l'id idRentedApartment

                            // on aura deux menus, le premier concerne la location et la seconde les propriétés

                            // // location
                            // tenantContainer = document.getElementById('tenant');
                            // select = tenantContainer.ownerDocument.getElementsByTagName("select")
                            // select.id = 'idApartmentRented';

                            // propriété
                            // let ownerContainer = document.getElementById('owner');
                            // select = tenantContainer.ownerDocument.getElementsByTagName("select")
                            // select.id = 'idApartmentOwned';


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
        const addButton = document.getElementById('js-add-btn');
        const containerListApartment = document.getElementById('js-container-list-apartments');
        const ul = document.getElementById('js-ul');

        const containerOwned = document.getElementById('owner');

        addButton.addEventListener('click', function (e) {
            //globalIdApartment = document.forms["form-create-user"]["fkApartment"].value;

            // récupération du dropdown avec les appartements (deuxième)
            let dropdownApartOwned = containerOwned.ownerDocument.getElementsByTagName('select')[2].value

            globalIdApartment = dropdownApartOwned

            // on vérifie si l'appartement n'est pas déjà dans la liste
            for (let i = 0; i < apartmentOwnedList.length; i++) {
                if (apartmentOwnedList[i]['idApartment'] == globalIdApartment) {
                    return;
                }
            }

            // todo check if null

            let data = {
                idBuilding: globalIdBuildingOwned,
                idApartment: globalIdApartment
            }
            apartmentOwnedList.push(data);

            // on crée et on affiche l'element
            let li = document.createElement("li");
            li.innerText = 'Immeuble : ' + globalIdBuildingOwned + 'appartement : ' + globalIdApartment;
            ul.appendChild(li);
            containerListApartment.style.display = 'flex';
        });
    }

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

        // Address
        const street = document.forms["form-create-user"]["street"].value;
        const houseNumber = document.forms["form-create-user"]["houseNumber"].value;
        const boxNumber = document.forms["form-create-user"]["boxNumber"].value;
        const zip = document.forms["form-create-user"]["zip"].value;
        const city = document.forms["form-create-user"]["city"].value;
        const country = document.forms["form-create-user"]["country"].value;





        // si on ne peut pas récupérer le fkApartment c'est qu'aucun immeuble n'a été sélectionné
        // let fkApartment;
        // try {
        //     fkApartment = document.forms["form-create-user"]["fkApartment"].value;
        // } catch (error) {
        //     containerInfo.style.display = 'block';
        //     containerInfo.innerText = "Veuillez choisir une résidence.";
        //     return;
        // }

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
            boxNumber== "" ||
            zip== "" ||
            city== "" ||
            country== "") {

            console.log('tout na pas ete encode')
            // fkAPartment

            containerInfo.style.display = 'block';
            containerInfo.innerText = "Veuillez encoder tous les champs !";
            return;
        }





            // une fois que tous les champs ont été encodé on vérifie la cohérence des valeurs
            // 1. Le role doit figurer parmi : TENANT, OWNER ou TENANT_OWNER
            if (!(role == "LOCATAIRE" || role == "PROPRIETAIRE" || role == "PROPRIETAIRE_LOCATAIRE")) {
                containerInfo.style.display = 'block';
                containerInfo.innerText = "Le rôle n'est pas valide.";
                console.log('le role nest pas validee')
                return;
            }
            // 2. le genre doit être "M" ou "F"
            if (!(gender == "M" || gender == "F" || gender == "O")) {
                formError.style.display = 'block';
                formError.innerText = "Le genre n'est pas valide.";
                console.log('le genre  nest pas validee')
                return;
            }
        // on récupère la location sil y a
        let containerRented = document.getElementById('tenant')
        let fkBuilding = containerRented.ownerDocument.getElementsByTagName('select')[0].value;
        let fkApartment = containerRented.ownerDocument.getElementsByTagName('select')[1].value;

        const data = {
            firstName: firstName,
            lastName: lastName,
            email: email,
            phone: phone,
            gender: gender,
            password: password,
            role: role,
            fkBuilding: fkBuilding ? fkBuilding : null,
            fkApartment: fkApartment ? fkApartment : null,
            // address
            street: street,
            houseNumber: houseNumber,
            boxNumber: boxNumber,
            zip: zip,
            city: city,
            country: country
        }

        console.log('les données sont : ')
        console.log(data);

        console.log('la requete est : ')
        console.log(apartmentOwnedList)

        $.post('/auth/register', data, function () {

        })
            .done(function (e) {
                console.log(e);
                const successMessage = encodeURI('Félicitation, votre compte a bien été créé !');
                //window.location = '/?success-message=' + successMessage;
            })
            .fail(function (error) {
                console.log('error', error);
            });
    });

});