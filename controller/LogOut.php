<?php

//Start the sesion.
session_start();

//Unset the data
unset($_SESSION);

//Destroy the sesison
session_destroy();

//Show Logout page
LogPage::header();
LogPage::displayTeam();
LogPage::footer();

?>