<?php
if (isset($_SESSION['id'])) {
$this->redirect('/chat/');
}
?>
<div class="container">
<h3>Login</h3>
<form action="#" method="post" class="form-control-lg ex-login">
    <span id ="loginErr"></span>
	<p>Email</p>
	<p><input type="email" name="email" id="email" class="input-group-lg  login"></p>
	<p>Password</p>
	<p><input type="password" name="password" class="input-group-lg password"></p>
	<b><button type="submit" name="enter" class="btn btn-success password">Login</button></b>
    <a href="register">Sign up</a>
</form>
</div>
