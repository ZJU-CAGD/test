<html>

<?php echo validation_errors(); ?>
<?php 
echo form_open('users/user_login'); 
?>
<table>  
<tr>  
<td>用户名</td>  
<td><input type="text" name="username"></td>  
</tr>  
<tr>  
<td>密码</td>  
<td><input type="password" name="password"></td>  
</tr>  
<tr>  
<td>  
<input type="submit" name="submit" value="登录">  
</td>   
</tr>  
</table>  
</form>  
</html>  