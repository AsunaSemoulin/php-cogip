<?php
require("./views/header.php");

$invoices = $db->getAllInvoice();
?>
<section class="columns structure-pages">
 <section class="column is-half is-offset-3">
  <section class="box">
   <table>
       <h2 class="subtitle is-size-3 has-text-weight-bold">Invoices</h2>
       <thead>
       <tr class="line">
        <table>
        <th>Number</th>
        <th>Date</th>
        <th>Content</th>
        <th>Amount</th>
        <th>Type</th>
        <th>Details</th>
    </tr>
       </thead>
       <tbody>
         <?php while ($donnee = $displayInvoicesAlphab->fetch()) { ?>
           <tr>
             <td><a href="?page=detailinvoice&invoices=<?php echo $donnee['idinvoices'] ?>"><?php echo $donnee['idinvoices'] ?></a></td>
             <td><?php echo $donnee['dateinvoice'] ?></td>
             <td>
               <form onsubmit="confirmation()" class="" action="" method="post">
                 <input type="hidden" name="iddelete" value="<?php echo $donnee['idinvoices'] ?>">
                 <button class="button is-link is-inverted" type="submit" name="delete" 
                 <?php 
                 echo"sessionCheckDelUpd()";
                 ?>
                 ><i class="fas fa-trash-alt"></i></button>
               </form>
             </td>
             <td>
                 <?php 
                 echo $errorDelInvoices 
                 ?>
                </td>
           </tr>
         <?php } ?>
       </tbody>
     </table>
  </section>
  <a class="button create is-rounded 
  <?php 
  echo"sessionCheckAdd()";
  ?> 
   href="?page=newinvoices>New invoices</a>
 </section>
</section>


<?php
while ($infos = $invoices->fetch(PDO::FETCH_ASSOC)) {
    $number = $infos["number"];
    $date = $infos["date"];
    $content = $infos["content"];
    $amount = $infos["amount"];
    $type = $infos["name"];
    $id = $infos["id"];

    echo "
            <tr class='line'>
                <td>$number</td>
                <td>$date</td>
                <td>$content</td>
                <td>$amount</td>
                <td>$type</td>
                <td><a href='./?action=invoice_details&id=$id'>Details</a></td>
            </tr>
    ";
}

echo "</table>";
require("./views/footer.php");