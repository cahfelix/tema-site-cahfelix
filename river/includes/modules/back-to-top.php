<?php
$river_options = river_qode_return_global_options();

if ( $river_options['show_back_button'] == "yes" ) { ?>
	<a id='back_to_top' href='#'>
		<span class="icon-stack">
			<i class="icon-chevron-up " style=""></i>
		</span>
	</a>
<?php } ?>