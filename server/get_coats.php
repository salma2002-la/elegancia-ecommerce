<?php

 include('connection.php');

 //create an sql querry that is going to connect to the database and get the products

 //this variable conn is in connection.php

 $statement=$conn->prepare("SELECT * from products WHERE product_category='Пальто'   LIMIT 6");

 $statement->execute();

 $coats_products=$statement->get_result();

 //video 57 moitié     php -S localhost:8000









?>