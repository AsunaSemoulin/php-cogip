<?php
require("./views/header.php");


if (!empty($id)) {
    $contact = $db->getAllInformationPeople($id);
?>
    <h1>Contact</h1>
    <table>
        <tr class="line">
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Company</th>
        </tr>
<?php
    while ($infos = $contact->fetch(PDO::FETCH_ASSOC)) {
        $firstname = $infos["firstname"];
        $lastname = $infos["lastname"];
        $email = $infos["email"];
        $companyname = $infos["companyname"];

        echo "
            <tr class='line'>
                <td>$firstname</td>
                <td>$lastname</td>
                <td>$email</td>
                <td>$companyname</td>
            </tr>
        ";
    }
?>
    </table>
    <h1>Invoice</h1>
    <table>
        <tr class="line">
            <th>Number</th>
            <th>Date</th>
            <th>Amount</th>
        </tr>
<?php
    $invoice = $db->getAllInvoiceOfOnePeople($id);

    while ($infos = $invoice->fetch(PDO::FETCH_ASSOC)) {
        $number = $infos["number"];
        $date = $infos["date"];
        $amount = $infos["amount"];

        echo "
                <tr class='line'>
                    <td>$number</td>
                    <td>$date</td>
                    <td>$amount</td>
                </tr>
        ";
    }

    echo "</table>";

    }


require("./views/footer.php");