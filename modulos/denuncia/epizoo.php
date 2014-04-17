<?
require_once ("../../config.php");
extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
	
		$query="insert into epi.rabia
				(id_rabia,id_denuncia,usuario,raza,sexo,color_m,edad,nombre,procedencia,prov_nac,callejero,int_casa,gallinero,
				m_perros,cant,problema,lab_fecha,sangre,suero,ganglio,piel,otro,parasitologico,paras_res,serologico,serol_res,molecular,mol_res,
				nom_prop,ape_prop,dni_prop,dom_prop,nro_prop,tel,loca_prop,dep_prop,prop_tenedor, t_prov, traslado,sig_cli,oligosint,polisint, d_aire)
				values
				(nextval('epi.rabia_id_rabia_seq'),'$id_denuncia','$usuario','$raza','$sexo','$color_m','$edad','$nombre','$procedencia','$prov_nac',
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
       <b> RABIA </b>
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
	            <b> DATOS DEL CASO</b>
	           </td>
	         </tr>
    </table></td></tr>  
   
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> Especie</b>
	           </td>
	         </tr>
		</table></td></tr>
		<tr>
            <td align="left">
         	  <b>Perro:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="raza" value="S" <?=($raza=='S')?'checked':'';?> >Si
							<input type="radio" name="raza" value="N" <?=($raza=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Gato:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="sexo" value="S" <?=($sexo=='S')?'checked':'';?> >Si
							<input type="radio" name="sexo" value="N" <?=($sexo=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Vaca:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="color_m" value="S" <?=($color_m=='S')?'checked':'';?> >Si
							<input type="radio" name="color_m" value="N" <?=($color_m=='N')?'checked':'';?> >No
	         </td>
		</tr>
		<tr>
			 <td align="left">
         	  <b>Caballo:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="edad" value="S" <?=($edad=='S')?'checked':'';?> >Si
							<input type="radio" name="edad" value="N" <?=($edad=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Murcielago:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="nombre" value="S" <?=($nombre=='S')?'checked':'';?> >Si
							<input type="radio" name="nombre" value="N" <?=($nombre=='N')?'checked':'';?> >No
	         </td>
			 
             <td align="left">
         	  <b>Otros:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$procedencia;?>" name="procedencia" >
			</td>            
		 </tr>
	</table></div></td></tr> 
	
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr>
            <td align="left">
         	  <b>Propietario:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="prov_nac" value="S" <?=($prov_nac=='S')?'checked':'';?> >Si
							<input type="radio" name="prov_nac" value="N" <?=($prov_nac=='N')?'checked':'';?> >No
	         </td>
			 
			<td align="left">
         	  <b>Domicilio:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$callejero;?>" name="callejero" >
			</td>  
			
			<td align="left">
         	  <b>Localidad:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$int_casa;?>" name="int_casa" >
			</td>  
			
			<td align="left">
         	  <b>Provincia:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$gallinero;?>" name="gallinero" >
			</td>  
			 
		</tr>
		<tr>
            <td align="left">
         	  <b>Establecimiento Ganadero:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="m_perros" value="S" <?=($m_perros=='S')?'checked':'';?> >Si
							<input type="radio" name="m_perros" value="N" <?=($m_perros=='N')?'checked':'';?> >No
	         </td>
			 
			<td align="left">
         	  <b>Total Animales:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$cant;?>" name="cant" >
			</td>  
			
			<td align="left">
         	  <b>Total Animales Enfermos:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$problema;?>" name="problema" >
			</td>  
			
			<td align="left">
         	  <b>Total Animales Muertos:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$lab_fecha;?>" name="lab_fecha" >
			</td> 			 
		</tr>		
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> DATOS EPIDEMIOLOGICOS</b>
	           </td>
	         </tr>
    </table></td></tr>
	  
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr>
            <td align="left">
         	  <b>Vacunación antirrábica previa:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="sangre" value="S" <?=($sangre=='S')?'checked':'';?> >Si
							<input type="radio" name="sangre" value="N" <?=($sangre=='N')?'checked':'';?> >No
	         </td>
			 
			<td align="left">
         	  <b>Vacuna Utilizada:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$suero;?>" name="suero" >
			</td>  
			
			<td align="left">
         	  <b>Fecha Ultima Vacunacion:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$ganglio;?>" name="ganglio" >
			</td>  			 
		</tr>
		<tr>
            <tr><td colspan=9><div ><table width="100%" align="left" >
			<tr id="ma">         
	           <td align="center" colspan="2">
	            <b> Exposición al animal 10 dlas antes de morir</b>
	           </td>
	         </tr>
			</table></td></tr>
			<td align="left">
         	  <b>Mordio:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="piel" value="S" <?=($piel=='S')?'checked':'';?> >Si
							<input type="radio" name="piel" value="N" <?=($piel=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>A Quien:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="otro" value="S" <?=($otro=='S')?'checked':'';?> >Humano
							<input type="radio" name="otro" value="N" <?=($otro=='N')?'checked':'';?> >Animal
	         </td>
			 
			<td align="left">
         	  <b>Fecha:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$parasitologico;?>" name="parasitologico" >
			</td>		 
		</tr>
		<tr>            
			<td align="left">
         	  <b>Otro Contacto:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="paras_res" value="S" <?=($paras_res=='S')?'checked':'';?> >Si
							<input type="radio" name="paras_res" value="N" <?=($paras_res=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>A Quien:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="serologico" value="S" <?=($serologico=='S')?'checked':'';?> >Humano
							<input type="radio" name="serologico" value="N" <?=($serologico=='N')?'checked':'';?> >Animal
	         </td>
			 
			<td align="left">
         	  <b>Fecha:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$serol_res;?>" name="serol_res" >
			</td>		 
		</tr>		
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> EXAMENES DE LABORATORIO</b>
	           </td>
	         </tr>
    </table></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr>
            <td align="left">
         	  <b>Fecha de Toma de Muestra:</b>
         	</td>         	
            <td align="left">
      		 <input type="text" size="30" value="<?=$molecular;?>" name="molecular" >
			</td> 
			
			<td align="left">
         	  <b>Tipo de Muestra:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="mol_res" value="S" <?=($mol_res=='S')?'checked':'';?> >Cerebro
							<input type="radio" name="mol_res" value="N" <?=($mol_res=='N')?'checked':'';?> >Cabeza
							<input type="radio" name="mol_res" value="X" <?=($mol_res=='X')?'checked':'';?> >Animal Entero
	        </td>			 
		</tr>
		<tr>
            			 
			<td align="left">
         	  <b>I.F.D:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$nom_prop;?>" name="nom_prop" >
			</td>
			<td align="left">
         	  <b>EB:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$ape_prop;?>" name="ape_prop" >
			</td>
			<td align="left">
         	  <b>PCR:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$dni_prop;?>" name="dni_prop" >
			</td>			
		</tr>		
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> ACCIONES DE CONTROL Y PREVENCION</b>
	           </td>
	         </tr>
    </table></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr>
            <tr><td colspan=9><div ><table width="100%" align="left" >
			<tr id="ma">         
	           <td align="center" colspan="2">
	            <b> Comunitaria</b>
	           </td>
	         </tr>
			</table></td></tr>
			<td align="left">
         	  <b>Búsqueda de personas expuestas al animal:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="dom_prop" value="S" <?=($dom_prop=='S')?'checked':'';?> >Si
							<input type="radio" name="dom_prop" value="N" <?=($dom_prop=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Numero de Personas:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$nro_prop;?>" name="nro_prop" >
			</td>		 
		</tr>
		<tr>            
			<td align="left">
         	  <b>Búsqueda y eliminación de animales no vacunados mordidos:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="tel" value="S" <?=($tel=='S')?'checked':'';?> >Si
							<input type="radio" name="tel" value="N" <?=($tel=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Numero de Animales:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$loca_prop;?>" name="loca_prop" >
			</td>		 
		</tr>	
		<tr>            
			<td align="left">
         	  <b>Vacunación antirrábica de bloqueo en caninos y felinos de esa localidad frente a un brote de rabia urbana:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="dep_prop" value="S" <?=($dep_prop=='S')?'checked':'';?> >Si
							<input type="radio" name="dep_prop" value="N" <?=($dep_prop=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Numero de Dosis Aplicada:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$prop_tenedor;?>" name="prop_tenedor" >
			</td>		 
		</tr>			
	</table></div></td></tr>
	
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