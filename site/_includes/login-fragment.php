
			<div class='login'>
				<h1 class='login-title'><?php echo $settings['application_name_long']; ?></h1>
				<p class='login-caption'>Please Log In</p>


				<!-- USER SELECTION LIST -->

				<div class='login-userlist'>
					<?php
					foreach ($users as $user) {
						?>
						<div class='login-userlist-user'
							data-username='<?php echo $user->username; ?>'>
							<div class='login-userlist-user-pic' 
								style='background-image: url("<?php echo $user->image_url(); ?>")'>
							</div>
							<div class='login-userlist-user-name'><?php echo $user->display_name(); ?></div>
						</div>
						<?php
					}
					?>
				</div><!-- End .login-userlist -->


				<!-- LOGIN FORMS -->

				<div class='login-forms'>
					<?php
					foreach ($users as $user) {
						?>
						<form class='login-forms-form' method='post' action=''
							data-username='<?php echo $user->username; ?>'>
							<div class='login-forms-form-pic'
								style='background-image: url("<?php echo $user->image_url(); ?>")'></div>
							<div class='login-forms-form-name'><?php echo $user->display_name(); ?></div>
							<input type='hidden' name='username' value='<?php echo $user->username; ?>'>
							<input class='login-forms-form-password' type='password' name='password' placeholder='password'>
							<input class='login-forms-form-submit' type='submit' value='Log In'>
						</form>
						<?php
					}
					?>
					<div class='login-forms-goback'>Go Back</div>
				</div><!-- End .login-forms -->



			</div><!-- End .login -->
