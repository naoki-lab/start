<?php
$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$cnt=0;
if(!empty($_POST["name"]) && !empty($_POST["comment"]) && empty($_POST["hennshuu"]) && empty($_POST["sakujo"])){

$name = $_POST["name"];
$comment=$_POST["comment"];

$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);	
	$sql -> execute();

$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		
		echo $row['id'].'名前';
		echo $row['name'].'コメント';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
}
//sapu
elseif(isset($_POST["pasu"]) && $_POST["pasu"]==3){
if(empty($_POST["name"]) && empty($_POST["comment"]) && !empty($_POST["sakujo"]) ){


$id =$_POST["sakujo"];
	$sql = 'delete from tbtest where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
	
		echo $row['id'].'名前';
		echo $row['name'].'コメント';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
}

elseif(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["hennshuu"]) ){

$name = $_POST["name"];
$comment=$_POST["comment"];

$id =$_POST["hennshuu"]; //変更する投稿番号

	$sql = 'update tbtest set name=:name,comment=:comment where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		
		echo $row['id'].'名前';
		echo $row['name'].'コメント';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}

}

}
if(!empty($_POST["pasu"]) && $_POST["pasu"]!=3 ){//sapunasi

$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
	
		echo $row['id'].'名前';
		echo $row['name'].'コメント';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}

}

if(empty($_POST["pasu"]) && (!empty($_POST["sakujo"]) || !empty($_POST["hennshuu"])) ){//sapunasi2


$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		
		echo $row['id'].'名前';
		echo $row['name'].'コメント';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
}



?>
<html>
<head
  <meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes"><!-- for smartphone. ここは一旦、いじらなくてOKです。 -->
	<meta charset="utf-8"><!-- 文字コード指定。ここはこのままで。 -->
	
</head>
  <body>
        <form action="keijibann.php" method="post">
            名前：<br />
            <input type="text" name="name" size="50" value="" /><br />
 コメント：<br />
            <input type="text" name="comment" size="50" value="" /><br />
 削除：<br />
            <input type="number" name="sakujo" size="50" value="" /><br />
 編集：<br />
            <input type="number" name="hennshuu" size="50" value="" /><br />
 パスワード：<br />
            <input type="text" name="pasu" size="50" value="" /><br />       
 
            <input type="submit" value="送信" />

        </form>
    </body>
</html>