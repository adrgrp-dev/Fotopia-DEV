<?php 
$to      = 'sidambara.selvan@adrgrp.com';
$subject = 'the subject';
$message = 'hello';
$headers = array(
    'From' => 'info@adrgrp.com',
    'Reply-To' => 'info@adrgrp.comm',
    'X-Mailer' => 'PHP/' . phpversion()
);

mail($to, $subject, $message, $headers);
?>


