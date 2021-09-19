<?php

date_default_timezone_set('Asia/Tokyo');
$time = date('Y年m月d日H時i分s秒');
$mes = $_POST['mes'].','.$time."\n";
define('CHAT','chat.txt');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    file_put_contents(CHAT,$mes,FILE_APPEND);
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style type="text/css">
        *{margin: 0; padding: 0; list-style: none;}
        .wrap{
            width: 600px;
            margin: 0 auto;
            padding: 20px 0 100px 0;
            background-color: #f1f1f2;
            min-height: 100%;
        }
        li{
            position: relative;
            padding: 10px 20px;
            margin: 0 10px 10px 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        span{
            position: absolute;
            top: 50ox;
            transform: translateY(-50%);
            right: 10px;
            font-size: 12px;
            color: #ccc;
        }
        form{
            position: fixed;
            top: 10%;
            left: 15px;
        }
    </style>
</head>
<body>
    
<div class="wrap">

<ul id='list'>
</ul>

<form action="index.php" method="post">
    <input type="text" name="mes">
    <input type="submit" value="投稿">
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(function(){
    $.ajax({
        url:'chat.txt',
    })
    .done(function(data){
        const ary = data.split("\n");
        console.log(ary);
        ary.forEach(function(chat){
            const post_text = chat.split(',')[0];
            const post_time = chat.split(',')[1];
            if(post_text){
            const li = `<li>${post_text}<span>${post_time}</span></li>`;
            $('#list').append(li);
            }   
        });
    });
});

</script>


</body>
</html>