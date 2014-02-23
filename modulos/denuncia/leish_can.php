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
					procedencia='$procedencia',º
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
					prop_tenedor='$prop_tenedor,
					t_prov='$t_prov',
					traslado='$traslado',
					sig_cli='$sig_cli',
					oligosint='$oligosint',
					polisint='$polisint',
					d_aire='$d_aire'
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
				(id_lvc,id_denuncia,usuario,fcarga,raza,sexo,color_m,edad,nombre,procedencia,prov_nac,callejero,int_casa,gallinero,
				m_perros,cant,problema,lab_fecha,sangre,suero,ganglio,piel,otro,parasitologico,paras_res,serologico,serol_res,molecular,mol_res,
				nom_prop,ape_prop,dni_prop,dom_prop,nro_prop,tel,loca_prop,dep_prop,prop_tenedor, t_prov, traslado,sig_cli,oligosint,polisint, d_aire)
				values
				(nextval('epi.lvcan_id_lvc_seq'),'$id_denuncia','$usuario', now(),'$raza','$sexo','$color_m','$edad','$nombre','$procedencia','$prov_nac',
				'$callejero','$int_casa','$gallinero',
				'$m_perros','$cant','$problema','$lab_fecha','$sangre','$suero','$ganglio','$piel','$otro','$parasitologico','$paras_res','$serologico','$serol_res','$molecular','$mol_res',
				'$nom_prop','$ape_prop','$dni_prop','$dom_prop','$nro_prop','$tel','$loca_prop','$dep_prop','$prop_tenedor', '$t_prov','$traslado','$sig_cli','$oligosint','$polisint','$d_aire' )";
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
					$procedencia=$res_lvc->fields['procedencia'];
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
					$t_prov=$res_lvc->fields['t_prov'];
					$traslado=$res_lvc->fields['traslado'];
					$sig_cli=$res_lvc->fields['sig_cli'];
					$oligosint=$res_lvc->fields['oligosint'];
					$polisint=$res_lvc->fields['polisint'];
					$d_aire=$res_lvc->fields['d_aire'];
		
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


</script>

