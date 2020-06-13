<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php
$titleText = '게시물 상세페이지';
$id = $_REQUEST['id'];

$sql = "
UPDATE article
SET hit = hit + 1
WHERE id = '{$id}'
";

mysqli_query($conn, $sql);

$sql = "
SELECT A.id, DATE(A.regDate), A.title, A.body, A.boardId, A.hit, A.memberId, M.name, COUNT(AR.id) AS count
FROM article AS A
LEFT JOIN member AS M
ON A.memberId = M.id
LEFT JOIN articleReply AS AR
ON A.id = AR.articleId
WHERE A.id = {$id}
";

$rs = mysqli_query($conn, $sql);

$article = mysqli_fetch_assoc($rs);

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . './head.php'; ?>

<div class="detail-Box con">
<h1>상세 페이지</h1>
    <ul class="article-head after">
        <li style="width: 10%;">글</li>
        <li style="width: 40%;">
            <a href="#">제목</a>
        </li>
        <li style="width: 15%;">작성자</li>
        <li style="width: 10%;">등록일</li>
        <li style="width: 10%;">조회수</li>
        <li style="width: 15%;">비고</li>
    </ul>
    <ul class="article-body after">
        <li style="width: 10%;"><?=$article['id']?></li>
        <li style="width: 40%; text-align: left; padding-left: 20px;">
            <?=$article['title']?>
        </li>
        <li style="width: 15%;"><?=$article['name']?></li>
        <li style="width: 10%;"><?=$article['DATE(A.regDate)']?></li>
        <li style="width: 10%;"><?=$article['hit']?></li>
        <li style="width: 15%;">
        <?php
        $hasPermission = false;
        if ( $isLogined ) {
            if ( $Loginedmember['id'] == $article['memberId'] ) {
                $hasPermission = true;
            }
        }
        if ($hasPermission) { ?>
            <a href="./modify.php?id=<?=$article['id']?>">수정</a> <a
                href="./delete.php?id=<?=$article['id']?>" onclick="if ( !confirm('삭제하시겠습니까?') ) return false; ">삭제</a>
        <?php } ?>
        </li>
        </li>
    </ul>
    <div class="detail-body">
        <?=$article['body']?>
    </div>
<?php

    
    $sql = "
    SELECT AR.*, M.name
    FROM articleReply AS AR
    LEFT JOIN `member` AS M
    ON AR.memberId = M.id
    WHERE AR.articleId = {$id}
    ORDER BY AR.id DESC
    ";
    
    $rs = mysqli_query($conn, $sql);
    
    while ( $articleReply = mysqli_fetch_assoc($rs) ) {
    $articleReplies[] = $articleReply;
}
?>
    <script>
       function writeReplyform(form){
        form.body.value = form.body.value.trim();

        if ( form.body.value.length == 0 ) {
            alert('내용을 입력해주세요.');
            form.body.focus();

            return false;
        }
        form.submit();
    }
    </script>
    <div id="replyBox" class="con">
        <h2>댓글 리스트 (<?=$article['count']?>)</h2>
        <?php if ($isLogined) { ?>
        <form action="../articleReply/writeReply.php" method="POST" class="after">
            <textarea maxlength="30" name="body" placeholder="댓글을 작성해주세요"></textarea>
            <input type="hidden" name="articleId" value="<?=$id?>">
            <input type="hidden" name="memberId" value="<?=$Loginedmember['id']?>">
            <input onsubmit="writeReplyform(this); return false;" type="submit" value="댓글작성">
        </form>
        <?php } ?>
            <div class="replies">
                <ul class="reply-head after">
                    <li style="width: 55%;">댓글</li>
                    <li style="width: 15%;">작성자</li>
                    <li style="width: 20%;">등록일</li>
                    <li style="width: 10%;">비고</li>
                </ul>
                <?php
                if ($article['count'] == 0) { ?>
                    <p>댓글이 없습니다..</p>
                <?php exit; } ?>

                <?php foreach ( $articleReplies as $articleReply ) { ?>
                <ul class="reply-body after">
                    <li style="width: 55%;"><?=$articleReply['body']?></li>
                    <li style="width: 15%;"><?=$articleReply['name']?></li>
                    <li style="width: 20%;"><?=$articleReply['regDate']?></li>
                    <li style="width: 10%;">
                    <?php 
                    $hasPermission = false;
                    if ( $isLogined ) {
                        if ( $Loginedmember['id'] == $articleReply['memberId'] ) {
                            $hasPermission = true;
                        }
                    }
                    if ($hasPermission) { ?>
                        <a href="#" onclick="if ( !confirm('삭제하시겠습니까?') ) return false; ">삭제</a>
                    <?php } ?></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>
</body>

</html>