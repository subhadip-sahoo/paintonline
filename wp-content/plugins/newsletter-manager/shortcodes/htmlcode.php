<script>
function xyz_em_verify_fields()
{
var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
var address = document.subscription.xyz_em_email.value;
if(reg.test(address) == false) {
	alert('<?php _e( 'Please check whether the email is correct.', 'newsletter-manager' ); ?>');
return false;
}else{
//document.subscription.submit();
return true;
}
}
</script>
<style>
#tdTop{
	border-top:none;
}
</style>
<form method="POST" name="subscription" action="<?php echo get_site_url()."/index.php?wp_nlm=subscription";?>">
    <input type="text" name="xyz_em_email" id="newsletter" placeholder="Your E-mail Address here">
    <input type="submit" name="htmlSubmit"  id="submit_em" class="btn btn-newsletter" value="Subscribe" onclick="javascript: if(!xyz_em_verify_fields()) return false; ">
</form>