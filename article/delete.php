<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$id = $_REQUEST['id'];


$sql = "
DELETE FROM article
WHERE id = '{$id}'
";
mysqli_query($conn, $sql);
?>

<script>
alert('<?=$id?>번 게시물이 삭제되었습니다.');
location.replace('./list.php');
</script>

