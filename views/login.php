<?php
require("./views/header.php");
?>
<div class="columns structure-pages">
 <div class="column is-4 is-offset-4">
  <div class="box login">
	<form action="index.php" method="post" id="login">
	    <input type="hidden" name="action" value="login_details"/>
	  	<h2 class="subtitle is-size-3 has-text-weight-bold">Sign in here</h2>
			<div class="field">
			  <p class="control has-icons-left has-icons-right">
			    <input class="input is-link is-rounded" type="text" name="username" value="" placeholder="username">
			    <span class="icon is-small is-left">
			      <i class="fas fa-user"></i>
			    </span>
			    <span class="icon is-small is-right">
			      <i class="fas fa-check"></i>
			    </span>
			  </p>
			</div>
			<div class="field">
			  <p class="control has-icons-left">
			    <input class="input is-link is-rounded" type="password" name="password" value="" placeholder="Password">
			    <span class="icon is-small is-left">
			      <i class="fas fa-lock"></i>
			    </span>
			  </p>
			</div>
			<label class="checkbox">
  				<input type="checkbox" for="remember me">
				  remember me
			</label>
			<br>
			<div class="field">
			  <p class="control">
			    <button class="button is-link is-large is-pulled-right" name="buttonName" value="submit">
				Submit
			    </button>
			  </p>
			</div>
	</form>
   </div>
   <?php if (isset($_GET['error']) AND $_GET['error']==1) echo "Login and password don't match !" ?>
 </div>	
</div>
<?php
require("./views/footer.php");
?>
