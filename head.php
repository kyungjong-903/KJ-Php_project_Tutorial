<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php if ($isLogined) {
    $Loginedmember = $_SESSION['loginedMember'];
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css"
    integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
     <?php include $_SERVER['DOCUMENT_ROOT'] . './head.js';
    ?>
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>경종 커뮤니티 - <?=$titleText?></title>
</head>
<style>
    <?php include $_SERVER['DOCUMENT_ROOT'] . './head.css';
    ?>
</style>

<body>
    <div id="header">
        <div class="Wrapper con after">
            <div class="logo">
                <a href="/article/list.php"">KYUNG JONG</a>
            </div>
            <ul class=" nav after">
                    <?php if (!$isLogined) { ?>
                    <li><a href="/member/join.php">회원가입</a></li>
                    <li><a href="/member/login.php">로그인</a></li>
                    <?php } ?>
                    <?php if ($isLogined) { ?>
                    <li><a href="/article/write.php">글쓰기</a></li>
                    <li><a href="/chatRoom/newChatRoom.php">채팅방 생성</a></li>
                    <li><a href="/member/doLogout.php">로그아웃</a></li>
                    <?php } ?>
                    </ul>
                    <div class="nameBox">
                        <?php if ($isLogined) { ?>
                        <li><span><?=$Loginedmember['name']?></span> 님 환영합니다.</li>
                        <?php } ?>
                    </div>
                    
            </div>
            <ul class="gnb con after">
                <li class="portfolio"><a href="#">PORTFOLIO</a></li>
                <li><a href="/article/list.php?boardId=1">공지사항</a></li>
                <li><a href="/article/list.php?boardId=2">자유게시판</a></li>
                <li><a href="/chatRoom/listChatRoom.php">채팅방</a></li>
            </ul>
        </div>