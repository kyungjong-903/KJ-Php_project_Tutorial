<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php 
unset($_SESSION['loginedMember']);
unset($_SESSION['loginedMemberId']);
?>

<script>
alert('로그아웃 되었습니다.');
location.replace('../article/list.php');
</script>