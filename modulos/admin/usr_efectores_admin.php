<?
/*
Author: JEM

modificada por
$Author: JEM $
$Revision: 1.00 $
$Date: 2011/07/18 14:54:30 $
*/

require_once ("../../config.php");

extract ( $_POST, EXTR_SKIP );
if ($parametros)
	extract ( $parametros, EXTR_OVERWRITE );
cargar_calendario ();

if ($borra_efec == 'borra_efec') {
	
	$query = "delete from sistema.usu_efec  
			where cuie='$cuie'";
	
	sql ( $query, "Error al eliminar el pcia" ) or fin_pagina ();
	$accion = "Los datos se han borrado";
}

if ($id_usuario) {
	$query = " SELECT 
		 *
		FROM
		  sistema.usuarios  
		  where id_usuario=$id_usuario";
	
	$res_usuario = sql ( $query, "Error al traer el Comprobantes" ) or fin_pagina ();
	$login = $res_usuario->fields ['login'];
	$login = strtoupper ( $login );
}

if ($_POST ['guardar_provincia'] == 'Guardar') {
	$db->StartTrans ();
	
	for($i = 0; $i < count ( $cuie ); $i ++) {
		$efector = $cuie [$i];
		
		$query = "insert into sistema.usu_efec
				   	(cuie, id_usuario)
				   	values
				   	('$efector', '$id_usuario')";
		
		sql ( $query, "Error al insertar Efector" ) or fin_pagina ();
	
	}
	
	$accion = "Los datos se han guardado correctamente";
	
	$db->CompleteTrans ();
}
//---------------------fin provincia------------------------------


echo $html_header;

?>
<script>
function editar_campos()
{	
	document.all.login.disabled=false;
	document.all.guardar_editar.disabled=false;
	document.all.cancelar_editar.disabled=false;
	document.all.borrar.disabled=false;
	document.all.guardar.enaible=false;
	return true;
}
//fin de function control_nuevos()
//empieza funcion mostrar tabla
var img_ext='<?=$img_ext = '../../imagenes/rigth2.gif'?>';//imagen extendido
var img_cont='<?=$img_cont = '../../imagenes/down2.gif'?>';//imagen contraido

function muestra_tabla(obj_tabla,nro){
 oimg=eval("document.all.imagen_"+nro);//objeto tipo IMG
 if (obj_tabla.style.display=='none'){
 	obj_tabla.style.display='inline';
    oimg.show=0;
    oimg.src=img_ext;
 }
 else{
 	obj_tabla.style.display='none';
    oimg.show=1;
	oimg.src=img_cont;
 }
}//termina muestra tabla

//---------------------scrip para provincia------------------------------

function control_nuevo_provincia(){ 
  if(document.all.cod_provincia.value==""){
  		alert('Debe ingresar un codigo de provincia');
  return false;
 } 
  if(document.all.nom_provincia.value==""){
  alert('Debe ingresar una Provincia');
  return false;
 } 
 } 
 
 
//---------------------fin scrip para provincia---------------------------

</script>
<form name='form1' action='usr_efectores_admin.php' method='POST'><input
	type="hidden" value="<?=$id_usuario?>" name="id_usuario">

