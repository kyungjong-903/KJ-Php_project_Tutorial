<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$chatRoomId = $_REQUEST['chatRoomId'];
$body = $_REQUEST['body'];
$memberId = $_SESSION['loginedMemberId'];

$sql = "
INSERT INTO chatRoomMessage
SET regDate = NOW(),
memberId = '{$memberId}',
chatRoomId = '{$chatRoomId}',
body = '{$body}'
";

mysqli_query($conn, $sql);

$id = mysqli_insert_id($conn);

$msg = "{$id}번 채팅메세지가 추가되었습니다.";
$resultCode = "S-1";

$rsData = [];
$rsData['msg'] = $msg;
$rsData['resultCode'] = $resultCode;

echo json_encode($rsData);

