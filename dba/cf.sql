use CHINESE_FRIDAY;

/*Referencing tables*/
DROP TABLE IF EXISTS MEAL_OPTIONS;
DROP TABLE IF EXISTS SELECTED_MEAL_OPTIONS;
DROP TABLE IF EXISTS ORDERS;

/*Base tables*/
DROP TABLE IF EXISTS MEAL_OPTIONS_BASE;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS MEALS;
DROP TABLE IF EXISTS RICE;

CREATE TABLE MEAL_OPTIONS_BASE(
	MOB_ID INT UNSIGNED AUTO_INCREMENT,
	MOB_OPTION VARCHAR(30) NOT NULL,
	PRIMARY KEY(MOB_ID)
);

CREATE TABLE USERS(
	USER_ID INT UNSIGNED AUTO_INCREMENT,
	USER_NAME VARCHAR(30) NOT NULL UNIQUE,
	PRIMARY KEY(USER_ID)
);

CREATE TABLE MEALS(
	MEAL_ID INT UNSIGNED AUTO_INCREMENT,
	MEAL_NAME VARCHAR(30) NOT NULL,
	MEAL_PRICE NUMERIC(5,2),
	MEAL_NO_SIDE TINYINT,
	PRIMARY KEY(MEAL_ID)
);

CREATE TABLE RICE(
	RICE_ID INT UNSIGNED AUTO_INCREMENT,
	RICE_TYPE VARCHAR(10) NOT NULL UNIQUE,
	PRIMARY KEY(RICE_ID)
);

