<?php
	class classmate
	{
		public $name;
		public $email;
	}
?>

<!DOCTYPE html>
	<head>
		<title>Randomisation Test</title>
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
		
		$sql="select * from anifun order by RAND();";
		mysql_select_db("secretsanta");
		$res=mysql_query($sql, $conn);
		if(!$res)
		{
			die("Failed ".mysql_error());
		}
		$carray=array();
		while($row=mysql_fetch_assoc($res))
		{
			$nc=new classmate;
			$nc->name=$row[name];
			$nc->email=$row[email];
			$carray[]=$nc;
		}
		
		$n=mysql_num_rows($res);
		$kvp=array();
		$cop=$carray;
		$ran=rand(0,$n-1);
		$f=$cop[$ran];
		unset($cop[$ran]);
		foreach($cop as $v)
		{
			$dum[]=$v;
		}
		$cop=$dum;
		$key=$f;
		while($n=count($cop))
		{
			$ran=rand(0,$n-1);
			$val=$cop[$ran];
			unset($cop[$ran]);
			$dum=array();
			foreach($cop as $v)
			{
				$dum[]=$v;
			}
			$cop=$dum;
			$kvp[]=array($key,$val);
			$key=$val;
		}
		$kvp[]=array($key, $f);
		?>
			<table>
			<?php
		foreach($kvp as $ar)
		{
			echo "<tr><td>{$ar[0]->name}</td> <td width=20>-></td> <td>{$ar[1]->name}</td></tr>";
			
		}
		?>
			</table>
			<?php
		mysql_close($conn);
	?>
	</center>
	</body>

</html>
			
