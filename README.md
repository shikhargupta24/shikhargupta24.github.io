# homework-1-comp-333
Homework 1 for Computer Science 333

Creating an advertisement for Wesleyan University using HTML and CSS

In some parts, Rueh and Keith worked together via one laptop but it is fine to say equal contribution amongst the three members I would analyze the issue section for further details.


Keith:
![61ff07818f7640eefd471ce96cbb5061](https://github.com/user-attachments/assets/fa9e6157-93f6-4bc1-8dae-230088f8773f)


Rufaida: 
![compsciscreenshot](https://github.com/user-attachments/assets/ebd24dea-6f43-4327-9ec7-2cc7cf8aea64)


Shikhar:
![Image 3-6-25 at 7 51 PM](https://github.com/user-attachments/assets/7f829c9d-e2f5-494e-b473-c08fdcfd75f2)


MYSQL FOLLOW UP
Referring to crudtables.sql, the code is going to be used to implement tables and sql queries into the database. 
After going through the process for xamp, and then opening up the xamp control panel and starting apache and mysql, phpmyadmin will be used to the create the database. 


Click new, and add a new database named wes-db. afterward, you will open the database and click new to creat a table names users. on the top right, toggle over to the SQl button and copy and paste the users table from the crudtables.sql document.
ex) CREATE TABLE  `users` (
    username VARCHAR(255) PRIMARY KEY, 
    password VARCHAR(255) NOT NULL);
Click Go.

after ward, to add in the data values, go on the users table and back to the sql button then copy and paste the INSERT data values
ex) INSERT INTO  `users` (username, password)
VALUES
 ('Rkhan', 'hashed password');
 click go.



Click new again and add a table named events. toggle the sql button and add the create table code for the events table. 
after ward, to add in the data values, go on the events table and back to the sql button then copy and paste the INSERT data values
  then click go. 

all of this code is found in the crudtables.sql
