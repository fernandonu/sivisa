<?

if (ereg("/login.php",$_SERVER["SCRIPT_NAME"])) {
	$tmp=explode("/login.php",$_SERVER["SCRIPT_NAME"]);
	$html_root = $tmp[0];
}
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Sistema de Vigilancia Sanidad Animal</title>
<head>
<link rel="icon" href="<? echo ((($_SERVER['HTTPS'])?"https":"http")."://".$_SERVER['HTTP_HOST']).$html_root; ?>/favicon.ico">
<link REL='SHORTCUT ICON' HREF='<? echo ((($_SERVER['HTTPS'])?"https":"http")."://".$_SERVER['HTTP_HOST']).$html_root; ?>/favicon.ico'>

<link type='text/css' href='<? echo $html_root; ?>/lib/estilos.css' REL='stylesheet'>
</head>
</head>

<body style="overflow:hidden;" onLoad="javascript: document.frm.username.focus();" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" background="<?="$html_root/imagenes/fondo.jpg"?>">
<form action='index.php' method='post' name='frm'>
<input type="hidden" name="resolucion_ancho" value="">
<input type="hidden" name="resolucion_largo" value="">
<div align="center">
<br>
<table cellpadding="0" cellspacing="0" border="0" align="center" width="780">
	<tr>
		<td bgcolor="#AEB3B7">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr> 
					<div align="center" >
						<td width="100%"><img src="<?="$html_root/imagenes/sp.gif"?>" width="1" height="8"><br></td>
					</div>
				</tr>
			</table>		
		</td>
	</tr>
	
	<tr>	  
	  <td width="245" colspan="3"><p align="center"><img src="<?="$html_root/imagenes/gob_sanluis.jpg"?>" width="781" height="141"/></td>
	</tr>
  	
  	<tr>
		<td bgcolor="#AEB3B7">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr> 
					<div align="center" >
						<td width="100%"><img src="<?="$html_root/imagenes/sp.gif"?>" width="1" height="8"><br></td>
					</div>
				</tr>
			</table>		
		</td>
	</tr>
	
  	<tr>
		<td colspan="5" >
			<img src="<?="$html_root/imagenes/Terrazas_del_Portezuelo.jpg"?>" width="781" height="200" />
		</td>
  	</tr>
  	
	<tr>	
		<td bgcolor="#AEB3B7">
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr> <div align="center" >
					<td bgcolor="#ffffff"><img src="<?="$html_root/imagenes/sp.gif"?>" width="1" height="1"></td>
					<td width="100%"><img src="<?="$html_root/imagenes/sp.gif"?>" width="1" height="8"><br></td>
					<td bgcolor="#ffffff"><img src="<?="$html_root/imagenes/sp.gif"?>" width="1" height="1"></td>
				</div></tr>
			</table>
		</td>		
	</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" align="center" width="780">
	<tr align="center">	   	
		<td width="119" valign="top" align="center"></td>
		<td width="279" valign="top" align="center" colspan="4">
			<div style="padding:3px;text-align:justify;align:center">
				<form method="POST" action="--WEBBOT-SELF--" align="center">
				<p style="text-align: right">
					<font face="Tahoma"size="2"><b>Usuario: </b></font>
					<INPUT name=username AUTOCOMPLETE="off" style="border-style: solid; border-width: 1px" size="23" tabindex="1">
				</p>
				<p style="text-align: right">
					<font face="Tahoma" size="2"><b>Contraseña: </b></font>
					<INPUT type=password name=password AUTOCOMPLETE="off" style="border-style: solid; border-width: 1px" size="23" tabindex="2">
				</p>
				<p style="text-align: center">
					<INPUT type=submit value="  Ingresar &gt;" name=loginform style="font-family: Tahoma; font-size: 10pt" tabindex="3">
				</p>
			</form>
			</div>
		</td>		
 	</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" align="center" width="785" height="25">
	<tr>
  		<td width="785" bgcolor="#006A9E">
  		<div > 
			<p align="center">
				<b><font color="#FFFFFF" face="Tahoma" size="2">2014 © Copyright</font></b>
			</p>
		</div>
		</td>
 	</tr>
</table>

</div>
<script>
//guardamos la resolucion de la pantalla del usuario en los hiddens para despues recuperarlas
//y guardarlas en las variable de sesion $_ses_user
document.all.resolucion_ancho.value=screen.width;
document.all.resolucion_largo.value=screen.height;

</script>
</body>
</form>
</html>
