<?
require_once ("../../config.php");
extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar_editar']=='Guardar'){
	$db->StartTrans();
  	if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
			 			   	
			   $query="update epi.brucel_can set 
						n_prop='$n_prop',
						a_prop='$a_prop',
						dom_prop='$dom_prop',
						telef='$telef',
						d_animal='$d_animal',
						d_epidemio='$d_epidemio',
						laboratorios=$laboratorios,
						f_carga=now(),
						usuario='$usuario'
					where id_bruc_can=$id_bruc_can";	
			
			   
			    sql($query, "Error actualizar registro") or fin_pagina();
			    $accion="Los datos se actualizaron";  
    $db->CompleteTrans();    
  
}

if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
	
		if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
	    	$n_prop=strtoupper($n_prop);     
		   	$a_prop=strtoupper($a_prop);
		   	$dom_prop=strtoupper($dom_prop);
		$query="insert into epi.brucel_can
			   	(id_bruc_can, id_denuncia, n_prop, a_prop, dom_prop, telef, d_animal, d_epidemio,laboratorios, f_carga, usuario)
			   	values
			    (nextval('epi.brucel_can_id_bruc_can_seq'), '$id_denuncia=$res_bruc->fields['ape_pac'];$n_prop', '$a_prop', '$dom_prop', '$telef', '$d_animal', '$d_epidemio', '$laboratorios', now(), '$usuario')";
				
			   sql($query, "Error al insertar t5") or fin_pagina();
			 	 
			   $accion="Los datos se han guardado correctamente"; 
   
   $db->CompleteTrans();   
         
}

if ($_POST['borrar']=='Borrar'){

	$query="delete from brucel_can 
			where id_bruc_can=$id_bruc_can";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}

if ($id_bruc_can){
			$query="SELECT * FROM epi.denuncia
					INNER JOIN epi.brucel_can ON epi.denuncia.id_denuncia = epi.brucel_can.id_denuncia";
			
			$res_q12 =sql($query, "Error consulta t5") or fin_pagina();
			if($res_q12->RecordCount()!=0){
				$id_bruc_can==$res_q12->fields['id_bruc_can']; 
				$n_prop=$res_q12->fields['n_prop'];
				$a_prop=$res_q12->fields['a_prop'];
				$dom_prop=$res_q12->fields['dom_prop'];
				$telef=$res_q12->fields['telef'];
				$d_animal=$res_q12->fields['d_animal'];
				$d_epidemio=$res_q12->fields['d_epidemio'];
				$laboratorios=$res_q12->fields['laboratorios'];
}
}
echo $html_header;
?>
<script>
//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevos(){
		 if(document.all.n_prop.value==""){
		  	alert('Debe ingresar el Nombre');
		  	document.all.n_prop.focus();
		  	return false;
		 } 
		 if(document.all.a_prop.value==""){
		  	alert('Debe ingresar Apellido');
		 	document.all.a_prop.focus();
			return false;
		 } 
		 if(document.all.dom_prop.value==""){
		  alert('Debe ingresar Matricula');
		  document.all.dom_prop.focus();
		  return false;
		 	} 
		 if(document.all.d_animal.value==""){
		  alert('Debe ingresar Numero de documento');
		  document.all.d_animal.focus();
		  return false; 
		 } 
		 if(document.all.d_epidemio.value==""){
		  alert('Debe ingresar Fecha');
		  document.all.d_epidemio.focus();
		  return false;
		 	} 
		 
		 if(document.all.laboratorios.value==-1 ){
			alert('Debe ingresar Veterinaria');
			document.all.laboratorios.focus();
			return false;
			}
	
 if (confirm('Confirma agregar datos de la denuncia?'))return true;
	 else return false;	
}//de function control_nuevos()

function editar_campos(){
	document.all.n_prop.disabled=false;
	document.all.a_prop.disabled=false;	
	document.all.dom_prop.disabled=false;
	document.all.telef.disabled=false;
	document.all.d_animal.disabled=false;
	document.all.d_epidemio.disabled=false;
	document.all.laboratorios.disabled=false;

	document.all.guardar_editar.disabled=false;
	document.all.cancelar_editar.disabled=false;
	document.all.borrar.disabled=false;
	return true;
}
//de function control_nuevos()


</script>

<form name='form1' action='brus_can.php' method='POST'>
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<input type="hidden" value="<?=$id_bruc_can?>" name="id_bruc_can">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_bruc_can) {
    	?>  
    	<font size=+1><b>Nuevo Dato</b></font>   
    	<? }
        else {
        ?>
        <font size=+1><b>Dato</b></font>   
        <? } ?>
       
    </td>
 </tr>
 
 <tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> BRUCELOSIS CANINA </b>
      </td>
     </tr>
     <tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número del Dato: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    </table></td></tr>	     
      <tr><td colspan=9><div ><table width=55% align="left" >
          <tr>         
	           <td align="right" colspan="2">
	            <b> DATOS DEL PROPIETARIO </b>
	           </td>
	         </tr>
    	</table></td></tr>	 
   <tr><td colspan=9><div ><table width=55% align="left" >
          <tr>
         	<td align="left">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$n_prop;?>" name="n_prop" <? if ($id_bruc_can) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$a_prop;?>" name="a_prop" <? if ($id_bruc_can) echo "disabled"?>>
            </td>
          </tr>  
	   </table></div></td></tr>
	  <tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="75" value="<?=$dom_prop;?>" name="dom_prop" <? if ($id_bruc_can) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Telefono:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$telef;?>" name="telef" <? if ($id_bruc_can) echo "disabled"?>>
            </td>
		 </tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         	<td align="left">
				<b>Datos del Animal:</b>
			</td>         	
			<td align='left'>
			      <textarea cols='100' rows='4' name='d_animal'  <? if($id_bruc_can) echo "disabled"?>><?=$d_animal;?></textarea>
			</td>
		</tr>
		</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=75% align="left" >   
		<tr>
            <td align="left">
         	  <b>Detalle Epidemiologico:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='d_epidemio'  <? if($id_bruc_can) echo "disabled"?>><?=$d_epidemio;?></textarea>
            </td>
		 </tr>
		 </table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=75% align="left" >   
		 <tr>
            <td align="left">
         	  <b>Examenes de laboratorio:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='laboratorios'  <? if($id_bruc_can) echo "disabled"?>><?=$laboratorios;?></textarea>
            </td>
		 </tr>
	</table></div></td></tr>	
	</table></td></tr>
         
<br>
<?if ($id_bruc_can){?>
<table class="bordes" align="center" width="100%">
		 <tr>
		    <td align="center">
		      <input type=button name="editar" value="Editar" onclick="editar_campos()" title="Edita Campos" style="width=130px"> &nbsp;&nbsp;
		      <input type="submit" name="guardar_editar" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		      <input type="button" name="cancelar_editar" value="Cancelar" title="Cancela Edicion" disabled style="width=130px" onclick="document.location.reload()">		      
		      <input type="submit" name="borrar" value="Borrar" style="width=130px" onclick="return confirm('Esta seguro que desea eliminar')" >
		    </td>
		 </tr> 
	 </table>	
	
	 <?}
	 else {?>
	 	<tr>
		    <td align="center">
		      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		    </td>
	 
	 <? } ?>
	   
 <tr><td><table width=100% align="center" class="bordes">
  <tr align="center">
   <td>
     <input type=button name="volver" value="Volver" onclick="document.location='den_ad.php'"title="Volver al Listado" style="width=150px">     
     </td>
  </tr>
 </table></td></tr>
 
 </table> 
 
 </table>
 </form>
 
 <?=fin_pagina();// aca termino ?>