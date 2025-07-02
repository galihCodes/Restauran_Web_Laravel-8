<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="regis/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="regis/css/style.css">
		<link rel="icon" href="/admin/icon/restaurant.png">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('regis/images/bg-registration-form-3.jpg');">
			<div class="inner">
				<form action="/register" method="post">
					@csrf
					<h3>Registration Form</h3>
					<div class="form-group">
						<div class="form-wrapper">
							<label for="">Full Name :</label>
							<div class="form-holder">
								<i class="zmdi zmdi-account-o" style="margin-top: 0.2rem"></i>
								<input required type="text" name="full_name" class="form-control" placeholder="Full Name">
							</div>
						</div>
						<div class="form-wrapper">
							<label for="">Username :</label>
							<div class="form-holder">
								<i class="zmdi zmdi-account" style="margin-top: 0.2rem"></i>
								<input required type="text" name="username" class="form-control" placeholder="Username">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="form-wrapper">
							<label for="">Email :</label>
							<div class="form-holder">
								<i class="zmdi zmdi-email" style="margin-top: 0.2rem"></i>
								<input required type="text" name="email" class="form-control" placeholder="Email">
							</div>
						</div>
						<div class="form-wrapper">
							<label for="">Password :</label>
							<div class="form-holder">
								<i class="zmdi zmdi-lock-outline"></i>
								<input required type="password" name="password" class="form-control" placeholder="********">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="form-wrapper">
							<label for="">Telepon :</label>
							<div class="form-holder">
								<i class="zmdi zmdi-phone" style="margin-top: 0.2rem"></i>
								<input required type="text" name="telepon" class="form-control" placeholder="Your Number">
							</div>
						</div>
						<div class="form-wrapper">
							<label for="">Level :</label>
							<div class="form-holder select">
								<select id="" class="form-control" name="level" required>
									<option selected hidden>-- Select Level --</option>
									<option value="admin">Admin</option>
									<option value="kasir">Kasir</option>
								</select>
								<i class="zmdi zmdi-face"></i>
							</div>
						</div>
					</div>
					<div class="form-end">
						<div class="checkbox">
							<div class="text-center p-t-120">
								Have a Account?
								<a class="txt2" href="/restauran/users">
									Dashboard
									<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
								</a>
							</div>
						</div>
						<div class="button-holder">
							<button type="submit">Register Now</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>