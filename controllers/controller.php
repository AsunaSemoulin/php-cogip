<?php
require("./models/model.php");

class Controller {

    public function getWelcome($response="") {
        $db = new DataBase();
        $description="Bienvenue";
        $title="Page de Bienvenue";
        $responses=$response;
        if (isset($_SESSION['modegod'])) {
            if ($_SESSION['modegod']==1) require("./views/welcome_god.php");
            else require("./views/welcome.php");
        }
        else require("./views/welcome.php");
    }

    public function getCompanies() {
        $db = new DataBase();
        $description="Company list";
        $title="Companies";
        require("./views/companies.php");
    }

    public function getInvoices() {
        $db = new DataBase();
        $description="Invoice list";
        $title="Invoice";
        require("./views/invoices.php");
    }

    public function getContacts() {
        $db = new DataBase();
        $description="Contact list";
        $title="Contact";
        require("./views/contacts.php");
    }

    public function getProviders() {
        $db = new DataBase();
        $description="Providers list";
        $title="Providers";
        require("./views/providers.php");
    }

    public function getClients() {
        $db = new DataBase();
        $description="Clients list";
        $title="Clients";
        require("./views/clients.php");
    }

    public function getCompanyDetails() {
        $db = new DataBase();
        $description="Information about a company";
        $title="Company detail";
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        require("./views/company_details.php");
    }

    public function getInvoiceDetails() {
        $db = new DataBase();
        $description="Information about an invoice";
        $title="Invoice detail";
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        require("./views/invoice_details.php");
    }

    public function getContactDetails() {
        $db = new DataBase();
        $description="Information about a contact";
        $title="Contact detail";
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        require("./views/contact_details.php");
    }

    public function getProviderDetails() {
        $db = new DataBase();
        $description="Information about a providers";
        $title="Providers informations";
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        require("./views/provider_details.php");
    }

    public function getClientDetails() {
        $db = new DataBase();
        $description="Information about a contact";
        $title="Contact detail";
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        require("./views/client_details.php");
    }

    public function getloginDetails() {
        $db = new DataBase();
        $test = $db->getAllUser();
        if ( isset($_POST['username']) ) {
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $password =  filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            while ($donnee = $test->fetch()) {
                if ($username == $donnee->login AND $password == $donnee->password) {
                    $check = 'welcome';
                    $_SESSION['username'] = $username;
                    $_SESSION['modegod'] = $donnee->modegod;
                }
            }
            if (isset($check)) {
                header('location:index.php?action=welcome');
            } else {
                header('location:index.php?action=login&error=1');
            }
        }
    }

    public function getlogin() {
        $description="login ecran";
        $title="logins";
        require("./views/login.php");
    }

    public function getLogOut() {
        session_destroy();
        header('location:index.php');
    }

    public function getNewInvoice($response="") {
        $db = new DataBase();
        $description="Create new invoice";
        $title="New Invoice";
        $responses=$response;
        $companies = $db->getAllCompany();
        $people = $db->getAllPeople();
        require("./views/new_invoice.php");
    }

    public function getNewPeople($response="") {
        $db = new DataBase();
        $description="Create new contact";
        $title="New Contact";
        $responses=$response;
        $companies = $db->getAllCompany();
        require("./views/new_contact.php");
    }

    public function getNewCompany($response="") {
        $db = new DataBase();
        $description="Create new company";
        $title="New Company";
        $responses=$response;
        require("./views/new_company.php");
    }

    public function setNewPeople() {
        $description="Create new contact";
        $title="New Contact";
        $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $company = filter_var($_POST["company"], FILTER_SANITIZE_NUMBER_INT);

        if (!isset($firstname) OR !isset($name) OR !isset($phone) OR !isset($email) OR !isset($company)) {
            $responses = 'Something is wrong!';
            $this->getNewPeople($responses);

            return;
        }
        // Make sure the form fields are not empty
        if (empty($firstname) OR empty($name) OR empty($phone) OR empty($email) OR empty($company)) {
            $responses = 'Please complete all fields!';
            $this->getNewPeople($responses);

            return;
        }
        $db = new DataBase();
        $db->setNewPeople($firstname, $name, $email, $phone, $company);
        require("./views/new_contact_confirmation_added.php");
    }

