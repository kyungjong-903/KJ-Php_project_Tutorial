<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$memberId = $_REQUEST['memberId'];
$articleId = $_REQUEST['articleId'];

$sql = "
INSERT INTO like
regDate = NOW(),
memberId = '{$memberId}',
articleId = '{$articleId}'
";

 mysqli_query($conn, $sql);


