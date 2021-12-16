<?php
/*
Template Name: Contact page
*/
$base_url = get_bloginfo('wpurl');
?>
<?php get_header(); ?>
<section class="page-title page-title-service">
    <div class="container">
    <h1>Contact us</h1>
    </div>
</section>
<div class="container">

<div class="d-flex contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span id="success" style="margin-top: 20px;"></span>
                    <h4 style="margin:20px 0px">Contact Us</h4>
                    <form id="contact-form" action="" method="post">
                        <div class="form-group" id="name-group">
                            <input class="form-control" type="text" placeholder="Name" name="name" id="name"> 
                        </div>
                        <div class="form-group" id="email-group">
                            <input class="form-control" type="text" placeholder="Email" name="email" id="email"> 
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="message" rows="3" name="message" placeholder="message"></textarea>
                        </div>
                        <input type="hidden" value=<?=get_bloginfo('admin_email')?> id="admin_email"/>
                        <input type="hidden" value="<?=$base_url?>" id="base_url"/>
                        <button type="submit" class="btn btn-contact-submit">Submit</button>
                    </form>
                </div>
                <div class="col-md-8" style="margin-top:15px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15611.364309140492!2d75.36795530595641!3d11.985496303495493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba43e44a99ada63%3A0x279f4178f3f56240!2sDharmasala%2C%20Kerala!5e0!3m2!1sen!2sin!4v1638439855882!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

        </div>
</div>
    
</div>

<script>
    $(document).ready(function() {

        $("#contact-form").submit(function (event) {
            event.preventDefault();
            $(".help-block").remove();
            $(".form-control").removeClass('error-msg');
            var name = $("#name").val();
            var email = $("#email").val();
            var message = $("#message").val();

            var formData = {
            name: name,
            email: email,
            message: message,
            admin_email : $("#admin_email").val(),
            site_url : $("#base_url").val(),
            };

            if(name == '')
            { 
                $("#name").addClass("error-msg");
                $("#name-group").append('<div class="help-block mb-3">Please enter your name</div>');
            }
            if(email == '')
            {
                $("#email").addClass("error-msg");
                $("#email-group").append('<div class="help-block mb-3">Please enter your email</div>');
            }

            if(email != '')
            {
                var is_email = isEmail($("#email").val());
                if(!is_email)
                {
                $("#email").addClass("error-msg");
                $("#email-group").append('<div class="help-block">Please enter a valid email</div>');
                }
            }
            if(is_email && name != '')
            {
                $('#preloader').show();
                $.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    post_details : formData,
                    action: 'contact_details' // this is going to be used inside wordpress functions.php
                },
                encode: true,
            }).done(function (data) {
                //console.log(data);
                $('#preloader').hide();
                $("#name").val('');
                $("#email").val('');
                $("#message").val('');
                if(data == 0)
                {
                $("#success").html('<div class="alert alert-success">Thank you for contacting us. We will get in touch with you soon.</div>');
                }
                else
                {
                $("#success").html('<div class="alert alert-danger">Sorry your email not sent. We have technical issues. Please try again later.</div>');
                }
                
            });
            }
        });

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
    });

</script>

<?php get_footer(); ?>
