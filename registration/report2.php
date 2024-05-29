<?php require(dirname(__FILE__) . '/config.php');

$empId = $_REQUEST['emp'];
$selectSQL = mysqli_query($db, "SELECT * FROM `" . DB_PREFIX . "employees` WHERE `emp_code` = '$empId' LIMIT 0, 1");
if ( $selectSQL ) {
	if ( mysqli_num_rows($selectSQL) > 0 ) {
		$empDATA = mysqli_fetch_assoc($selectSQL);
	}
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #C5EBAA;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
        .popup {
            background: white;
            padding: 40px; 
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px; 
            width: 100%; 
        }
        .popup img {
            width: 70px;
            height: 70px;
        }
        .popup h2 {
			margin: 20px 0; 
            font-size: 24px; 
        }
        .popup p {
			margin: 20px 0;
            font-size: 18px;
        }
        .popup button {
			padding: 15px 30px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .popup button:hover {
            background-color: #0056b3;
        }
    </style>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Employee Information - Payroll</title>

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/AdminLTE.css">

</head>

 <body class="hold-transition register-page">
	<div class="container">
			<div class="popup">
		<img src="tick.png">
		<h2>Account Created!</h2>
		     <p>Press the OK button to go back.</p>
		<a href="http://localhost/payroll/employees">
		     <button type="submit">OK</button>
		</a>
	</div>

	</div>    

	<script src="<?php echo BASE_URL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo BASE_URL; ?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>

<?php unset($_SESSION['success']); ?>
