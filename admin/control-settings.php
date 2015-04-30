<?php if (!$this->options['post_id']) { ?>
	<h3><?php _e('Player controls', 'youtube-customizr'); ?></h3>
<?php } ?>
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<?php _e('Hide controls', 'youtube-customizr'); ?>
			</th>
			<td>
				<label for="controls">
					<input name="controls" type="hidden" value="0" />
					<input name="controls" type="checkbox" id="controls" value="1" <?= ($this->options['controls'] == 1) ? 'checked' : ''; ?> />
					<?php _e('Hide all the video controls.', 'youtube-customizr') ?>
				</label>
			</td>
		</tr>
		<tr class="controls_related_true">
			<th scope="row">
				<?php _e('Disable mouse', 'youtube-customizr'); ?>
			</th>
			<td>
				<label for="disableclick">
					<input name="disableclick" type="hidden" value="0" />
					<input name="disableclick" type="checkbox" id="disableclick" value="1" <?= ($this->options['disableclick'] == 1) ? 'checked' : ''; ?> />
					<?php _e('Disables the posibilty of clicking or hovering over the videos.', 'youtube-customizr') ?>
				</label>
			</td>
		</tr>
	</tbody>
</table>
<table class="form-table controls_related_false">
	<tbody>
		<tr>
			<th scope="row">
				<label for="autohide"><?php _e('Autohide controls', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<select name="autohide" id="autohide">
					<option <?= ($this->options['autohide'] == 2) ? 'selected="selected"' : ''; ?> value="2"><?php _e('Only hide progressbar, keep the player controls', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['autohide'] == 1) ? 'selected="selected"' : ''; ?> value="1"><?php _e('Hide all', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['autohide'] == 0) ? 'selected="selected"' : ''; ?> value="0"><?php _e('Show all', 'youtube-customizr'); ?></option>
				</select>
				<?php if (!$this->options['post_id']) { ?>
				<p class="description">
					<?php _e('A few seconds after the video starts playing you can choose to hide certain controls', 'youtube-customizr'); ?>
				</p>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="theme"><?php _e('Player theme', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<select name="theme" id="theme">
					<option <?= ($this->options['theme'] == 'dark') ? 'selected="selected"' : ''; ?> value="dark"><?php _e('Dark', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['theme'] == 'light') ? 'selected="selected"' : ''; ?> value="light"><?php _e('Light', 'youtube-customizr'); ?></option>
				</select>
				<?php if (!$this->options['post_id']) { ?>
				<p class="description">
					<?php _e('The player can be displayed in a dark or light theme', 'youtube-customizr'); ?>
				</p>
				<?php } ?>
			</td>
		</tr>
		<tr class="modestbranding_related">
			<th scope="row">
				<label for="color"><?php _e('Progressbar color', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<select name="color" id="color">
					<option <?= ($this->options['color'] == 'red') ? 'selected="selected"' : ''; ?> value="red"><?php _e('Red', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['color'] == 'white') ? 'selected="selected"' : ''; ?> value="white"><?php _e('White', 'youtube-customizr'); ?></option>
				</select>
				<?php if (!$this->options['post_id']) { ?>
				<p class="description">
					<?php _e('The color that will be used in the videos progress bar to highlight the amount of the video that the viewer has already seen.', 'youtube-customizr'); ?>
				</p>
				<?php } ?>
			</td>
		</tr>
		<tr class="color_related">
			<th scope="row">
				<?php _e('Modest Branding', 'youtube-customizr'); ?>
			</th>
			<td>
				<label for="modestbranding">
					<input name="modestbranding" type="hidden" value="0" />
					<input name="modestbranding" type="checkbox" id="modestbranding" value="1" <?= ($this->options['modestbranding'] == 1) ? 'checked' : ''; ?> />
					<?php _e('Remove the YouTube logo from the control bar.', 'youtube-customizr') ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<?php _e('Show video info', 'youtube-customizr'); ?>
			</th>
			<td>
				<label for="showinfo">
					<input name="showinfo" type="hidden" value="0" />
					<input name="showinfo" type="checkbox" id="showinfo" value="1" <?= ($this->options['showinfo'] == 1) ? 'checked' : ''; ?> />
					<?php _e('Shows info like title & uploader of the video.', 'youtube-customizr') ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<?php _e('Annotations', 'youtube-customizr'); ?>
			</th>
			<td>
				<label for="iv_load_policy">
					<input name="iv_load_policy" type="hidden" value="1" />
					<input name="iv_load_policy" type="checkbox" id="iv_load_policy" value="3" <?= ($this->options['iv_load_policy'] == 3) ? 'checked' : ''; ?> />
					<?php _e('Turn off annotations by default.', 'youtube-customizr') ?>
				</label>
			</td>
		</tr>
	</tbody>
</table>
<script>
	related_checkboxes('#controls', '.controls_related_true');
	related_checkboxes('#controls', '.controls_related_false', true);
	related_checkboxes('#modestbranding', '.modestbranding_related', true);
	related_checkboxes('#color ', '.color_related', 'white');
</script>