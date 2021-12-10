<?php
require("./views/header.php");

if ($responses!="") echo "<h4>" . $responses . "</h4>";
$invoices = $db->getFiveLastInvoice();

if (isset($_SESSION['username'])) {
    echo "<h1>Bienvenue " . $_SESSION['username'] . " !</h1>";
}
?>
    <h1>Five last invoices</h1>
    <table>
        <tr class="line">
            <th>Number</th>
            <th>Date</th>
            <th>Company</th>
            <th>Details</th>
        </tr>
<?php
while ($infos = $invoices->fetch(PDO::FETCH_ASSOC)) {
    $number = $infos["number"];
    $date = $infos["date"];
    $name = $infos["name"];
    $id = $infos["id"];

    echo "
            <tr class='line'>
                <td>$number</td>
                <td>$date</td>
                <td>$name</td>
                <td><a href='./?action=invoice_details&id=$id'>Details</a></td>
            </tr>
    ";
}

$contacts = $db->getFiveLastPeople();
?>
</table>
<h1>Five last contacts</h1>
    <table>
        <tr class="line">
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Company</th>
            <th>Details</th>
        </tr>
<?php
while ($infos = $contacts->fetch(PDO::FETCH_ASSOC)) {
    $firstname = $infos["firstname"];
    $lastname = $infos["lastname"];
    $email = $infos["email"];
    $phone = $infos["phone"];
    $name = $infos["name"];
    $id = $infos["id"];

    echo "
            <tr class='line'>
                <td>$firstname</td>
                <td>$lastname</td>
                <td>$phone</td>
                <td>$email</td>
                <td>$name</td>
                <td><a href='./?action=contact_details&id=$id'>Details</a></td>
            </tr>
    ";
}

$companies = $db->getFiveLastCompany();
?>
</table>
<h1>Five last companies</h1>
    <table>
        <tr class="line">
            <th>Name</th>
            <th>Country</th>
            <th>VAT</th>
            <th>Type</th>
            <th>Details</th>
        </tr>
<?php
while ($infos = $companies->fetch(PDO::FETCH_ASSOC)) {
    $name = $infos["name"];
    $country = $infos["country"];
    $vat = $infos["vat"];
    $type = $infos["type"];
    $id = $infos["id"];

    echo "
            <tr class='line'>
                <td>$name</td>
                <td>$country</td>
                <td>$vat</td>
                <td>$type</td>
                <td><a href='./?action=company_details&id=$id'>Details</a></td>
            </tr>
    ";
}

echo "</table>";

echo "<div id='welcomeBottomMenu'><a href='index.php?action=clients'>Clients list</a><a href='index.php?action=providers'>Providers list</a></div>";


require("./views/footer.php");