    public function setNewInvoice() {
        $description="Create new invoice";
        $title="New Invoice";
        $invoice_number = filter_var($_POST["invoice_number"], FILTER_SANITIZE_STRING);
        $invoice_date_day = filter_var($_POST["invoice_date_day"], FILTER_SANITIZE_NUMBER_INT);
        $invoice_date_month = filter_var($_POST["invoice_date_month"], FILTER_SANITIZE_NUMBER_INT);
        $invoice_date_year = filter_var($_POST["invoice_date_year"], FILTER_SANITIZE_NUMBER_INT);
        $company = filter_var($_POST["company"], FILTER_SANITIZE_NUMBER_INT);
        $contact = filter_var($_POST["contact"], FILTER_SANITIZE_NUMBER_INT);
        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
        if ($invoice_date_day<10) $invoice_date_day = "0" . $invoice_date_day;
        if ($invoice_date_month<10) $invoice_date_month = "0" . $invoice_date_month;
        $invoice_date = $invoice_date_year . "-" . $invoice_date_month . "-" .$invoice_date_day ;

        if (!isset($invoice_number) OR !isset($invoice_date) OR !isset($company) OR !isset($contact)) {
            $responses = 'Something is wrong!';
            $this->getNewInvoice($responses);

            return;
        }
        // Make sure the form fields are not empty
        if (empty($invoice_number) OR empty($invoice_date) OR empty($company) OR empty($contact)) {
            $responses = 'Please complete all fields!';
            $this->getNewInvoice($responses);

            return;
        }

        $db = new DataBase();

        $companies = $db->getCompanyPeople($company);
        $i=0;
        while ($infos = $companies->fetch(PDO::FETCH_ASSOC)) {
            if ($contact == $infos['idpeople']) $i++;
        }

        if ($i==0) {
            $responses = "contact selected don't work for the company selected";
            $this->getNewInvoice($responses);

            return;
        }

        $db->setNewInvoice($invoice_number, $invoice_date, $content, $amount, $company, $contact);
        require("./views/new_invoice_confirmation_added.php");
    }

    public function setNewCompany() {
        $description="Create new company";
        $title="New Company";
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $country = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
        $vat = filter_var($_POST["vat"], FILTER_SANITIZE_STRING);
        $type = filter_var($_POST["type"], FILTER_SANITIZE_NUMBER_INT);


        if (!isset($name) OR !isset($country) OR !isset($vat) OR ($type>2) OR ($type<1)) {
            $responses = 'Something is wrong!';
            $this->getNewCompany($responses);

            return;
        }
        // Make sure the form fields are not empty
        if (empty($name) OR empty($country) OR empty($vat)) {
            $responses = 'Please complete all fields!';
            $this->getNewCompany($responses);

            return;
        }
        $db = new DataBase();
        $db->setNewCompany($name, $country, $vat, $type);
        require("./views/new_company_confirmation_added.php");
    }

    public function setCompany($response="") {
        $db = new DataBase();
        $description="Update a company";
        $title="Update Company";
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        $company_req = $db->getCompanyInfo($id);
        $company = $company_req->fetch(PDO::FETCH_ASSOC);
        $responses=$response;
        require("./views/update_company.php");
    }

    public function setInvoice($response="") {
        $db = new DataBase();
        $description="Update an invoice";
        $title="Update invoice";
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        // requete doesnt exist in the model
        $responses=$response;
        $companies = $db->getAllCompany();
        $people = $db->getAllPeople();
        $invoice_req = $db->getInvoiceInfo ($id);
        $invoice = $invoice_req->fetch(PDO::FETCH_ASSOC);
        $idpeople_req = $db->getInvoiceInfoPeople ($id);
        $result = $idpeople_req->fetch(PDO::FETCH_ASSOC);
        $idpeople = $result['idpeople'];
        $idcompany_req = $db->getCompanyIdFromInvoice ($id);
        $result = $idcompany_req->fetch(PDO::FETCH_ASSOC);
        $idcompany = $result['idcompany'];
        $date=$invoice['date'];
        $year=substr($date, 0, 4);
        $month=substr($date, 5, 2);
        $day=substr($date, 8,2);
        require("./views/update_invoice.php");
    }

