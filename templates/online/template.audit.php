<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>IP HISTORY FOR MEMBER</title><link rel=stylesheet type=text/css href="<?php echo $data['Host']?>/css/style.css"><script type=text/javascript language=JavaScript src="<?php echo $data['Host']?>/js/script.js"></script><script text/javascript language=JavaScript>document.oncontextmenu=new Function("return false")</script></head><body topmargin=5 leftmargin=5 marginwidth=5 marginheight=5 bgcolor=#FFFFFF>
 <table class=frame width=274 border=0 cellspacing=1 cellpadding=2>
  <tr><td class=capl colspan=2 nowrap>IP HISTORY FOR</td></tr>
  <tr><td class=field width=100 nowrap>Username:</td><td class=input><?php echo $post['Member']['username']?></td></tr>
  <tr><td class=field nowrap>Full name:</td><td class=input><?php echo $post['Member']['fname']?> <?php echo $post['Member']['lname']?></td></tr>
  <tr><td class=field nowrap>E-Mail address:</td><td class=input><?php echo $post['Member']['email']?></td></tr>
 </table>
 <br>
 <table class=frame width=274 border=0 cellspacing=1 cellpadding=2>
  <tr><td class=capc width=130><a href="<?php echo $data['Admins']?>/history.htm?member=<?php echo $post['Member']['id']?>&order=date">VISIT DATE</a></td><td class=capc><a href="<?php echo $data['Admins']?>/history.htm?member=<?php echo $post['Member']['id']?>&order=address">IP ADDRESS</a></td></tr>
 <?foreach($post['History'] as $key=>$value){$bgcolor=$key%2?'#EEEEEE':'#E7E7E7'?>
  <tr bgcolor=<?php echo $bgcolor?> onmouseover="setPointer(this,<?php echo $key?>,'over','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')" onmouseout="setPointer(this,<?php echo $key?>,'out','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')" onmousedown="setPointer(this,<?php echo $key?>,'click','<?php echo $bgcolor?>','#CCFFCC','#FFCC99')">
   <td align=center><?php echo prndate($value['date'])?></td><td align=center><?php echo $value['address']?></td>
  </tr>
 <?}?>
 </table>
 <br>
 <table class=frame width=274 border=0 cellspacing=1 cellpadding=2>
 <tr><td class=capc><input type=button class=submit value="CLOSE" onclick="javascript:window.close()"></td></tr>
 </table>
 </body>
</html>