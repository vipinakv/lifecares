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
?>
<style>
.img-wrap {
    position: relative;
    display: inline-block;
    font-size: 0;
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #FFF;
    padding: 2px 2px 7px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    opacity: .5;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wrap:hover .close {
    opacity: 1;
}
</style>
<?php

if(isset($_POST['SubmitButton']))
{ 
    // File upload configuration 
    $targetDir = ABSPATH."wp-content/themes/lifecare/assets/gallery/";
    $allowTypes = array('jpg','JPG','png','jpeg','gif'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['images']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['images']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['images']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to databse 
                if(move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)){ 
					$wpdb->insert('wp_image_gallery', array(
						'image_name' => $fileName,
						'title' => "",
						'created_at' => time(),
						'updated_at' => time(), 
					));
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        // Error message 
        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
         
        }else{ 
            $statusMsg = 'Please select a file to upload.'; 
    } 
}  
$results = $wpdb->get_results("SELECT * FROM wp_image_gallery");
$base_url = get_bloginfo('wpurl');
?>
<h1 class="wp-heading-inline">Gallery</h1>
<span class="row-title">You can select multiple images at a time</span>
<form action="" method="post" enctype="multipart/form-data">
	<table style="padding:20px">
		<tr>
			<td>Upload Images</td>
			<td><input type="file" name="images[]" multiple required="required"/></td>
		</tr>
		<tr>
			<td><input type="submit" name="SubmitButton" class="button button-primary" value="Upload"></td>
		</tr>
	</table>	
</form>

<h2 class="wp-heading-inline">Images in gallery</h2>
<?php 
foreach($results as $result)
{
	$imageURL = get_template_directory_uri().'/assets/gallery/'.$result->image_name;
?>
    <div class="img-wrap">
        <span class="close">&times;</span>
        <img style='width:100px;float:left; height:100px;margin-bottom:5px; margin-left:5px;border-radius:10px;'
    src="<?=$imageURL; ?>" data-id="<?=$result->id;?>"/>
    </div>

<?php }
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       
        $('.img-wrap .close').on('click', function() {
            var id = $(this).closest('.img-wrap').find('img').data('id');
            $.ajax({
                url : 'gallery.php',
                type : 'POST',
                data : {
                    'id' : id
                },
                success : function(data) {              
                    location.reload();
                },
            });
        });
    });
</script>
<?php
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $result = $wpdb->get_results("SELECT * FROM wp_image_gallery where id=".$id);
        $image = $result[0]->image_name;
        $image_path = WP_CONTENT_DIR.'/themes/lifecare/assets/gallery/'.$image;
       
        //Deleting image from folder
        if (file_exists($image_path)) 
        {
            unlink($image_path);
        }
        //Deleting from table
        $table = "wp_image_gallery";
        $wpdb->delete( $table, array( 'id' => $id ));
        exit;
    }
?>

<?php

require_once ABSPATH . 'wp-admin/admin-footer.php';
?>
