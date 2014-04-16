<?
require_once ("../../config.php");
extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
	
		$query="insert into epi.rabia
				(id_rabia,id_denuncia,usuario,fcarga,raza,sexo,color_m,edad,nombre,procedencia,prov_nac,callejero,int_casa,gallinero,
				m_perros,cant,problema,lab_fecha,sangre,suero,ganglio,piel,otro,parasitologico,paras_res,serologico,serol_res,molecular,mol_res,
				nom_prop,ape_prop,dni_prop,dom_prop,nro_prop,tel,loca_prop,dep_prop,prop_tenedor, t_prov, traslado,sig_cli,oligosint,polisint, d_aire)
				values
				(nextval('epi.rabia_id_rabia_seq'),'$id_denuncia','$usuario', now(),'$raza','$sexo','$color_m','$edad','$nombre','$procedencia','$prov_nac',
				'$callejero','$int_casa','$gallinero',
				'$m_perros','$cant','$problema','$lab_fecha','$sangre','$suero','$ganglio','$piel','$otro','$parasitologico','$paras_res','$serologico','$serol_res','$molecular','$mol_res',
				'$nom_prop','$ape_prop','$dni_prop','$dom_prop','$nro_prop','$tel','$loca_prop','$dep_prop','$prop_tenedor', '$t_prov','$traslado','$sig_cli','$oligosint','$polisint','$d_aire' )";
			sql($query, "Error al insertar t4") or fin_pagina();
		 	$accion="Los datos se han guardado correctamente"; 			   
   $db->CompleteTrans();           
}

