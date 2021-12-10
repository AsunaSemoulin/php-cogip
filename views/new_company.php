<?php
require("./views/header.php");

// Check if the form was submitted

echo $responses;
?>
    <h1>Create a new company</h1>


    <form action='index.php' method='POST'>
        <input type='hidden' name='action' value='new_company'>
        <label>Name</label>
        <input name='name' type='text' id='name' class='text-box' type='text' placeholder='Enter company name' required>

        <label>Country</label>
        <input name='country' id='country' class='text-box' type='text' placeholder='Enter Country' required>

        <label>VAT</label>
        <input name='vat' id='vat' class='text-box' type='text' placeholder='Enter VAT' required>

        <label>Type of company</label>
        <select name="type" id="type">
            <option value="1">Client</option>
            <option value="2">Provider</option>
        </select>

        <button type='button' onclick='submit()' value='submit'>submit</button>
    </form>

<?php
require("./views/footer.php");
