<?php
session_start();

if (isset($_POST['return'])) {
	unset($_POST['return']);
	header("Location: form.php");
	exit;
}
elseif (isset($_POST['confirm'])) {
	unset($_POST['confirm']);
	require_once('api.php');
	$api = new ZohoApi();
	$api -> initiateData();
	$api -> upload();
	session_unset();
	session_destroy();
	header("Location: complete.html");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = 'UTF-8'>
	<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
	<link rel = 'stylesheet' type = 'text/css' href = 'style_sheet.css'>
</head>
<body>
	<header><h2>No.1 Solutions: 授業体験会申し込み<h2>
	</header>
	<section>
		<div id = 'confirm' class = 'form'>
			<form action="" method = 'POST'>
				<h2>確認</h2>

				<div id = 'final'>
					<div>
						<h4>保護者様のお名前:</h4>
						<?= $_SESSION['parent'];?>
					</div>

					<div>
						<h4>お子様のお名前:</h4>
						<?= $_SESSION['child'];?>
					</div>

					<div>
						<h4>お子様の学年:</h4>
						<?= $_SESSION['grade'];?>
					</div>

					<div>
						<h4>メールアドレス:</h4>
						<?= $_SESSION['email'];?>
					</div>

					<div>
						<h4>電話番号:</h4>
						<?= $_SESSION['phone'];?>
					</div>

					<div>
						<h4>体験会の希望教室:</h4>
						<?= $_SESSION['learn'];?>
					</div>

					<div>
						<h4>体験会の参加希望クラス:</h4>
						<?= $_SESSION['class'];?>
					</div>

					<div>
						<h4>希望の連絡方法:</h4>
						<?= $_SESSION['method'];?>
					</div>

					<div>
						<h4>電話の場合のご希望の時間帯:</h4>
						<?= $_SESSION['time'];?>
					</div>

					<div>
						<h4>プログラミングキッズに期待すること:</h4>
						<?php if (!empty($_SESSION['gain']))
						{ echo implode(", ", $_SESSION['gain']);}?>
					</div>

					<div>
						<h4>ご意見、ご要望:</h4>
						<?= $_SESSION['opinion'];?>
					</div>
				</div>

				<div id = 'submitButtons'>
					<input type = 'submit' name = 'return' value = '変更を加える'>

					<input type = 'submit' name = 'confirm' value = '確認する'>
				</div>
			</form>
		</div>
	</section>

	<footer><h5>〒153-0043 東京都目黒区東山3-15-1出光池尻ビル7階<br>
		株式会社ナンバーワンソリューションズ 内　プログラミングキッズ<br>
		https://programmingkids.net<br>
		Email :  info@programmingkids.net<br>
	</h5>
</footer>
</body>
</html>