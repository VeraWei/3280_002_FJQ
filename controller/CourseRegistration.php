<?php 

RegistrationDAO::initialize('RegistrationUser');
//if(isset($_POST['username'])){
$RegistrationUser = RegistrationDAO::getCourses(/*$_POST['username']*/ 300000000);
    var_dump($RegistrationUser);
//}

RegistrationPage::PrintHeader();
RegistrationPage::printTable($RegistrationUser);
RegistrationPage::PrintForm();
RegistrationPage::PrintFooter();

?>