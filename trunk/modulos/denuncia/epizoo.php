<?
require_once ("../../config.php");
extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar']=='Guardar'){
	$db->StartTrans();
	$usuario=$_ses_user['name'];
	
		$query="insert into epi.epizoo
				(id_epizoo,id_denuncia,usuario,raza,sexo,color_m,edad,nombre,procedencia,prov_nac,callejero,int_casa,gallinero,
				m_perros,cant,problema,lab_fecha,sangre,suero,ganglio,piel,otro,parasitologico,paras_res,serologico,serol_res,molecular,mol_res,
				nom_prop,ape_prop,dni_prop,dom_prop,nro_prop,tel,loca_prop,dep_prop,prop_tenedor, t_prov, traslado,sig_cli,oligosint,polisint, d_aire)
				values
				(nextval('epi.epizoo_id_epizoo_seq'),'$id_denuncia','$usuario','$raza','$sexo','$color_m','$edad','$nombre','$procedencia','$prov_nac',
				'$callejero','$int_casa','$gallinero',
				'$m_perros','$cant','$problema','$lab_fecha','$sangre','$suero','$ganglio','$piel','$otro','$parasitologico','$paras_res','$serologico','$serol_res','$molecular','$mol_res',
				'$nom_prop','$ape_prop','$dni_prop','$dom_prop','$nro_prop','$tel','$loca_prop','$dep_prop','$prop_tenedor', '$t_prov','$traslado','$sig_cli','$oligosint','$polisint','$d_aire' )";
			sql($query, "Error al insertar t4") or fin_pagina();
		 	$accion="Los datos se han guardado correctamente"; 			   
   $db->CompleteTrans();           
}

if ($_POST['borrar']=='Borrar'){

	$query="delete from epi.epizoo
			where id_epizoo=$id_epizoo";
	
	sql($query, "Error al eliminar el registro") or fin_pagina(); 
	
	$accion="Los datos se han borrado";
}
$sql_den="select id_epizoo from epi.epizoo where id_denuncia=$id_denuncia";
$res_den =sql($sql_den, "Error consulta t5") or fin_pagina();
if ($res_den->recordcount()>0) $id_epizoo=$res_den->fields['id_epizoo'];

