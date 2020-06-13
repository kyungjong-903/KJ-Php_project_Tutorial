<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php
$titleText = '게시물 리스트';
if ( isset($_REQUEST['page']) == false ) {
    $_REQUEST['page'] = 1;
}
$page = $_REQUEST['page'];

if ( isset($_REQUEST['boardId']) == false ) {
    $_REQUEST['boardId'] = 2;
}
$boardId = $_REQUEST['boardId'];

    $sql = "
    SELECT COUNT(*) AS count
    FROM article
    WHERE boardId = {$boardId}
    ";

    $rs = mysqli_query($conn, $sql);
    $count = mysqli_fetch_assoc($rs);
    $count = $count['count'];
    $pageLimit = 10;
    $from = ($page - 1) * $pageLimit;
    $totalPage = intval(ceil($count / $pageLimit));


    $sql = "
    SELECT A.id, DATE(A.regDate), A.title, A.body, A.boardId, A.hit, M.name, A.memberId, COUNT(AR.id) AS repliescount, COUNT(L.id) AS likescount
    FROM article AS A
    LEFT JOIN member AS M
    ON A.memberId = M.id
    LEFT JOIN articleReply AS AR
    ON A.id = AR.articleId
    LEFT JOIN `like` AS L
    ON A.id = L.articleId
    WHERE boardId = {$boardId}
    GROUP BY A.id
    ORDER BY A.id DESC
    LIMIT {$from}, {$pageLimit}
    ";



$rs = mysqli_query($conn, $sql);

while ( $article = mysqli_fetch_assoc($rs) ) {
    $articles[] = $article;
}
$boardName = '';
?>
<script>
    function searchWordCheck(form) {
        form.searchWord.value = form.searchWord.value.trim();

        if (form.searchWord.value.length == 0) {
            alert('검색어를 입력해주세요.');
            form.searchWord.focus();

            return false;
        }
        form.submit();
    }
</script>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/head.php'; ?>
<div id="articles" class="con">
<form action="./search.php" onsubmit="searchWordCheck(this); return false;"
    class="search-Box" method="POST">
        <?php if ($boardId == 1) {  $boardName = '공지사항'; ?>
        <span>공지사항</span>
        <?php } ?>
        <?php if ($boardId == 2) {  $boardName = '자유게시판'; ?>
        <span>자유게시판</span>
        <?php } ?>
    <input type="hidden" name="boardId" value="<?=$boardId?>">
    <input type="text" name="searchWord" class="search-input" placeholder="<?=$boardName?> 게시물을 검색하세요.">
    <input type="submit" class="search-submit" value="검색">
</form>
    
    <h2><?=$boardName?></h2>
    
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
    <script>
        function checklike(form){
            var memberId = form.memberId.value;
            var articleId = form.articleId.value;
        console.log('asdasd');
        console.log(memberId);
        console.log(articleId);
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: './checklike.php',
            data: { memberId:memberId, 
                    articleId:articleId },
            success:function(data){
                console.log(data);
                if (data.msg == 'S-1'){
                    $(this).children('.like').addClass('done');
                    function likeUp(data){
                        $.ajax({
                            type: 'post',
                            dataType: 'json',
                            url: './likeUp.php',
                            data: {memberId : data.memberId,                  articleId:data.articleId},
                            success: function(){

                            }
                        });
                    }
                }
                else {
                    $('.like').removeClass('done');
                }
            },
        });
    }
    </script>

    <?php foreach ($articles as $article) { ?>
    <ul class="article-body after">
        <li style="width: 10%;"><?=$article['id']?></li>
        <?php   $replyCount = ''; 
            if ($article['repliescount'] == 0) {
                $replyCount = 'noCount'; 
            } ?>
        <?php   $likeCount = ''; 
            if ($article['likescount'] == 0) {
                $likeCount = 'noCount'; 
            } ?>
        <li style="width: 40%; text-align: left; padding-left: 20px;">
            <a href="./detail.php?id=<?=$article['id']?>"><?=$article['title']?> <span style="margin-left:5px;"  class="reply <?=$replyCount?>"><i class="fas fa-comments"></i><?=$article['repliescount']?></span>
            </a>
            <form action="" onclick="checklike(this);">
            <input type="hidden" name="memberId" value="<?=$Loginedmember['id']?>">
            <input type="hidden" name="articleId" value="<?=$article['id']?>">
            <a href="#" style="margin-left:5px;"><span class="like <?=$likeCount?>"><i class="fas fa-thumbs-up"></i><?=$article['likescount']?></span></a>
            </form>
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
    </ul>
    <?php } ?>
</div>

<div class="pageList">
    <ul class="after">
        <li><a href="./list.php?boardId=<?=$boardId?>&page=1">처음</a></li>
    <?php for ($i = 1 ; $i <= $totalPage ; $i++) { 
        if ($i < $page - 3 || $i > $page + 3) {
            continue;
        }
        $class = '';
        if ( $i == $page ) {
            $class = "current";
        }
        ?>
    <li><a href="./list.php?boardId=<?=$boardId?>&page=<?=$i?>" class="<?=$class?>"><?=$i?></a></li>
    <?php } ?>
    <li><a href="./list.php?boardId=<?=$boardId?>&page=<?=$totalPage?>">끝</a></li>
    </ul>
</div>
</body>

</html>