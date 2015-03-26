<?php
	$host="cryfin.ipagemysql.com";
	$user="cryfin";
	$pass="Anime.Fan123";
	$conn=mysql_connect($host, $user, $pass);
	if(!$conn)
	{
		die("Could not connect " . mysql_error());
	}
	$sql="select * from final;";
	mysql_select_db("secretsanta");
	$res=mysql_query($sql, $conn);
	if(!$res)
	{
		die("Failed ".mysql_error());
	}
	while($row=mysql_fetch_assoc($res))
	{
		$santa=$row[santa];
		$email=$row[email];
		$secret=$row[secret];
		$headers = 'From: admin@cryf.in' . "\r\n" .
					'Reply-To: unknown7bolt@gmail.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
$msg=<<<END
Hello {$santa},

	Your secret friend is {$secret}.

Shh... It's a secret.

Pray for them, wish them a happy and successful year ahead.

Merry Christmas and a Happy New Year!
Do well in the exams :)
END;

		mail($email, "Secret Santa", $msg, $headers);
	}
	echo "Completed";
	mysql_close($conn);
?>
