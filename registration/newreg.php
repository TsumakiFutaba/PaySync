<?php 
require(dirname(__FILE__) . '/config.php');

$errors = array();
$expensions = array("jpeg", "jpg", "png");
$target_dir_photo = dirname(__FILE__) . "/photos/";
$target_dir_idphoto = dirname(__FILE__) . "/idphotos/";

if (!is_dir($target_dir_photo)) {
    mkdir($target_dir_photo, 0777, true);
}
if (!is_dir($target_dir_idphoto)) {
    mkdir($target_dir_idphoto, 0777, true);
}

if (isset($_POST['submit'])) {

    $selectSQL = mysqli_query($db, "SELECT * FROM `" . DB_PREFIX . "employees` ORDER BY `emp_id` DESC LIMIT 0, 100");
    if ($selectSQL) {
        if (mysqli_num_rows($selectSQL) > 0) {
            $LastEMP = mysqli_num_rows($selectSQL);
            $curEmpID = 'WY' . ($LastEMP < 10 ? sprintf("%02d", $LastEMP + 1) : $LastEMP + 1);
        } else {
            $curEmpID = 'WY01';
        }
    } else {
        $errors['database'] = '<span class="text-danger">Something went wrong, please contact support team!</span>';
    }

    if (empty($_POST['first_name'])) {
        $errors['first_name'] = '<span class="text-danger">Please enter your first name!</span>';
    }
    if (empty($_POST['last_name'])) {
        $errors['last_name'] = '<span class="text-danger">Please enter your last name!</span>';
    }
    if (empty($_POST['dob'])) {
        $errors['dob'] = '<span class="text-danger">Please enter your date of birth!</span>';
    }
    if (empty($_POST['gender'])) {
        $errors['gender'] = '<span class="text-danger">Please select your gender!</span>';
    }
    if (empty($_POST['address'])) {
        $errors['address'] = '<span class="text-danger">Please enter your address!</span>';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = '<span class="text-danger">Please enter your email id!</span>';
    }
    if (empty($_POST['mobile'])) {
        $errors['mobile'] = '<span class="text-danger">Please enter your mobile number!</span>';
    } else {
        $mobile = $_POST['mobile'];
        if (!ctype_digit($mobile)) {
            $errors['mobile'] = '<span class="text-danger">Mobile number should contain only numbers!</span>';
        }
    }
    if (empty($_POST['identification'])) {
        $errors['identification'] = '<span class="text-danger">Please choose your identification document!</span>';
    }
    if (empty($_POST['employment_type'])) {
        $errors['employment_type'] = '<span class="text-danger">Please choose your employment type!</span>';
    }
    if (empty($_POST['joining_date'])) {
        $errors['joining_date'] = '<span class="text-danger">Please enter your joining date!</span>';
    }
    if (empty($_POST['emp_password'])) {
        $errors['emp_password'] = '<span class="text-danger">Please set employee password!</span>';
    } else {
        $emp_password = $_POST['emp_password'];
        if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])(?=.*\W).{8,}$/", $emp_password)) {
            $errors['emp_password'] = '<span class="text-danger">Password must be at least 8 characters long and include at least one digit, one letter, and one special character!</span>';
        }
        $emp_password = addslashes($emp_password); // Fixed the misplaced assignment
    }
    if (empty($_FILES['photo']['name'])) {
        $errors['photo'] = '<span class="text-danger">Please upload your recent photograph!</span>';
    } else {
        $file_tmp_photo = $_FILES['photo']['tmp_name'];
        $file_type_photo = $_FILES['photo']['type'];
        $file_ext_photo = strtolower(end(explode('.', $_FILES['photo']['name'])));
        $photocopy_photo = $curEmpID . '.' . $file_ext_photo;
        if (in_array($file_ext_photo, $expensions) === false) {
            $errors['photo'] = '<span class="text-danger">Extension not allowed, please choose a JPEG or PNG file!</span>';
        }
    }
    if (empty($_FILES['idphoto']['name'])) {
        $errors['idphoto'] = '<span class="text-danger">Please upload your recent ID photograph!</span>';
    } else {
        $file_tmp_idphoto = $_FILES['idphoto']['tmp_name'];
        $file_type_idphoto = $_FILES['idphoto']['type'];
        $file_ext_idphoto = strtolower(end(explode('.', $_FILES['idphoto']['name'])));
        $photocopy_idphoto = $curEmpID . '_id.' . $file_ext_idphoto;
        if (in_array($file_ext_idphoto, $expensions) === false) {
            $errors['idphoto'] = '<span class="text-danger">Extension not allowed, please choose a JPEG or PNG file!</span>';
        }
    }

    if (empty($errors)) {
        $photo_uploaded = move_uploaded_file($file_tmp_photo, $target_dir_photo . $photocopy_photo);
        $idphoto_uploaded = move_uploaded_file($file_tmp_idphoto, $target_dir_idphoto . $photocopy_idphoto);

        if ($photo_uploaded && $idphoto_uploaded) {
            extract($_POST);
            $insertSQL = mysqli_query($db, "INSERT INTO `" . DB_PREFIX . "employees`(`emp_code`, `first_name`, `last_name`, `dob`, `gender`, `address`, `email`, `mobile`, `telephone`, `identity_doc`, `emp_type`, `joining_date`, `emp_password`, `photo`, `idphoto`, `created`) VALUES ('$curEmpID', '$first_name', '$last_name', '$dob', '$gender', '$address', '$email', '$mobile', '$telephone', '$identification', '$employment_type', '$joining_date', '" . sha1($emp_password) . "', '$photocopy_photo', '$photocopy_idphoto', NOW())");
            $_SESSION['success'] = '<p class="text-center"><span class="text-success">Employee registration successful!</span></p>';
            header('location:report2.php');
        } else {
            if (!$photo_uploaded) {
                $errors['photo'] = '<span class="text-danger">Photo is not uploaded, please try again!</span>';
            }
            if (!$idphoto_uploaded) {
                $errors['idphoto'] = '<span class="text-danger">ID Photo is not uploaded, please try again!</span>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<a href="http://localhost/payroll/registration/newreg.php"></a>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<title>Employee Registration - Payroll</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/AdminLTE.css">
<link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datepicker/datepicker3.css">

</head>

<style>
    .input-container {
        position: relative;
    }
    #togglePassword {
        position: absolute;
        top: 50%;
        right: 14px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>

<body class="hold-transition register-page">
<div class="container">
    <div class="register-box">
        <div class="register-logo">
            <a href="<?php echo BASE_URL; ?>"><b>PaySync</b></a>
            <small>Employee Registration Form</small>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Fill the below form</h3>
            <div class="box-tools pull-right">
                <span class="text-red">All fields are mandatory</span>
            </div>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data" novalidate="">
            <div class="box-body">
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name:" value="<?php echo $_POST['first_name']; ?>" required />
                        <?php echo $errors['first_name']; ?>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name:" value="<?php echo $_POST['last_name']; ?>" required />
                        <?php echo $errors['last_name']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="dob" name="dob" placeholder="Date of Birth:" value="<?php echo $_POST['dob']; ?>" required />
                        <?php echo $errors['dob']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label">Gender</label>
                    <div class="col-sm-10">
                        <label class="radio-inline"><input type="radio" name="gender" value="Male"> Male</label>
                        <label class="radio-inline"><input type="radio" name="gender" value="Female"> Female</label>
						<label class="radio-inline"><input type="radio" name="gender" value="Female"> Other</label>
                        <?php echo $errors['gender']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="address" name="address" placeholder="Your address..." required><?php echo $_POST['address']; ?></textarea>
                        <?php echo $errors['address']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address:" value="<?php echo $_POST['email']; ?>" required />
                            <span id="emailError" style="color: red;"><?php echo $errors['email']; ?></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="mobile" class="col-sm-2 control-label">Mobile Number</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number:" value="<?php echo $_POST['mobile']; ?>" required />
                        <span id="mobileError" style="color: red;"><?php echo $errors['mobile']; ?></span>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telephone Number:" value="<?php echo $_POST['telephone']; ?>" />
                        <span id="telephoneError" style="color: red;"><?php echo $errors['telephone']; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="identification" class="col-sm-2 control-label">ID Type:</label>
                    <div class="col-sm-5">
                        <select class="form-control" id="identification" name="identification" required>
                            <option value="">Select...</option>
							<option value="National ID">National ID</option>
							<option value="PhilHealth ID">PhilHealth ID</option>
                            <option value="SSS ID">SSS ID</option>
                            <option value="Passport">Passport</option>
                            <option value="Driver's License">Driver's License</option>
                            <option value="Voter's Card">Voter's Card</option>
                        </select>
                        <?php echo $errors['identification']; ?>
                    </div>
                    <div class="col-sm-5">
                        <input type="file" id="idphoto" name="idphoto" accept=".jpeg, .jpg, .png" required />
                        <?php echo $errors['idphoto']; ?>
                        <span id="fileTypeError" style="color: red;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="employment_type" class="col-sm-2 control-label">Employment Type</label>
                    <div class="col-sm-10">
                        <label class="radio-inline"><input type="radio" name="employment_type" value="Part Time"> Part Time</label>
						<label class="radio-inline"><input type="radio" name="employment_type" value="Part Time"> Intern</label>
                        <label class="radio-inline"><input type="radio" name="employment_type" value="Full Time"> Full Time</label>
                        <?php echo $errors['employment_type']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="joining_date" class="col-sm-2 control-label">Joining Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="joining_date" name="joining_date" placeholder="Joining Date:" value="<?php echo $_POST['joining_date']; ?>" required />
                        <?php echo $errors['joining_date']; ?>
                    </div>
                </div>
				<div class="form-group">
                    <label for="emp_password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <div class="input-container">
                            <input type="password" class="form-control" id="emp_password" name="emp_password" placeholder="Employee Password:" required />
                            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </div>
                        <?php echo $errors['emp_password']; ?>
                    </div>
                </div>
				<div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Photograph</label>
                    <div class="col-sm-10">
                        <input type="file" id="photo" name="photo" accept=".jpeg, .jpg, .png" required />
                        <?php echo $errors['photo']; ?>
                        <span id="photoFileTypeError" style="color: red;"></span>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Show Password Script -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordField = document.getElementById('emp_password');
        var togglePasswordIcon = document.getElementById('togglePassword');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            togglePasswordIcon.classList.remove('fa-eye');
            togglePasswordIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            togglePasswordIcon.classList.remove('fa-eye-slash');
            togglePasswordIcon.classList.add('fa-eye');
        }
    });
