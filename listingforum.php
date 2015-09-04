<?php print "<div class='listforum'>"; 

$forum = "SELECT * FROM `db_forum` WHERE `parent` = $parent AND `type` = 'f' ORDER BY `disporder` ASC ";
$getforum = mysqli_query($connection, $forum);
while ($allforum = mysqli_fetch_array($getforum)) {
		$fid	= $allforum['fid'];
		$fname	= $allforum['fname'];
		$thread		= $allforum['thread'];
		$desc		= $allforum['descript'];

	print "
	<table width='100%' cellspacing='0'><tbody><tr>
		<td width='5%' class='bullet' style='text-align:center;'><sup><i class='icon-quote-left'></i></sup>...</td>
		<td width='75%'><a class='forum' href='thread.php?fid=$fid'><div class='fname'>$fname</div><div class='desc'><em>$desc</em></div></a></td>
		<td width='20%'><div class='thread'>$thread Threads</div></td>
	</tr></tbody></table>
	";
	};
?>

<?php print "</div>	</section>" ?>