CREATE TABLE MEAL_OPTIONS(
	MO_MOB_ID INT UNSIGNED NOT NULL,
	MO_MEAL_ID INT UNSIGNED NOT NULL,
	PRIMARY KEY(MO_MOB_ID, MO_MEAL_ID),
	FOREIGN KEY(MO_MOB_ID) REFERENCES MEAL_OPTIONS_BASE(MOB_ID)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(MO_MEAL_ID) REFERENCES MEALS(MEAL_ID)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ORDERS(
	ORDER_ID INT UNSIGNED AUTO_INCREMENT,
	ORDER_DATE DATE NOT NULL,
	ORDER_USER_ID INT UNSIGNED NOT NULL,
	ORDER_MEAL_ID INT UNSIGNED NOT NULL,
	ORDER_RICE INT UNSIGNED NOT NULL,
	PRIMARY KEY(ORDER_ID),
	FOREIGN KEY(ORDER_USER_ID) REFERENCES USERS(USER_ID)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(ORDER_MEAL_ID) REFERENCES MEALS(MEAL_ID)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(ORDER_RICE) REFERENCES RICE(RICE_ID)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE SELECTED_MEAL_OPTIONS(
	SMO_MOB_ID INT UNSIGNED NOT NULL,
	SMO_ORDER_ID INT UNSIGNED NOT NULL,
	PRIMARY KEY(SMO_MOB_ID, SMO_ORDER_ID),
	FOREIGN KEY(SMO_MOB_ID) REFERENCES MEAL_OPTIONS_BASE(MOB_ID)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY(SMO_ORDER_ID) REFERENCES ORDERS(ORDER_ID)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

/* Create User list */
INSERT INTO MEAL_OPTIONS_BASE VALUES(null, 'No veggies'), (null, 'Add Chopsticks'), (null, 'Only Green Peppers and Onions'), (null, 'Extra Spicy');

INSERT INTO USERS VALUES(null, 'Justin Walrath'),(null, 'Jered Berge'),(null, 'Tracy Buck'),(null, 'Cliff Torpy'),(null, 'Tessa Seiders'),(null, 'Nathan Palmer'),(null, 'Jared Barden');

/*Backed up the production server's MySQL*/
/*INSERT INTO MEALS VALUES(null, 'L25 General Tso\'s Chicken', 4.95, false), (null, 'L25 General Tso\'s Shrimp', 4.95, false);*/
INSERT INTO MEALS (MEAL_ID, MEAL_NAME, MEAL_PRICE, MEAL_NO_SIDE) VALUES
(1, 'L25 General Tso''s Chicken', '4.95', 0),
(2, 'L25 General Tso''s Shrimp', '4.95', 0),
(3, 'L1 Roast Pork', '4.75', 0),
(4, 'Eggroll', '1.00', 1),
(5, 'L1 Chicken Chow Mein', '4.75', 0),
(6, 'L2 Beef Chow Mein', '4.75', 0),
(7, 'L2 Shrimp Chow Mein', '4.75', 0),
(8, 'L3 Roast Pork', '4.75', 0),
(9, 'L3 Chicken Lo Mein', '4.75', 0),
(10, 'L4 Shrimp Lo Mein', '4.75', 0),
(11, 'L4 Beef Lo Mein', '4.75', 0),
(12, 'L5 Chicken with Broccoli', '4.75', 0),
(13, 'L5 Pork with Broccoli', '4.75', 0),
(14, 'L6 Beef with Broccoli', '4.75', 0),
(15, 'L6 Shrimp with Broccoli', '4.75', 0),
(16, 'L7 Chicken with Garlic Sauce', '4.75', 0),
(17, 'L7 Pork with Garlic Sauce', '4.75', 0),
(18, 'L8 Beef with Garlic Sauce', '4.75', 0),
(19, 'L8 Shrimp with Garlic Sauce', '4.75', 0),
(20, 'L9 Shredded Pork', '4.75', 0),
(21, 'L10 Crispy Pork Szechuan Style', '4.75', 0),
(22, 'L10 Chicken Szechuan Style', '4.75', 0),
(23, 'L11 Crispy Shrimp Szechuan Sty', '4.75', 0),
(24, 'L11 Beef Szechuan Style', '4.75', 0),
(25, 'L12 Hunan Chicken', '4.75', 0),
(26, 'L12 Hunan Pork', '4.75', 0),
(27, 'L13 Hunan Shrimp', '4.75', 0),
(28, 'L13 Hunan Beef', '4.75', 0),
(29, 'L14 Szechuan Chicken', '4.75', 0),
(30, 'L14 Szechuan Pork', '4.75', 0),
(31, 'L15 Szechuan Flavor Shrimp', '4.75', 0),
(32, 'L15 Szechuan Beef', '4.75', 0),
(33, 'L16 Pineapple Chicken', '4.75', 0),
(34, 'L17 Lemon Chicken', '4.75', 0),
(35, 'L17 Lemon Shrimp', '4.75', 0),
(36, 'L18 Coconut Chicken', '4.95', 0),
(37, 'L18 Coconut Shrimp', '4.95', 0),
(38, 'L19 Walnut Chicken', '4.95', 0),
(39, 'L19 Walnut Shrimp', '4.95', 0),
(40, 'L20 Black Pepper Chicken w.Oni', '4.75', 0),
(41, 'L21 Chicken with Cashew', '4.75', 0),
(42, 'L21 Shrimp with Cashew', '4.75', 0),
(43, 'L22 Kung Po Chicken', '4.75', 0),
(44, 'L22 Kung Po Shrimp', '4.75', 0),
(45, 'L23 Sweet and Sour Chicken', '4.75', 0),
(46, 'L23 Sweet and Sour Pork', '4.75', 0),
(47, 'L24 Sweet and Sour Shrimp', '4.75', 0),
(48, 'L26 Sesame Chicken', '4.95', 0),
(49, 'L26 Sesame Shrimp', '4.95', 0),
(50, 'L27 Orange Flavored Chicken', '4.95', 0),
(51, 'L27 Orange Flavored Beef', '4.95', 0),
(52, 'L28 Honey Chicken with mixed v', '4.75', 0),
(53, 'L29 Shrimp with Lobster Sauce', '4.75', 0),
(54, 'L30 Chicken with Mixed Vegetab', '4.75', 0),
(55, 'L30 Pork with Mixed Vegetables', '4.75', 0),
(56, 'L31 Beef with Mixed Vegetables', '4.75', 0),
(57, 'L31 Shrimp with Mixed Vegetabl', '4.75', 0),
(58, 'L32 Moo Goo Gai Pan', '4.75', 0),
(59, 'L33 Chicken with Mushroom', '4.75', 0),
(60, 'L33 Pork with Mushroom', '4.75', 0),
(61, 'L34 Beef with Mushroom', '4.75', 0),
(62, 'L34 Beef with Mushroom', '4.75', 0),
(63, 'L35 Pepper Steak with Onion', '4.75', 0),
(64, 'L36 Chicken with String Beans', '4.75', 0),
(65, 'L36 Shrimp with String Beans', '4.75', 0),
(66, 'L37 Chicken with Snow Peas', '4.75', 0),
(67, 'L37 Shrimp with Snow Peas', '4.75', 0),
(68, 'L38 Hot and Spicy Chicken', '4.75', 0),
(69, 'L38 Hot and Spicy Pork', '4.75', 0),
(70, 'L39 Hot and Spicy Beef', '4.75', 0),
(71, 'L39 Hot and Spicy Shrimp', '4.75', 0),
(72, 'L40 Sha Cha Chicken with Mixed', '4.75', 0),
(73, 'L40 Sha Cha Pork with Mixed Ve', '4.75', 0),
(74, 'L41 Sha Cha Beef with Mixed Ve', '4.75', 0),
(75, 'L41 Sha Cha Shrimp with Mixed ', '4.75', 0),
(76, 'L42 Curry Chicken', '4.75', 0),
(77, 'L42 Curry Shrimp', '4.75', 0),
(78, 'L43 Double Cooked Pork', '4.75', 0),
(79, 'L44 Sauteed Chicken & Shrimp', '4.75', 0),
(80, 'L45 Boneless Spare Ribs', '4.75', 0),
(81, 'L46 Vegetable Lo Mein', '4.75', 0),
(82, 'L47 Broccoli with Brown Sauce', '4.75', 0),
(83, 'L48 Broccoli in Garlic Sauce', '4.75', 0),
(84, 'L49 Mixed Vegetable Tray', '4.75', 0),
(85, 'Nothing', '0.00', 1);

INSERT INTO RICE VALUES(null, 'Fried Rice'), (null, 'White Rice'), (null, 'Roast Pork'), (null, 'Rice NA');

/*INSERT INTO MEAL_OPTIONS VALUES(1, 1), (1, 2), (2, 1), (2, 2);*/
INSERT INTO MEAL_OPTIONS (MO_MOB_ID, MO_MEAL_ID) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(1, 3),
(2, 3),
(1, 5),
(2, 5),
(1, 6),
(2, 6),
(1, 7),
(2, 7),
(1, 8),
(2, 8),
(1, 9),
(2, 9),
(1, 10),
(2, 10),
(1, 11),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(1, 16),
(2, 16),
(1, 17),
(2, 17),
(1, 18),
(2, 18),
(1, 19),
(2, 19),
(1, 20),
(2, 20),
(1, 21),
(2, 21),
(1, 22),
(2, 22),
(1, 23),
(2, 23),
(1, 24),
(2, 24),
(1, 25),
(2, 25),
(1, 26),
(2, 26),
(1, 27),
(2, 27),
(1, 28),
(2, 28),
(1, 29),
(2, 29),
(1, 30),
(2, 30),
(1, 31),
(2, 31),
(1, 32),
(2, 32),
(2, 33),
(1, 34),
(2, 34),
(1, 35),
(2, 35),
(1, 36),
(2, 36),
(1, 37),
(2, 37),
(1, 38),
(2, 38),
(1, 39),
(2, 39),
(1, 40),
(2, 40),
(1, 41),
(2, 41),
(1, 42),
(2, 42),
(1, 43),
(2, 43),
(1, 44),
(2, 44),
(1, 45),
(2, 45),
(1, 46),
(2, 46),
(1, 47),
(2, 47),
(1, 48),
(2, 48),
(1, 49),
(2, 49),
(1, 50),
(2, 50),
(1, 51),
(2, 51),
(2, 52),
(1, 53),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(2, 57),
(1, 58),
(2, 58),
(1, 59),
(2, 59),
(1, 60),
(2, 60),
(1, 61),
(2, 61),
(1, 62),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(1, 68),
(2, 68),
(1, 69),
(2, 69),
(1, 70),
(2, 70),
(4, 70),
(1, 71),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(1, 76),
(2, 76),
(3, 76),
(4, 76),
(1, 77),
(2, 77),
(3, 77),
(4, 77),
(1, 78),
(2, 78),
(1, 79),
(2, 79),
(1, 80),
(2, 80),
(2, 81),
(2, 82),
(2, 83),
(2, 84);

INSERT INTO ORDERS VALUES(null, NOW(), 1, 1, 2), (null, NOW(), 2, 1, 1);

INSERT INTO SELECTED_MEAL_OPTIONS VALUES(1, 1), (2, 1), (1, 2);

select U.USER_NAME, M.MEAL_NAME, MOB.MOB_OPTION, R.RICE_TYPE, M.MEAL_PRICE from ORDERS O inner join SELECTED_MEAL_OPTIONS SMO on O.ORDER_ID = SMO.SMO_ORDER_ID inner join MEAL_OPTIONS_BASE MOB on MOB.MOB_ID = SMO.SMO_MOB_ID inner join MEALS M on M.MEAL_ID = O.ORDER_MEAL_ID inner join USERS U on U.USER_ID = O.ORDER_USER_ID inner join RICE R on R.RICE_ID = O.ORDER_RICE WHERE O.ORDER_DATE = CURDATE() order by U.USER_NAME, M.MEAL_NAME, MOB.MOB_OPTION, R.RICE_TYPE, M.MEAL_PRICE;