</script>

<!-- Email Validation Script -->
<script>
    document.getElementById('email').addEventListener('input', function () {
        var emailField = document.getElementById('email');
        var emailError = document.getElementById('emailError');
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailPattern.test(emailField.value)) {
            emailError.textContent = '';
        } else {
            emailError.textContent = 'Please enter a valid email address.';
        }
    });
</script>

<!-- Mobile and Phone Validation Script -->
<script>
    function validateNumberInput(inputField, errorSpan) {
        var fieldValue = inputField.value.trim();
        fieldValue = fieldValue.replace(/\D/g, '');
        inputField.value = fieldValue;
        if (fieldValue.length > 11) {
            inputField.value = fieldValue.slice(0, 11);
        }
        if (fieldValue.length === 11) {
            errorSpan.textContent = '';
        } else {
            errorSpan.textContent = 'Number must contain 11 digits.';
        }
    }

    document.getElementById('mobile').addEventListener('input', function () {
        validateNumberInput(this, document.getElementById('mobileError'));
    });

    document.getElementById('telephone').addEventListener('input', function () {
        validateNumberInput(this, document.getElementById('telephoneError'));
    });
</script>

<!-- ID Photo Validation Script -->
<script>
    document.getElementById('idphoto').addEventListener('change', function () {
        var fileInput = this;
        var file = fileInput.files[0];
        var fileTypeErrorSpan = document.getElementById('fileTypeError');

        if (file) {
            var fileName = file.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            var allowedExtensions = ['jpeg', 'jpg', 'png'];

            if (allowedExtensions.indexOf(fileExtension) === -1) {
                fileInput.value = '';
                fileTypeErrorSpan.textContent = 'Only JPEG, JPG, and PNG files are allowed.';
            } else {
                fileTypeErrorSpan.textContent = '';
            }
        }
    });
