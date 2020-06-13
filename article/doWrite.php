<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$boardId = $_REQUEST['boardId'];
$title = $_REQUEST['title'];
$body = $_REQUEST['body'];


$sql = "
INSERT INTO article
SET regDate = NOW(),
memberId = '1',
boardId = '{$boardId}',
title = '{$title}',
body = '{$body}'
";

mysqli_query($conn, $sql);
?>

<script>
alert('게시물이 추가되었습니다.');
location.replace('./list.php?boardId=<?=$boardId?>');
</script>

