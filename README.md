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

Install
-------------------------------------------- 
import database.sql dans la bdd <br>
Change le config.php pour correspondre à la bdd

Some words to describe the app.. HackMe !

Vulnerabilities
===============

1.1 XSS: Allow to inject code via pagination
--------------------------------------------

In feedbacks list page, a GET parameter `page` is vulnerable to XSS attack.

1.2 Proof of concept
~~~~~~~~~~~~~~~~~~~~~

http://localhost/feedbacks.php?page="><script>alert('hello');</script>
~~~~~~~~~~~~~~~~~~~~~
1.3 Code
~~~~~~~~

File: `feedbacks.php`, line: 182.

    <a href="#" class="current-page"><?= replace(array('<', '>'), '', $_GET['id']) ?></a>
~~~~~~~~~~~~~~~~~~~~~
1.4 Fix
~~~~~~~

   <a href="#" class="current-page"><?= htmlentities($_GET['id']) ?></a>


...