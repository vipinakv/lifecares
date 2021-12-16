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

$days = ['All'=>'All days','Mon'=>'Monday','Tue'=>'Tuesday','Wed'=>'Wednesday','Thu'=>'Thursday','Fri'=>'Friday','Sat'=>'Saturday','Sun'=>'Sunday'];
$doctors = $wpdb->get_results("SELECT id,first_name,last_name FROM wp_doctors_data WHERE status =1");
$list = [];
$doctors = json_decode(json_encode($doctors), true);
foreach($doctors as $doctor)
{
	$lists[$doctor['id']] = $doctor['first_name']." ".$doctor['last_name'];
}
$admin_url = admin_url();
?>
<style>
	.select-box
	{
		width : 28%;
	}
</style>
<script src="<?=$admin_url?>/js/jquery.min.js"></script>
<link href="<?=$admin_url?>/css/select2.min.css" rel="stylesheet" />
<script src="<?=$admin_url?>/js/select2.min.js"></script>
<div class="wrap">
<h1 id="add-new-doctor">Consulting time</h1>

<p class="search-box">
	<a href="<?=esc_url(admin_url('doctors_index.php'))?>" class="page-title-action">Doctors List</a>
	<?php
	if(isset($_GET['id']))
	{?>
		<a href="<?=esc_url(admin_url('add_doctor.php?id='.$_GET['id']))?>" class="page-title-action">Go back</a>
	<?php }?>
</p>
<form method="post" name="addtime" id="addtime" class="validate" novalidate="novalidate">
<table class="form-table" role="presentation">
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'Doctors' ); ?> <span class="day"><?php _e( '(required)' ); ?></span></label></th>
		<td>
			<select class="doctors select-box" name="doctor" required>
				<?php foreach($lists as $key=>$list)
				{	if($key == $_GET['id'])
					{
						$selected = 'selected';
					}
					else
					{
						$selected = '';
					}
					
					?>
					<option value=<?=$key?> <?=$selected?>><?=$list?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'Visit day' ); ?> <span class="day"><?php _e( '(required)' ); ?></span></label></th>
		<td>
			<select class="days select-box" name="days[]" multiple="multiple" aria-required="true">
				<?php foreach($days as $key=>$day)
					{	
						$selected = ($key == 'All') ? 'selected' : '';
					?>
					<option value=<?=$key?> <?=$selected?>><?=$day?></option>
				<?php }?>
			</select>
			<p>Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</p>
		</td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login"><?php _e( 'consulting time' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
		<td>
			<input type="time" name="start_time"/>
			<input type="time" name="end_time"/>
		</td>
	</tr>
</table>
	<?php submit_button( __( 'Add' ), 'primary', 'addtime', true); ?>

</form>
</div>

<?php
if(isset($_POST['addtime']))
{
	$doctor_id = $_POST['doctor'];
	$start_time = date('h:ia', strtotime($_POST['start_time']));
	$end_time = date('h:ia', strtotime($_POST['end_time']));
	$days = $_POST['days'];

	foreach($days as $day)
	{
		$results = $wpdb->get_row("SELECT * from wp_doctor_visit_days WHERE doctor_id=".$doctor_id." AND visit_day = '".$day."'");
		if(!empty($results))
		{
			$wpdb->delete( 'wp_doctor_visit_days',['doctor_id' => $doctor_id,'visit_day' => $day]);
		}
		$wpdb->insert('wp_doctor_visit_days', array(
            'doctor_id' => $doctor_id,
            'visit_day' => $day,
			'visit_time' => $start_time." - ".$end_time, 
            'created_at' => time(),
            'updated_at' => time()
        ));
	}
}
?>
<script>
	$(document).ready(function() {
    $('.select-box').select2();
});
</script>
<?php
require_once ABSPATH . 'wp-admin/admin-footer.php';
?>