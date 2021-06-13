-- Address
INSERT INTO address(street, house_number, box_number, zip, city, country)
VALUES
('Rue Cour Boisacq1', '18', 'B', '1301', 'Bierges', 'Belgique'),
('Rue du Benoit2', '59', 'B', '1302', 'Mont-Saint-Guibert', 'France'),
('Rue Cour Boisacq3', '18', 'B', '1304', 'Bierges', 'Belgique'),
('Rue de la source4', '77', 'B', '1305', 'Grez-Doiceau', 'Belgique'),
('Rue Cour Boisacq5', '18', 'B', '1306', 'Bierges', 'Belgique'),
('Rue Cour Boisacq6', '18', 'B', '1301', 'Bierges', 'Belgique'),
('Rue du Benoit7', '59', 'B', '1302', 'Mont-Saint-Guibert', 'France'),
('Rue Cour Boisacq8', '18', 'B', '1304', 'Bierges', 'Belgique'),
('Rue de la source9', '77', 'B', '1305', 'Grez-Doiceau', 'Belgique'),
('Rue Cour Boisacq10', '18', 'B', '1306', 'Bierges', 'Belgique'),
('Rue de la source11', '77', 'B', '1305', 'Grez-Doiceau', 'Belgique'),
('Rue Cour Boisacq12', '18', 'B', '1306', 'Bierges', 'Belgique'),
('Rue Cour Boisacq13', '18', 'B', '1306', 'Bierges', 'Belgique');

-- User
INSERT INTO user(firstname, lastname, email, phone, gender, role, password, fkAddress, fkBuilding, fkApartment )
VALUES
('Emile', 'Cyimena', 'cyimena09@hotmail.com', '0484090853', 'M', 'SYNDIC', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 1, null, null),
('Benoit', 'Vankoningsloo', 'benoit@hotmail.com', '0477213465', 'M', 'SYNDIC', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 2, 1,1),
('Amaury', 'Cyemezo', 'cyemezo@hotmail.com', '0499591245', 'M', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 3,1, 1),
('Alice', 'Malaika', 'malaika@hotmail.com', '0476134465', 'F', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 4,1, 1),
('Mike', 'Francois', 'mike@hotmail.com', '0488124678', 'M', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 5,1, 2),
('Susi', 'Toupe', 'stoupe0@symantec.com', '6685851293', 'F', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 6,1, 2),
('Eveline', 'Joyner', 'ejoyner1@cloudflare.com', '7861614104', 'F', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 7,1, 2),
('Eba', 'Penquet', 'epenquet2@walmart.com', '7779636737', 'M', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 8,1, 3),
('Justina', 'Dearth', 'jdearth3@hc360.com', '5481337107', 'F', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 9,1, 4),
('Venus', 'Tolwood', 'vtolwood4@w3.org', '2896359988', 'F', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 10,2, 5),
('Napoleon', 'Jencey', 'njencey5@csmonitor.com', '5625961927', 'M', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 11,2, 6),
('Kain', 'Wrist', 'kwrist6@mayoclinic.com', '5729661592', 'M', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 12,2, 7),
('Vernor', 'Titchen', 'vtitchen7@moonfruit.com', '2342462343', 'M', 'LOCATAIRE', '$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2', 13,3, 8);

-- Building
INSERT INTO building(name) VALUES ('Building A');
INSERT INTO building(name) VALUES ('Building B');
INSERT INTO building(name) VALUES ('Building C');
INSERT INTO building(name) VALUES ('Building D');

-- Apartment
INSERT INTO apartment(name, fkBuilding, fkOwner, fkTenant)
VALUES
('Apartement A1', 1, 2, 1),
('Apartement A2', 1, 6, 2),
('Apartement A3', 1, 7, 3),
('Apartement A4', 1, 8, 4),
('Apartement B1', 2, 9, 5),
('Apartement B2', 2, 10, 6),
('Apartement B3', 2, 11, 7),
('Apartement C1', 3, 12, 8),
('Apartement C2', 3, 13, 9),
('Apartement C3', 3, 2, 10),
('Apartement D1', 4, 3, 11),
('Apartement D2', 4, 4, 12),
('Apartement D3', 4, 5, 13);

-- Communication
INSERT INTO communication(subject, message, date_creation, last_update, fkBuilding)
VALUES
('Sujet Building A', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 1),
('Sujet Building A', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 1),
('Sujet Building B', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 2),
('Sujet Building C', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 3),
('Sujet Building D', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 4),
('Sujet Building E', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 4),
('Sujet Building F', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 4),
('Sujet Building A', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 1),
('Sujet Building A', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 1),
('Sujet Building A', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 1);

-- Ticket
INSERT INTO ticket(subject, status, description, date_creation, last_update, fkUser, fkBuilding)
VALUES
('Ticket Building A', 'Traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 3, 1),
('Ticket Building A', 'En attente', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 3, 1),
('Ticket Building B', 'Non traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 4, 2),
('Ticket Building C', 'Non traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 5, 3),
('Ticket Building D', 'Non traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 6, 4),
('Ticket Building E', 'Non traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 7, 4),
('Ticket Building F', 'Non traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 8, 4),
('Ticket Building A', 'Non traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 7, 1),
('Ticket Building A', 'Non traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 6, 1),
('Ticket Building A', 'Non traité', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?', '2021-05-24', '2021-05-24', 5, 1);
