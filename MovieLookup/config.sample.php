<?php
const LOGGER_DB = '';
const LOGGER_USER = '';
const LOGGER_PASS = '';
const MOVIE_DB_KEY = '';
const APP_PATH = '';

spl_autoload_register(function($class) {
    include "{$_SERVER['DOCUMENT_ROOT']}/" . APP_PATH . "classes/{$class}.php";
});
