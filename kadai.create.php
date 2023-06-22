<?php
// var_dump
// exit();


// POSTデータ確認
if(
  // だめな条件
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['deadline']) || $_POST['deadline'] === '' 
) {
  exit('ParamError');
}

$name = $_POST['name'];
$occupation = $_POST['occupation'];
$department = $_POST['department'];
$regidential = $_POST['regidential'];
$email = $_POST['email'];
$deadline = $_POST['deadline'];

// DB接続
// todo_create.php

// 各種項目設定
$dbn ='mysql:dbname=kadai_card_01;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}

// 「dbError:...」が表示されたらdb接続でエラーが発生していることがわかる．



// SQL作成&実行
// todo_create.php

// SQL作成&実行
// $sql = 'INSERT INTO kadai_card_table (id,name,occupation, department,regidential,email,deadline,created_at, updated_at) VALUES (NULL, :name,occupation, department,regidential,email :deadline, now(), now())';

// $stmt = $pdo->prepare($sql);

// // バインド変数を設定
// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);

// ちゃぴー
$sql = 'INSERT INTO kadai_card_table (id, name, occupation, department, residential, email, deadline, created_at, updated_at) VALUES (NULL, :name, :occupation, :department, :regidential, :email, :deadline, now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':occupation', $occupation, PDO::PARAM_STR);
$stmt->bindValue(':department', $department, PDO::PARAM_STR);
$stmt->bindValue(':residential', $regidential, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);


// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:kadai.input.php');
exit();