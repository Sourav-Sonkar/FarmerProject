<?php
$email = "hello@gmail."; 
$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
if (preg_match($regex, $email)) {
 echo $email . " is a valid email. We can accept it.";
} else { 
 echo $email . " is an invalid email. Please try again.";
}           
?>