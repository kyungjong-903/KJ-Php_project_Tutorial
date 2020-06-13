<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$title = $_REQUEST['title'];
$memberId = $_REQUEST['memberId'];


$sql = "
INSERT INTO chatRoom
SET regDate = NOW(),
memberId = '{$memberId}',
title = '{$title}'
";

mysqli_query($conn, $sql);
?>

<script>
alert('채팅방이 생성되었습니다.');
location.replace('./listChatRoom.php');
</script>

