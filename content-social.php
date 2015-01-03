<?php
//social icons
$social = get_option('tpb-social');
?>
<div class="col-md-12 social-icons">
	<?php if(!empty($social['facebook']) && $social['facebook'] !== false): ?>
	    <a href="<?php echo $social['facebook']; ?>" class="fa fa-facebook-square"></a>
	<?php endif; ?>
	<?php if(!empty($social['twitter']) && $social['twitter'] !== false): ?>
	    <a href="<?php echo $social['twitter']; ?>" class="fa fa-twitter-square"></a>
	<?php endif; ?>
</div><!-- .col-md-12 social-icons -->
