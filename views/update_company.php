<?php
require("./views/header.php");

echo $responses;
?>
    <h1>Update a company</h1>

    <form action='index.php' method='POST'>
        <input type='hidden' name='action' value='update_company'>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Name</label>
        <input name='name' type='text' id='name' class='text-box' type='text' value='<?php echo $company['name']; ?>' required>

        <label>Country</label>
        <input name='country' id='country' class='text-box' type='text' value='<?php echo $company['country']; ?>' required>

        <label>VAT</label>
        <input name='vat' id='vat' class='text-box' type='text' value='<?php echo $company['vat']; ?>' required>

        <label>Type of company</label>
        <select name="type" id="type">
            <option value="1" <?php if ($company['idtype']==1) echo "selected";  ?>>Client</option>
            <option value="2" <?php if ($company['idtype']==2) echo "selected";  ?>>Provider</option>
        </select>

        <button type='button' onclick='submit()' value='submit'>submit</button>
    </form>

<?php
require("./views/footer.php");