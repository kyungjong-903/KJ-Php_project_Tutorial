<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php
$titleText = '게시물 수정'; 
$id = $_REQUEST['id'];

$sql = "
SELECT A.id, DATE(A.regDate), A.title, A.body, A.boardId, A.hit, M.name
FROM article AS A
LEFT JOIN member AS M
ON A.memberId = M.id
WHERE A.id = {$id}
";

$rs = mysqli_query($conn, $sql);

$article = mysqli_fetch_assoc($rs);

?>

<?php include $_SERVER['DOCUMENT_ROOT'] . './head.php'; ?>

<div id="write-form" class="con">
<h1>게시물 수정</h1>
    <form action="./doModify.php" method="POST" class="after">
    <input type="hidden" name="id" value="<?=$article['id']?>">
        <div class="left">
            <div>수정</div>
            <div>작성자</div>
            <div>게시판선택</div>
            <div>제목</div>
            <div>내용</div>
        </div>
        <div class="right">
            <div><input style="width : 50px;" type="submit" value="수정"></div>
            <div><?=$article['name']?></div>
            <div><select name="boardId">
                    <option value="2">자유게시판</option>
                    <option value="1">공지사항</option>
                </select></div>
            <div><input type="text" placeholder="<?=$article['title']?>" name="title"></div>
            <div><textarea style="height : 200px;" name="body"><?=$article['body']?></textarea></div>
        </div>
    </form>
</div>
</body>
</html>