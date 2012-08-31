<?php if (isset($errors)): ?>
<div class="alert-message red">
	<p><strong><?php echo __("Error"); ?></strong></p>
	<ul>
		<?php if (is_array($errors)): ?>
			<?php foreach ($errors as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>
		<?php else: ?>
			<li><?php echo $errors; ?></li>
		<?php endif; ?>
	</ul>
</div>
<?php endif; ?>

<?php if (isset($messages)): ?>
	<div class="alert-message blue">
	<p><strong><?php echo __("Success"); ?></strong></p>
	<ul>
		<?php if (is_array($messages)): ?>
			<?php foreach ($messages as $message): ?>
				<li><?php echo $message; ?></li>
			<?php endforeach; ?>
		<?php else: ?>
			<li><?php echo $messages; ?></li>
		<?php endif; ?>
	</ul>
	</div>
<?php endif; ?>

<?php echo Form::open(); ?>
	<article class="container base" id="alert_messages" style="display:none">
		<div class="alert-message red">
			<p><?php echo __("Oops! Something went wrong while processing your request"); ?></p>
		</div>
	</article>

	<article class="container base">
		<header class="cf">
			<div class="property-title">
				<h1><?php echo __('Google Analytics'); ?></h1>
			</div>
		</header>

		<section class="property-parameters">
			<div class="parameter">
				<label for="site_name">
					<p class="field"><?php echo __("Tracking ID"); ?></p>
					<?php echo Form::input("webanalytics_google", $settings['webanalytics_google']); ?>
				</label>
			</div>
		</section>
	</article>
	<article class="container base">
		<header class="container cf">
			<div class="property-title">
				<h1><?php echo __("Gauges"); ?></h1>
			</div>
		</header>

		<section class="property-parameters">
			<div class="parameter">
				<label for="site_locale">
					<p class="field"><?php echo __("Data Site ID"); ?></p>
					<?php echo Form::input("webanalytics_gauges", $settings['webanalytics_gauges']); ?>
				</label>
			</div>
		</section>
	</article>
	<div class="save-toolbar">
		<p class="button-blue"><a href="#" onclick="submitForm(this)"><?php echo __("Save Changes"); ?></a></p>
	</div>
<?php echo Form::close(); ?>
