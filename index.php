<?php
/**
 * Redirect otomatis ke folder public Laravel saat dibuka di XAMPP
 * URL: http://localhost/findu-laravel/ -> http://localhost/findu-laravel/public/
 */
header('Location: public/');
exit;
