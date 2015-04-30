<table class="form-table">
	<tbody>
		<?php if ($this->options['post_id']) { ?>
		<input name="video" type="hidden" id="video" value="<?= $this->options['video'] ?>" />
		<tr>
			<th scope="row">
				<label for="width"><?php _e('Start & End', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<input style="float: left;" class="small-text" name="start" type="text" id="start" readonly value="<?= $this->options['start'] ?>" />
				<div style="margin: 5px 0 0 65px;" id="start_slider"></div>
				<input style="float: left;" class="small-text" name="end" type="text" id="end" readonly value="<?= $this->options['end'] ?>" />
			</td>
		</tr>
		<?php } ?>
		<tr>
			<th scope="row">
				<label for="width"><?php _e('Video width', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<input name="width" type="text" id="width" value="<?= $this->options['width'] ?>" class="small-text" />
				<select name="width_value" id="width_value">
					<option <?php echo ($this->options['width_value'] == '%') ? 'selected="selected"' : ''; ?> value="%">%</option>
					<option <?php echo ($this->options['width_value'] == 'px') ? 'selected="selected"' : ''; ?> value="px">px</option>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="width_ratio"><?php _e('Aspect ratio', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<select name="width_ratio" id="width_ratio">
					<option <?php echo ($this->options['width_ratio'] == '0') ? 'selected="selected"' : ''; ?> value="0">16:9</option>
					<option <?php echo ($this->options['width_ratio'] == '1') ? 'selected="selected"' : ''; ?> value="1">4:3</option>
				</select>
				<?php if (!$this->options['post_id']) { ?>
				<p class="description">
					<?php _e('The aspect ratio is used to calculate the height of your video.', 'youtube-customizr'); ?>
				</p>
				<?php } ?>
			</td>
		</tr>
	</tbody>
</table>￼
<script>
	admin_sliders('#start', 0, <?= $this->options['seconds'] ?>, <?= $this->options['start'] ?>, 1, '#end', <?= $this->options['end'] ?>);
</script>