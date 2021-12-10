<?php
session_start();
require("./controllers/controller.php");

$controller = new Controller();

if (isset($_GET["action"])) {
    if ($_GET["action"] == "welcome") {
        $controller->getWelcome();
    }

    if ($_GET["action"] == "clients") {
        $controller->getClients();
    }

    if ($_GET["action"] == "client_details") {
        $controller->getClientDetails();
    }

    if ($_GET["action"] == "providers") {
        $controller->getProviders();
    }

    if ($_GET["action"] == "provider_details") {
        $controller->getProviderDetails();
    }

    if ($_GET["action"] == "contacts") {
        $controller->getContacts();
    }

    if ($_GET["action"] == "contact_details") {
        $controller->getContactDetails();
    }

    if ($_GET["action"] == "invoices") {
        $controller->getInvoices();
    }

    if ($_GET["action"] == "invoice_details") {
        $controller->getInvoiceDetails();
    }

    if ($_GET["action"] == "companies") {
        $controller->getCompanies();
    }

    if ($_GET["action"] == "company_details") {
        $controller->getCompanyDetails();
    }

    if ($_GET["action"] == "login") {
        $controller->getLogin();
    }

    if ($_GET["action"] == "new_contact") {
        $controller->getNewPeople();
    }

    if ($_GET["action"] == "new_invoice") {
        $controller->getNewInvoice();
    }

    if ($_GET["action"] == "new_company") {
        $controller->getNewCompany();
    }

    if ($_GET["action"] == "logout") {
        $controller->getLogOut();
    }

    if ($_GET["action"] == "update_contact") {
        $controller->setContact();
    }

    if ($_GET["action"] == "update_invoice") {
        $controller->setInvoice();
    }

    if ($_GET["action"] == "update_company") {
        $controller->setCompany();
    }

    if ($_GET["action"] == "unset_company") {
        $controller->unsetCompany();
    }

    if ($_GET["action"] == "delete_contact") {
        $controller->unsetPeople();
    }

    if ($_GET["action"] == "delete_invoice") {
        $controller->unsetInvoice();
    }

}

if (isset($_POST["action"])) {
    if ($_POST["action"] == "login_details") {
        $controller->getloginDetails();
    }

    if ($_POST["action"] == "new_contact") {
        $controller->setNewPeople();
    }

    if ($_POST["action"] == "new_invoice") {
        $controller->setNewInvoice();
    }

    if ($_POST["action"] == "new_company") {
        $controller->setNewCompany();
    }

    if ($_POST["action"] == "update_contact") {
        $controller->updatePeople();
    }

    if ($_POST["action"] == "update_invoice") {
        $controller->updateInvoice();
    }

    if ($_POST["action"] == "update_company") {
        $controller->updateCompany();
    }
}

if (!isset($_GET['action']) AND !isset($_POST['action'])) {
    $_GET['action']="login";
    $controller->getLogin();
}