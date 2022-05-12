<?php
include "app/helper.php";

try {
    $flag = mail("bhagirath.wscube@gmail.com", "Testing Email", "Testing the email data", []);
} catch (\Exception $err) {
    p($err->getMessage());
}
p($flag);
