<?php

// DB接続
// todo_create.php

// 各種項目設定
$dbn ='mysql:dbname=kadai;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}



// SQL作成&実行
$sql = 'SELECT * FROM kadai_card_01';

$stmt = $pdo->prepare($sql);

// バインド変数を設定

// fetchALL

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// todo_read.php

// SQL実行の処理

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output = "";
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["deadline"]}</td>
      <td>{$record["name"]}</td>
    </tr>
  ";
}



?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>エコーメンバー登録画面（入力画面）</title>
</head>

<body>
  <fieldset>
    <legend></legend>
    <a href="kadai.input.php">エコーメンバー登録画面（入力画面）</a>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>name</th>
          <th>occupation</th>
          <th>department</th>
          <th>regidential</th>
        </tr>
      </thead>
      <tbody>
 <!-- html部分にデータを追加 -->
<tbody>
  <!-- 🔽 に<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
  <?= $output ?>

      </tbody>
    </table>
  </fieldset>
</body>

</html>