<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$loginId = $_REQUEST['loginId'];

$sql = "
SELECT COUNT(*)
FROM `member`
WHERE loginId = '{$loginId}'
";

$rs = mysqli_query($conn, $sql);
$member = mysqli_fetch_assoc($rs);

if (strlen($loginId) < 3){
    $msg = 'F-1';
    echo json_encode($msg);
}

else if (strlen($loginId) > 3 && $member['COUNT(*)'] == 0) {
    $msg = 'S-1';
    echo json_encode($msg);
}
else {
    $msg = 'F-1';
    echo json_encode($msg);
}