if ($_POST['borrar']=='Borrar'){

	$query="delete from epi.rabia
			where id_rabia=$id_rabia";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}
$sql_den="select id_rabia from epi.rabia where id_denuncia=$id_denuncia";
$res_den =sql($sql_den, "Error consulta t5") or fin_pagina();
if ($res_den->recordcount()>0) $id_rabia=$res_den->fields['id_rabia'];

if ($id_rabia) {
			$q_lvc="select * from epi.rabia where id_denuncia=$id_denuncia";
			$res_lvc=sql($q_lvc, "Error consulta t2") or fin_pagina();
			if($res_lvc->RecordCount()!=0){
					$id_rabia=$res_lvc->fields['id_rabia'];
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
					$lab_fecha=$res_lvc->fields['lab_fecha'];
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
		 if(document.all.nom_prop.value==""){
		  	alert('Debe ingresar el Nombre');
		  	document.all.nom_prop.focus();
		  	return false;
		 } 
		 if(document.all.ape_prop.value==""){
		  	alert('Debe ingresar Apellido');
		 	document.all.ape_prop.focus();
			return false;
		 } 
		 
	
 if (confirm('Confirma agregar datos?'))return true;
	 else return false;	
}//de function control_nuevos()


</script>

<form name='form1' action='rabia.php' method='POST'>
<input type="hidden" value="<?=$id_rabia?>" name="id_rabia">
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="95%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_rabia) {
    	?>  
    	<font size=+1><b>Nuevo Dato</b></font>   
    	<? }
        else {
        ?>
        <font size=+1><b>Dato</b></font>   
        <? } ?>
       
    </td>
 </tr>
  <tr><td><table width=100% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> LEISHMANIASIS VIACERAL CANINA </b>
      </td>
     </tr>
     <tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número de Denuncia: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
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
				<b>Propietario (si/no):</b>
				<input type="text" size="4" value="<?=$prop_tenedor;?>" name="prop_tenedor" >
	        </td>
         	<td align="left">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$nom_prop;?>" name="nom_prop" >
            </td>
            <td align="left">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$ape_prop;?>" name="ape_prop" >
            </td>
            <td align="left">
         	  <b>D.N.I.:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="15" value="<?=$dni_prop;?>" name="dni_prop" >
            </td>
          </tr>  
	   </table></div></td></tr>
	  <tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         <td align="left">
         	  <b>Telefono:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$tel;?>" name="tel" >
            </td>
         	<td align="left">
         	  <b>Domicilio:</b> 
         	</td>         	
            <td align='left'>
              <input type="text" size="65" value="<?=$dom_prop;?>" name="dom_prop" >
            </td>
            <td align="left">
         	  <b>Nº:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$nro_prop;?>" name="nro_prop" >
            </td>
		 </tr>
		  </table></div></td></tr>
	  <tr><td colspan=9><div ><table width=75% align="left" >   
		  <tr>
         	<td align="left">
         	  <b>Localidad:</b> 
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$loca_prop;?>" name="loca_prop" >
            </td>
            <td align="left">
         	  <b>Departamento:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$dep_prop;?>" name="dep_prop" >
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
   
	<tr><td colspan=9><div ><table width="100%" align="left" >   
		<tr>
            <td align="left">
         	  <b>Raza:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="15" value="<?=$raza;?>" name="raza" >
            </td>
             <td align="left">
         	  <b>Sexo (M/F):</b>
      		 <input type="text" size="3" value="<?=$sexo;?>" name="sexo" >
			</td>
            <td align="left">
         	  <b>Color del manto:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$color_m;?>" name="color_m" >
            </td>
            <td align="left">
         	  <b>Edad:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="10" value="<?=$edad;?>" name="edad" >
            </td>
            <td align="left">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="30" value="<?=$nombre;?>" name="nombre" >
            </td>
		 </tr>
	</table></div></td></tr> 
	 <tr><td colspan=9><div ><table width=95% align="left" >     
        <tr>
               	<td align="right">	 
					<b>Procedencia (Criadero/Familia/Calle/Refugio/Importacion):</b>
				</td>  
				<td align="left">
					<input type="text" size="30" value="<?=$procedencia;?>" name="procedencia">
	            </td>
	         
	            <td align="left">
         	  		<b>Provincia de nacimiento:</b>
         		</td>         	
            	<td align='left'>
              		<input type="text" size="65" value="<?=$prov_nac;?>" name="prov_nac" >
            	</td>
	            </tr>
	 </table></div></td></tr> 
	 <tr><td colspan=9><div ><table width=95% align="left" >              
	            
	           <tr> 
            	<td align="right">
					<b>Traslados en los ultimos dos años (SI/NO):</b>
				</td>  
				<td align="left">
							<input type="text" size="4" value="<?=$traslado;?>" name="traslado">
				</td>
				 <td align="left">
         	  		<b>De ser SI, ¿a que provincia?:</b>
         		</td>         	
            	<td align='left'>
              		<input type="text" size="65" value="<?=$t_prov;?>" name="t_prov" >
            	</td>
				</tr>
		
	</table></div></td></tr>		  
   
	 <tr><td colspan=9><div ><table width=75% align="left" >              
	            
	           <tr> 
            	<td align="right">
					<b>Signos Clinicos (SI/NO):</b>
				</td>  
				<td align="left">
							<input type="text" size="4" value="<?=$sig_cli;?>" name="sig_cli">
				</td>
				 <td align="right">
         	  		<b>De ser SI (Ologisintomatico o Polisintomatico):</b>
         		</td>         	
            	<td align="left">					
					<input type="text" size="30" value="<?=$polisint;?>" name="polisint">
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
					<b>Queda suelto en la calle (SI/NO):</b>
				</td>  
				<td align="left">
							<input type="text" size="4" value="<?=$callejero;?>" name="callejero">
				</td>	
				<td align="right">
					<b>Duerme al aire libre (SI/NO):</b>
				</td>  
				<td align="left">
							<input type="text" size="4" value="<?=$d_aire;?>" name="d_aire">
				</td>
				
    	</tr>
    	<tr>
    			<td align="right">
					<b>Duerme en el interior de la casa (SI/NO):</b>
				</td>  
				<td align="left">
							<input type="text" size="4" value="<?=$int_casa;?>" name="int_casa">
				</td>	
				<td align="right">
					<b>En el terreno hay Gallinero (SI/NO):</b>
				</td>  
				<td align="left">
							<input type="text" size="4" value="<?=$gallinero;?>" name="gallinero">
				</td>
				
    	</tr>
    	
   	</table></td></tr>  
	<tr><td colspan=9><div ><table width="95%" align="left" > 	
     	<tr> 
            	<td align="right">
					<b>Posee otros perro? (SI/NO):</b>
				</td>  
				<td align="left">
							<input type="text" size="4" value="<?=$m_perros;?>" name="m_perros">
				</td>
				 <td align="right">
         	  		<b>De ser SI, cuantos?:</b>
         		</td> 
				<td align='left'>
              		<input type="text" size="10" value="<?=$cant;?>" name="cant" >
            	</td>				
    		</tr>		   	
   	</table></td></tr> 	
	
   	
   <tr><td colspan=9><div ><table width="100%" align="left" > 		
   			<tr> 
            	<td align="left">
					<b>Alguno tiene lesiones de piel, crecimiento exagerado de uñas, hinchazon abdominal o problemas oculares? (SI/NO):</b>
				</td>  
			
				<td align="left">
							<input type="text" size="4" value="<?=$problema;?>" name="problema">
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
   	
   	<tr><td colspan=9><div ><table width="90%" align="left" > 		
   			<tr> 
            	<td align="left">
					<b>Fecha:</b>
				</td>  
				<td align="left">
					<input type="text" size="10" value="<?=$lab_fecha;?>" name="lab_fecha">

				</td>
				<td align="left">
					<b>Tipo de muestra:</b>
				</td>
				<td align="left">
					<b>Sangre (S/N):</b>
				</td>
				<td>
					<input type="text" size="2" value="<?=$sangre;?>" name="sangre">
				</td>
				<td align="left">
					<b>Suero (S/N):</b>
				</td>
				<td>
					<input type="text" size="2" value="<?=$suero;?>" name="suero">
				</td>
				<td align="left">
					<b>Ganglio (S/N):</b>
				</td>
				<td>
					<input type="text" size="2" value="<?=$ganglio;?>" name="ganglio">
				</td>
				<td align="left">
					<b>Piel (S/N):</b>
				</td>
				<td>
					<input type="text" size="2" value="<?=$piel;?>" name="piel">
				</td>
				<td align="left">
					<b>otro (describir):</b>
				</td>
				<td>
					<input type="text" size="10" value="<?=$otro;?>" name="otro">
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
   			<td><input type="text" size="50" value="<?=$parasitologico;?>" name="parasitologico" ></td>
   			<td><input type="text" size="100" value="<?=$paras_res;?>" name="paras_res" ></td>
   		</tr>
   		<tr>
   			<td id=me align="center" width="20%"><b>Serologia</b></td>
   			<td><input type="text" size="50" value="<?=$serologico;?>" name="serologico" ></td>
   			<td><input type="text" size="100" value="<?=$serol_res;?>" name="serol_res" ></td>
   		</tr>
   		<tr>
   			<td id=me align="center" width="20%"><b>Molecular/PCR</b></td>
   			<td><input type="text" size="50" value="<?=$molecular;?>" name="molecular" ></td>
   			<td><input type="text" size="100" value="<?=$mol_res;?>" name="mol_res" ></td>
   		</tr>
   	
	 
	 </table></td></tr> 		
 </table>           
<br>
<?if ($id_rabia){?>
<table class="bordes" align="center" width="100%">
		 <tr>
		    <td align="center">
		      <input type="submit" name="borrar" value="Borrar" style="width=130px" onclick="return confirm('Esta seguro que desea eliminar')" >
		    </td>
		 </tr> 
	 </table>	
	
	 <?}
	 else {?>
	 <table class="bordes" align="center" width="100%">
	 	<tr>
		    <td align="center">
		      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		    </td>
		</tr> 
	 </table>
	 
	 <? } ?>
	 
 <tr><td><table width=100% align="center" class="bordes">
  <tr align="center">
   <td>
     <input type=button name="volver" value="Volver" onclick="document.location='den_lis.php'"title="Volver al Listado" style="width=150px">     
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