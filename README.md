# homework-2-comp-333
Homework 2 for Computer Science 333

Creating an advertisement for Wesleyan University using HTML and CSS

Going by order of the the Names Keith,Rueh,Shikhar its a 40/40/20 split. 

Link:https://wesleyanapp.infinityfreeapp.com/login.php

Keith:
![61ff07818f7640eefd471ce96cbb5061](https://github.com/user-attachments/assets/fa9e6157-93f6-4bc1-8dae-230088f8773f)


Rufaida: 
![compsciscreenshot](https://github.com/user-attachments/assets/ebd24dea-6f43-4327-9ec7-2cc7cf8aea64)


Shikhar:
![Image 3-6-25 at 7 51 PM](https://github.com/user-attachments/assets/7f829c9d-e2f5-494e-b473-c08fdcfd75f2)


Instructions 
prior to setting up the databse on infinity free, a local environment was used through xamp - phpmyadmin, where the queries were created and tested. This platform is mentioned below in the mysql follow up instructions**

After creating an account for infinity free, create a domain name and choose the extension. We then first went into the control panel down to the mysql databse and created a database called app_db. Then click admin on the right side leading us to where we will input information/build the database. after clicking admin, the platform wil open and on the right side you will click sql where the queries will be inserted. Copy and paste the create table queries and the insert queries one by one into the query box, and click go after each additon. (this process and outlook of the system was exactly like that of the set up for the phpmyadmin through xamp mentioned below. 
Afterward, going back to the home page a free ssl/tls certficate can be requested which will turn the website into a secure connection adding https:// behind the domain name. Then on the home page of infinty free, click file manager and enter the htdocs where all the code files will be added (excluding the gitignore, read.md, license, and index.html - since it was replaced by the index.php.). After uploading the files, make sure the config.php has the same db name, host name, user, and password as mentioned in the mysqldatabases.



**MYSQL (local follow up instructions )
Referring to crudtables.sql, the code is going to be used to implement tables and sql queries into the database. 
After going through the process for downloading xamp, and then opening up the xamp control panel and starting apache and mysql, phpmyadmin will open and it will be used to the create the database. 
When on the phpmyadmin page, click new, and add a new database named app-db. afterward, you will open the database and click new to create a table named users. on the top right, toggle over to the SQl button and copy and paste the users table from the crudtables.sql document.
ex) CREATE TABLE  `users` (
    username VARCHAR(255) PRIMARY KEY NOT NULL, 
    password VARCHAR(255) NOT NULL);
Click Go after entering the create table query into the box.

after ward, to add in the data values, go on the users table and back to the sql button then copy and paste the INSERT data values
ex) 
INSERT INTO  `users` (username, password)
VALUES
 ('Rkhan', 'Chocolate240'),
 ('Keith', 'Penutbuttercar'),
 ('Sgupta', 'Caramellane10');
 click go.

Click new again on the left side menu where the table are beneath the selected database and add a table named events. toggle the sql button and add the create table code for the events table. 
after ward, to add in the data values, go on the events table and back to the sql button then copy and paste the INSERT data values
  then click go. 
all of this code is found in the crudtables.sql
