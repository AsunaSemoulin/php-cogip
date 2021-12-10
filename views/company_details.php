<?php
require("./views/header.php");

if (!empty($id)) {
    $client = $db->getCompanyInfo($id);
?>
    <h1>Company</h1>
    <table>
        <tr class="line">
            <th>Name</th>
            <th>Country</th>
            <th>VAT</th>
        </tr>
<?php
    while ($infos = $client->fetch(PDO::FETCH_ASSOC)) {
        $name = $infos["name"];
        $country = $infos["country"];
        $vat = $infos["vat"];

        echo "
                <tr class='line'>
                    <td>$name</td>
                    <td>$country</td>
                    <td>$vat</td>
                </tr>
        ";
    }
?>
    </table>
    <h1>Contact</h1>
        <table>
        <tr class="line">
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
<?php
    $people = $db->getCompanyPeople($id);

    while ($infos = $people->fetch(PDO::FETCH_ASSOC)) {
        $firstname = $infos["firstname"];
        $lastname = $infos["lastname"];
        $email = $infos["email"];
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
?>
        </table>
    <h1>Invoices</h1>
            <table>
        <tr class="line">
            <th>Number</th>
            <th>Date</th>
            <th>Content</th>
            <th>Amount</th>
        </tr>
<?php
    $invoices = $db->getAllInvoiceCompany($id);

    while ($infos = $invoices->fetch(PDO::FETCH_ASSOC)) {
        $number = $infos["number"];
        $date = $infos["date"];
        $content = $infos["content"];
        $amount = $infos["amount"];

        echo "
                <tr class='line'>
                    <td>$number</td>
                    <td>$date</td>
                    <td>$content</td>
                    <td>$amount</td>
                </tr>
        ";
    }

    echo "</table>";
}
require("./views/footer.php");