if ($id_epizoo) {
			$q_lvc="select * from epi.epizoo where id_denuncia=$id_denuncia";
			$res_lvc=sql($q_lvc, "Error consulta t2") or fin_pagina();
			if($res_lvc->RecordCount()!=0){
					$id_epizoo=$res_lvc->fields['id_epizoo'];
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
	if (confirm('Confirma agregar datos?'))return true;
	 else return false;	
}//de function control_nuevos()


</script>

<form name='form1' action='epizoo.php' method='POST'>
<input type="hidden" value="<?=$id_epizoo?>" name="id_epizoo">
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="95%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_epizoo) {
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
       <b> EPIZOOTIAS </b>
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
	            <b> TIPO DE NOTIFICACIÓN</b>
	           </td>
	         </tr>
    </table></td></tr>  
   
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >		
		<tr >
            <td align="left">
         	  <b>Cambio de comportamiento animal:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="raza" value="S" <?=($raza=='S')?'checked':'';?> >Si
							<input type="radio" name="raza" value="N" <?=($raza=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Cambio de comportamiento poblacional:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="sexo" value="S" <?=($sexo=='S')?'checked':'';?> >Si
							<input type="radio" name="sexo" value="N" <?=($sexo=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Cambio en la ecologia de la especie:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="color_m" value="S" <?=($color_m=='S')?'checked':'';?> >Si
							<input type="radio" name="color_m" value="N" <?=($color_m=='N')?'checked':'';?> >No
	         </td>		
			 <td align="left">
         	  <b>Sospecha de enfermedad zoonótica:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="edad" value="S" <?=($edad=='S')?'checked':'';?> >Si
							<input type="radio" name="edad" value="N" <?=($edad=='N')?'checked':'';?> >No
	         </td>
		</tr>
		<tr>
			 <td align="left">
         	  <b>Animales enfermos:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="nombre" value="S" <?=($nombre=='S')?'checked':'';?> >Si
							<input type="radio" name="nombre" value="N" <?=($nombre=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Rumor de mortandad:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="procedencia" value="S" <?=($procedencia=='S')?'checked':'';?> >Si
							<input type="radio" name="procedencia" value="N" <?=($procedencia=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Rumor de mortandad:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="prov_nac" value="S" <?=($prov_nac=='S')?'checked':'';?> >Si
							<input type="radio" name="prov_nac" value="N" <?=($prov_nac=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Observación de osamentas:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="callejero" value="S" <?=($callejero=='S')?'checked':'';?> >Si
							<input type="radio" name="callejero" value="N" <?=($callejero=='N')?'checked':'';?> >No
	         </td>
		</tr>
		<tr>
			 <td align="left">
         	  <b>Hallazgo de patógenos con potencial zoonótico en muestrasanimales:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="int_casa" value="S" <?=($int_casa=='S')?'checked':'';?> >Si
							<input type="radio" name="int_casa" value="N" <?=($int_casa=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Hallazgo de patógenos con potencial zoonótico en muestrasambientales:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="gallinero" value="S" <?=($gallinero=='S')?'checked':'';?> >Si
							<input type="radio" name="gallinero" value="N" <?=($gallinero=='N')?'checked':'';?> >No
	         </td>
			 
             <td align="left">
         	  <b>Descripcion del Evento:</b>
			 </td> 
			 <td align="left" colspan='4'>
				<textarea cols='50' rows='3' name='m_perros'><?=$m_perros;?></textarea>
			</td>            
		 </tr>
	</table></div></td></tr> 
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> LUGAR DE OCURRENCIA</b>
	           </td>
	         </tr>
    </table></td></tr>
	  
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr>
            <td align="left">
         	  <b>Provincia:</b>
         	</td>         	
           <td align="left">
      		 <input type="text" size="30" value="<?=$cant;?>" name="cant" >
			</td>  
			 
			<td align="left">
         	  <b>Departamento:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$problema;?>" name="problema" >
			</td>  
			
			<td align="left">
         	  <b>Localidad:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$lab_fecha;?>" name="lab_fecha" >
			</td>  			 
		</tr>
		<tr>
			<td align="left">
         	  <b>Hábitat:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="sangre" value="u" <?=($sangre=='u')?'checked':'';?> >Urbano
							<input type="radio" name="sangre" value="r" <?=($sangre=='r')?'checked':'';?> >Rural
							<input type="radio" name="sangre" value="p" <?=($sangre=='p')?'checked':'';?> >Parque/Reserva
							<input type="radio" name="sangre" value="o" <?=($sangre=='o')?'checked':'';?> >Otros
	         </td>
			 <td align="left">
         	  <b>Detalle de ubicación (dirección. kilometraje o nombre de la reserva)::</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$suero;?>" name="suero" >
			</td>
			<td align="left">
         	  <b>GPS:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$ganglio;?>" name="ganglio" >
			</td>			
		</tr>
		
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> MUESTRAS OBTENIDAS</b>
	           </td>
	         </tr>
    </table></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr>
			<td align="left">
         	  <b>Muestra:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="piel" value="S" <?=($piel=='S')?'checked':'';?> >Si
							<input type="radio" name="piel" value="N" <?=($piel=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Tipo:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="otro" value="s" <?=($otro=='s')?'checked':'';?> >Sangre intestinal/Parasito
							<input type="radio" name="otro" value="o" <?=($otro=='o')?'checked':'';?> >Orina
							<input type="radio" name="otro" value="m" <?=($otro=='m')?'checked':'';?> >Materia Fecal
							<input type="radio" name="otro" value="c" <?=($otro=='c')?'checked':'';?> >Contenido
	         </td>             
		</tr>
		<tr>
			<td align="left">
         	  <b>Muestra:</b>
         	</td> 
			<td align="left">
							<input type="radio" name="parasitologico" value="s" <?=($parasitologico=='s')?'checked':'';?> >Biopsia
							<input type="radio" name="parasitologico" value="o" <?=($parasitologico=='o')?'checked':'';?> >Necropsia
							<input type="radio" name="parasitologico" value="m" <?=($parasitologico=='m')?'checked':'';?> >Tejidos:
							<input type="radio" name="parasitologico" value="c" <?=($parasitologico=='c')?'checked':'';?> >Contenido
	         </td>
			<td align="left">
         	  <b>Tejidos:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$paras_res;?>" name="paras_res" >		
		</tr>
		<tr>
			<td align="left">
         	  <b>Preservación:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$serologico;?>" name="serologico" >	
			<td align="left">
         	  <b>Descripcion Otros:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$serol_res;?>" name="serol_res" >	
		</tr>		
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> EXÁMENES DE LABORATORIO</b>
	           </td>
	         </tr>
    </table></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr>            
			<td align="left">
         	  <b>Examen:</b>
         	</td>         	
            <td align="left">
							<input type="radio" name="molecular" value="S" <?=($molecular=='S')?'checked':'';?> >Si
							<input type="radio" name="molecular" value="N" <?=($molecular=='N')?'checked':'';?> >No
	         </td>
			 <td align="left">
         	  <b>Fecha toma de muestra:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$mol_res;?>" name="mol_res" >
			</td>		 
		</tr>
		<tr>            
			 <td align="left">
         	  <b>Prueba realizada:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$nom_prop;?>" name="nom_prop" >
			</td>	
			<td align="left">
         	  <b>Resultado:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$ape_prop;?>" name="ape_prop" >
			</td>				
		</tr>	
		<tr>
			 <td align="left">
         	  <b>Responsable:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$dni_prop;?>" name="dni_prop" >
			</td>
			<td align="left">
         	  <b>Institución:</b>
			 </td> 
			 <td align="left">
      		 <input type="text" size="30" value="<?=$dom_prop;?>" name="dom_prop" >
			</td>			
		</tr>			
	</table></div></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" >
          <tr id="ma">         
	           <td align="center" colspan="2">
	            <b> OBSERVACIONES O COMENTARIO</b>
	           </td>
	         </tr>
    </table></td></tr>
	
	<tr><td colspan=9><div ><table width="100%" align="left" class=bordes >   
		<tr>            
			<td align="left">
         	  <b>OBSERVACIONES:</b>
			 </td> 
			 <td align="left">
				<textarea cols='50' rows='3' name='nro_prop'><?=$nro_prop;?></textarea>
			</td>
			<td align="left">
         	  <b>Acciones en Terreno:</b>
			 </td> 
			 <td align="left">
				<textarea cols='50' rows='3' name='tel'><?=$tel;?></textarea>
			</td>						
		</tr>				
	</table></div></td></tr>
	
 </table>           
<br>
<?if ($id_epizoo){?>
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