Hack ME  (CRUD) in PHP & MySQL
========

Members
-------------------------------------------- 
Marie Cogis<br>
Piere-louis Signoret<br>
Pierre Coursier<br>
Yannig Smagghe<br>
-------------------------------------------- 

:application_path: ./

:database_path: ./database.sql

Description
--------------------------------------------

This app has several functionalities : 
* Register as a new user
    * Allows you to update your profile informations
* Login as a known user
* Search for comic books
* a Link to Bonus 
* Comment a book  
* A bonus game for tryharders


Install
-------------------------------------------- 
import database.sql in the database <br>
Modify config.php to match the database
<to unlock bonus game>
cp .htpasswd  /etc/apache2 

Vulnerabilities
===============

1 XSS: Allow to inject code via pagination
--------------------------------------------

In feedbacks list page, a GET parameter `page` is vulnerable to XSS attack.

1.1 Proof of concept
~~~~~~~~~~~~~~~~~~~~~
Page : fiche.php (books list -> select one)
    You need to change input type from "email" to "text" and increase "maxlength" from 30 to whatever you want
    In the name field you can load JS script, however u can't use :
        - <script>
        - <SCRIPT>
        - alert 
        - console.log
~~~~~~~~~~~~~~~~~~~~~
1.2 Code
~~~~~~~~
    File : fiche.php
    
    function verif_script($user){
        if(strstr($user, '<script>')){
            echo '<h1 style="color: red;">hahahaha</h1>';
            return false;
        }
        return true;
    }
    
    if(verif_script($user_name) && !empty($_POST)){
        $add_comment = mysqli_query($mysqli, "
    INSERT INTO commentaries (user_name, commentarie, comics_name) VALUES ('$user_name', '$comment', '$name');
    ");
    }
~~~~~~~~
1.3 Fix
~~~~~~~~~~~~~~~~~~~~
    htmlentities on $name
~~~~~~~~~~~~~~~~~~~~

2 SQL Injection
---------------
1.1 Proof of concept

<b>A Vérifier</b>
~~~~~~~~~~~~~~~~~~~
Page : search book

Modify the select value (inspect code) and enter 1 OR 1=1, this returns all the books in the database
~~~~~~~~~~~~~~~~~~~

1.2 Code
~~~~~~~~
File : search.php

Line : $result = mysqli_query($mysqli, "SELECT denomination,id, denomination_secondaire, code 
                                        FROM comics 
                                        WHERE id = $data; ");
~~~~~~~~
1.3 Fix
~~~~~~~
Replace $data with '$data' in the line above
~~~~~~~
3 SQL Blind Injection
---------------------
1.1 Proof of concept
~~~~~~~~~~~~~~~~~~~
Page : login.php

Login as "USER' AND substring(version(), 1, 1) = 5 AND 'test'='test" with your password let u loging in.
If u replace the version tested by 4, connexion will fail. 
~~~~~~~~~~~~~~~~~~~
1.2 Code
~~~~~~~~
File login.php

Line :     $result = mysqli_query($mysqli, "SELECT IF( EXISTS(
                   SELECT denomination
                   FROM people
                   WHERE `denomination` =  '" . $login . "' AND `code_2_connexion` = '" . $hashed_password . "'), true, false)");
           $res = mysqli_fetch_array($result);

            if ($res[0] === '1'){
                header('Location: profil.php');
            } 
~~~~~~~~
1.3 Fix
~~~~~~~
Escape string of $login
~~~~~~~
4 File upload
-------------
1.1 Proof of concept
~~~~~~~~~~~~~~~~~~~
Page profil.php

Possibility to load fake .png files, they need to be at least > 10Ko
~~~~~~~~~~~~~~~~~~~

1.2 Code
~~~~~~~~
File profile.php
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
~~~~~~~~

1.3 Fix
~~~~~~~
Use dedicated library to upload image files, modify rights on the upload folder
~~~~~~~
5 File inclusion
----------------
1.1 Proof of concept
~~~~~~~~~~~~~~~~~~~
File inclusion, on the page "Book Reader", u can enter in the URL a file u previously loaded on our profile

Exemple of URL : http://hackme.lo/livres/liseuse.php/?livres=../uploads/malicious_image.png
~~~~~~~~~~~~~~~~~~~

1.2 Code
~~~~~~~~
File : livres/liseuse.php

Inclusion happen here:
<?php
include($_GET['livres']);

Link to this page : 
$message = "<li><a href=liseuse.php/?livres=". $entry . ">" . $entry . "</a></li>";

~~~~~~~~

1.3 Fix
~~~~~~~
Never use include to display the data content
~~~~~~~

6 Social engineering
--------------------
1.1 Proof of concept
~~~~~~~~~~~~~~~~~~~
Page : Bonus game (admin/admin.php)

Pretty easy to Brute force password with low security (spoiler alert : admin)
~~~~~~~~~~~~~~~~~~~

1.2 Code
~~~~~~~~
In .htaccess :
AuthType Basic
AuthName "Restricted Content"
AuthUserFile /etc/apache2/.htpasswd
Require valid-user
~~~~~~~~
~~~~~~~~
In .htpasswd :
admin:$apr1$63jI7gXQ$g14mHyE0uRASXmOnWGhxS1
~~~~~~~~

1.3 Fix
~~~~~~~
Don't be a retard, use a more complex password.
~~~~~~~