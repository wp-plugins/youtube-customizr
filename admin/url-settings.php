<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<label for="width"><?php _e('YouTube Link', 'youtube-customizr'); ?></label>
			</th>
			<td>
				<input class="large-text" name="url" type="text" id="url" value="<?= $this->options['url'] ?>" />
				<input name="video" type="hidden" id="video" value="<?= $this->options['video'] ?>" />
			</td>
		</tr>
	</tbody>
</table>