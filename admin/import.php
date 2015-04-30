<?php if (isset($_POST['action'])) {
    $this->import_videos();
} ?>

    <div class="wrap import">

        <h2><?php _e('Import Videos to Youtube Customizr', 'youtube-customizr'); ?></h2>
        <hr />
        <form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <h3><?php _e('Import all uploads of a single user', 'youtube-customizr'); ?></h3>
            <p class="description">
                <?php _e('If you want to import your uploaded videos at once you just have to fill in your username and press import.', 'youtube-customizr'); ?>
            </p>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="import" value="user">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="import_value"><?php _e('Username', 'youtube-customizr'); ?></label>
                        </th>
                        <td>
                            <input class="regular-text" name="import_value" type="text" id="import_username" value="<?php echo ( isset($_POST['import']) && $_POST['import'] == 'user' ? $_POST['import_value'] : ''); ?>" />
                            <select name="recurring" id="recurring">
	                            <option value="none>"><?php echo _e ('Don\'t Repeat','youtube-customizr'); ?></option>
                                <?php $schedules = wp_get_schedules();
                                foreach ($schedules as $key => $value ) { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value['display']; ?></option>
                                <?php } ?>
                            </select>
                            <?php submit_button('Import all uploads'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <hr />
        <form method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <h3><?php _e('Import a playlist', 'youtube-customizr'); ?></h3>
            <p class="description">
                <?php _e('If you want to import all videos in a playlist at once you just have to fill in the playlist id and press import.', 'youtube-customizr'); ?>
            </p>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="import" value="playlist">
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row">
                        <label for="import_value"><?php _e('Playlist ID', 'youtube-customizr'); ?></label>
                    </th>
                    <td>
                        <input class="regular-text" name="import_value" type="text" id="import_playlist" />
                        <select name="recurring" id="recurring">
	                        <option value="none>"><?php echo _e ('Don\'t Repeat','youtube-customizr'); ?></option>
                            <?php foreach ($schedules as $key => $value ) { var_dump($schedules);?>
                            <option value="<?php echo $key; ?>"><?php echo $value['display']; ?></option>
                            <?php } ?>
                        </select>
                        <?php submit_button('Import playlist'); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>