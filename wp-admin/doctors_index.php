<?php
/**
 * Dashboard Administration Screen
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Bootstrap */
require_once __DIR__ . '/admin.php';

/** Load WordPress dashboard API */
require_once ABSPATH . 'wp-admin/includes/dashboard.php';

wp_dashboard_setup();

wp_enqueue_script( 'dashboard' );

require_once ABSPATH . 'wp-admin/admin-header.php';

$doctors_list = $wpdb->get_results("SELECT * FROM wp_doctors_data ORDER BY created_at DESC");
$base_url = get_bloginfo('wpurl');
$admin_url = admin_url();
?>
<script src="<?=$admin_url?>/js/jquery.min.js"></script>
<div class="wrap">
<h1 class="wp-heading-inline">Doctors</h1>
<a href="<?php echo esc_url( admin_url( 'add_doctor.php' ) ); ?>" class="page-title-action">Add New</a>
<p class="search-box">
    <input type="search" id="user-search-input" name="search" value="" placeholder="search by name">
    <input type="submit" id="search-submit" class="button" value="Search">
</p>
<table class="wp-list-table widefat fixed striped table-view-list users">
	<thead>
        <tr>
            <th scope="col" id="name" class="manage-column column-name">Name</th>
            <th scope="col" id="name" class="manage-column column-name">Designation</th>
            <th scope="col" id="email" class="manage-column">Email</th>
            <th scope="col" id="role" class="manage-column column-role">Phone</th>
            <th scope="col" id="posts" class="manage-column column-posts num">Status</th>	
        </tr>
	</thead>

	<tbody id="the-list" data-wp-lists="list:user">
		<?php foreach($doctors_list as $doctor_list){
            $image = empty($doctor_list->image) ? 'avatar.jpg' : $doctor_list->image;
            $status = ($doctor_list->status == 1) ? 'Active' : 'Inactive';?>
            <tr>
                <td class="name column-name has-row-actions column-primary" data-colname="name">
                    <img src="<?=get_template_directory_uri()?>/assets/doctors_photo/<?=$image?>" alt="doctor" width="32" height="32"> 
                    <strong><?=$doctor_list->first_name." ".$doctor_list->last_name;?>
                    </strong><br><div class="row-actions"><span class="edit"><a href="<?php echo esc_url(admin_url('add_doctor.php?id='.$doctor_list->id))?>">Edit</a> | </span><span class="view"><a href="<?php echo esc_url(admin_url('view_doctor.php?id='.$doctor_list->id))?>" aria-label="View posts by admin">View</a></div>
                </td>
                <td class="name column-designation" data-colname="designation"><?=$doctor_list->designation?></td>
                <td class="email column-email" data-colname="Email"><?=$doctor_list->email?></td>
                <td class="role column-phone" data-colname="Phone"><?=$doctor_list->phone?></td>
                <td class="posts column-posts num" data-colname="Status"><span style="<?php if($doctor_list->status == 1){?>
                    background-color:#148847;<?php }else{?>background-color:#f76060;<?php }?>color:#fff"><?=$status?></span></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<style>
    .widefat {
    width: 95%;
}
</style>
<script>
    $(document).ready(function() {
        $("#search-submit").click(function (event) {
            var keyword = $("#user-search-input").val();
            $.ajax({
                type: "POST",
                url: "admin-ajax.php",
                data: {
                    keyword : keyword,
                    action: 'doctor_search'
                },
                encode: true,
            }).done(function (data) {
               $("#the-list").html(data);
            });
        });
    });
</script>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';