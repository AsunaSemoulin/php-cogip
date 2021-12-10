<?php
require("./views/header.php");
$displayFacturesAlphab = $dbh->query('SELECT idfactures, datefacture FROM factures ORDER BY datefacture DESC');
if (!empty($id)) {
    $companyandpeople = $db->getInvoiceInfo($id);

    ?>
    <h1>Informations</h1>
    <table>
        <tr class="line">
            <th>Number</th>
            <th>Date</th>
        </tr>

    <?php

    while ($infos = $companyandpeople->fetch(PDO::FETCH_ASSOC)) {
        $number = $infos["number"];
        $date = $infos["date"];

        echo "
                <tr class='line'>
                    <td>$number</td>
                    <td>$date</td>
                </tr>
        ";
    }

    echo "</table>";

    $companyandpeople = $db->getInvoiceInfoCompany($id);
?>
    <h1>Company linked</h1>
    <table>
        <tr class="line">
            <th>Name</th>
            <th>Country</th>
            <th>VAT</th>
            <th>Type</th>
        </tr>
<?php
    while ($infos = $companyandpeople->fetch(PDO::FETCH_ASSOC)) {
        $name = $infos["companyname"];
        $country = $infos["country"];
        $vat = $infos["vat"];
        $type = $infos["type"];

        echo "
                <tr class='line'>
                    <td>$name</td>
                    <td>$country</td>
                    <td>$vat</td>
                    <td>$type</td>
                </tr>
        ";
    }
?>
    </table>
    <h1>Contact linked</h1>
    <table>
        <tr class="line">
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
<?php
    $companyandpeople = $db->getInvoiceInfoPeople($id);

    while ($infos = $companyandpeople->fetch(PDO::FETCH_ASSOC)) {
        $firstname = $infos["firstname"];
        $lastname = $infos["lastname"];
        $email = $infos["emailcontact"];
        $phone = $infos["phone"];

        echo "
                <tr class='line'>
                    <td>$firstname</td>
                    <td>$lastname</td>
                    <td>$email</td>
                    <td>$phone</td>
                </tr>
        ";
    }

    echo "</table>";
}
require("./views/footer.php");
