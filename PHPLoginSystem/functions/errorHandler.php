<?php

function errorHandler($e) {
     if($e == 1) {
          echo "Empty Imputs";
     }

     if($e == 2) {
          echo "For the First Name and Last Name you can use only letters";
     }

     if($e == 3) {
          echo "You can't user special characters in username";
     }

     if($e == 4) {
          echo "Invalid Email";
     }

     if($e == 5) {
          echo "Password must be at least 8 characters long";
     }

     if($e == 6) {
          echo "Password must contain a big characters, a small one and a number";
     }

     if($e == 7) {
          echo "Passwords don`t match";
     }

     if($e == 8) {
          echo "Account already exists";
     }
}