$(document).ready(function(){
    
    $('#idCheck').on('click', function(){
        
        console.log(idCheck);
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: './memberIdCheck.php',
            data: {loginId: $('.loginId').val()},
            success:function(data){
                console.log(data);
                if(data == 'S-1'){
                    $('.idCheckText').html("사용 가능한 아이디입니다.");
                    $('.idCheckText').css({'color' : 'rgb(68, 189, 52)'});
                    $('.loginId').css({'background-color' : 'rgb(223, 255, 219)'});
                    idCheck = 1;
                    
                }else{
                    $('.idCheckText').html("사용 할 수 없는 아이디입니다.");
                    $('.idCheckText').css({'color' : 'red'});
                    $('.loginId').css({'background-color' : 'rgb(252, 220, 220)'});
                    idCheck = 0;
                }
            },
        });
    });
});