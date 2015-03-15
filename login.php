<html dir="ltr">
<head>
<meta http-equiv="Content-Language" content="ar-jo">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256">
<title>Login Page</title>
</head>
<body bgcolor="#EFEFEF">
<font face="PT Bold Heading"  color="#0000FF">
<h2><p align='center'>Search Of the approved scientific journals</p></h2>

<br />

<div style="position: absolute; width: 958px; height: 45px; z-index: 1; right: 220px; top: 160px">

<h3><p align="center">Login Page</p> </h3>

<br /><br />
<center>

<form action="" method="post" class="style" >
<br /><br />
 &nbsp;&nbsp;User ID :<input type="text" name="id" value="" /><br />
Password :<input type="password" name="pass" value=""   /> <br />
<input type="submit" name="login" value="login" />

<br /><br />

<?php
session_start();

// connect to DB

mysql_connect("localhost","root",null) or die (mysql_error());
mysql_select_db('journals');


echo '<center><font color="#FF0000">';


	if(isset($_POST['login']))
    {
        if(!empty($_POST['id']) && !empty($_POST['pass']))
        {
            
                $id=$_POST['id'];
                $DBid=mysql_query("SELECT `user_id`, `user_name`, `user_passowrd`,type  FROM `users` WHERE user_id=".$id) or die(mysql_error());
                $user_data=mysql_fetch_assoc($DBid);
                
                if(!empty($user_data))
                {
                    if ($user_data['user_passowrd']==$_POST['pass'])
                    {
                        $_SESSION['id']=$id;
                        $_SESSION['user_name']=$user_data['user_name'];
                        if ($user_data['type']=='admin')
                        {
                           
                             header("Location:admin.php");
                        }
                        elseif ($user_data['type']=='resercher')
                        {
                           
                            header("Location:doctor.php");
                        }
                        elseif($user_data['type']=='committee')
                        {
                          
                           header("Location:committee.php"); 
                        }
                        
                    }
                }
               else  {echo "&nbsp;&nbsp;This User Not Exist";}
                
           
            
        }
        else 
        
        {
            echo "&nbsp;&nbsp;Enter Email and Password";
        }
        
    }
?>
</center>
</div>
</form>






