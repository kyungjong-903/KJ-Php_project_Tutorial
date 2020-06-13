<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$titleText = '게시물 작성'; 
?>
<?php include_once  $_SERVER['DOCUMENT_ROOT'] . './head.php'; ?>

<script>
    function submitWriteForm(form) {
    form.title.value = form.title.value.trim();
    form.body.value = form.body.value.trim();

    if ( form.title.value.length == 0 ) {
        alert('제목을 입력해주세요.');
        form.title.focus();

        return false;
    }
    if ( form.body.value.length == 0 ) {
        alert('내용을 입력해주세요.');
        form.body.focus();

        return false;
    }
    form.submit();
}
</script>

<div id="write-form" class="con">
<h1>게시물 작성</h1>
    <form action="./doWrite.php" onsubmit="submitWriteForm(this); return false;" method="POST" class="after">
        <div class="left">
            <div>작성</div>
            <div>작성자</div>
            <div>게시판선택</div>
            <div>제목</div>
            <div>내용</div>
        </div>
        <div class="right">
            <div><input style="width : 50px;" type="submit" value="작성"></div>
            <div><?=$Loginedmember['name']?></div>
            <div><select name="boardId">
                    <option value="2">자유게시판</option>
                    <option value="1">공지사항</option>
                </select></div>
            <div><input type="text" name="title" placeholder="제목을 입력하세요"></div>
            <div><textarea style="height : 200px;" name="body" ></textarea></div>
        </div>
    </form>
</div>
</body>
</html>