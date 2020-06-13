<?php include $_SERVER['DOCUMENT_ROOT'] . './head.php';
$titleText = '로그인';
?>
<script>

function LoginAsTest(){
    $('.loginId').val('test')
    $('.loginPw').val("test");
}

</script>

<div id="write-form" class="con">
<h1>로그인</h1>
    <form action="./doLogin.php" method="POST" class="after">
        <div class="left">
            <div>아이디</div>
            <div>비밀번호</div>
            <div>로그인</div>
        </div>
        <div class="right">
            <div><input style="width : 200px;" type="text" name="loginId" class="loginId"></div>
            <div><input style="width : 200px;" type="password" name="loginPw" class="loginPw"></div>
            <div><input style="width : 50px; display:inline-block;" type="submit" value="로그인"> <input style="display:inline-block; width : 100px;" type="button" onclick="LoginAsTest();" value="테스트 아이디"></div>
        </div>
    </form>
</div>
</body>
</html>