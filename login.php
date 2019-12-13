<?php include "includes/topinclude.php"; ?>
<?php include("loginBackend.php"); ?>
<div class="content">
    <div class="content-block">
        <h1>Login</h1>
    </div>
</div>
<form action="login.php" method="post">
    <table>
        <tr>
            <td>email:</td>
            <td><input type="text" name="email" /></td>
        </tr>
        <tr>
            <td>password:</td>
            <td><input type="password" name="password" /></td>
        </tr>
    </table>
    <input type="submit" name="submit" />
</form>

<?php include "includes/bottominclude.php" ?>