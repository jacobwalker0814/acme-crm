Customer Paradigm Candidate Project
===================================

# Installation

Install Composer if necessary
    curl -sS https://getcomposer.org/installer | php

Run composer install
    php -f composer.phar install


### Part I. Abstract Model


**Subjects tested: OO Concepts, MySQL CRUD, Object-relational mapping**

In this folder you will find

    Contact.php
    contacts.sql
    contact_test.php

You will be building the abstract class that Contact should extend from (currently named AbstractModel)

You will need to:

1. Import contacts.sql into a MySQL database

2. Write AbstractModel.php with the following methods

        public function save()
        public function load($id)
        public function delete($id)
        public function getData($key=false)
        public function setData($arr, $value=false)
You will need to make database calls in these methods. Use one of the following adapters:

        PDO
        MySQL
        MySQLi

3. Ensure contacts_test.php runs correctly (the expected output is in the file)—this is basically a unit test

**NOTE**: You do not need to make AbstractModel work with composite keys. (Assume all models extending from this table use a single primary key)


=========================================================================================
### Part II. Framework

**Subjects tested: MVC, Framework Exposure**

Using the framework of your choice, incorporate the abstract model into a simple application.

**Application guidelines**:

1. Must have the following web page <code>myapp/contact/view?id=[some_id]</code> or <code>myapp/contact/view/[some_id]</code> which displays all of the contact's information for the given id.

2. Must use the Contact model shown above to load the record.


=========================================================================================
### Part III. GitHub

1. Commit your changes to your forked repository and issue a pull request to this repository.

Good luck!