<form name='form1' action='leish_can.php' method='POST'>
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
  <tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> LEISHMANIASIS VIACERAL CANINA </b>
      </td>
     </tr>
     <tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número del Dato: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    </table></td></tr>	     
      <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> DATOS DEL PROPIETARIO Y/O TENEDOR RESPONSABLE </b>
	           </td>
	         </tr>
    	</table></td></tr> 
   <tr><td colspan=9><div ><table width=100% align="left" >
        <tr>
        	<td align='left'>
				<b>Propietario:</b>
				<input type="checkbox" name="prop_tenedor" value="S" >
	        </td>
         	<td align="left">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$nom_prop;?>" name="nom_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$ape_prop;?>" name="ape_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>D.N.I.:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="15" value="<?=$dni_prop;?>" name="dni_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
          </tr>  
	   </table></div></td></tr>
	  <tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         <td align="left">
         	  <b>Telefono:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$tel;?>" name="tel" <? if ($id_lvc) echo "disabled"?>>
            </td>
         	<td align="left">
         	  <b>Domicilio:</b> 
         	</td>         	
            <td align='left'>
              <input type="text" size="65" value="<?=$dom_prop;?>" name="dom_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Nº:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$nro_prop;?>" name="nro_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
		 </tr>
		  </table></div></td></tr>
	  <tr><td colspan=9><div ><table width=75% align="left" >   
		  <tr>
         	<td align="left">
         	  <b>Localidad:</b> 
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$loca_prop;?>" name="loca_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Departamento:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$dep_prop;?>" name="dep_prop" <? if ($id_lvc) echo "disabled"?>>
            </td>
		 </tr>
		 
	</table></div></td></tr>	    
   
	 <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> DATOS DEL CASO CANINO </b>
	           </td>
	         </tr>
    	</table></td></tr>  
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>Raza:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="15" value="<?=$raza;?>" name="raza" <? if ($id_lvc) echo "disabled"?>>
            </td>
             <td align="left">
         	  <b>Sexo:</b>
      					<input type="radio" name="sexo" value="F" checked>H
						<input type="radio" name="sexo" value="M">M
			</td>
            <td align="left">
         	  <b>Color del manto:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="15" value="<?=$color_m;?>" name="color_m" <? if ($id_lvc) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Edad:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="15" value="<?=$edad;?>" name="edad" <? if ($id_lvc) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="15" value="<?=$nombre;?>" name="nombre" <? if ($id_lvc) echo "disabled"?>>
            </td>
		 </tr>
	</table></div></td></tr> 
	 <tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
               	<td align="right">	 
					<b>Procedencia:</b>
				</td>  
				<td align="left">
							<input type="radio" name="procedencia" value="Criadero/flia">Criadero/flia.
							<input type="radio" name="procedencia" value="Calle">Calle
							<input type="radio" name="procedencia" value="Refugio">Refugio
							<input type="radio" name="procedencia" value="Importacion">Importacion
	            </td>
	         
	            <td align="left">
         	  		<b>Provincia de nacimiento:</b>
         		</td>         	
            	<td align='left'>
              		<input type="text" size="65" value="<?=$prov_nac;?>" name="prov_nac" <? if ($id_lvc) echo "disabled"?>>
            	</td>
	            </tr>
	 </table></div></td></tr> 
	 <tr><td colspan=9><div ><table width=95% align="left" >              
	            
	           <tr> 
            	<td align="right">
					<b>Traslados en los ultimos dos años:</b>
				</td>  
				<td align="left">
							<input type="radio" name="traslado" value="S" checked>Si
							<input type="radio" name="traslado" value="N">No
				</td>
				 <td align="left">
         	  		<b>De ser SI, ¿a que provincia?:</b>
         		</td>         	
            	<td align='left'>
              		<input type="text" size="65" value="<?=$t_prov;?>" name="t_prov" <? if ($id_lvc) echo "disabled"?>>
            	</td>
				</tr>
		
	</table></div></td></tr>		  
   
	 <tr><td colspan=9><div ><table width=75% align="left" >              
	            
	           <tr> 
            	<td align="right">
					<b>Signos Clinicos:</b>
				</td>  
				<td align="left">
							<input type="radio" name="sig_cli" value="S" checked>Si
							<input type="radio" name="sig_cli" value="N">No
				</td>
				 <td align="right">
         	  		<b>De ser SI:</b>
         		</td>         	
            	<td align="left">
					<b>Ologisintomatico:</b>
					<input type="checkbox" name="oligosint" value="S" >
					<b>Polisintomatico:</b>
					<input type="checkbox" name="polisint" value="S" >			
				</td>
				</tr>
		
	</table></div></td></tr>
 <tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> DATOS EPIDEMIOLOGICOS </b>
	           </td>
	         </tr>
    	</table></td></tr>  
	
   <tr><td colspan=9><div ><table width="95%" align="left" > 	
     <tr> 
            	<td align="right">
					<b>Queda suelto en la calle:</b>
				</td>  
				<td align="left">
							<input type="radio" name="callejero" value="S" checked>Si
							<input type="radio" name="callejero" value="N">No
				</td>	
				<td align="right">
					<b>Duerme al aire libre:</b>
				</td>  
				<td align="left">
							<input type="radio" name="d_aire" value="S" checked>Si
							<input type="radio" name="d_aire" value="N">No
				</td>
				
    	</tr>
    	<tr>
    			<td align="right">
					<b>Duerme en el interior de la casa:</b>
				</td>  
				<td align="left">
							<input type="radio" name="int_casa" value="S" checked>Si 
							<input type="radio" name="int_casa" value="N">No
				</td>	
				<td align="right">
					<b>En el terreno hay Gallinero:</b>
				</td>  
				<td align="left">
							<input type="radio" name="gallinero" value="S" checked>Si 
							<input type="radio" name="gallinero" value="N">No
				</td>
				
    	</tr>
    	
   	</table></td></tr>  
	<tr><td colspan=9><div ><table width="95%" align="left" > 	
     	<tr> 
            	<td align="right">
					<b>Posee otros perro?:</b>
				</td>  
				<td align="left">
							<input type="radio" name="m_perros" value="S" checked>Si
							<input type="radio" name="m_perros" value="N">No
				</td>
				 <td align="right">
         	  		<b>De ser SI, cuantos?:</b>
         		</td> 
				<td align='left'>
              		<input type="text" size="10" value="<?=$cant;?>" name="cant" <? if ($id_lvc) echo "disabled"?>>
            	</td>
				<td align="right">
					<b>Duerme al aire libre:</b>
				</td>  
				<td align="left">
							<input type="radio" name="d_aire" value="S" checked>Si
							<input type="radio" name="d_aire" value="N">No
				</td>
				
    		</tr>
    	<tr> 
            	<td align="right">
					<b>Posee otros perro?:</b>
				</td>  
				<td align="left">
							<input type="radio" name="m_perros" value="S" checked>Si
							<input type="radio" name="m_perros" value="N">No
				</td>
		</tr>
		
		   	
   	</table></td></tr> 	
	
   	
   <tr><td colspan=9><div ><table width="65%" align="left" > 		
   			<tr> 
            	<td align="left">
					<b>Alguno tiene lesiones de piel, crecimiento exagerado de uñas, hinchazon abdominal o problemas oculares?:</b>
				</td>  
			
				<td align="left">
							<input type="radio" name="problema" value="S" checked>Si
							<input type="radio" name="problema" value="N">No
				</td>
			</tr>	
   	</table></td></tr> 			
   	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> EXAMENES DE LABORATORIO </b>
	           </td>
	         </tr>
    	</table></td></tr>  
   	
   	<tr><td colspan=9><div ><table width="65%" align="left" > 		
   			<tr> 
            	<td align="left">
					<b>Fecha:</b>
				</td>  
				<td align="left">
					<input type=text id=lab_fecha name=lab_fecha  value='<?=$lab_fecha; ?>' size=10 >				    	 
					<?=link_calendario("lab_fecha");?>	
				</td>
				<td align="left">
					<b>Tipo de muestra:</b>
				</td>
				<td align="left">
					<b>Sangre:</b>
				</td>
				<td>
					<input type="checkbox" name="sangre" value="S" >
				</td>
				<td align="left">
					<b>Suero:</b>
				</td>
				<td>
					<input type="checkbox" name="suero" value="S" >			
				</td>
				<td align="left">
					<b>Ganglio:</b>
				</td>
				<td>
					<input type="checkbox" name="ganglio" value="S" >			
				</td>
				<td align="left">
					<b>Piel:</b>
				</td>
				<td>
					<input type="checkbox" name="piel" value="S" >			
				</td>
				<td align="left">
					<b>otro:</b>
				</td>
				<td>
					<input type="checkbox" name="otro" value="S" >			
				</td>
			</tr>	
   	</table></td></tr> 		
   	
   <tr><td colspan=7><div ><table width="65%" align="center" border="1" > 		
   		<tr id=mo> 
		    <td align=right id=mo width="20%" >Tipo</a></td>   
		    <td align=right id=mo><a id=mo >Estudio Realizado</a></td>      	
		    <td align=right id=mo><a id=mo >Resultado</a></td>      	
	 	</tr>
   	
   		<tr>
   			<td id=me align="center" width="20%"><b>Parasitologico</b></td>
   			<td><input type="text" size="50" value="<?=$parasitologico;?>" name="parasitologico" <? if ($id_lvc) echo "disabled"?>></td>
   			<td><input type="text" size="100" value="<?=$paras_res;?>" name="paras_res" <? if ($id_lvc) echo "disabled"?>></td>
   		</tr>
   		<tr>
   			<td id=me align="center" width="20%"><b>Serologia</b></td>
   			<td><input type="text" size="50" value="<?=$parasitologico;?>" name="serologico" <? if ($id_lvc) echo "disabled"?>></td>
   			<td><input type="text" size="100" value="<?=$serol_res;?>" name="serol_res" <? if ($id_lvc) echo "disabled"?>></td>
   		</tr>
   		<tr>
   			<td id=me align="center" width="20%"><b>Molecular/PCR</b></td>
   			<td><input type="text" size="50" value="<?=$molecular;?>" name="molecular" <? if ($id_lvc) echo "disabled"?>></td>
   			<td><input type="text" size="100" value="<?=$mol_res;?>" name="mol_res" <? if ($id_lvc) echo "disabled"?>></td>
   		</tr>
   	
	 
	 </table></td></tr> 		
 </table>           
<br>
<?if ($id_lvc){?>
<table class="bordes" align="center" width="100%">
		 <tr>
		    <td align="center">
		      <input type="submit" name="guardar_editar" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
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