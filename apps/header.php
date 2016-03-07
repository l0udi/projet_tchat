<?php
if (isset($_SESSION['id'], $_SESSION['login']))
{
  if ($_SESSION['admin'] == true) {
   require('views/header_admin.phtml');
 } 
  else {
   require('views/header_in.phtml');
 } 
}
 else {
  require('views/header.phtml');
 }
 ?>