<?php

$user = $vars['user'];

echo sprintf(__('email:salutation', $user->language), $user->name);
echo "\n\n";
echo __('email:resetreq:somebody_requested', $user->language);
echo "\n\n";
echo __('email:resetreq:click_link', $user->language);
echo "\n";
echo Config::get('secure_url') . "pg/password_reset?u={$user->guid}&c={$user->passwd_conf_code}";
echo "\n";