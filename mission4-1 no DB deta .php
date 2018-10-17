<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>送信フォーム</title>
</head>
<body>

<?php
if(!empty($_POST['password1']) && $_POST['password1'] != "usakame" && empty($_POST['password2']) && empty($_POST['password3']))
{
	print "パスワードが違います";
}

if(!empty($_POST['password2']) && $_POST['password2'] != "usakame" && empty($_POST['password1']) && empty($_POST['password3']))
{
	print "パスワードが違います";
}

if(!empty($_POST['password3']) && $_POST['password3'] != "usakame" && empty($_POST['password2']) && empty($_POST['password1']))
{
	print "パスワードが違います";
}


//3-1 データベース接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn,$user,$password);




//3-2　テーブル作成
$sql = 'CREATE TABLE user4 (	
	id INT(11) AUTO_INCREMENT PRIMARY KEY,	
	name VARCHAR(20),	
	comment TEXT,	
	time DATETIME,
	password VARCHAR(20)
) engine=innodb default charset=utf8';

$stmt = $pdo->query($sql);



/*
//3-3　テーブル一覧確認
$sql = 'SHOW TABLES';
$result = $pdo -> query($sql);
foreach ($result as $row){
	echo $row[0];
	echo '<br>';
	}
echo "<hr>";





//3-4　テーブル中身確認
$sql = 'SHOW CREATE TABLE user4';
$result = $pdo -> query($sql);
foreach ($result as $row){
	print_r($row);
	}
echo "<hr>";

*/




//編集機能
if(!empty($_POST['edit']) && $_POST['password3'] == "usakame")
{

$sql = 'SELECT * FROM user4';
$results = $pdo -> query($sql);


foreach ($results as $row)
{

	if($id=$_POST['edit'])
	{

	$_0 = $row['id'];
	$_1 = $row['name'];
	$_2 = $row['comment'];

	}
}

}

?>


	<form method="post" action="mission4-1.php">
		<input type="text" name="name" value="<?php if(!empty($_POST["edit"])){print $_1;}?>" placeholder="<?php if(empty($_POST["edit"])){print "名前";}?>">
		<br>
		<input type="text" name="comment" value="<?php if(!empty($_POST["edit"])){print $_2;}?>" placeholder="<?php if(empty($_POST["edit"])){print "コメント";}?>">
		<br>
		<input type="text" name="password1" placeholder="パスワード">
		<input type="submit" value="送信">
		<br>
		<input type="hidden" name="hensyu" value="<?php if(!empty($_POST["edit"])){print $_POST["edit"];}?>">
		<br>
		<br>
	</form>
	<form method="post" action="mission4-1.php">
		<input type="text" name="delete" placeholder="削除対象番号">
		<br>
		<input type="text" name="password2" placeholder="パスワード">
		<input type="submit" value="削除">
		<br>
		<br>
	</form>
	<form method="post" action="mission4-1.php">
		<input type="text" name="edit" placeholder="編集対象番号">
		<br>
		<input type="text" name="password3" placeholder="パスワード">
		<input type="submit" value="編集">
		<hr>
	</form>






<?php

if(!empty($_POST['edit']) && $_POST['password3'] == "usakame")
{

$sql = 'SELECT * FROM user4';
$results = $pdo -> query($sql);


	foreach ($results as $row)
	{
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].',';
	echo $row['time'].'<br>';
	}

}



//初期画面で投稿内容の表記
if(empty($_POST['name']) && empty($_POST['delete']) && empty($_POST['edit']))
{

$sql = 'SELECT * FROM user4';
$results = $pdo -> query($sql);

foreach ($results as $row)
{
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].',';
	echo $row['time'].'<br>';

}
	

}


if(!empty($_POST['hensyu']) && empty($_POST['password1']))
{

$id = $_POST['hensyu'];
$name = $_POST['name'];
$comment = $_POST['comment'];
$sql = "update user4 set name='$name',comment='$comment' where id = $id";
$result = $pdo->query($sql);



$sql = 'SELECT * FROM user4';
$results = $pdo -> query($sql);
	foreach ($results as $row)
	{
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['time'].'<br>';
	}


}

//削除機能
if(!empty($_POST['delete']) && $_POST['password2'] == "usakame")
{

$id = $_POST['delete'];
$sql = "delete from user4 where id=$id";
$result = $pdo->query($sql);



$sql = 'SELECT * FROM user4';
$results = $pdo -> query($sql);
	foreach ($results as $row)
	{
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['time'].'<br>';
	}
}



//投稿機能
if(!empty($_POST['comment']) && empty($_POST['hensyu']) && $_POST['password1'] == "usakame")
{

//3-5　データ入力
	$sql = $pdo->prepare("INSERT INTO user4 (name,comment,time,password) VALUES (:name,:comment,:time,:password)");
	$sql -> bindParam(':name',$name,PDO::PARAM_STR);
	$sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
	$sql -> bindParam(':time',$time,PDO::PARAM_STR);
	$sql -> bindParam(':password',$password,PDO::PARAM_STR);

	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$time = date('Y/m/d H:i:s');
	$password = $_POST['password1'];

	$sql -> execute();



//3-6 データの表示

	$sql = 'SELECT * FROM user4';
	$results = $pdo -> query($sql);
	foreach ($results as $row)
	{
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $row['time'].'<br>';
	}
}

?>


</body>
</html>
