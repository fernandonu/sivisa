<?
require_once ("../../config.php");
extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar_editar']=='Guardar'){
	$db->StartTrans();
  	$f_nacimiento=Fecha_db($f_nacimiento);
				if ($lab_fecha!='')$lab_fecha=Fecha_db($lab_fecha);else $lab_fecha='1000-01-01';	
	
			   $query="update epi.lvcan set
					raza='$raza',
					sexo='$sexo',
					color_m='$color_m',
					edad='$edad',
					nombre='$nombre',
					cri_flia='$cri_flia',
					calle='$calle',
					refugio='$refugio',
					importacion='$importacion',
					prov_nac='$prov_nac',
					callejero='$callejero',
					int_casa='$int_casa',
					gallinero='$gallinero',
					m_perros='$m_perros',
					cant='$cant',
					problema='$problema',
					lab_fecha='$lab_fecha',
					sangre='$sangre',
					suero='$suero',
					ganglio='$ganglio',
					piel='$piel',
					otro='$otro',
					parasitologico='$parasitologico',
					paras_res='$paras_res',
					serologico='$serologico',
					serol_res='$serol_res',
					molecular='$molecular',
					mol_res='$mol_res',
					nom_prop='$nom_prop',
					ape_prop='$ape_prop',
					dni_prop='$dni_prop',
					dom_prop='$dom_prop',
					nro_prop='$nro_prop',
					tel='$tel',
					loca_prop='$loca_prop',
					dep_prop='$dep_prop',
					prop_tenedor='$prop_tenedor
				where id_lvc=$id_lvc";
			   
			    sql($query, "Error actualizar registro") or fin_pagina();
			    $accion="Los datos se actualizaron";  
    $db->CompleteTrans();    
  
}

if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
	
		$f_nacimiento=Fecha_db($f_nacimiento);
				if ($lab_fecha!='')$lab_fecha=Fecha_db($lab_fecha);else $lab_fecha='1000-01-01';	
		
		$query="insert into epi.lvcan
				(id_lvc,id_denuncia,usuario,fcarga,raza,sexo,color_m,edad,nombre,cri_flia,calle,refugio,importacion,prov_nac,callejero,int_casa,gallinero,
				m_perros,cant,problema,lab_fecha,sangre,suero,ganglio,piel,otro,parasitologico,paras_res,serologico,serol_res,molecular,mol_res,
				nom_prop,ape_prop,dni_prop,dom_prop,nro_prop,tel,loca_prop,dep_prop,prop_tenedor)
				values
				(nextval('epi.lvcan_id_lvc_seq'),'$id_denuncia','$usuario', now(),'$raza','$sexo','$color_m','$edad','$nombre','$cri_flia','$calle','$refugio','$importacion','$prov_nac',
				'$callejero','$int_casa','$gallinero',
				'$m_perros','$cant','$problema','$lab_fecha','$sangre','$suero','$ganglio','$piel','$otro','$parasitologico','$paras_res','$serologico','$serol_res','$molecular','$mol_res',
				'$nom_prop','$ape_prop','$dni_prop','$dom_prop','$nro_prop','$tel','$loca_prop','$dep_prop','$prop_tenedor')";
			sql($query, "Error al insertar t4") or fin_pagina();
		 	$accion="Los datos se han guardado correctamente"; 
			   sql($query, "Error al insertar t5") or fin_pagina();
			 	 
			   $accion="Los datos se han guardado correctamente"; 
   
   $db->CompleteTrans();   
         
}

