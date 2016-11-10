<?php /*?><p>Hello,<br></p>
		<p>You can change your password through this <a href="{{ $body_url }}" >link</a>:<br> We remind you that you have 2 days until the link expires. </p><?php */?>
        <?php echo trans('emailtemplet.forgotpassword', array('body_url' => $body_url));


?>