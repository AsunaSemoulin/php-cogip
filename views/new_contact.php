<?php
require("./views/header.php");

// Check if the form was submitted

echo $responses;
?>
<h1>Create a new contact</h1>


    <form action='index.php' method='POST'>
    <input type='hidden' name='action' value='new_contact'>
    <label>Firstname</label>
    <input name='firstname' type='text' id='firstname' class='text-box' type='text' placeholder='Enter Firstname' required>

    <label>Name</label>
    <input name='name' id='name' class='text-box' type='text' placeholder='Enter Name' required>

    <label>Phone</label>
    <input name='phone' id='phone' class='text-box' type='text' placeholder='Enter Phone' required>

    <label>Email</label>
    <input name='email' id='email' class='text-box' type='text' placeholder='Enter Email' required>

    <label>Company</label>
    <select id='company' name='company' placeholder='Company'>
        <?php
        while ($infos = $companies->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $infos['id'] . "'>" . $infos['name'] . "</option>";
        }
        ?>
    </select>
    
    <button type='button' onclick='submit()' value='submit'>submit</button> 
    </form>

<?php
require("./views/footer.php");