</script>


<script>
    document.getElementById('photo').addEventListener('change', function () {
        var fileInput = this;
        var file = fileInput.files[0];
        var photoFileTypeErrorSpan = document.getElementById('photoFileTypeError');

        if (file) {
            var fileName = file.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            var allowedExtensions = ['jpeg', 'jpg', 'png'];

            if (allowedExtensions.indexOf(fileExtension) === -1) {
                fileInput.value = '';
                photoFileTypeErrorSpan.textContent = 'Only JPEG, JPG, and PNG files are allowed.';
            } else {
                photoFileTypeErrorSpan.textContent = '';
            }
        }
    });
</script>

<!-- Calendar Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var picker = new Pikaday({
            field: document.getElementById('dob'),
            format: 'YYYY-MM-DD',
            maxDate: new Date(),
            yearRange: [1900, new Date().getFullYear()],
            onSelect: function(date) {
                validateYear(this._o.field);
            }
        });

        document.getElementById('dob').addEventListener('input', function() {
            validateYear(this);
        });

        function validateYear(input) {
            const value = input.value;
            const yearPart = value.split('-')[0];

            if (yearPart.length > 4) {
                input.value = value.slice(0, 4) + value.slice(4).replace(/[^-]/g, '');
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script src="<?php echo BASE_URL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo BASE_URL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo BASE_URL; ?>dist/js/app.min.js"></script>
</body>
</html>