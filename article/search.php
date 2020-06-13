<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php
$titleText = '게시물 리스트';
    if ( isset($_REQUEST['page']) == false ) {
        $_REQUEST['page'] = 1;
    }

    $page = $_REQUEST['page'];
    $boardId = $_REQUEST['boardId'];
    $searchWord = $_REQUEST['searchWord'];

    $sql = "
    SELECT COUNT(*) AS count
    FROM article
    WHERE boardId = {$boardId}
    AND title LIKE '%{$searchWord}%'
    ";

    $rs = mysqli_query($conn, $sql);
    $countNotice = mysqli_fetch_assoc($rs);
    $countNotice = $countNotice['count'];
    $pageLimit = 10;
    $from = ($page - 1) * $pageLimit;
    $totalPage = intval(ceil($countNotice / $pageLimit));


    $sql = "
    SELECT A.id, DATE(A.regDate), A.title, A.body, A.boardId, A.hit, M.name
    FROM article AS A
    LEFT JOIN member AS M
    ON A.memberId = M.id
    WHERE boardId = {$boardId}
    AND title LIKE '%{$searchWord}%'
    ORDER BY A.id DESC
    LIMIT {$from}, {$pageLimit}
    ";


$rs = mysqli_query($conn, $sql);

while ( $article = mysqli_fetch_assoc($rs) ) {
    $articles[] = $article;
}
$boardName = '';
?>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/head.php'; ?>
    
    <div id="articles" class="con">
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
    <form action="./search.php" onsubmit="searchWordCheck(this); return false;"
        class="search-Box" method="POST">
        <?php if ($boardId == 1) {  $boardName = '공지사항'; ?>
        <span>공지사항</span>
        <?php } ?>
        <?php if ($boardId == 2) {  $boardName = '자유게시판'; ?>
        <span>자유게시판</span>
        <?php } ?>
        <input type="hidden" name="boardId" value="<?=$boardId?>">
        <input type="text" name="searchWord" class="search-input" placeholder="게시물을 검색하세요.">
        <input type="submit" class="search-submit" value="검색">
    </form>
     <span style="letter-spacing:1px;"><?=$boardName?></span> 에서 <span>"<?=$searchWord?>"</span> 검색결과 입니다.
        
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
            <?php if ($countNotice == 0) { ?>
               검색 결과가 없습니다...
            <?php exit; } ?>
           
            <?php foreach ($articles as $article) { ?>
            <ul class="article-body after">
                <li style="width: 10%;"><?=$article['id']?></li>
                <li style="width: 40%; text-align: left; padding-left: 20px;">
                    <a href="./detail.php?id=<?=$article['id']?>"><?=$article['title']?></a>
                </li>
                <li style="width: 15%;"><?=$article['name']?></li>
                <li style="width: 10%;"><?=$article['DATE(A.regDate)']?></li>
                <li style="width: 10%;"><?=$article['hit']?></li>
                <li style="width: 15%;"><a href="./modify.php?id=<?=$article['id']?>">수정</a> <a href="./delete.php?id=<?=$article['id']?>" onclick="if ( !confirm('삭제하시겠습니까?') ) return false; ">삭제</a></li>
            </ul>
            <?php } ?>
    </div>
    <div class="pageList">
    <a href="./search.php?page=1&searchWord=<?=$searchWord?>&boardId=<?=$boardId?>">처음</a>
    <?php for ($i = 1 ; $i <= $totalPage ; $i++) { 
        if ($i < $page - 3 || $i > $page + 3) {
            continue;
        }
        $class = '';
        if ( $i == $page ) {
            $class = "current";
        }
        ?>
        <a href="./search.php?page=<?=$i?>&searchWord=<?=$searchWord?>&boardId=<?=$boardId?>" class="<?=$class?>"><?=$i?></a>
    <?php } ?>
    <a href="./search.php?page=<?=$totalPage?>&searchWord=<?=$searchWord?>&boardId=<?=$boardId?>">끝</a>
    </div>

</body>
</html>