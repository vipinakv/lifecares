<?php
/**
 * New User Administration Screen.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

require_once ABSPATH . 'wp-admin/admin-header.php';

$doctor = $wpdb->get_row("SELECT * FROM wp_doctors_data WHERE id=".$_GET['id']);
$image = empty($doctor->image) ? 'avatar.png' : $doctor->image;
?>
<div class="wrap">
<p class="search-box">
	<a href="doctors_index.php" class="page-title-action">Go back</a>
</p>
    <table class="form-table" role="presentation">
        <tr>
            <img src="<?=get_template_directory_uri()?>/assets/doctors_photo/<?=$image?>" width="150">
        </tr>
        <tr>
            <td>Name : <?=$doctor->first_name?><?=$doctor->last_name?></td>
        </tr>
        <tr>
            <td>email : <?=$doctor->email?><?=$doctor->last_name?></td>
        </tr>
        <tr>
            <td>phone : <?=$doctor->phone?><?=$doctor->last_name?></td>
        </tr>
        <tr>
            <td>designation : <?=$doctor->designation?><?=$doctor->last_name?></td>
        </tr>
        <tr>
            <td>facebook : <?=$doctor->facebook_link?><?=$doctor->last_name?></td>
        </tr>
        <tr>
            <td>Twitter : <?=$doctor->twitter_link?><?=$doctor->last_name?></td>
        </tr>
        <tr>
            <td>Linked in : <?=$doctor->linked_in?><?=$doctor->last_name?></td>
        </tr>
        <tr>
            <td>Description : <?=$doctor->description?><?=$doctor->last_name?></td>
        </tr>
    </table>
</div>
<style>
    .search-box
    {
        margin-top: 35px !important;
    }  
</style>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';
?>