<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php 

$articleId = $_REQUEST['articleId'];
$memberId = $_REQUEST['memberId'];
$body = $_REQUEST['body'];

$sql = "
INSERT INTO articleReply
SET regDate = NOW(),
memberId = '{$memberId}',
articleId = '{$articleId}',
body = '{$body}'
";

mysqli_query($conn, $sql);

?>
<script>
location.replace('http://localhost:8022/article/detail.php?id=<?=$articleId?>');
</script>






