<?php
	class classmate
	{
		public $name;
		public $email;
	}
?>

<!DOCTYPE html>
	<?php
		$host="";
		$user="";
		$pass="";
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
			$nc->name=trim($row[name]);
			$nc->email=trim($row[email]);
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
		$count=0;
		
		// transfer final list to db
		
		foreach($kvp as $ar)
		{
			//~ echo "<p>".++$count." {$ar[0]->name} -> {$ar[1]->name}</p>";
			$sql="insert into final values(\"{$ar[0]->name}\",\"{$ar[0]->email}\",\"{$ar[1]->name}\");";
			$res=mysql_query($sql, $conn);
			if(!$res)
			{
				die("Failed ".mysql_error());
			}
		}
		echo "Completed";
		
		
		mysql_close($conn);
	?>
</html>

