<?php require_once(dirname(__FILE__) . '/config.php');
if ( !isset($_SESSION['Admin_ID']) || !isset($_SESSION['Login_Type']) ) {
   	header('location:' . BASE_URL);
} ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<title>My Profile - Payroll</title>

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/AdminLTE.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datepicker/datepicker3.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/skins/_all-skins.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<?php require_once(dirname(__FILE__) . '/partials/topnav.php'); ?>

		<?php require_once(dirname(__FILE__) . '/partials/sidenav.php'); ?>

		<div class="content-wrapper">
			<section class="content-header">
				<h1>My Profile</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">My Profile</li>
				</ol>
			</section>

			<section class="content">
				<div class="row">
					<?php
					if ( $_SESSION['Login_Type'] == 'admin' ) {
						$query = mysqli_query($db, "SELECT * FROM `" . DB_PREFIX . "admin` WHERE `admin_id` = " . $_SESSION['Admin_ID']);
						if ( $query ) {
							if ( mysqli_num_rows($query) == 1 ) {
								$data = mysqli_fetch_assoc($query); ?>
			        			 <div class="col-lg-6">
									<div class="box">
										<div class="box-header">
											<h3 class="box-title">Edit Profile Details</h3>
										</div>
										<div class="box-body">
											<form method="POST" role="form" data-toggle="validator" id="profile-form">
												<div class="form-group">
													<label for="admin_name">Name: </label>
													<input type="text" class="form-control" name="admin_name" id="admin_name" value="<?php echo $data['admin_name']; ?>" required />
												</div>
												<div class="form-group">
													<label for="admin_email">Email: </label>
													<input type="email" class="form-control" name="admin_email" id="admin_email" value="<?php echo $data['admin_email']; ?>" required />
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-primary">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div> 
								<div class="col-lg-6">
									<div class="box">
										<div class="box-header">
											<h3 class="box-title">Change Login Details</h3>
										</div>
										<div class="box-body">
											<form method="POST" role="form" data-toggle="validator" id="password-form">
												<div class="form-group">
													<label for="admin_code">Login ID: </label>
													<input type="text" class="form-control" name="admin_code" id="admin_code" value="<?php echo $data['admin_code']; ?>" required />
												</div>
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="admin_password">Password: </label>
															<input type="password" class="form-control" name="admin_password" id="admin_password" required />
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="admin_password_conf">Confirm Password: </label>
															<input type="password" class="form-control" name="admin_password_conf" id="admin_password_conf" required />
														</div>
													</div>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-primary">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php
							}
						}
					} else {
						$query = mysqli_query($db, "SELECT * FROM `" . DB_PREFIX . "employees` WHERE `emp_id` = " . $_SESSION['Admin_ID']);
						if ( $query ) {
							if ( mysqli_num_rows($query) == 1 ) {
								$data = mysqli_fetch_assoc($query); ?>
								<div class="col-lg-9">
									<div class="box">
										<div class="box-header">
											<h3 class="box-title">Edit Profile Details</h3>
										</div>
										<div class="box-body">
											<form method="POST" role="form" data-toggle="validator" id="profile-form">
												<div class="row">
													<div class="col-lg-3">
														<div class="form-group">
															<label for="first_name">First Name </label>
															<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $data['first_name']; ?>" required />
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="last_name">Last Name </label>
															<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $data['last_name']; ?>" required />
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="dob">Date of Birth (MM/DD/YYYY) </label>
															<input type="text" class="form-control datepicker" name="dob" id="dob" value="<?php echo $data['dob']; ?>" required />
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="gender">Gender </label>
															<select class="form-control" name="gender" id="gender" required>
																<option value="">Please make a choice</option>
																<option value="male" <?php echo $data['gender']=='male'?'selected':''; ?>>
																	Male
																</option>
																<option value="female" <?php echo $data['gender']=='female'?'selected':''; ?>>
																	Female
																</option>
															</select>
														</div>
													</div>
													<div class="col-lg-12">
														<div class="form-group">
															<label for="address">Address </label>
															<input type="text" class="form-control" name="address" id="address" value="<?php echo $data['address']; ?>" required />
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="email">Email: </label>
															<input type="email" class="form-control" name="email" id="email" value="<?php echo $data['email']; ?>" required />
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="mobile">Mobile: </label>
															<input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $data['mobile']; ?>" required />
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="telephone">Telephone: </label>
															<input type="text" class="form-control" name="telephone" id="telephone" value="<?php echo $data['telephone']; ?>" />
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="identity_doc">ID Type: </label>
															<select class="form-control" name="identity_doc" id="identity_doc" required>
																<option value="">Please make a choice</option>
																<option value="Voter ID" <?php echo $data['identity_doc']=='Voter ID'?'selected':''; ?>>Voter's ID</option>
																<option value="Aadhar Card" <?php echo $data['identity_doc']=='Aadhar Card'?'selected':''; ?>>SSS ID</option>
																<option value="Driver's License" <?php echo $data['identity_doc']=='Drivers License'?'selected':''; ?>>Driver's License</option>
																<option value="Passport" <?php echo $data['identity_doc']=='Passport'?'selected':''; ?>>Passport</option>
																<option value="PhilHealth ID" <?php echo $data['identity_doc']=='PhilHealth ID'?'selected':''; ?>>PhilHealth ID</option>
															</select>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="identity_no">ID No.</label>
															<input type="text" class="form-control" name="identity_no" id="identity_no" value="<?php echo $data['identity_no']; ?>" required />
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="emp_type">Employment Type</label>
															<select class="form-control" name="emp_type" id="emp_type" required>
																<option value="">Please make a choice</option>
																<option value="Part-time employee" <?php echo $data['emp_type']=='Part-time employee'?'selected':''; ?>>Part-time employee</option>
																<option value="Intern" <?php echo $data['emp_type']=='Intern'?'selected':''; ?>>Intern</option>
																<option value="Holiday worker" <?php echo $data['emp_type']=='Holiday worker'?'selected':''; ?>>Holiday worker</option>
																<option value="Permanent position" <?php echo $data['emp_type']=='Permanent position'?'selected':''; ?>>Permanent position</option>
															</select>
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="joining_date">Joining Date (MM/DD/YYYY)</label>
															<input type="text" class="form-control datepicker" name="joining_date" id="joining_date" value="<?php echo $data['joining_date']; ?>" required />
														</div>
													</div>
												</div>
												<div class="form-group">
													<button type="submit" class="btn btn-primary">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php
							}
						}
					} ?>
				</div>
			</section>
		</div>

	</div>

	<script src="<?php echo BASE_URL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo BASE_URL; ?>bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/jquery-validator/validator.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo BASE_URL; ?>dist/js/app.min.js"></script>
	<script type="text/javascript">var baseurl = '<?php echo BASE_URL; ?>';</script>
	<script src="<?php echo BASE_URL; ?>dist/js/script.js?rand=<?php echo rand(); ?>"></script>
</body>
</html>
