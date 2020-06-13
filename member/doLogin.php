<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php
$loginId = $_REQUEST['loginId'];
$loginPw = $_REQUEST['loginPw'];


$sql = "
SELECT *
FROM `member`
WHERE loginId = '{$loginId}'
";

$rs = mysqli_query($conn, $sql);
$member = mysqli_fetch_assoc($rs);

if ( $member === null ) {
    ?>
    <script>
    alert('존재하지 않는 아이디 입니다.');
    history.back();
    </script>
    <?php
    exit;
    }

if ( $member['loginPw'] =! $loginPw ) {
    ?>
    <script>
    alert('비밀번호가 일치하지 않습니다.');
    history.back();
    </script>
    <?php
    exit;
    } 
    
    $_SESSION['loginedMember'] = $member;
    $_SESSION['loginedMemberId'] = $member['id'];
    ?>

    

<script>
alert('<?=$member['name']?> 님 환영합니다.');
location.replace('../article/list.php');
</script>

