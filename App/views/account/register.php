<div class="container">
<h3>Register</h3>
<form class="form-control-lg ex-register" method="post">
    <span id="regerr"></span>
	<p>Username</p>
    <span class ="emsg"></span>
	<p><input type="text" name = "username" id = "username" required></p>
    <p>Email</p>
    <span class ="erremail"></span>
    <p><input type="email" name = "email" id = "email" required></p>
    <p>Password</p>
	<p><input type="password" name="password" id="password" required> </p>
    <p>Confirm Password</p>
    <span id = "error"></span>
    <p><input type="password" name="confirmPass" id = "confirmPass" required> </p>
	<b><button class="btn btn-success" id = "sub" type="submit">Register</button></b>
    <a href="login">Back to Login</a>
</form>
</div>
</div>