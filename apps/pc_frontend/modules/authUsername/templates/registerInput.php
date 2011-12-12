<?php

$options = array();
$options['url'] = url_for('authUsername/register');

op_include_form('requestRegisterUriForm', $form, $options);