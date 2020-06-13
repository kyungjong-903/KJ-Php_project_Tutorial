<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php
$titleText = '채팅 페이지';
$id = $_REQUEST['id'];

$sql = "
SELECT CR.*,DATE(CR.regDate),
M.name
FROM chatRoom AS CR
LEFT JOIN member AS M
ON CR.memberId = M.id
WHERE CR.id = {$id}
";

$rs = mysqli_query($conn, $sql);

$chatRoom = mysqli_fetch_assoc($rs);

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . './head.php'; ?>
<div class="detail-Box con">
    <h1>채팅방</h1>
    <ul class="article-head after">
        <li style="width: 60%;">
            <a href="#">제목</a>
        </li>
        <li style="width: 15%;">방장</li>
        <li style="width: 10%;">등록일</li>
        <li style="width: 15%;">비고</li>
    </ul>
    <ul class="article-body after">
        <li style="width: 60%;">
            <?=$chatRoom['title']?>
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
            <a href="./deleteChatRoom.php?id=<?=$chatRoom['id']?>"
                onclick="if ( !confirm('삭제하시겠습니까?') ) return false; ">삭제</a>
            <?php } ?>
        </li>
    </ul>
    <script>
        
        var chatRoomId = <?=$chatRoom['id']?>;
        var loginedmemberId = <?=$Loginedmember['id']?>;

        var lastReceviedChatMessageId = 0;

        $(function() {
            loadNewMessages();
            });
            
        setInterval(function() { loadNewMessages(); }, 300);
        function loadNewMessages() {
            $.ajax({
                type: 'post',
                dataType: 'json',
                url:'./getNewMessages.php',
                data:{
                    chatRoomId:chatRoomId,
                    from:lastReceviedChatMessageId
                },
                success:function(data) {
                    if (data == 'no-data') {
                        console.log(data);
                        return false;
                    }
                    else {
                        for ( var i = 0; i < data.messages.length; i++ ) {
                            console.log(i);
                            lastReceviedChatMessageId = data.messages[i].id;
                            drawMessage(data.messages[i]);
                        }
                    }        
                },
            });
        }
            function drawMessage(message) {
                var html = '';
                var writer = '';
                if (loginedmemberId != message.memberId) {
                    writer = 'other';
                }
                else {
                    writer = 'mine';
                }


                html += '<div class="chat-message ' + writer + '">';
                html += '<div><span class="name">' + message.name + '</span>';
                html += '<span class="date">' + message.time + '</span></div>';
                html += '<div class="body">' + message.body + '</div>';
                html += '</div>';

                $('.message-group').append(html);
                $('.chat-page>#chat-room').scrollTop(99999);
            }


            function submitWriteMessageForm(form) {                

                    form.body.value = form.body.value.trim();
                    
                    if ( form.body.value.length == 0 ) {
                        alert('채팅을 입력해주세요.');
                        form.body.focus();

                        return false;
                    }
                    $.ajax({
                        type:'post',
                        dataType: 'json',
                        url:'./doWriteMessage.php',
                        data:{
                            chatRoomId:chatRoomId,
                            body:form.body.value
                        },
                        success:function(data){

                        },
                    });
                    
                    form.body.value = '';
                    form.body.focus();
                }
    </script>
    <div class="chat-page">
        <div id="chat-room">
            <div class="message-box">
                    <div class="message-group after">
                    </div>
            </div>
        </div>
        <div class="input-box">
            <form action="" onsubmit="submitWriteMessageForm(this); return false;" method="POST" class="after">
                    <input autocomplete="off" type="text" name="body">
                    <input type="submit" value="전송">
            </form>
        </div>
    </div>
</div>

</body>

</html>