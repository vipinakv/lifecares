<?php
use PHPMailer\PHPMailer\PHPMailer;

    function load_stylesheet(){
        wp_register_style('stylesheet',get_template_directory_uri().'/style.css', array(),false,'all');
        wp_enqueue_style('stylesheet');
    }
    add_action('wp_enqueue_sripts', 'load_stylesheet');
    add_theme_support('post-thumbnails');
    add_theme_support('post-author');
    
    function my_custom_sidebar() {
        register_sidebar(
            array (
                'name' => __( 'Custom', 'your-theme-domain' ),
                'id' => 'custom-side-bar',
                'description' => __( 'Custom Sidebar', 'your-theme-domain' ),
                'before_widget' => '<div class="widget-content">',
                'after_widget' => "</div>",
                'before_title' => '<h3 class="widget-title">',
                'after_title' => '</h3>',
            )
        );
    }
    add_action( 'widgets_init', 'my_custom_sidebar' );

    add_filter( 'wpcf7_load_js', '__return_false' );


    function register_my_menus() {
        register_nav_menus(
          array(
            'top-header' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' ),
            'footer-menu1' => __( 'Footer Menu1' )
          )
        );
      }
      add_action( 'init', 'register_my_menus' );

      add_action('wp_ajax_nopriv_contact_details','contact_details');
      add_action('wp_ajax_contact_details', 'contact_details');
  

      function wpdocs_register_my_custom_menu_page() {
        add_menu_page(
            __( 'Gallery', 'textdomain' ),
            'Gallery',
            'manage_options',
            'gallery.php',
            '',
            'dashicons-format-gallery',
            6
        );
    }
    add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );
    
    /*
    * Date : 01-12-2021
    * Function for getting images from database to be diaplayed at home page
    */
    function get_gallery_images()
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM wp_image_gallery ORDER BY created_at DESC LIMIT 8");
        return $results;
    }   

    /*
    * Date :01-12-2021
    * Function for getting posts displayed at home page
    */
    function get_home_posts()
    {
        global $wpdb;
        $query = "SELECT title, post_name, date, content,excerpt,post_id, CONCAT(LEFT(image, LENGTH(image) - LOCATE('.', REVERSE(image))),'.',SUBSTRING_INDEX(image, '.', -1)) AS image
				FROM (
				  SELECT    
				  p.post_title AS title, 
				  p.post_status AS 'status', 
				  p.post_date AS date,
				  p.post_content AS content,
				  p.post_name AS post_name,
				  p.post_excerpt AS excerpt,
                  p.ID as post_id,
				  (SELECT `guid` FROM wp_posts WHERE id = m.meta_value) AS image
				  FROM wp_posts p, wp_postmeta m
				  WHERE p.post_type = 'post'
				  AND p.post_status = 'publish'
				  AND p.id = m.post_id
				  AND m.meta_key = '_thumbnail_id'
				  ORDER BY date DESC
				  LIMIT 3
				) TT";
        $results = $wpdb->get_results($query);
        return $results;
    }

    /*
    * Date :01-12-2021
    * Function for getting author of each single post
    * params Int post_id
    * returns string author_name
    */
    function getAuthor($post_id)
    {
        global $wpdb;
        $query = 'SELECT display_name FROM `wp_users` 
            INNER JOIN wp_posts on post_author = wp_users.ID 
            WHERE wp_posts.ID ='.$post_id;
        $results = $wpdb->get_results($query);
        return $results[0]->display_name;
    }

    /*
	 * Date :01-12-2021
	 * FUnction for getting post categories
	 */
	 function get_posts_categories()
	 {
		 $base_url = get_bloginfo('wpurl');
		 global $wpdb;
		 $query = "SELECT t.name,t.slug
					FROM   wp_terms t
					INNER JOIN wp_term_taxonomy tt
					ON t.term_id = tt.term_id
					WHERE  tt.taxonomy = 'category'
					ORDER  BY name";
		 $results = $wpdb->get_results($query);

		 $html = '<div class="widget-content">
					<h3>Categories</h3>
					</div>';
		 $html .= '<div class="widget-content"><ul class="wp-block-categories-list wp-block-categories">';
		 foreach($results as $result)
		 {
			 $html .= '<li class="cat-item"><a href="'.$base_url.'/categories?cat='.$result->slug.'">'.$result->name.'</a>						</li>';
		 }

		$html .= '</ul></div>';
		 echo $html;
	 }
	add_shortcode( 'post_categories', 'get_posts_categories' );

    /*
	 * Date : 01-12-2021
	 * Function for adding pagination
	*/
	function cq_pagination($pages = '', $range = 4)
    {
        $showitems = ($range * 2)+1;
        global $paged;
        if(empty($paged)) $paged = 1;
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        if(1 != $pages)
        {
            echo "<nav aria-label='Page navigation example'>  <ul class='pagination'> <span>Page ".$paged." of ".$pages."</span>";
            if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
            if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<li class=\"page-item active\"><a class='page-link'>".$i."</a></li>":"<li class='page-item'> <a href='".get_pagenum_link($i)."' class=\"page-link\">".$i."</a></li>";
                }
            }
            if ($paged < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href=\"".get_pagenum_link($paged + 1)."\">i class='flaticon flaticon-back'></i></a></li>";
            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo " <li class='page-item'><a class='page-link' href='".get_pagenum_link($pages)."'><i class='flaticon flaticon-arrow'></i></a></li>";
            echo "</ul></nav>\n";
        }
  }

  /*
      * Date : 01-12-2021
      * Ajax request function for sending contact email
      */
      function contact_details() 
      {
          $email = $_POST['post_details']['email'];
          $admin_email = $_POST['post_details']['admin_email'];
          $message = $_POST['post_details']['message'];
          $name = $_POST['post_details']['name'];
          $site_url = $_POST['post_details']['site_url'];
          
          send_email($email,$name,$admin_email,$message,$site_url);
          return true;
      }
  
      /*
      * Date : 01-12-2021
      * Function for sending email
      * Params @$email : string
      */
      function send_email($email,$name=null,$admin_email=null,$message=null,$site_url)
      {
          require_once "PHPMailer/PHPMailer.php";
          require_once "PHPMailer/SMTP.php";
          require_once "PHPMailer/Exception.php";
      
          $mail = new PHPMailer;
      
          $mail->isSMTP();      
          //Set SMTP host name                      
          $mail->Host = "smtp.gmail.com";
          //Set this to true if SMTP host requires authentication to send email
          //$mail->SMTPDebug = true;
          $mail->SMTPAuth = true;                      
          //Provide username and password
          $mail->Username = "lifescare2021@gmail.com";       
          $mail->Password = "Lifecare@2021";                       
          //If SMTP requires TLS encryption then set it
          $mail->SMTPSecure = "tls";                     
          //Set TCP port to connect to
          $mail->Port = 587;                 
          $mail->From = "lifescare2021@gmail.com";
          $mail->FromName = 'Lifecare';
          $recipient_mail = $admin_email;
          $mail->addAddress($recipient_mail, "Recepient Name");
          //$mail->isHTML(true);
          $mail->Subject = "Weavers";
          $mail->Body = "<b>Messag from ".$name."</b><br>Email: ".$email."<br>Message : ".$message."<br><a href=".$site_url.">".$site_url."</a>";
          $mail->AltBody = "This is the plain text version of the email content";
          if($mail->send())
          {
              return true;
          }
          else
          {
            return false;
          }  
      }

      /*
      * Date : 01-12-2021
      * Function for adding a left menu - doctors
      */
      function register_my_custom_menu_doctors_page() {
        add_menu_page(
            __( 'Doctors', 'textdomain' ),
            'Doctors',
            'manage_options',
            'doctors_index.php',
            '',
            'dashicons-admin-users',
            6
        );
    }
    add_action( 'admin_menu', 'register_my_custom_menu_doctors_page' );

    add_action('admin_menu', 'register_custom_submenu');

    function register_custom_submenu() {
    add_submenu_page( 'doctors_index.php', 'Add Doctor', 'Add New', 'administrator', 'add_doctor.php', '' );
    }

    add_action('admin_menu', 'register_custom_submenu_doctor');

    function register_custom_submenu_doctor() {
        add_submenu_page( 'doctors_index.php', 'Add Doctor', 'Add Consulting Time', 'administrator', 'add_doctor_time.php', '' );
        }

    /*
    * Date : 02-12-2021
    * Function for getting doctors
    */
    function get_doctors()
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT * FROM wp_doctors_data WHERE status = 1 ORDER BY created_at DESC");
        return $results;
    }   

    /*
    * Date : 06-12-2021
    * Function for getting events
    */
    function get_all_events()
    {
       /* global $wpdb;
        $results = $wpdb->get_results("SELECT wp_posts.post_title,wp_posts.id,wp_posts.post_excerpt AS excerpt
        from wp_posts WHERE wp_posts.post_type = 'tribe_events' AND wp_posts.post_title NOT LIKE 'Auto Draft' 
        AND wp_posts.post_status = 'publish' ORDER BY post_date DESC LIMIT 3");
        return $results;*/

        $events = tribe_get_events(
            array(
                'eventDisplay'=>'upcoming',
                'posts_per_page' => 3,
        )
        );
        return $events;
    }

    /*
    * Date : 07-12-2021
    * Function for getting doctor visit days
    */
    function get_doctor_visit_days($id)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT visit_day,visit_time from wp_doctor_visit_days WHERE doctor_id=".$id);
        $days = '';
        foreach($results as $result)
        {
            if($result->visit_day == 'All')
            {
                $days .= "All days - ".$result->visit_time." ";
            }
            else
            {
                $days .= $result->visit_day." - ".$result->visit_time." ";
            }
        }
       // $days = rtrim($days,',');
        return $days;
    }

    add_action('wp_ajax_nopriv_edit_doctor_time','edit_doctor_time');
    add_action('wp_ajax_edit_doctor_time', 'edit_doctor_time');

    /*
    * Date : 09-12-2021
    * Function for getting timer for setting consulting time
    */
    function edit_doctor_time()
    {
        $day = $_POST['day'];
        $html = '<th scope="row"><label for="user_login">Edit Time( '.$day.' )</label></th>
                <td id="time1"><input type="time" name="start_time" id="start_time"/>
                <input type="time" name="end_time" id="end_time"/>
                <input type="button" class="change_time button" id="'.$day.'" value="edit"/>
                </td>';

        echo $html;exit;
    }

    add_action('wp_ajax_nopriv_edit_db_time','edit_db_time');
    add_action('wp_ajax_edit_db_time', 'edit_db_time');

    /*
    * Date : 09-12-2021
    * Function for saving time change on table
    */
    function edit_db_time()
    {
        $day = $_POST['day'];
        $doctor_id = $_POST['doctor_id'];
        $start_time = date('h:ia', strtotime($_POST['start_time']));
	    $end_time = date('h:ia', strtotime($_POST['end_time']));
        global $wpdb;

        $data['visit_time'] = $start_time." - ".$end_time;
        $data['updated_at'] = time();

        $visit_time = $start_time." - ".$end_time;

		$wpdb->update('wp_doctor_visit_days', $data, ['doctor_id' => $doctor_id,'visit_day' => $day]);
        
        echo $visit_time;exit;
    }

    add_action('wp_ajax_nopriv_delete_db_time','delete_db_time');
    add_action('wp_ajax_delete_db_time', 'delete_db_time');

    /*
    * Date : 09-12-2021
    * Function for saving time change on table
    */
    function delete_db_time()
    {
        $day = $_POST['day'];
        $doctor_id = $_POST['doctor_id'];

        global $wpdb;
        $wpdb->delete( 'wp_doctor_visit_days',['doctor_id' => $doctor_id,'visit_day' => $day]);
        exit;
    }
    add_action('wp_ajax_nopriv_doctor_search','doctor_search');
    add_action('wp_ajax_doctor_search', 'doctor_search');

    /*
    * Date : 09-12-2021
    * Function for searching doctors
    */
    function doctor_search()
    {
        global $wpdb;
        $keyword = $_POST['keyword'];

        $doctors_list = $wpdb->get_results("SELECT * FROM wp_doctors_data where first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%'");
        $html = '';
        foreach($doctors_list as $doctor_list){
            $image = empty($doctor_list->image) ? 'avatar.png' : $doctor_list->image;
            $status = ($doctor_list->status == 1) ? 'Active' : 'Inactive';
            
            $html .= '<tr>';
            $html .= '<td class="name column-name has-row-actions column-primary" data-colname="name">
                    <img src="'.get_template_directory_uri().'/assets/doctors_photo/'.$image.'" class="gravatar avatar avatar-32 um-avatar um-avatar-default" alt="doctor" data-default="http://localhost/lifecare/wp-content/plugins/ultimate-member/assets/img/default_avatar.jpg" width="32" height="32"> 
                    <strong>'.$doctor_list->first_name." ".$doctor_list->last_name.'
                    </strong><br><div class="row-actions"><span class="edit"><a href="add_doctor.php?id='.$doctor_list->id.'">Edit</a> | </span><span class="view"><a href="view_doctor.php?id='.$doctor_list->id.'" aria-label="View posts by admin">View</a></div>
                </td>';
            $html .= '<td class="name column-designation" data-colname="designation">'.$doctor_list->designation.'</td>';
            $html .= '<td class="email column-email" data-colname="Email">'.$doctor_list->email.'</td>';
            $html .= '<td class="role column-phone" data-colname="Phone">'.$doctor_list->phone.'</td>';
            if($doctor_list->status == 1)
            {
                $style ='background-color : #148847';
            }
            else
            {
                $style = 'background-color : #f76060';
            }
            $html .= '<td class="posts column-posts num" data-colname="Status"><span style="color:#000;'.$style.'">'.$status.'</span></td>';
            $html .= '</tr>';
        } 
        echo $html;exit;
    }
    
?>