<?php

 include('connection.php');

 //create an sql querry that is going to connect to the database and get the products

 //this variable conn is in connection.php

 $statement=$conn->prepare("SELECT * from products LIMIT 6");

 $statement->execute();

 $featured_products=$statement->get_result();

 //video 57 moitié 









?>