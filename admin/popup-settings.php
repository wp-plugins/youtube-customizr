<table class="form-table">
	<tbody>
		<tr>
            <?php if (!$this->options['post_id']) { ?>
			<th scope="row">
				<?php _e('Lightbox', 'youtube-customizr'); ?>
			</th>
            <?php } ?>
			<td>
				<label for="lightbox">
					<input name="lightbox" type="hidden" value="0" />
					<input name="lightbox" type="checkbox" id="lightbox" value="1" <?= ($this->options['lightbox'] == 1) ? 'checked' : ''; ?> />
					<?php if (!$this->options['post_id']) {
						 _e('Open my videos in a lightbox.', 'youtube-customizr');
					} else {
						 _e('Open this video in a lightbox.', 'youtube-customizr');
					}?>
				</label>
			</td>
		</tr>
	</tbody>
</table>