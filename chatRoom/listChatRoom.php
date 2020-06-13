<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php
$titleText = '채팅방 리스트';
if ( isset($_REQUEST['page']) == false ) {
    $_REQUEST['page'] = 1;
}

$page = $_REQUEST['page'];


$sql = "
SELECT COUNT(*) AS count
FROM chatRoom
";
$rs = mysqli_query($conn, $sql);
$count = mysqli_fetch_assoc($rs);
$count = $count['count'];
$pageLimit = 10;
$from = ($page - 1) * $pageLimit;
$totalPage = intval(ceil($count / $pageLimit));


// DB에 말할 용건, SQL  
$sql = "
SELECT CR.*,DATE(CR.regDate),
M.name,
COUNT(CRM.id) AS MessageCount
FROM chatRoom AS CR
LEFT JOIN chatRoomMessage AS CRM
ON CR.id = CRM.chatRoomId
LEFT JOIN MEMBER AS M
ON CR.memberId = M.id
GROUP BY CR.id
ORDER BY CR.id DESC
LIMIT {$from}, {$pageLimit}
";

$rs = mysqli_query($conn, $sql);

while ( $chatRoom = mysqli_fetch_assoc($rs) ) {
    $chatRooms[] = $chatRoom;
}
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/head.php'; ?>

<div id="articles" class="con">
    <h2>채팅방 리스트</h2>
    <ul class="article-head after">
        <li style="width: 10%;">채팅방</li>
        <li style="width: 50%;">
            <a href="#">제목</a>
        </li>
        <li style="width: 15%;">작성자</li>
        <li style="width: 10%;">등록일</li>
        <li style="width: 15%;">비고</li>
    </ul>
    <?php if (!$isLogined) { ?>
    로그인 후 이용할수있습니다..
    <?php } ?>
    <?php if ($isLogined) { ?>    
    <?php foreach ($chatRooms as $chatRoom) { ?>

    <ul class="article-body after">
        <li style="width: 10%;"><?=$chatRoom['id']?></li>
        <li style="width: 50%; text-align: left; padding-left: 20px;">
            <a href="./chatRoom_detail.php?id=<?=$chatRoom['id']?>"><?=$chatRoom['title']?></a>
        </li>
        <li style="width: 15%;"><?=$chatRoom['name']?></li>
        <li style="width: 10%;"><?=$chatRoom['DATE(CR.regDate)']?></li>
        <li style="width: 15%;">
        <?php
        $hasPermission = false;
        if ( $isLogined ) {
            if ( $Loginedmember['id'] == $chatRoom['memberId'] ) {
                $hasPermission = true;
            }
        }
        if ($hasPermission) { ?>
            <a href="./deleteChatRoom.php?id=<?=$chatRoom['id']?>" onclick="if ( !confirm('삭제하시겠습니까?') ) return false; ">삭제</a>
        <?php } ?>
        </li>
    </ul>
        <?php } ?>
    <?php } ?>
</div>