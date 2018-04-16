Audi Security Quattro

========



Members

-------------------------------------------- 

Marie Cogis<br>

Piere-louis Signoret<br>

Pierre Coursier<br>

Yannig Smagghe<br>

-------------------------------------------- 





Name of target : 

Erwin





à faire :

<strike>sql injection</strike><br>

<strike>sql blind</strike><br>

file upload</strike><br>

file inclusion</strike><br>

<strike>XSS</strike><br>

command injection</strike><br>







Vulnerabilities



Page login :

social Engineering : admin password



page Disney Search :



page profile.php

    Vulnerabilites XSS

    command : <script>alert('ok')</script>

    result : popup ok

    

    With this security breach every time "name" is called, script is execute because he is on database

    



Vulnerabilities

===============



##1 SqlInjection 



    

### 1.1 Proof of concept

The vulnerable page is "disney.php"

You can enter this line in the "Rechercher un personnage Disney" field : 

~~~~~~~~~~

1' OR 1=1 #

~~~~~~~~~~

This return all the content of the table on which the request is performed

### 1.2 Code



Most likely the code behind the request is something like this : 

~~~~~~~~~~~

SELECT id, name FROM personnages WHERE name = '$name'

~~~~~~~~~~~

The variable $name probably doesn't escape " ' " 

### 1.3 Fix

Use the following code line :

~~~~~~~~~~~~

mysql_real_escape($name)

~~~~~~~~~~~~



##2 SqlInjection BLIND

### 2.1 Proof of concept

~~~~~~~~~~~

1 AND substring(version(), 1, 1) = 4

~~~~~~~~~~~

This return a message informing the request has failed, when we enter

~~~~~~~~~~~

1 AND substring(version(), 1, 1) = 5

~~~~~~~~~~~

The message indicates the request was successful. 



### 2.2 Code



The idea in the line code is checking if the request returned results or not, the request probably looks like :

~~~~~~~~~~~~

SELECT id FROM personnages WHERE id = $id 

~~~~~~~~~~~~



### 2.3 Fix

Actually you have two ways to protect yourself against this failure :

You can use simple quotes and escape some character, and make the request look like this :

~~~~~~~~~~~

SELECT id FROM personnages WHERE id = '$id'



with



mysql_real_escape_string on $id 

~~~~~~~~~~~



##3 XSS

### 3.1 Proof of concept

The vulnerable page is profil.php

You can enter this code in the name modification field :

~~~~~~~~~~~

<script>alert('ok')</script>

The result launch a pop-up with the 'ok' message

~~~~~~~~~~~

### 3.2 Code

~~~~~~~~~~~

the code is normal but it does not use protections like described in next part.

~~~~~~~~~~~

### 3.3 Fix

To fix this kind of leaks you can use :

~~~~~~~~~~~

htmlEntities

~~~~~~~~~~~





##4 Social engineering

### 4.1 Proof of concept

Social engineering failure append on the first page of the website, on the login box

Sometimes, trying the easiest way can be the good way

The developpement team told us that it is fully protected but we succeded to get in by using :

~~~~~~~~~~~

login : admin

pwd :   password

~~~~~~~~~~~

### 4.2 Code

The code has no actual leak



### 4.3 fix

~~~~~~~~~~~

to fix this kind of problems, you just have to not use too simple passwords or user-names,

thats why many websites force you to use special character or upper-case ones.

~~~~~~~~~~~



Retreived Data 

==============



### Database 



#### Général 

#####Name  

* quattro 



#####Tables  

* disney

    * id     int(6) unsigned

    * name    varchar(30 

* comments

    * comment  varchar(255)    

    * id       int(6) unsigned 

    * name     varchar(30)

* users

    * comment  varchar(255)    

    * id       int(6) unsigned 

    * name     varchar(30)



### Content



####users



1   test admin  $2y$15$VyBAGsKjne5J4IUp67TUO.vc628oZ23I0yd40AjXj26bcm3wgN5XW 



2   1    user   $2y$15$ZapZXnoKpcqwka5ZG5QX4ekDNZcQ0nhsAOq4JE7a18EEEgpFEDCfK



Password seems to have been encrypt with something else than md5



####disney

1   Mulan       

2   Blanche-neige 

3   Kairi         

4   Lumiere       

5   Belle         

6   Aurore        

7   Cendrillon    

8   Nala          

9   Minnie        

10  Ariel         

11  Miguel        

12  Jasmine       

13  Raiponce      

14  M\xe9rida     

15  Tiana         

16  Pocahontas    

17  Mickey        

18  Donald        

19  Pluto         

20  Dingo         

21  Riri          

22  Fifi          

23  Loulou        

24  Daisy         

25  Aladin        

26  Bambi         

27  Anna          

28  Bouriquet     

29  Buzz          

30  Clochette     

31  Dumbo         

32  Flash         

33  Lilo          

34  Stitch        

35  Marie         

36  N\xe9mo       

37  Bob           

38  Boo           

39  Sullivan      

40  Pinocchio     

41  Olaf          

42  Porcinet      

43  Winnie        

44  Tigrou        

45  Tic           

46  Tac           

47  Wall-E        

48  Eve           

49  Woody         

50  Vaiana        

51  Peter Pan     

52  Sofia         

53  Big Ben       

54  Elsa   

####coments



Originnaly the table is empty but we can get the data after our test and see that it contains : 



38  test      test                           

39  1 or 1=1  test                           

40  test      1 OR 1=1                       

41  test      1 union select nom from users; 

42  test      test                           
