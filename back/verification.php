<?php
session_start();
if (isset($_POST['captcha']) && strtolower($_POST['captcha']) == strtolower($_SESSION['captcha'])) {
    echo "CAPTCHA correct.";

} else {
    echo "CAPTCHA incorrect.";
}