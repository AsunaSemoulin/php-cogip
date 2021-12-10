<?php
require("./views/header.php");

$providers = $db->getAllCompanySupplier();
?>
<h1>Providers</h1>
<table>
        <tr class="line">
            <th>Name</th>
            <th>Country</th>
            <th>VAT</th>
            <th>Details</th>
        </tr>
<?php
while ($infos = $providers->fetch(PDO::FETCH_ASSOC)) {
    $name = $infos["name"];
    $country = $infos["country"];
    $vat = $infos["vat"];
    $id = $infos["id"];

    echo "
            <tr class='line'>
                <td>$name</td>
                <td>$country</td>
                <td>$vat</td>
                <td><a href='./?action=company_details&id=$id'>Details</a></td>
            </tr>
    ";
}

echo "<hr/>";
require("./views/footer.php");
