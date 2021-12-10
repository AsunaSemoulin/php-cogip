<?php
require("./views/header.php");

    if (isset($responses)) echo $responses;
?>
    <h1>Create a new invoice</h1>

    <form action="index.php" method="post">
    <input type="hidden" name="action" value="new_invoice">

    <label>Invoice number</label>
    <input name="invoice_number" type="text" id="invoice_number" class="text-box" type="text" required>

    <label>Invoice date</label>
    <select name="invoice_date_day" id="invoice_date_day">
        <?php
        $i=1;
        while ($i<=31) {
            echo "<option value='" . $i ."'>" .$i ."</option>";
            $i++;
        }
        ?>
    </select>
    <select name="invoice_date_month" id="invoice_date_month">
        <?php
        $i=1;
        while ($i<=12) {
            echo "<option value='" . $i ."'>" .$i ."</option>";
            $i++;
        }
        ?>
    </select>
    <select name="invoice_date_year" id="invoice_date_year">
        <?php
        $i=date('Y');
        while ($i>=1940) {
            echo "<option value='" . $i ."'>" .$i ."</option>";
            $i--;
        }
        ?>
    </select>


    <label>Amount</label>
    <input name="amount" id="amount" class="text-box" type="text" required>

    <label>Product to be invoiced</label>
    <input name="content" id="content" class="text-box" type="text" required>

        <label>Company</label>
    <select id="company" name="company">
        <?php
        while ($infos = $companies->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $infos['id'] . "'>" . $infos['name'] . "</option>";
        }
        ?>
                </select>

    <label>Contact person regarding the invoice</label>
    <select id="contact" name="contact">
        <?php
        while ($infos = $people->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $infos['id'] . "'>" . $infos['firstname'] . " " . $infos['lastname'] . "</option>";
        }
        ?>
                </select>

    <button type="button" onclick="submit()" value="submit">submit</button>

    </form>
<?php
require("./views/footer.php");