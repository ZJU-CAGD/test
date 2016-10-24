<html>

<?php echo validation_errors(); ?>
<?php 
echo form_open('users/user_register'); 
?>
<table>  
<tr>  
<td>用户名：(32字符以内)</td>  
<td><input type="text" name="username"></td>  
</tr>  
<tr>  
<td>密码：(32字符以内)</td>  
<td><input type="password" name="password"></td>  
</tr>  
<tr>  
<td>生日：(八位数字，如19910101)</td>  
<td><input type="birthday" name="birthday"></td>  
</tr> 
<tr>  
<td>性别：(男为‘M’， 女为‘F’，为大写)</td>  
<td><input type="sex" name="sex"></td>  
</tr> 
<tr>  
<td>  
<input type="submit" name="submit" value="立即注册">  
</td>   
</tr>  
</table>  
</form>  
</html>  