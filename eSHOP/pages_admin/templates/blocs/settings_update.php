	
	
	<div id="version_checker">
		<?php version_checker($latest_pv); ?>
	</div>

	<div class="ui grid">
		<div class="eight wide column stackable">
			<div class="ui horizontal divider">Current Version</div>
			<div class="ui two column stackable grid">
				<div class="column right aligned">Version</div>
				<div class="column"><?= $plugin_version ?></div>
				<div class="column right aligned">DB Version</div>
				<div class="column"><?= $plugin_db_version ?> </div>
			</div>
		</div>
		<div class="eight wide column stackable">
			<div class="ui horizontal divider">Latest Version</div>
			<div class="ui two column stackable grid">
				<div class="column right aligned">Version</div>
				<div class="column"><?= $latest_pv ?></div>
				<div class="column right aligned">DB Version</div>
				<div class="column"><?= $latest_db ?> </div>
			</div>
		</div>
	</div>

	<div class="ui horizontal divider">What's news on eSH0P <?= $latest_pv ?></div>
	<div class="ui container">
			<div class="sub header">
				<?php
					$list = explode(",",$changelog);
					foreach($list AS $val){
						echo '<p> - '. $val .'</p>';
					}
				?>
			</div>
		</h4>
		<div id="upgradenow" class="ui segment center">
			<div class="ui buttons">
				<a href="https://github.com/coolternet/plugins_cms/archive/master.zip" class="ui button">Dowload from GitHub</a>
			<div class="or"></div>
				<a class="ui positive button">Update Now</a>
			</div>
		</div>
	<div>