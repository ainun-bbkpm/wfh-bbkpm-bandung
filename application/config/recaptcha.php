<?php
defined('BASEPATH') or exit('No direct script access allowed');

// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin
$config['recaptcha_site_key'] = '6LcZas8ZAAAAAG_XOTNYuC0F3uq5ALsHKCD7HIuT';
$config['recaptcha_secret_key'] = '6LcZas8ZAAAAANAoqwYs0kvTMzsuXJCghD_MZVeB';

// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
$config['recaptcha_lang'] = 'en';

/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */