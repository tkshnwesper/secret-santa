<!DOCTYPE html>
	
	<?php
		if($_GET['action']=="show")
		{
			?>
			
			<head>
				<title>User List</title>
			</head>
			<body>
				<center>
					
			<?php
			$host="cryfin.ipagemysql.com";
			$user="cryfin";
			$pass="Anime.Fan123";
			$conn=mysql_connect($host, $user, $pass);
			if(!$conn)
			{
				die("Could not connect " . mysql_error());
			}

			$sql="select name from anifun order by name;";
			mysql_select_db("secretsanta");
			$res=mysql_query($sql, $conn);
			if(!$res)
			{
				die("Failed ".mysql_error());
			}
			$count=mysql_num_rows($res);
			$prev='A'-1;
			echo "<p>Registered users: {$count}</p>";
			echo "<p>";
			while($row=mysql_fetch_assoc($res))
			{
				
				$name=$row['name'];
				$f=strtoupper($name[0]);
				if($prev<$f)
				{
					echo "</p><p>";
					echo "<b><u>{$f}</u></b><br>";
					$prev=$f;
				}
				echo "{$name}<br>";
			}
			echo "</p>";
			mysql_close($conn);
			?>
			<p><a href="ss.php">Back</a></p>
			</center>
			</body>
			</html>
			
			<?php
			exit();
		}
	?>

	
<?php if($_POST[name]=="" and $_POST[email]==null) { ?>
	
	<head>
	<title>Secret Santa Pool</title>
	</head>
	<body>
		<p>
			Add your name to the pool!<br> We will let you know by email who your secret santa is! Please wait a while for the 
			pool to fill up.
		</p>
		
		<fieldset>
			<form method="POST">
				<table>
					<tr>
					<td>Name</td> <td><input type="text" name="name"></td>
					</tr>
					<tr>
					<td>Email</td> <td><input type="text" name="email"></td>
					</tr>
				</table>
				<input type="submit" value="Submit">
			</form>
		</fieldset>
		<p>
			<a href="ss.php?action=show">Show registered users</a>
		</p>
		<p>
			<a href="rand.php">Randomisation Test</a>
		</p>
	</body>
	
	
<?php }
	
	else {	?>
		
		<?php
			$errorflag=0;
			if(strlen($_POST[name])>255)
			{
				$errorflag=1;

			}
			if(strlen($_POST[email])>255)
			{
				$errorflag=2;

			}
			
			if($_POST[name]=="" or $_POST[email]==null)
			{
				$errorflag=3;
			}
			if($errorflag)
			{
				switch($errorflag)
				{
					case 1:
					print("Enter a shorter name");
					break;
					
					case 2:
					print("Enter a valid email");
					break;
					
					case 3:
					print("Enter both values");
					break;
					
					default:
					print("Undefined error");
				}	?>
				
		<head>
			<title>Error!</title>
		</head>
		
	<?php		die();
			}
		?>
		
	<head>
		<title>Successful!</title>
	</head>
	
	<body>
			

			
		<?php
			$host="cryfin.ipagemysql.com";
			$user="cryfin";
			$pass="Anime.Fan123";
			$conn=mysql_connect($host, $user, $pass);
			if(!$conn)
			{
				die("Could not connect " . mysql_error());
			}

			$sql="insert into anifun values(\"{$_POST[name]}\", \"{$_POST[email]}\");";
			mysql_select_db("secretsanta");
			$res=mysql_query($sql, $conn);
			if(!$res)
			{
				die("Failed ".mysql_error());
			}
			echo "Your name has been added to the pool!";
			mysql_close($conn);
		}
		?>
		

	
</html>
		
