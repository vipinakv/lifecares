<?php
/**
 * New User Administration Screen.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . '/admin.php';

wp_enqueue_script( 'wp-ajax-response' );
ob_start();

require_once ABSPATH . 'wp-admin/admin-header.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$doctor = $wpdb->get_row("SELECT * FROM wp_doctors_data WHERE id=".$id);
$visiting_days = $wpdb->get_results("SELECT visit_day FROM wp_doctor_visit_days WHERE doctor_id =".$id);
$i = 0;
$consult_days = json_decode(json_encode($visiting_days), true);
if(empty($id))
{
	$title = 'Add Doctor';
	$btnvalue = 'Add';
}
else
{
	$title = 'Edit Doctor : '.$doctor->first_name." ".$doctor->last_name;
	$btnvalue = 'Edit';
}
$visit_days = get_doctor_visit_days($id);

$visit_days = preg_split('/(?=[A-Z])/',$visit_days);
array_shift($visit_days);

$admin_url = admin_url();
?>
<style>
	.time_delete
	{
		margin-left: 5px;
	}
	.fileinput-upload {
        display: none !important;
	}
	.file-input
	{
		width : 41%;
	}
	textarea
	{
		width:41% !important;
	}

</style>
<script src="<?=$admin_url?>/js/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="<?=$admin_url?>/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="<?=$admin_url?>/js/fileinput.js" type="text/javascript"></script>
<div class="wrap">
<h1 id="add-new-doctor"><?=$title?></h1>

<p class="search-box">
	<a href="doctors_index.php" class="page-title-action">Go back</a>
</p>
<form method="post" name="createuser" id="createuser" class="validate" novalidate="novalidate" enctype="multipart/form-data">
<?php
	// Load up the passed data, else set to a default.
	$first_name = !empty($doctor->first_name) ? $doctor->first_name : '';
	$last_name = !empty($doctor->first_name) ? $doctor->last_name : '';
	$email = !empty($doctor->email) ? $doctor->email : '';
	$phone = !empty($doctor->phone) ? $doctor->phone : '';
	$facebook = !empty($doctor->facebook_link) ? $doctor->facebook_link : '';
	$twitter = !empty($doctor->twitter_link) ? $doctor->twitter_link : '';
	$linkedin = !empty($doctor->linked_in) ? $doctor->linked_in : '';
	$designation = !empty($doctor->designation) ? $doctor->designation : '';
	$description = !empty($doctor->description) ? $doctor->description : '';
	$image = !empty($doctor->image) ? $doctor->image : '';
?>
<table class="form-table" role="presentation">
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'Username' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="first_name" type="text" id="first_name" value="<?php echo esc_attr($first_name ); ?>" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" required/></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="user_login"><?php _e( 'Lastname' ); ?></label></th>
		<td><input name="last_name" type="text" id="last_name" value="<?=$last_name?>" autocapitalize="none" autocorrect="off" maxlength="60" /></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="email"><?php _e( 'Email' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="email" type="email" id="email" value="<?=$email?>"/></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'Phone' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="phone" type="text" id="phone"  value="<?=$phone?>" aria-required="true"/></td>
	</tr>
    <tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'designation' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="designation" type="text" id="designation"  value="<?=$designation?>" aria-required="true"/></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'Facebook' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="facebook_link" type="text" id="facebook_link"  value="<?=$facebook?>" aria-required="true"/></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'linkedin' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="linkedin" type="text" id="linkedin"  value="<?=$linkedin?>" aria-required="true"/></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'Twitter' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><input name="twitter_link" type="text" id="twitter_link"  value="<?=$twitter?>" aria-required="true"/></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="user_login"><?php _e( 'image' ); ?></label></th>
		<td>
<?php if(!empty($image))
		{?>
		<img src="<?=get_template_directory_uri()?>/assets/doctors_photo/<?=$image?>" width="100">
<?php }?> <input class="file" type="file" name="image"/></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'description' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td><textarea name="description" aria-required="true" cols="10" rows="10" class="textarea"><?=$description?></textarea></td>
	</tr>
	<?php
	if(!empty($id))
	{?>
		<tr class="form-field">
			<th scope="row"><label for="status"><?php _e( 'Status' ); ?></label></th>
			<td>
				<select name="status" id="status">
					<option value="1"<?php if($doctor->status == 1){?> selected="selected"<?php }?>>Active</option>
					<option value="2"<?php if($doctor->status == 2){?> selected="selected"<?php }?>>Inactive</option>
				</select>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="user_login"><?php _e( 'Consulting time' ); ?></label></th>
			<td>
				<?php 
					foreach($visit_days as $day)
					{?>
						<p id="time_<?=$consult_days[$i]['visit_day']?>"><?=$day?><a href="" class="time_edit" data-day="<?=$consult_days[$i]['visit_day']?>">Edit</a>
						<a href="" class="time_delete" data-day="<?=$consult_days[$i]['visit_day']?>">Delete</a></p>
					<?php 
				$i++;} ?>
				<a href="<?=esc_url(admin_url('add_doctor_time.php?id='.$id))?>">Add consulting time</a>
			</td>		
		</tr>
		<tr id="edit_time">
		</tr>
		<?php }?>
</table>
	<?php submit_button( __( $btnvalue ), 'primary', 'createuser', true); ?>

</form>
<input type="hidden" value="<?=$id?>" id="doctor_id">
</div>

<?php
if(isset($_POST['createuser']))
{
    $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$designation = $_POST['designation'];
	$description = $_POST['description'];
	$facebook = $_POST['facebook_link'];
	$twitter = $_POST['twitter_link'];
	$linkedin = $_POST['linkedin'];

	$targetDir = ABSPATH."wp-content/themes/lifecare/assets/doctors_photo/";
	$fileName = $_FILES['image']['name'];

	if (!empty($fileName)) {
		if (!empty($id) && $doctor->image != '') {
			$image_path = WP_CONTENT_DIR.'/themes/lifecare/assets/doctors_photo/'.$doctor->image;
			//Deleting image from folder
			if (file_exists($image_path)) {
				unlink($image_path);
			}
		}
		$targetFilePath = $targetDir . $fileName;
		if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
			$image_name = $fileName;
		}
	}
	else if(!empty($id) && empty($fileName)){
		$image_name = $doctor->image;
	}
	else
	{
		$image_name = '';
	}
	
	if(!empty($id))
	{
		$data['first_name'] = $first_name;
		$data['last_name'] = $last_name;
		$data['email'] = $email;
		$data['phone'] = $phone;
		$data['designation'] = $designation;
		$data['twitter_link'] = $twitter;
		$data['facebook_link'] = $facebook;
		$data['linked_in'] = $linkedin;
		$data['description'] = $description;
		$data['image'] = $image_name;
		$data['status'] = $_POST['status'];

		$wpdb->update('wp_doctors_data', $data, ['id' => $id]);
	}
	else
	{
        $wpdb->insert('wp_doctors_data', array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'designation'=> $designation,
            'description' => $description,
            'facebook_link' => $facebook,
            'twitter_link' => $twitter,
            'linked_in'=> $linkedin,
            'status' => 1,
            'image' => $image_name,
            'created_at' => time(),
            'updated_at' => time()
        ));
		$doctor_id = $wpdb->insert_id;
    }

	$redirect = 'doctors_index.php';
	wp_redirect( $redirect );
	exit();
}
?>
<script>
    $(document).ready(function() {

		//Getting timer for updating consulting time
		$(document).on("click", ".time_edit", function(){
			event.preventDefault();
			var day =  $(this).data("day");	
			$.ajax({
                type: "POST",
                url: "admin-ajax.php",
                data: {
					day : day,
                    action: 'edit_doctor_time' // this is going to be used inside wordpress functions.php
                },
            }).done(function (data) {
               $("#edit_time").html(data);
            });
        });

		//Updating consulting time
		$(document).on("click", ".change_time", function(){
			var day = $(this).attr('id');
			var doctor_id = $("#doctor_id").val();
			var start_time = $("#start_time").val();
			var end_time = $("#end_time").val();

			if(start_time == '' || end_time == '')
			{
				$("#time1").append("<span style='color:red'>Please select time<span>");
			}
			else
			{
				$.ajax({
					type: "POST",
					url: "admin-ajax.php",
					data: {
						day : day,
						doctor_id : doctor_id,
						start_time : start_time,
						end_time : end_time,
						action: 'edit_db_time' // this is going to be used inside wordpress functions.php
					},
				}).done(function (data) {
					if(day == 'All')
					{
						day_first = 'All days';
					}
					else
					{
						day_first = day;
					}
				alert("Time edited successfully");
				$("#time_"+day).html(day_first+" - "+data+"<a href='' class='time_edit' data-day="+day+"> Edit</a><a href='' class='time_delete' data-day="+day+"> Delete</a>");
				$("#edit_time").html('');
				});
			}
		});

		//Deleting consulting day
		$(document).on("click", ".time_delete", function(){
			event.preventDefault();
			var day =  $(this).data("day");	
			var doctor_id = $("#doctor_id").val();
			$.ajax({
                type: "POST",
                url: "admin-ajax.php",
                data: {
					day : day,
					doctor_id : doctor_id,
                    action: 'delete_db_time' // this is going to be used inside wordpress functions.php
                },
            }).done(function (data) {
               alert("Deleted successfully");
			   $("#time_"+day).html('');
            });
		});
    });
</script>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';
?>