if ($_POST['borrar']=='Borrar'){

	$query="delete from brucel_can 
			where id_lvc=$id_lvc";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}

if ($id_lvc) {
					$q_lvc="SELECT DISTINCT *
					epi.brucellosis 
					where epi.brucellosis.id_denuncia = $id_denuncia
					ORDER BY
					epi.brucellosis.id_lvc DESC";
			$res_lvc=sql($q_lvc, "Error consulta t2") or fin_pagina();
			if($res_lvc->RecordCount()!=0){
					$id_lvc=$res_lvc->fields['id_lvc'];
					$raza=$res_lvc->fields['raza'];
					$sexo=$res_lvc->fields['sexo'];
					$color_m=$res_lvc->fields['color_m'];
					$edad=$res_lvc->fields['edad'];
					$nombre=$res_lvc->fields['nombre'];
					$cri_flia=$res_lvc->fields['cri_flia'];
					$calle=$res_lvc->fields['calle'];
					$refugio=$res_lvc->fields['refugio'];
					$importacion=$res_lvc->fields['importacion'];
					$prov_nac=$res_lvc->fields['prov_nac'];
					$callejero=$res_lvc->fields['callejero'];
					$int_casa=$res_lvc->fields['int_casa'];
					$gallinero=$res_lvc->fields['gallinero'];
					$m_perros=$res_lvc->fields['m_perros'];
					$cant=$res_lvc->fields['cant'];
					$problema=$res_lvc->fields['problema'];
					$lab_fecha=fecha($res_lvc->fields['lab_fecha']);
					$sangre=$res_lvc->fields['sangre'];
					$suero=$res_lvc->fields['suero'];
					$ganglio=$res_lvc->fields['ganglio'];
					$piel=$res_lvc->fields['piel'];
					$otro=$res_lvc->fields['otro'];
					$parasitologico=$res_lvc->fields['parasitologico'];
					$paras_res=$res_lvc->fields['paras_res'];
					$serologico=$res_lvc->fields['serologico'];
					$serol_res=$res_lvc->fields['serol_res'];
					$molecular=$res_lvc->fields['molecular'];
					$mol_res=$res_lvc->fields['mol_res'];
					$nom_prop=$res_lvc->fields['nom_prop'];
					$ape_prop=$res_lvc->fields['ape_prop'];
					$dni_prop=$res_lvc->fields['dni_prop'];
					$dom_prop=$res_lvc->fields['dom_prop'];
					$nro_prop=$res_lvc->fields['nro_prop'];
					$tel=$res_lvc->fields['tel'];
					$loca_prop=$res_lvc->fields['loca_prop'];
					$dep_prop=$res_lvc->fields['dep_prop'];
					$prop_tenedor=$res_lvc->fields['prop_tenedor'];
		
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
<input type="hidden" value="<?=$id_lvc?>" name="id_lvc">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_lvc) {
    	?>  
    	<font size=+1><b>Nuevo Dato</b></font>   
    	<? }
        else {
        ?>
        <font size=+1><b>Dato</b></font>   
        <? } ?>
       
    </td>
 </tr>
 <tr><td>
  <table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> Brucelosis Canina</b>
      </td>
     </tr>
     <tr>
       <td>
        <table>
         <tr>	           
           <td align="center" colspan="2">
            <b> Número del Dato: <font size="+1" color="Red"><?=($id_lvc)? $id_lvc : "Nuevo Dato"?></font> </b>
           </td>
         </tr>
         </tr>
       <tr><td><table>
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
              <input type="text" size="50" value="<?=$n_prop;?>" name="n_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$a_prop;?>" name="a_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
          </tr>  
	   </table></div></td></tr>
	  <tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="75" value="<?=$dom_prop;?>" name="dom_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Telefono:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$telef;?>" name="telef" <? if ($id_lvc) echo "disabled"?>>
            </td>
		 </tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >     
        <tr>
         	<td align="left">
				<b>Datos del Animal:</b>
			</td>         	
			<td align='left'>
			      <textarea cols='100' rows='4' name='d_animal'  <? if($id_lvc) echo "disabled"?>><?=$d_animal;?></textarea>
			</td>
		</tr>
		</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>Detalle Epidemiologico:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='d_epidemio'  <? if($id_lvc) echo "disabled"?>><?=$d_epidemio;?></textarea>
            </td>
		 </tr>
		 </table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		 <tr>
            <td align="left">
         	  <b>Examenes de laboratorio:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='laboratorios'  <? if($id_lvc) echo "disabled"?>><?=$laboratorios;?></textarea>
            </td>
		 </tr>
	</table></div></td></tr>	
 </table>           
<br>
<?if ($id_lvc){?>
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
 
 <tr><td><table width=100% align="center" class="bordes">
  <tr align="center">
   
  </tr>  
 </table></td></tr>
 
 </table>
 </form>
 
 <?=fin_pagina();// aca termino ?>