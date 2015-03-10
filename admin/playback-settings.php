<?php if (!$this->options['post_id']) { ?>
	<h3><?php _e('Playback Settings', 'youtube-customizr'); ?></h3> 
<?php } ?>
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<label for="suggestedquality"><?php _e('Preferred quality', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<select name="suggestedquality" id="suggestedquality">
					<option <?= ($this->options['suggestedquality'] == 'default') ? 'selected="selected"' : ''; ?> value="default"><?php _e('Default', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['suggestedquality'] == 'small') ? 'selected="selected"' : ''; ?> value="small"><?php _e('Small', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['suggestedquality'] == 'medium') ? 'selected="selected"' : ''; ?> value="medium"><?php _e('Medium', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['suggestedquality'] == 'large') ? 'selected="selected"' : ''; ?> value="large"><?php _e('Large', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['suggestedquality'] == 'hd720') ? 'selected="selected"' : ''; ?> value="hd720"><?php _e('720p (HD Ready)', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['suggestedquality'] == 'hd1080') ? 'selected="selected"' : ''; ?> value="hd1080"><?php _e('1080p (Full HD)', 'youtube-customizr'); ?></option>
					<option <?= ($this->options['suggestedquality'] == 'highres') ? 'selected="selected"' : ''; ?> value="highres"><?php _e('Higher than 1080p', 'youtube-customizr'); ?></option>
				</select>
				<?php if (!$this->options['post_id']) { ?>
				<p class="description">
					 <?php _e('We advise you to leave the preferred video quality on default. This way YouTube can determine the best quality for each device.', 'youtube-customizr'); ?>
				</p>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="volume"><?php _e('Volume', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<input class="small-text float-left" name="volume" type="text" id="volume" readonly value="<?= $this->options['volume'] ?>" />
				<div class="ytc-slider" id="volume_slider"></div>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="playbackrate"><?php _e('Playback Speed', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<input class="small-text float-left" name="playbackrate" type="text" id="playbackrate" readonly value="<?= $this->options['playbackrate'] ?>" />
				<div class="ytc-slider" id="playbackrate_slider"></div>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<?php _e('Autoplay', 'youtube-customizr'); ?>
			</th>
			<td>
				<label for="autoplay">
					<input name="autoplay" type="hidden" value="0" />
					<input name="autoplay" type="checkbox" id="autoplay" value="1" <?= ($this->options['autoplay'] == 1) ? 'checked' : ''; ?> /> 
					<?php if (!$this->options['post_id']) {
						 _e('Automatically play my videos.', 'youtube-customizr');
					} else {
						 _e('Automatically play this video.', 'youtube-customizr');
					}?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row">
				<?php _e('Loop', 'youtube-customizr'); ?>
			</th>
			<td>
				<label for="loop">
					<input name="loop" type="hidden" value="0" />
					<input name="loop" type="checkbox" id="loop" value="1" <?= ($this->options['loop'] == 1) ? 'checked' : ''; ?> />
					<?php if (!$this->options['post_id']) {
						 _e('Start my videos again when they have finished playing.', 'youtube-customizr'); 
					} else {
						_e('Start this video again when it has finished playing.', 'youtube-customizr');
					}?>
				</label>
			</td>
		</tr>
		<tr class="loop_related">
			<th scope="row">
				<?php _e('Related videos', 'youtube-customizr'); ?>
			</th>
			<td>
				<label for="rel">
					<input name="rel" type="hidden" value="0" />
					<input name="rel" type="checkbox" id="rel" value="1" <?= ($this->options['rel'] == 1) ? 'checked' : ''; ?> />
					<?php _e('Show related YouTube videos when the video has finished playing', 'youtube-customizr') ?>
				</label>
			</td>
		</tr>
	</tbody>
</table>
<script>
	related_checkboxes('#loop', '.loop_related', true);
	admin_sliders('#volume', 0, 100, <?= $this->options['volume'] ?>);
	admin_sliders('#playbackrate', 1, 8, <?= $this->options['playbackrate'] ?>, 4);
</script>