    public function setContact($response="") {
        $db = new DataBase();
        $description="Update a contact";
        $title="Update Contact";
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        $companies = $db->getAllCompany();
        $contact_req = $db->getAllInformationPeople ($id);
        $contact = $contact_req->fetch(PDO::FETCH_ASSOC);
        $responses=$response;
        require("./views/update_contact.php");
    }

    public function updateCompany() {
        $db = new DataBase();
        $description="Update a company";
        $title="Update a company";
        $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $country = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
        $vat = filter_var($_POST["vat"], FILTER_SANITIZE_STRING);
        $type = filter_var($_POST["type"], FILTER_SANITIZE_NUMBER_INT);

        if (!isset($name) OR !isset($country) OR !isset($vat) OR ($type>2) OR ($type<1)) {
            $responses = 'Something is wrong!';
            $_GET['id']=$id;
            $this->setCompany($responses);

            return;
        }

        if (empty($name) OR empty($country) OR empty($vat)) {
            $responses = 'Please complete all fields!';
            $_GET['id']=$id;
            $this->setCompany($responses);

            return;
        }

        $company_req = $db->getCompanyInfo($id);
        $company = $company_req->fetch(PDO::FETCH_ASSOC);
        if ($company['idtype']!=$type) {
            $req = $db->getCountCompanyInvoice($id);
            $result = $req->fetch(PDO::FETCH_ASSOC);
            if ($result['nbinvoice']>0) {
                $response="<p>You can modify the type of this company because there are invoice linked to her.</p>
                <p>Please delete or update the invoice before</p>";
                $_GET['id']=$id;
                $this->setCompany($response);

                return;
            }
        }

        $db->setCompany ($id, $name, $country, $vat, $type);
        require ('./views/update_company_confirmation.php');
    }

    public function updatePeople() {
        $db = new DataBase();
        $description="Update a contact";
        $title="Update a contact";
        $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $company = filter_var($_POST["company"], FILTER_SANITIZE_NUMBER_INT);
        $contact_req = $db->getAllInformationPeople($id);
        $contact = $contact_req->fetch(PDO::FETCH_ASSOC);

        if (!isset($firstname) OR !isset($name) OR !isset($phone) OR !isset($email) OR !isset($company)) {
            $responses = 'Something is wrong!';
            $_GET['id']=$id;
            $this->setContact($responses);

            return;
        }
        // Make sure the form fields are not empty
        if (empty($firstname) OR empty($name) OR empty($phone) OR empty($email) OR empty($company)) {
            $responses = 'Please complete all fields!';
            $_GET['id']=$id;
            $this->setContact($responses);

            return;
        }

        if ($contact['idcompany']!=$company) {
            $req = $db->getCountPeopleInvoice($id);
            $result = $req->fetch(PDO::FETCH_ASSOC);
            if ($result['nbinvoice']>0) {
                $response="<p>You can modify the contact company because there are invoice linked to him.</p>
                <p>Please delete or update the invoice before</p>";
                $_GET['id']=$id;
                $this->setContact($response);

                return;
            }
        }
        $db->setPeople ($id, $firstname, $name, $email, $phone, $company);
        require ('./views/update_contact_confirmation.php');
    }

