<?php include "tops.php" ?>
<ul class="navigation">
	<li><a href="index.php"><i class="icon-home"></i> Home</a></li>
   	<li><a href="#">New Thread</a></li>
</ul>
<script src="http://code.google.com/p/rangyinputs/source/browse/trunk/standalone.js" type="text/javascript"></script>
<script type="text/javascript" src="js/tool-text.js"></script>

<!-- Mulai ISI nya -->
<?php require_once "config.php"; 
$fid =$_GET['fid'];
?>

<div class="window">
	<div class="window-inner">
    	<div class="window-head" style="padding:10px;"><center><b>New Thread</b></center></div>
      <form method="post" action="newthread-submit.php" name="formtosub">
        <input type="hidden" name="fid" value="<?php echo "$fid"; ?>" />
        <input type="hidden" name="uid" value="<?php echo "$uid_now"; ?>" />
        <input type="hidden" name="username" value="<?php echo "$username"; ?>" />
    	<table width="100%" cellspacing="0" cellpadding="10px" border="0"><tbody>
        	<tr>
            	<td width="17%">Judul</td>
                <td><input type="text" name="judul" required style="width:250px; padding:5px 10px; border:1px solid #D8D8D8;" placeholder="Judul" /></td>
            </tr><tr>
            	<td valign="top">Content</td>
                <td>
                	<div style="border:1px solid #D8D8D8; border-bottom:none; width:500px; padding:5px 2px;">
                    	<div class="toolbar" style="font-size:12px;">
<span onclick="insertText('[b]', '[/b]'); return false;" class="texttool"><i class='icon-bold'></i></span>
<span onclick="insertText('[i]', '[/i]'); return false;" class="texttool"><i class='icon-italic'></i></span>
<span onclick="insertText('[u]', '[/u]'); return false;" class="texttool"><i class='icon-underline'></i></span>
<span onclick="insertText('[L]', '[/L]'); return false;" class="texttool"><i class='icon-align-left'></i></span>
<span onclick="insertText('[e]', '[/e]'); return false;" class="texttool"><i class='icon-align-center'></i></span>
<span onclick="insertText('[R]', '[/R]'); return false;" class="texttool"><i class='icon-align-right'></i></span>
<span onclick="insertText('[J]', '[/J]'); return false;" class="texttool"><i class='icon-align-justify'></i></span>
<span onclick="insertFile('[file]', '[/file]'); return false;" class="texttool" id="addFile"><i class='icon-file-alt'></i></span>
<span onclick="insertImg('[img]', '[/img]'); return false;" class="texttool"><i class='icon-picture'></i></span>
<span onclick="insertA('[a]', '[/a]'); return false;" class="texttool"><i class='icon-link'></i></span>
<span onclick="insertText('[code]', '[/code]'); return false;" class="texttool"><i class='icon-code'></i></span>
                        </div>
                    </div>
                	<textarea name="content" id="content" required style="width:500px; max-width:500px; height:300px; max-height:300px; border:1px solid #D8D8D8;"></textarea><br />
                    <span style="font-size:13px; color:#FF5A5C;"><em><b>*)</b> Ingin menambahkan File? Ini <a href="#" target="_blank" style="text-decoration:none;"><b>Caranya</b></a>. List Code File ada <a href="file/" target="_blank" style="text-decoration:none;"><b>Di sini</b></a></em></span>
                    </td>
            </tr><tr>
            	<td colspan="2"><center>
                	<a href="thread.php?fid=<?php echo "$fid"; ?>" class="btn btn-blue" style="line-height:30px; height:28px; position: relative; top:1px; font-size:13px;">Back</a> &nbsp; 
                	<input type="submit" class="btn btn-blue" value="Post" />
                </center></td>
            </tr>
        </tbody></table>
      </form>
    </div>
</div>
<!-- Akhir ISI nya -->

<?php include "end.php";