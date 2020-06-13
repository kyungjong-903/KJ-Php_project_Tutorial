<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; ?>
<?php

$chatRoomId = $_REQUEST['chatRoomId'];
$from = $_REQUEST['from'];

$sql = "
SELECT CRM.*,TIME(CRM.regDate) AS time,
M.name
FROM chatRoomMessage AS CRM
LEFT JOIN `member` AS M
ON CRM.memberId = M.id
WHERE CRM.chatRoomId = '{$chatRoomId}'
AND CRM.id > '{$from}'
ORDER BY CRM.id ASC
";

$rs = mysqli_query($conn, $sql);

$msg = 'no-data';

while ( $chatRoomMessage = mysqli_fetch_assoc($rs) ) {
    $chatRoomMessages[] = $chatRoomMessage;
}
    if (!isset($chatRoomMessages)) {
        echo json_encode($msg);     
    }
    else {
        $rsData['messages'] = $chatRoomMessages;

        echo json_encode($rsData);
    }



