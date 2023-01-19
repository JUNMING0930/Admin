<?php require('dataconnection.php');?>
<?php include('a_includes/header.php');?>
<?php session_start(); ?>
<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Admin Login
				</span>
				
				<form action="logincode.php" method="POST" class="login100-form validate-form p-b-33 p-t-5" >
					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="text" name="adminemail" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="adminpass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
					<div class="container-login100-form-btn m-t-32">
							<?php
								if(isset($_SESSION['message']))
								{
									$msg = $_SESSION['message'];
									echo "<strong>$msg</strong>";
								}
								unset($_SESSION['message']);
							?>
					</div>	
						<div class="container-login100-form-btn m-t-32">
							<button type="submit" class="login100-form-btn" name="loginbtn">
								Login
							</button>
					</div>
						
				</form>
			</div>
		</div>
	</div>

<?php include('a_includes/footer.php');?>
<?php session_destroy(); ?>