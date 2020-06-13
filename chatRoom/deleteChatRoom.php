<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$id = $_REQUEST['id'];


$sql = "
DELETE FROM chatRoom
WHERE id = '{$id}'
";
mysqli_query($conn, $sql);

$sql = "
DELETE FROM chatRoomMessage
WHERE chatRoomId = '{$id}'
";
mysqli_query($conn, $sql);
?>

<script>
alert('<?=$id?>번 채팅방이 삭제되었습니다.');
location.replace('./listChatRoom.php');
</script>

