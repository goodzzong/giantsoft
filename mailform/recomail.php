<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
.menu {
font-family: "����";
font-size: 12px;
color: #666666;
}
.menubw {
font-family: "����";
font-size: 12px;
color: #FFFFFF;
}
-->
</style>
</head>

<body>
<table width="600" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor='#BDBEBD' style='border-collapse: collapse'>
<tr align="center" bgcolor="8C8E8C"> 
<td height="25" colspan="2" class="menubw"><b>test ���� ������ ��ǰ ��õ �����Դϴ�</b></td>
</tr>
<tr> 
<td height="25" width="120" align="center" bgcolor="8C8E8C" class="menubw">�������</td>
<td height="25" width="480" class="menu">test@test.co.kr</td>
</tr>
<tr> 
<td height="25" width="120" align="center" bgcolor="8C8E8C" class="menubw">�޴»��</td>
<td height="25" width="480" class="menu">aaa@aaa.co.kr</td>
</tr>
<tr> 
<td height="25" width="120" align="center" bgcolor="8C8E8C" class="menubw">����</td>
<td height="25" width="480" class="menu">test�Դϴ�</td>
</tr>
</table>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td height="65" align="center"><img src="images/bt_goshop.gif" width="160" height="41"></td>
</tr>
</table>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
<tr> 
<td><img src="images/bar_product_info.gif" width="100" height="23"></td>
</tr>
</table>
<table width="600" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor='#ADAEAD' style='border-collapse: collapse'>
<tr> 
<td width="405" align="center">��ǰ�̹���</td>
<td width="195" align="center"><table width="175" border="0" cellpadding="0" cellspacing="0" class="menu">
<form method="post" name="goods_form">
<tr> 
<td width="85" height="25" align="right">�ǸŰ��� :</td>
<td width="90" height="25" align="right"> ��</td>
</tr>
<tr> 
<td width="85"25" align="right">�Һ��ڰ� :</td>
<td width="90" height="25" align="right"><del> 
<?=number_format($goods_stat->old_price);?>
              ��</del>&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr> 
            <td width="85" height="25" align="right"><font color="#FF0000">��</font> 
              Point :</td>
            <td width="90" height="25" align="right"> 
              <?=number_format($goods_stat->shop_price*$goods_stat->point*0.01);?>
              P&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr> 
            <td width="85" height="25" align="right">��ǰ�ڵ� :</td>
            <td width="90" height="25" align="right"> 
              <?=$goods_stat->code;?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <!-- �ɼ���� -->
          <? if($goods_stat->option_check==1) {?>
          <? } else if($goods_stat->option_check==2) {?>
          <? }?>
          <!-- �ɼ���� -->
          <? if($goods_stat->goods_file) {?>
          <? }?>
          <? if($admin_stat->delivery_company) {?>
          <tr> 
            <td width="85" height="25" align="right">��۹�� :</td>
            <td width="90" height="25" align="right"> 
              <?=$admin_stat->delivery_company;?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <?}?>
          <tr> 
            <td width="85" height="25" align="right">�Ǹż��� :</td>
            <td width="90" height="25" align="right"> 
              <? if($goods_stat->unlimit==0) { if($goods_stat->number==0) { echo('ǰ��'); } else { echo($goods_stat->number."&nbsp;��");}} else { echo('�����');}?>
              &nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr> 
            <td width="85" height="25" align="right">�ֹ����� :</td>
            <td width="90" height="25" align="right"><input name="buy_goods_cnt" type="text" class="input" size="5" value="1" style="text-align: right;" onKeyPress="if( (event.keyCode<48) || (event.keyCode>57) ) event.returnValue=false;">
              ��&nbsp;&nbsp;&nbsp;</td>
          </tr>
        </form>
      </table></td>
  </tr>
  <tr> 
    <td colspan="2"><blockquote class="menu"><br>
        ��ǰ���� <br>
        <br>
      </blockquote></td>
  </tr>
</table>
</body>
</html>
