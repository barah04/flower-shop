<?php
session_start();
session_destroy(); // تدمير الجلسة
header("Location: page21.php"); // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
exit();
?>
