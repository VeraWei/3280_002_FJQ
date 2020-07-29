<?php

//Start the sesion... one last time!
session_start();

//Unset the data
unset($_SESSION);

//Destroy the sesison
session_destroy();
LogPage::header();

LogPage::displayTeam();

LogPage::footer();

?>