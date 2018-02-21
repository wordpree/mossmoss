<?php
if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div class="col-md-3 ct_sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div> <!-- end #sidebar -->
<?php endif; ?>