<?php
require("./views/header.php");

$peoples = $db->getAllPeople();
?>
<h1>Contact</h1>
<table>
        <tr class="line">
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Company</th>
            <th>Details</th>
        </tr>
<?php
while ($infos = $peoples->fetch(PDO::FETCH_ASSOC)) {
    $id = $infos["id"];
    $firstname = $infos["firstname"];
    $lastname = $infos["lastname"];
    $email = $infos["email"];
    $companyname = $infos["name"];

    echo "
            <tr class='line'>
                <td>$firstname</td>
                <td>$lastname</td>
                <td>$email</td>
                <td>$companyname</td>
                <td><a href='./?action=contact_details&id=$id'>Details</a></td>
            </tr>
    ";
}

echo "</table>";

require("./views/footer.php");