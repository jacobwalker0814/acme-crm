CREATE TABLE contacts(
id int AUTO_INCREMENT PRIMARY KEY,
name VARCHAR (255),
email VARCHAR (255)
)engine=InnoDB;

INSERT INTO contacts
(id, name, email)
VALUES
(1, "John Doe", "john@doe.com"),
(2, "Alice Mar", "alice@mar.com");