    public function updateInvoice() {
        $description="Update an invoice";
        $title="update an invoice";
        $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        $invoice_number = filter_var($_POST["invoice_number"], FILTER_SANITIZE_STRING);
        $invoice_date_day = filter_var($_POST["invoice_date_day"], FILTER_SANITIZE_NUMBER_INT);
        $invoice_date_month = filter_var($_POST["invoice_date_month"], FILTER_SANITIZE_NUMBER_INT);
        $invoice_date_year = filter_var($_POST["invoice_date_year"], FILTER_SANITIZE_NUMBER_INT);
        $company = filter_var($_POST["company"], FILTER_SANITIZE_NUMBER_INT);
        $contact = filter_var($_POST["contact"], FILTER_SANITIZE_NUMBER_INT);
        $amount = filter_var($_POST["amount"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $content = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
        if ($invoice_date_day<10) $invoice_date_day = "0" . $invoice_date_day;
        if ($invoice_date_month<10) $invoice_date_month = "0" . $invoice_date_month;
        $invoice_date = $invoice_date_year . "-" . $invoice_date_month . "-" .$invoice_date_day ;
        if (!isset($invoice_number) OR !isset($invoice_date) OR !isset($company) OR !isset($contact)) {
            $responses = 'Something is wrong!';
            $_GET['id']=$id;
            $this->setInvoice($responses);

            return;
        }
        // Make sure the form fields are not empty
        if (empty($invoice_number) OR empty($invoice_date) OR empty($company) OR empty($contact)) {
            $responses = 'Please complete all fields!';
            $_GET['id']=$id;
            $this->setInvoice($responses);

            return;
        }

        $db = new DataBase();
        $companies = $db->getCompanyPeople($company);
        $i=0;
        while ($infos = $companies->fetch(PDO::FETCH_ASSOC)) {
            if ($contact == $infos['idpeople']) $i++;
        }

        if ($i==0) {
            $responses = "contact selected don't work for the company selected";
            $_GET['id']=$id;
            $this->setInvoice($responses);

            return;
        }

        $db->setInvoice ($id, $invoice_number, $invoice_date, $content, $amount, $contact, $company);
        require ('./views/update_invoice_confirmation.php');
    }

    public function unsetInvoice()
    {
        if (isset($_GET["id"])) $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

        if (!isset($id)) {
            $responses = 'Something is wrong!';
            $this->getWelcome($responses);

            return;
        }
        // Make sure the form fields are not empty
        if (empty($id)) {
            $responses = "You shouldn't be there !!! stop playing with this dude !";
            $_GET['id']=$id;
            $this->getWelcome($responses);

            return;
        }

        $db = new DataBase();
        $db->unsetInvoice ($id);
        $responses = "Invoice deleted succesfully";
        $this->getWelcome($responses);
    }

    public function unsetCompany()
    {
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        $db = new DataBase();

        if (!isset($id)) {
            $responses = 'Something is wrong!';
            $this->getWelcome($responses);

            return;
        }
        // Make sure the form fields are not empty
        if (empty($id)) {
            $responses = "You shouldn't be there !!! stop playing with this dude !";
            $_GET['id']=$id;
            $this->getWelcome($responses);

            return;
        }

        $req = $db->getCountCompanyInvoice($id);
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result['nbinvoice']>0) {
            $response="<p>You can delete this company because there are invoice linked to her.</p>
            <p>Please delete or update the invoice before</p>";
            $_GET['id']=$id;
            $this->getWelcome($response);

             return;
        }

        $db->unsetCompany ($id);
        $responses = "Company deleted succesfully";
        $this->getWelcome($responses);
    }

    public function unsetPeople()
    {
        $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
        $db = new DataBase();
        $contact_req = $db->getAllInformationPeople($id);
        $contact = $contact_req->fetch(PDO::FETCH_ASSOC);

        if (!isset($id)) {
            $responses = 'Something is wrong!';
            $this->setWelcome($responses);

            return;
        }
        // Make sure the form fields are not empty
        if (empty($id)) {
            $responses = "You shouldn't be there !!! stop playing with this dude !";
            $_GET['id']=$id;
            $this->getWelcome($responses);

            return;
        }

        $req = $db->getCountPeopleInvoice($id);
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result['nbinvoice']>0) {
            $responses="<p>You can delete the contact because there are invoice linked to him.</p>
            <p>Please delete or update the invoice before</p>";
            $_GET['id']=$id;
            $this->getWelcome($responses);

             return;
        }

        $db->unsetPeople($id);
        $responses = "Contact deleted succesfully : nbinvoice " .$result['nbinvoice'] ;
        $this->getWelcome($responses);
    }


}