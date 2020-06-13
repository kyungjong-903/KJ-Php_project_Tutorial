<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php


$id = $_REQUEST['id'];
$boardId = $_REQUEST['boardId'];
$title = $_REQUEST['title'];
$body = $_REQUEST['body'];


$sql = "
UPDATE INTO article
SET regDate = NOW(),
memberId = '1',
boardId = '{$boardId}',
title = '{$title}',
body = '{$body}'
WHERE id =  '{$id}'
";

mysqli_query($conn, $sql);
?>

<script>
alert('<?=$id?>번 게시물이 수정되었습니다.');
location.replace('./detail.php?id=<?=$id?>');
</script>