<?
echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";
?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0
	align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
	<tr id="mo">
		<td>
    	<?
					if (! $id_usuario) {
						?>  
    	<font size=+1><b>Nuevo Dato</b></font>   
    	<?
					} else {
						?>
        <font size=+1><b><?=$login?></b></font>   
        <?
					}
					?>
       
    </td>
	</tr>
	<tr>
		<td>
		<table width=90% align="center" class="bordes">
			<tr>
				<td id=mo colspan="2"><b> Usuario</b></td>
			</tr>
			<tr>
				<td>
				<table>
					<tr>
						<td align="center" colspan="2"><b> ID Usuario: <font size="+1"
							color="Red"> <?=($id_usuario) ? $id_usuario : "Nuevo Dato"?></font>
						</b></td>
					</tr>
					</tr>
					<tr>
						<td align="right"><b>Login:</b></td>
						<td align='left'><input type="text" size="40" value="<?=$login;?>"
							name="login" <?
							if ($id_usuario)
								echo "disabled"?>></td>
					</tr>
				</table>
			
			
			<tr>
				<td>
				<table width=100% align="center" class="bordes">
					<tr align="center">

					</tr>
				</table>
				</td>
			</tr>
 <?
	if ($id_usuario) {
		
		//--------------------- FORM Efector------------------------------		?>
 
 
 	<tr>
				<td>
				<table width="100%" class="bordes" align="center">
					<tr align="center" id="mo">
						<td align="center"><b>Agregar Efector</b></td>
					</tr>


					<tr>
						<td>
						<table width="100%" align="center">

							<tr>
								<td align="right"><b>Efectores:</b></td>
								<td align='left'><select multiple name="cuie[]" Style=""
									size="20" onKeypress="buscar_combo(this);"
									onblur="borrar_buffer();" onchange="borrar_buffer();"
									<?php
		if (($id_planilla) and ($tipo_transaccion != "M"))
			echo "disabled"?>>
			  <?
		$sql = "select * from nacer.efe_conv order by nombre";
		$res_efectores = sql ( $sql ) or fin_pagina ();
		while ( ! $res_efectores->EOF ) {
			$cuiel = $res_efectores->fields ['cuie'];
			$nombre_efector = $res_efectores->fields ['nombre'];
			
			?>
				<option value='<?=$cuiel?>' <?
			if ($cuie == $cuiel)
				echo "selected"?>><?=$cuiel . " - " . $nombre_efector?></option>
			    <?
			$res_efectores->movenext ();
		}
		?>
			</select></td>
							</tr>
							<tr>
								<td align="center" colspan="5" class="bordes"><input
									type="submit" name="guardar_provincia" value="Guardar"
									title="Guardar" style=""
									onclick="return control_nuevo_provincia()">&nbsp;&nbsp;</td>
							</tr>

						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		
	
 <? //--------------------- lista efectores------------------------------		?>

		
			 
	<tr>
				<td>
				<table width="100%" class="bordes" align="center">
					<tr align="center" id="mo">
						<td align="center" width="3%"><img id="imagen_2"
							src="<?=$img_ext?>" border=0 title="Mostrar" align="left"
							style="cursor: pointer;"
							onclick="muestra_tabla(document.all.prueba_vida,2);"></td>
						<td align="center"><b>Efectores Relacionados</b></td>
					</tr>

				</table>
				</td>
			</tr>


			<tr>
				<td>
				<table id="prueba_vida" border="1" width="100%"
					style="display: none; border: thin groove">
			<? //tabla de comprobantes
		$query = "select nacer.efe_conv.nombre, nacer.efe_conv.cuie from nacer.efe_conv join sistema.usu_efec on (nacer.efe_conv.cuie = sistema.usu_efec.cuie) 
			        join sistema.usuarios on (sistema.usu_efec.id_usuario = sistema.usuarios.id_usuario) 
			        where sistema.usuarios.id_usuario = '$id_usuario' order by nombre";
		
		$res_comprobante = sql ( $query, "<br>Error al traer los comprobantes<br>" ) or fin_pagina ();
		if ($res_comprobante->RecordCount () == 0) {
			?>
				 <tr>
						<td align="center"><font size="2" color="Red"><b>No existe ningun
						Efector relacionado con este Usuario</b></font></td>
					</tr>
				 <?
		} else {
			?>
				 	<tr id="sub_tabla">
						<td width=1%>&nbsp;</td>
						<td width="20%">CUIE</td>
						<td width="30%">Efector</td>
						<td width=1%>Borrar</td>

					</tr>
					
				 	<?
			$res_comprobante->movefirst ();
			while ( ! $res_comprobante->EOF ) {
				
				$ref = encode_link ( " ", array ("cuie" => $res_comprobante->fields ['cuie'], "nombreefector" => $res_comprobante->fields ['nombreefector'] ) );
				$onclick_elegir = "location.href='$ref'";
				
				$id_tabla = "tabla_" . $res_comprobante->fields ['cuie'];
				$onclick_check = " javascript:(this.checked)?Mostrar('$id_tabla'):Ocultar('$id_tabla')";
				?>
				 		
				 		<tr <?=atrib_tr ()?>>
						<td><input type=checkbox name=check_prestacion value=""
							onclick="<?=$onclick_check?>" class="estilos_check"></td>
						<td onclick="<?=$onclick_elegir?>"><?=$res_comprobante->fields ['cuie']?></td>
						<td onclick="<?=$onclick_elegir?>"><?=$res_comprobante->fields ['nombre']?></td>
					 		<?
				$ref = encode_link ( "usr_efectores_admin.php", array ("cuie" => $res_comprobante->fields ['cuie'], "borra_efec" => "borra_efec", "id_usuario" => $id_usuario ) );
				$onclick_provincia = "if (confirm('Seguro que desea eliminar el Efector?')) location.href='$ref'";
				?>
					 		<td align="center"><img src='../../imagenes/salir.gif'
							style='cursor: pointer;' onclick="<?=$onclick_provincia?>"></td>
					</tr>
					 	<?
				$res_comprobante->movenext ();
			} // fin while
		} //fin del else		?>	 	
		</table>
				</td>
			</tr>
		 <?php
	}
	?>
 

	
 <tr>
				<td>
				<table width=100% align="center" class="bordes">
					<tr align="center">
						<td><input type=button name="volver" value="Volver"
							onclick="document.location='usr_efectores_listado.php'"
							title="Volver al Listado" style=""></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>

<?=fin_pagina ();// aca termino ?>
