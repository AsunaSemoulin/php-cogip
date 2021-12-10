<?php
require("./views/header.php");

echo $responses;
?>
    <h1>Update a contact</h1>


    <form action='index.php' method='POST'>
        <input type='hidden' name='action' value='update_contact'>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Firstname</label>
        <input name='firstname' type='text' id='firstname' class='text-box' type='text' value='<?php echo $contact['firstname']; ?>' required>

        <label>Name</label>
        <input name='name' id='name' class='text-box' type='text' value='<?php echo $contact['lastname']; ?>' required>

        <label>Phone</label>
        <input name='phone' id='phone' class='text-box' type='text' value='<?php echo $contact['phone']; ?>' required>

        <label>Email</label>
        <input name='email' id='email' class='text-box' type='text' value='<?php echo $contact['email']; ?>' required>

        <label>Company</label>
        <select id='company' name='company'>
            <?php
            while ($infos = $companies->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $infos['id'] . "'";
                if ($infos['id']==$contact['idcompany']) echo "selected";
                echo ">" . $infos['name'] . "</option>";
            }
            ?>
        </select>

        <button type='button' onclick='submit()' value='submit'>submit</button>
    </form>

<?php
require("./views/footer.php");
