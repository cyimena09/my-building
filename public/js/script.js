$(document).ready(function () {

    /* *****************************************************************************************
    * ------------------------------  CREER UN NOUVEL ANIMAL -----------------------------------
    *  *****************************************************************************************
    * */

    // let formError = document.getElementById('form-error'); // message d'erreur du formulaire
    //
    // $('form#form-add-animal').on('submit', function (e) {
    //     e.preventDefault();
    //
    //     // On récupère les valeurs du formulaire
    //     let name = document.forms["form-add-animal"]["name"].value;
    //     let sex = document.forms["form-add-animal"]["sex"].value;
    //     let birthDate = document.forms["form-add-animal"]["birthDate"].value;
    //     let fkRace = document.forms["form-add-animal"]["fk_race"].value;
    //     let sterilized = document.forms["form-add-animal"]["sterilized"].value;
    //     let chip = document.forms["form-add-animal"]["chip"].value;
    //     let fkPerson = document.forms["form-add-animal"]["fk_person"].value;
    //
    //     // lorsque l'on va tester la validité de la date encodé par l'utilisateur le format va changer
    //     // donc on utilise cette variable pour conserver le format initial. Car la Db n'accepte qu'un format
    //     let tempoDate = birthDate
    //
    //     // On vérifie que tous les champs ont été encodé
    //     if (name == "" || sex == "" || birthDate == "" || fkRace == "" || sterilized == "" || chip == "" || fkPerson == "") {
    //         formError.style.display = 'block';
    //         formError.innerText = "Veuillez encoder tous les champs !";
    //     } else {
    //         // une fois que tous les champs ont été encodé on vérifie la cohérence des valeurs
    //         // 1. le sexe doit etre "M" ou "F"
    //         if (!(sex == "M" || sex == "F")) {
    //             formError.style.display = 'block';
    //             formError.innerText = "Le sexe du chien n'est pas valide !";
    //             return;
    //         }
    //         // 2. La stérilisation doit être un booléan, ici 0 ou 1
    //         if (!(sterilized == "0" || sterilized == "1")) {
    //             formError.style.display = 'block';
    //             formError.innerText = "La valeur de stérilisé n'est pas valide !";
    //             return;
    //         }
    //
    //         // On vérifie la validité de la date. On décide qu'on ne peut pas ajouter au chenil un animal pas encore né.
    //         // Donc la date ne peut pas être supérieur à aujourd'hui
    //
    //         function isValidDate(d) { // retourne true si le paramètre est une date
    //             return d instanceof Date && !isNaN(d);
    //         }
    //
    //         // on convertit la date de naissance en type Date.
    //         // Attention, ca ne signigie pas que ca devient une date, on l'a juste convert
    //         birthDate = new Date(birthDate);
    //
    //         if (!isValidDate(birthDate)) { // on test la validité de la date. Si ce n'est pas une date on envoie l'erreur
    //             formError.style.display = 'block';
    //             formError.innerText = "La date n'est pas valide !";
    //             return;
    //         }
    //
    //         // On vérifie si la date est inférieur à la date d'aujourd'hui
    //         let currentDate = new Date();
    //         if (currentDate < birthDate) {
    //             formError.style.display = 'block';
    //             formError.innerText = "Veuillez entrer une date inférieur à aujourd'hui!";
    //             return;
    //         }
    //
    //         // On pourrait aussi vérifier que la race encodé fasse bien parti de la liste des races disponible dans la Db
    //         // mais manque de temps.
    //     }
    //
    //     let data = {
    //         name: name,
    //         sex: sex ,
    //         birthDate: tempoDate ,
    //         fk_race: fkRace,
    //         sterilized: sterilized,
    //         chip: chip,
    //         fk_person: fkPerson
    //     }
    //
    //     $.post('/animals/create', data, function () {
    //
    //     })
    //         .done(function () {
    //             window.location = 'http://chenil.com/persons/show/' + fkPerson; // redirection
    //
    //         })
    //         .fail(function (error) {
    //             console.log('error', error);
    //         });
    // });

});