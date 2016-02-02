<div class='appbar'>
	<div class='appbar-left'>
		<div class='appbar-left-apptitle'>
			<?php
			echo $settings['application_name_long'];
			?>
		</div>
	</div>
	<div class='appbar-right'>
		<div class='appbar-right-accountmenu'>
			<div class='appbar-right-accountmenu-userlabel'>
				<?php
				echo $current_user->display_name();
				?>
			</div>
			<div class='appbar-right-accountmenu-menu'>
				<div class='appbar-right-accountmenu-menu-item' data-menu-action='logout'>
					Logout
				</div>
			</div>
		</div>
	</div>
	
</div><!-- End .appbar -->
