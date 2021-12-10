<?php

class DataBase
{
//    David
    private $db='cogip';
    private $login = 'root';
    private $pass ='';
    private $connec;

//    private $db='david_vangoidtsnoven_becogip';
//    private $login = 'david_vangoidtsnoven_becogip';
//    private $pass ='fGDfgTF69542(2@@';
//    private $connec;

    public function __construct(){
          $this->connexion();
     }

    private function connexion() {
        try {
            $bdd = new PDO('mysql:host=localhost;dbname='.$this->db.';charset=utf8', $this->login, $this->pass);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->connec = $bdd;
        }

        catch (PDOException $e) {
            $msg = 'ERROR PDO in' . $e->getfile() . 'L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($msg);
        }

    }

    public function getAllPeople () {
        $req = $this->connec->prepare("SELECT p.id, p.firstname, p.lastname, p.email, p.phone, c.name 
                                       FROM people p, company c, people_company pc 
                                       WHERE p.id=pc.idpeople AND pc.idcompany=c.id
                                       ORDER BY lastname ASC");
        $req->execute();

        return $req;
    }

    public function getAllCompany () {
        $req = $this->connec->prepare("SELECT id, name, country, vat 
                                       FROM company 
                                       ORDER BY name ASC");
        $req->execute();

        return $req;
    }

    public function getAllInvoice() {
        $req = $this->connec->prepare("SELECT i.id, i.number, i.date, i.content, i.amount, c.name , t.name
                                       FROM invoice i, company c, companytype t, invoice_company ic, company_type ct
                                       WHERE i.id=ic.idinvoice AND c.id=ic.idcompany AND c.id=ct.idcompany AND t.id=ct.idtype
                                       ORDER BY date DESC");
        $req->execute();

        return $req;
    }

    public function getAllType() {
        $req = $this->connec->prepare("SELECT id, name 
                                       FROM companytype 
                                       ORDER BY name ASC");
        $req->execute();

        return $req;
    }

    public function getFiveLastInvoice() {
        $req = $this->connec->prepare("SELECT i.id AS id, i.number, i.date, i.content, i.amount, c.name 
                                       FROM invoice i, company c, invoice_company ic
                                       WHERE i.id=ic.idinvoice AND c.id=ic.idcompany
                                       ORDER BY date DESC LIMIT 0,5");
        $req->execute();

        return $req;
    }

    public function getFiveLastPeople () {
        $req = $this->connec->prepare("SELECT p.id AS id, p.firstname, p.lastname, p.email, p.phone, c.name 
                                       FROM people p, company c, people_company pc 
                                       WHERE p.id=pc.idpeople AND pc.idcompany=c.id
                                       ORDER BY id DESC LIMIT 0,5");
        $req->execute();

        return $req;
    }

    public function getFiveLastCompany () {
        $req = $this->connec->prepare("SELECT c.id as id, c.name as name, c.country as country, c.vat as vat, t.name as type 
                                       FROM company c, companytype t, company_type ct
                                       WHERE c.id=ct.idcompany AND t.id=ct.idtype
                                       ORDER BY id DESC LIMIT 0,5");
        $req->execute();

        return $req;
    }

    public function getAllCompanyClient () {
        $req = $this->connec->prepare("SELECT c.id, c.name, c.country, c.vat 
                                       FROM company c, company_type t 
                                       WHERE c.id=t.idcompany AND t.idtype=1 ORDER BY name ASC");
        $req->execute();

        return $req;
    }

    public function getAllCompanySupplier () {
        $req = $this->connec->prepare("SELECT c.id, c.name, c.country, c.vat 
                                       FROM company c, company_type t 
                                       WHERE c.id=t.idcompany AND t.idtype=2 ORDER BY name ASC");
        $req->execute();

        return $req;
    }

    public function getAllInformationPeople ($id) {
        $req = $this->connec->prepare("SELECT p.firstname AS firstname, p.lastname AS lastname, p.email AS email, p.phone AS phone, c.id AS idcompany, c.name as companyname 
                                       FROM people p, company c, people_company pc 
                                       WHERE p.id='$id' AND p.id=pc.idpeople AND pc.idcompany=c.id ");
        $req->execute();

        return $req;
    }

    public function getAllInvoiceOfOnePeople ($id) {
        $req = $this->connec->prepare("SELECT DISTINCT i.number AS number, i.date AS date, i.amount AS amount, p.phone AS phone 
                                       FROM invoice i, people_invoice pi, people p
                                       WHERE  p.id='$id' AND i.id=pi.idpeople AND pi.idinvoice=p.id
                                       ORDER BY date desc");
        $req->execute();

        return $req;
    }

    public function getCountPeopleInvoice ($id) {
        $req = $this->connec->prepare("SELECT COUNT(*) as  nbinvoice
                                       FROM invoice i, people_invoice pi, people p
                                       WHERE  p.id='$id' AND i.id=pi.idpeople AND pi.idinvoice=p.id
                                       ORDER BY date desc");
        $req->execute();

        return $req;
    }

    public function getInvoiceInfo ($id) {
        $req = $this->connec->prepare("SELECT number AS number, date AS date, content AS content, amount as amount
                                       FROM invoice
                                       WHERE id='$id'");
        $req->execute();

        return $req;
    }

//NOT GOOD
    public function getInvoiceInfoCompany ($id) {
        $req = $this->connec->prepare("SELECT c.name AS companyname, c.country AS country, c.vat AS vat, ct.name as type
                                       FROM invoice i, company c, invoice_company ic, company_type ctj, companytype ct
                                       WHERE i.id='$id' AND ic.idinvoice='$id' AND ic.idcompany=c.id AND c.id=ctj.idcompany AND
                                             ctj.idcompany=ct.id");
        $req->execute();

        return $req;
    }

    public function getInvoiceInfoPeople ($id) {
        $req = $this->connec->prepare("SELECT p.id AS idpeople, p.firstname AS firstname, p.lastname AS lastname, p.email AS emailcontact, p.phone AS phone
                                       FROM invoice i, people p, people_invoice pi
                                       WHERE i.id='$id' AND pi.idinvoice=i.id AND pi.idpeople=p.id");
        $req->execute();

        return $req;
    }

    public function getCompanyIdFromInvoice ($id) {
        $req = $this->connec->prepare("SELECT idcompany AS idcompany
                                       FROM invoice_company
                                       WHERE idinvoice='$id'");
        $req->execute();

        return $req;
    }

    // number, date content amount 'name du type'
    public function getAllInvoiceCompany ($id) {
        $req = $this->connec->prepare("SELECT i.number AS number, i.date AS date, i.content AS content, i.amount AS amount, ct.name as type
                                       FROM invoice i, company c, invoice_company ic, company_type ctj, companytype ct
                                       WHERE c.id='$id' AND i.id=ic.idinvoice AND c.id=ic.idcompany AND c.id=ctj.idcompany AND ctj.idcompany=ct.id");
        $req->execute();

        return $req;
    }


    public function getCompanyInfo($id) {
        $req = $this->connec->prepare("SELECT c.id AS idcompany, c.name AS name, c.country AS country, c.vat AS vat, ct.id as idtype, ct.name AS type 
                                       FROM company c, companytype ct, company_type ctj 
                                       WHERE c.id='$id' AND c.id=ctj.idcompany AND ctj.idtype=ct.id");
        $req->execute();

        return $req;
    }

    public function getCompanyPeople($id) {
        $req = $this->connec->prepare("SELECT p.id AS idpeople, p.firstname, p.lastname, p.email, p.phone
                                       FROM people p, company c, people_company pc
                                       WHERE p.id=pc.idpeople AND pc.idcompany=c.id AND c.id='$id'");
        $req->execute();

        return $req;
    }

    public function getCompanyInvoice($id) {
        $req = $this->connec->prepare("SELECT i.number AS number, i.date AS date, i.content AS content, i.amount AS amount
                                       FROM invoice i, company c, invoice_company ic
                                       WHERE i.id=ic.idinvoice AND c.id=ic.idcompany AND c.id='$id'");
        $req->execute();

        return $req;
    }

    public function getCountCompanyInvoice($id) {
        $req = $this->connec->prepare("SELECT COUNT(*) as nbinvoice
                                       FROM invoice i, company c, invoice_company ic
                                       WHERE i.id=ic.idinvoice AND c.id=ic.idcompany AND c.id='$id'");
        $req->execute();

        return $req;
    }

    public function getUserConnection($username, $password) {
        $req = $this->connec->prepare("SELECT password 
                                       FROM user 
                                       WHERE username='$username'");
        $req->execute();
        $row = $req->fetch();
        $pass = $row->password;
        if (password_verify($password, $pass)) {
            return "ok";
        }

        return "notok";
    }

    public function getUser($id) {
        $req = $this->connec->prepare("SELECT firstname, lastname, login, email, password, modegod 
                                       FROM user 
                                       WHERE id='$id'");
        $req->execute();

        return $req;
    }

    public function getAllUser() {
        $req = $this->connec->prepare("SELECT firstname, lastname, login, email, password, modegod
                                       FROM user");
        $req->execute();

        return $req;
    }


    public function setNewPeople($firstname, $lastname, $email, $phone, $idcompany) {
        $req = $this->connec->prepare("INSERT INTO people (firstname, lastname, email, phone) 
                                        VALUES ('$firstname', '$lastname', '$email', '$phone')");
        $req->execute();
        $idpeople = $this->connec->lastInsertId();
        $req = $this->connec->prepare("INSERT INTO people_company (idpeople, idcompany) 
                                        VALUES ('$idpeople', '$idcompany')");
        $req->execute();
    }

    public function setNewCompany($name, $country, $vat, $idtype) {
        $req = $this->connec->prepare("INSERT INTO company (name, country, vat) 
                                        VALUES ('$name', '$country', '$vat')");
        $req->execute();
        $idcompany = $this->connec->lastInsertId();
        $req = $this->connec->prepare("INSERT INTO company_type (idcompany, idtype) 
                                        VALUES ('$idcompany', '$idtype')");
        $req->execute();
    }

    public function setNewInvoice($number, $date, $content, $amount, $idcompany, $idpeople) {
        $req = $this->connec->prepare("INSERT INTO invoice (number, date, content, amount) 
                                        VALUES ('$number', '$date', '$content', '$amount')");
        $req->execute();
        $idinvoice = $this->connec->lastInsertId();
        $req = $this->connec->prepare("INSERT INTO invoice_company (idcompany, idinvoice) 
                                        VALUES ('$idcompany', '$idinvoice')");
        $req->execute();
        $req = $this->connec->prepare("INSERT INTO people_invoice (idpeople, idinvoice) 
                                        VALUES ('$idpeople', '$idinvoice')");
        $req->execute();
    }

    public function unsetPeople ($id) {
        $req = $this->connec->prepare("DELETE FROM people_company WHERE idpeople='$id'");
        $req->execute();
        $req = $this->connec->prepare("DELETE FROM people WHERE id='$id'");
        $req->execute();
    }

    public function unsetCompany ($id) {
        $req = $this->connec->prepare("DELETE FROM people_company WHERE idcompany='$id'");
        $req->execute();
        $req = $this->connec->prepare("DELETE FROM company WHERE id='$id'");
        $req->execute();
    }

    public function unsetInvoice ($id) {
        $req = $this->connec->prepare("DELETE FROM invoice WHERE id='$id'");
        $req->execute();
        $req = $this->connec->prepare("DELETE FROM people_invoice WHERE idinvoice='$id'");
        $req->execute();
        $req = $this->connec->prepare("DELETE FROM invoice_company WHERE idinvoice='$id'");
        $req->execute();
    }

    public function setPeople ($id, $firstname, $lastname, $email, $phone, $company) {
        $req = $this->connec->prepare("UPDATE people 
                                       SET firstname='$firstname', lastname='$lastname', email='$email', phone='$phone'
                                       WHERE id='$id'");
        $req->execute();

        $req = $this->connec->prepare("UPDATE people_company 
                                       SET idcompany='$company'
                                       WHERE idpeople='$id'");
        $req->execute();
    }

    public function setCompany ($id, $name, $country, $vat, $type) {
        $req = $this->connec->prepare("UPDATE company_type 
                                       SET idtype='$type'
                                       WHERE idcompany='$id'");
        $req->execute();

        $req = $this->connec->prepare("UPDATE company 
                                       SET name='$name', country='$country', vat='$vat'
                                       WHERE id='$id'");
        $req->execute();
    }

    public function setInvoice ($id, $number, $date, $content, $amount, $idpeople, $idcompany) {
        $req = $this->connec->prepare("UPDATE invoice 
                                       SET number='$number', date='$date', content='$content', amount= '$amount'
                                       WHERE id='$id'");
        $req->execute();

        $req = $this->connec->prepare("UPDATE invoice_company 
                                       SET idcompany='$idcompany'
                                       WHERE idinvoice='$id'");
        $req->execute();

        $req = $this->connec->prepare("UPDATE people_invoice 
                                       SET idpeople='$idpeople'
                                       WHERE idinvoice='$id'");
        $req->execute();
    }
}