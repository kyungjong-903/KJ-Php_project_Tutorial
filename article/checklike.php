<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$memberId = $_REQUEST['memberId'];
$articleId = $_REQUEST['articleId'];

$sql = "
SELECT COUNT(*) AS 'count'
FROM `like`
WHERE memberId = '{$memberId}' AND articleId = '{$articleId}'
";

$rs = mysqli_query($conn, $sql);
$count = mysqli_fetch_assoc($rs);

$count = $count['count'];

if ($count == 0){
    $msg = 'S-1';
}
else {
    $msg = 'F-1';
}

$rsData = [];
$rsData['msg'] = $msg;
$rsData['memberId'] = $memberId;
$rsData['articleId'] = $articleId;
echo json_encode($rsData);
?>

