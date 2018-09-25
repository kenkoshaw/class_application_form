<?php
session_start();
// define variables and set to empty values
$parentName = $childName = $grade = $email = $phone = $hopeLearn 
= $hopeClass = $contactMethod = $callTime = $gain = $opinion 
= $parentNameErr = $childNameErr = $gradeErr = $emailErr = $phoneErr 
= $hopeLearnErr = $hopeClassErr = $contactMethodErr = '';

$baseErr = "が必要です";

if (isset($_POST['submit1'])) {
	unset($_POST['submit1']);
	
	if (empty($_POST['parentName'])) {
		$parentNameErr = "* 保護者様のお名前".$baseErr;
	} else {
		$parentName = test_input($_POST['parentName']);
		
		if (!preg_match("/^[a-zA-Zぁ-んァ-ン一-龯 ]*$/",$parentName)){
			$parentNameErr = "* 文字とスペースのみ";
		}
	}

	if (empty($_POST['childName'])) {
		$childNameErr = "* お子様のお名前".$baseErr;
	} else {
		$childName = test_input($_POST['childName']);
		
		if (!preg_match("/^[a-zA-Zぁ-んァ-ン一-龯 ]*$/",$childName)){
			$childNameErr = "* 文字とスペースのみ";
		}
	}

	if (empty($_POST['grade'])) {
		$gradeErr = "* お子様の学年".$baseErr;
	} else {
		$grade = $_POST['grade'];
	}

	if (empty($_POST['email'])) {
		$emailErr = "* メールアドレス".$baseErr;
	} else {
		$email = test_input($_POST['email']);
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$emailErr = "* 無効なメール";
		}
	}

	if (empty($_POST['phone'])) {
		$phoneErr = "* 電話番号".$baseErr;
	} else {
		$phone = test_input($_POST['phone']);
		
		$regex1 = "^\d{3}-\d{4}-\d{4}$";
		$regex2 = "^\d{11}$";
		$regex3 = "^0\d0-\d{4}-\d{4}$";
		$regex4 = "^[0-9-]{6,9}$";
		$regex5 = "^[0-9-]{12}$";
		$regex6 = "^\d{1,4}-\d{4}$";
		$regex7 = "^\d{2,5}-\d{1,4}-\d{4}$";
		
		if (!preg_match('/'.$regex1.'|'.$regex2.'|'.$regex3.'|'
		.$regex4.'|'.$regex5.'|'.$regex6.'|'.$regex7.'/',$phone)) {
			$phoneErr = "* 無効な電話番号"; 
		}
	}

	if (empty($_POST['hopeLearn'])) {
		$hopeLearnErr = "* 希望教室".$baseErr;
	} else {
		$hopeLearn = $_POST['hopeLearn'];
	}

	if (empty($_POST['hopeClass'])) {
		$hopeClassErr = "* 参加希望クラス".$baseErr;
	} else {
		$hopeClass = $_POST['hopeClass'];
	}

	if (empty($_POST['contactMethod'])){
		$contactMethodErr = "* 連絡方法".$baseErr;
	} else {
		$contactMethod = $_POST['contactMethod'];
	}

	if (empty($_POST['opinion'])){
		$opinion = "";
	} else {
		$opinion = test_input($_POST['opinion']);
	}

	$callTime = $_POST['callTime'];
	$gain = $_POST['gain'];

	$_SESSION['parent'] = $parentName;
	$_SESSION['child'] = $childName;
	$_SESSION['grade'] = $grade;
	$_SESSION['email'] = $email;
	$_SESSION['phone'] = $phone;
	$_SESSION['learn'] = $hopeLearn;
	$_SESSION['class'] = $hopeClass;
	$_SESSION['method'] = $contactMethod;
	$_SESSION['time'] = $callTime;
	$_SESSION['gain'] = $gain;
	$_SESSION['opinion'] = $opinion;

	if ($parentNameErr == "" and $childNameErr == "" and $gradeErr == "" and $emailErr == "" 
	and $phoneErr == "" and $hopeLearnErr == "" and $hopeClassErr == ""){
		header("Location: confirm.php");
		exit;
	}
} elseif (isset($_POST['reset'])) {
	session_unset();
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function isChecked($value) {
	if(!empty($_SESSION['gain'])) {
		foreach ($_SESSION['gain'] as $chkval) {
			if($chkval == $value) {
				return true;
			}
		}
	}
	return false;
}

function isSelected($name, $value) {
	if(!empty($_SESSION[$name])) {
		if ($_SESSION[$name] == $value) {
			return true;
		}
	}
	return false;
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
		<div class = 'form'>
			<form action="" method = 'POST'>
				<h2>授業体験会申し込み</h2>
				<p id = 'required'><span class = 'error'>* 必須フィールド</span></p>
				<div class = 'text'>
					<div>
						<input class = 'input' type = 'text' value="<?= $_SESSION['parent']?>" 
						name = 'parentName' maxlength = '50'/>
						<label>保護者様のお名前<span class = 'error'> *</span></label>
					</div>

					<div class = 'error'>
						<span class = 'error'><?= $parentNameErr;?></span>
					</div>

					<div>
						<input class = 'input' type = 'text' value="<?= $_SESSION['child']?>" 
						name = 'childName' maxlength = '50'/>					
						<label>お子様のお名前<span class = 'error'> *</span></label>
					</div>

					<div class = 'error'>
						<span class = 'error'><?= $childNameErr;?></span>
					</div>

					<div>
						<select class = 'input' type = 'text' name = 'grade'>
							<option disabled selected value> -- オプションを選択 -- </option>

							<option value = '1' <?php if (isSelected('grade','1'))
							{ echo "selected = 'true'";}?>>1</option>

							<option value = '2' <?php if (isSelected('grade','2'))
							{ echo "selected = 'true'";}?>>2</option>

							<option value = '3' <?php if (isSelected('grade','3'))
							{ echo "selected = 'true'";}?>>3</option>

							<option value = '4' <?php if (isSelected('grade','4'))
							{ echo "selected = 'true'";}?>>4</option>

							<option value = '5' <?php if (isSelected('grade','5'))
							{ echo "selected = 'true'";}?>>5</option>

							<option value = '6' <?php if (isSelected('grade','6'))
							{ echo "selected = 'true'";}?>>6</option>

							<option value = '7' <?php if (isSelected('grade','7'))
							{ echo "selected = 'true'";}?>>7</option>

							<option value = '8' <?php if (isSelected('grade','8'))
							{ echo "selected = 'true'";}?>>8</option>

							<option value = '9' <?php if (isSelected('grade','9'))
							{ echo "selected = 'true'";}?>>9</option>

							<option value = '10' <?php if (isSelected('grade','10'))
							{ echo "selected = 'true'";} ?> >10</option>

							<option value = '11' <?php if (isSelected('grade','11'))
							{ echo "selected = 'true'";}?>>11</option>

							<option value = '12' <?php if (isSelected('grade','12'))
							{ echo "selected = 'true'";}?>>12</option>
						</select>
						<label>お子様の学年<span class = 'error'> *</span></label>
					</div>
					
					<div class = 'error'>
						<span class = 'error'><?= $gradeErr;?></span>
					</div>

					<div>
						<input class = 'input' type = 'text' value="<?= $_SESSION['email']?>" 
						name = 'email' maxlength = '254'/>
						<label>メールアドレス<span class = 'error'> *</span></label>
					</div>

					<div class = 'error'>
						<span class = 'error'><?= $emailErr;?></span>
					</div>

					<div>
						<input class = 'input' type = 'text' value="<?= $_SESSION['phone']?>"name = 'phone'/>
						<label>電話番号<span class = 'error'> *</span></label>
					</div>

					<div class = 'error'>
						<span class = 'error'><?= $phoneErr;?></span>
					</div>

					<div>
						<select class = 'input' type = 'text' name = 'hopeLearn'>
							<option disabled selected value> -- オプションを選択 -- </option>
							
							<option value = '池尻大橋教室' <?php if (isSelected('learn','池尻大橋教室'))
							{ echo "selected = 'true'";}?>>池尻大橋教室</option>
							
							<option value = '二子玉川教室' <?php if (isSelected('learn','二子玉川教室'))
							{ echo "selected = 'true'";}?>>二子玉川教室</option>
							
							<option value = '溝の口教室' <?php if (isSelected('learn','溝の口教室'))
							{ echo "selected = 'true'";}?>>溝の口教室</option>
							
							<option value = '鷺沼教室' <?php if (isSelected('learn','鷺沼教室'))
							{ echo "selected = 'true'";}?>>鷺沼教室</option>
						</select>
						<label>体験会の希望教室<span class = 'error'> *</span></label>
					</div>

					<div class = 'error'>
						<span class = 'error'><?= $hopeLearnErr;?></span>
					</div>

					<div>
						<select class = 'input' type = 'text' name = 'hopeClass'>
							<option disabled selected value> -- オプションを選択 -- </option>
							
							<option value = 'ベーシック' <?php if (isSelected('class','ベーシック'))
							{ echo "selected = 'true'";} ?> >ベーシック</option>
							
							<option value = 'アドバンス' <?php if (isSelected('class','アドバンス'))
							{ echo "selected = 'true'";} ?> >アドバンス</option>
						</select>
						<label>体験会の参加希望クラス<span class = 'error'> *</span></label>
					</div>

					<div class = 'error'><span class = 'error'><?= $hopeClassErr;?></span></div>

					<div>
						<select class = 'input' name = 'contactMethod'>
							<option disabled selected value> -- オプションを選択 -- </option>
							
							<option id = 'number' value = '電話で' <?php if (isSelected('method','電話で'))
							{ echo "selected = 'true'";} ?> >電話で</option>
							
							<option value = 'メールで' <?php if (isSelected('method','メールで'))
							{ echo "selected = 'true'";} ?> >メールで</option>
						</select>
						<label>希望の連絡方法<span class = 'error'> *</span></label>
					</div>

					<div class = 'error'><span class = 'error'><?= $contactMethodErr;?></span></div>

					<div>
						<input class = 'input' type = 'time' value="<?= $_SESSION['time'] ?>" name = 'callTime'/>
						<label>電話の場合のご希望の時間帯</label>
					</div>
				</div>

				<div class = 'checkbox'>
					<div>
						<h4 id = 'check_title'>プログラミングキッズに期待すること?</h4>
					</div>

					<div>
						<input type = 'checkbox' name = 'gain[]' value = '論理的思考' 
						<?php if (isChecked('論理的思考')){ echo "checked = 'checked'";}?>/>
						<label>論理的思考を身につけさせたい</label>
					</div>

					<div>
						<input type = 'checkbox' name = 'gain[]' value = '創造力を育' 
						<?php if (isChecked('創造力を育')){ echo "checked = 'checked'";}?>/>
						<label>創造力を育てたい</label>
					</div>

					<div>
						<input type = 'checkbox' name = 'gain[]' value = 'コミュニケーション力' 
						<?php if (isChecked('コミュニケーション力')){ echo "checked = 'checked'";}?>/>
						<label>コミュニケーション力を身につけさせたい</label>
					</div>

					<div>
						<input type = 'checkbox' name = 'gain[]' value = '好奇心を育' 
						<?php if (isChecked('好奇心を育')){ echo "checked = 'checked'";}?>/>
						<label>好奇心を育てたい</label>
					</div>

					<div>
						<input type = 'checkbox' name = 'gain[]' value = '考える力を育' 
						<?php if (isChecked('考える力を育')){ echo "checked = 'checked'";}?>/>
						<label>考える力を育てたい</label>
					</div>
				</div>
				<div class = 'textarea'>
					<div>
						<textarea id = 'area' name = 'opinion'><?= $_SESSION['opinion']?></textarea>
						<label>ご意見、ご要望</label>
					</div>
				</div>
				<div id = 'submitButtons'>
					<input name = 'reset' type = 'submit' value = 'リセット'>
					<input name = 'submit1' type = 'submit' value = '登録'>
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