<?php include $_SERVER['DOCUMENT_ROOT'] . './head.php';
$titleText = '회원가입';
?>

<script>
    var idCheck = 0;
    console.log(idCheck);
    function loginPwCheckform(form) {
    form.loginId.value = form.loginId.value.trim();
    form.loginPw.value = form.loginPw.value.trim();
    form.loginPwCheck.value = form.loginPwCheck.value.trim();
    form.name.value = form.name.value.trim();
    
    if ( form.loginId.value.length == 0 ) {
        alert('아이디를 입력해주세요.');
        form.loginId.focus();

        return false;
    }
    if ( form.loginPw.value.length == 0 ) {
        alert('비밀번호를 입력해주세요.');
        form.loginPw.focus();

        return false;
    }
    if ( form.loginPwCheck.value.length == 0 ) {
        alert('비밀번호 확인을 입력해주세요.');
        form.loginPwCheck.focus();

        return false;
    }
    if ( form.name.value.length == 0 ) {
        alert('이름을 입력해주세요.');
        form.name.focus();

        return false;
    }
    if ( form.loginPw.value != form.loginPwCheck.value ) {
        alert('비밀번호가 다릅니다.');
        form.loginPwCheck.focus();

        return false;
    }
    if (idCheck == 0){
        alert('아이디 중복확인을 해주세요');
        form.loginId.focus();

        return false;
    }
    form.submit();
    
    }
</script>

<div id="write-form" class="con">
<h1>회원가입</h1>
    <form action="./doJoin.php" method="POST" class="after" onsubmit="loginPwCheckform(this); return false;">
        <div class="left">
            <div>아이디</div>
            <div>비밀번호</div>
            <div>비밀번호 확인</div>
            <div>이름</div>
            <div>회원가입</div>
        </div>
        <div class="right">
            <div><input style="width : 200px;" type="text" name="loginId" class="loginId" placeholder="Id"><input style="width : 80px;" id="idCheck" type="button" value="중복확인">
            <p class="idCheckText"></p></div>
            <div><input style="width : 200px;" type="password" name="loginPw" placeholder="Password"></div>
            <div><input style="width : 200px;" type="password" name="loginPwCheck" placeholder="Password"></div>
            <div><input style="width : 200px;" type="text" name="name" placeholder="Name"></div>
            <div><input style="width : 80px;" type="submit" value="회원가입"></div>
        </div>
    </form>
</div>
</body>
</html>