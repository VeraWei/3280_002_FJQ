<?php

// Please rename me according to the naming convention

// require the config
require_once("inc/config.inc.php");

// require all the entities
require_once("inc/Entity/Facility.class.php");
require_once("inc/Entity/Page.class.php");
require_once("inc/Entity/Reservation.class.php");

// require all the utilities: PDO and DAO(s)
require_once("inc/Utility/FacilityDAO.class.php");
require_once("inc/Utility/PDOService.class.php");
require_once("inc/Utility/ReservationDAO.class.php");

//Initialize the DAO(s)
FacilityDAO::initialize("Facility");
ReservationDAO::initialize("Reservation");


//If there was post data from an edit form then process it
if (!empty($_POST)) {
    
    // if it is an edit (remember the hidden input)
    if($_POST['action']=="edit"){
        //Assemble the Reservation to update        
        $reservationToEdit = ReservationDAO::getReservation($_POST['reservationid']);
        
        $reservationToEdit->setName($_POST['name']);
        $reservationToEdit->setFacilityID($_POST['facilityid']);
        $reservationToEdit->setReservationDate($_POST['date']);
        $reservationToEdit->setLength($_POST['length']);
        //Send the Reservation to the DAO to be updated
        ReservationDAO::updateReservation($reservationToEdit);
    } else {
        // it is not an edit... it means create a new record
        
        $newReservation = new Reservation;
        $newReservation->setName($_POST['name']);
        $newReservation->setEmail($_POST['email']);
        $newReservation->setFacilityID($_POST['facilityid']);
        $newReservation->setReservationDate($_POST['date']);
        $newReservation->setLength($_POST['length']);
        
        // //Add the book to the database
        ReservationDAO::createReservation($newReservation);
        //Assemble the Reservation to Insert/Create
        
        //Send the Reservation to the DAO for creation
    }
 
}

//If there was a delete that came in via GET
if (isset($_GET["action"]) && $_GET["action"] == "delete")  {
    //Use the DAO to delete the corresponding Reservation
    ReservationDAO::deleteReservation($_GET['id']);
}

// Display the header (remeber to set the title/heading)
Page::$title = "Final Project: PDO CURD - Group 1";
// Call the HTML header
Page::header();

// List all reservations.
// Note: You need to use the results from the corresponding DAO that gives you the reservation list
$reservations = ReservationDAO::getReservationList();

Page::listReservations($reservations);

$facilities = FacilityDAO::getFacility();

//If there was a edit that came in via GET
if (isset($_GET["action"]) && $_GET["action"] == "edit")  {
    // Use the DAO to pull that specific reservation
    // Hint: notice the url link for delete.... you should have something similar with edit
    // And you can access it through $_GET

    // Render the  Edit Section form with the reservation to edit.
    $reservationToEdit = ReservationDAO::getReservation($_GET['id']);
    
    Page::editReservationForm($reservationToEdit, $facilities);
    
    // Rememver to use the correct DAO to get the facility list
    
} else {
    // Otherwise, it is a create reservation form
    Page::createReservationForm($facilities);
    
}

// Finally I need to call the last function from the HTML
Page::footer();

?>
