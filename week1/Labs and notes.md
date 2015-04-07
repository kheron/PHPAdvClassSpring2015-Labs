##########################################################
RUN phone.sql from the week1 demo before starting this Lab
###########################################################

Lab 1
-------------------------------------------------------
We will create an email type add form.

The form will have take an email type and add it to the emailtype table
Validate the form and save it into the database.
If there are errors please re-display the form with the error messages.
Create a emailTypeDB class that will have a function to save the email type and one to display them.
Include this in the form.
When displaying the list of active types, wrap them in a strong tag.
Some email types that will be added.

Primary
Secondary
Database name to create: PHPadvClassSpring2015

Tables:

CREATE TABLE IF NOT EXISTS emailtype (
emailtypeid TINYINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
emailtype VARCHAR(50) NOT NULL UNIQUE KEY, 
active TINYINT(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

 

CREATE TABLE IF NOT EXISTS email (
emailid INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, 
email VARCHAR(255) NOT NULL UNIQUE KEY,
emailtypeid TINYINT UNSIGNED DEFAULT NULL,
FOREIGN KEY (emailtypeid) REFERENCES emailtype(emailtypeid),
logged DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00', 
lastupdated DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
active tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;




Lab 2
----------------------------------------------------------

Lets begin to design some classes with Object-oriented principles in PHP.

Use the email and emailtype tables for this assignments. A model and data access object should be created for each table.

Create a Data Object/Model that will implement this interface.  The model should follow the column names in the Database.

interface IModel {
    public function reset();
    public function map(array $values);
}

Create a Data Access Object class that will implement this interface.

interface IDAO {
    public function getById($id);
    public function delete($id); 
    public function save(IModel $model);

    public function getAllRows();

}

 

You will need a Database class to inject into your DAO class.

 

On a test page I should be able to get a record by an id.

I should be able to delete a record,

The Add/save feature should allow me to either insert if it is a new record or update if it is an existing record. 

Also add a namespace that will use your name and week

namespace gforti/week2;

use gforti/week2;



PHP Resources
--------------------------------------------------------------------------------
Take a look at the resources above.  I added a book I recommend that I think will be a great quick read. Use this book to also read topics we will be covering next two classes.

PHP Quick Scripting Reference on books 24/7

Class
Inheritance
Access Levels
Interface
Abstract
Magic Methods
Type Hinting
Namespaces
Advanced Variables
Exception Handling


Advance PHP Final Project Proposal
-----------------------------------------------------------------------------------
For the Final project you can work alone or in teams of two.  The final Project must be a web application that runs on PHP.  All code must be written by your team. The idea does not have to be original but there are key factors the project must follow.


It must be written using PHP, HTML, CSS and JavaScript only.
MySQL is the only database allowed.
All PHP code must use object-oriented principles.
The program has to be able to create, read, update and disable/delete data (crud).
Note that your program does not have to be a crud program but I must approve it.
There has to be a signup and log in piece to your project. 
All code must be documented using the PHP doc style comments.
All team members must distribute the work in PHP equally.

With these rules you will need to submit your proposal with the following information.


Team members
Project Idea
List of tasks to be completed for the project.
Who is assigned for each task.
Estimates on how long each task should take.
Your proposal should be in a readme.txt file in your final folder on github.com

If you are working in teams I suggest that you create a team github.com account for this project.  When submitting the assignment you must have the same code in each of your own github.com accounts. 


Please note I must approve of the project with the information submitted before you can start. The proposal must be submitted no later than week 4.

 



PHP Resources
------------------------------------------------------------------------
PHP Documentation

PHP.net (Links to an external site.)

Github - All demos will be posted here

https://github.com/gforti/PHPadvClassSpring2015 (Links to an external site.)

Great way to catch up on PHP, HTML/CSS and JavaScript too!

http://www.codecademy.com/ (Links to an external site.)

Free PHP books on Books 24x7 (School Library (Links to an external site.))

PHP Quick Scripting Reference