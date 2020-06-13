<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$titleText = '채팅방 생성';
?>
<?php include_once  $_SERVER['DOCUMENT_ROOT'] . './head.php'; ?>

<script>
    function submitCreateForm(form) {
    form.title.value = form.title.value.trim();
    
    if ( form.title.value.length == 0 ) {
        alert('제목을 입력해주세요.');
        form.title.focus();

        return false;
    }
    form.submit();
}
</script>

<div id="write-form" class="con">
<h1>채팅방 생성</h1>
    <form action="./createChatRoom.php" id="createChatRoom" onsubmit="submitCreateForm(this); return false;" method="POST" class="after">
        <div class="left">
            <div>채팅방 제목</div>            
            <div>생성</div>
        </div>
        <div class="right">
            <div>
                <input type="text" name="title" placeholder="채팅방 제목을 입력해주세요.">
                <input type="hidden" name="memberId" value="<?=$Loginedmember['id']?>">
            </div>
            <div><input style="width : 50px;" type="submit" value="생성"></div>
        </div>
    </form>
</div>
</body>
</html>