<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar_editar']=='Guardar'){
 $db->StartTrans();
 	$usuario=$_ses_user['name'];
		
				$f_nacimiento=Fecha_db($f_nacimiento);
				if ($primera_dosis!='')$primera_dosis=Fecha_db($primera_dosis);else $primera_dosis='1000-01-01';	
				if ($ultima_dosis!='')$ultima_dosis=Fecha_db($ultima_dosis);else $ultima_dosis='1000-01-01';	
				if ($primer_diag!='')$primer_diag=Fecha_db($primer_diag);else $primer_diag='1000-01-01';	
				if ($direc_fdiag!='')$direc_fdiag=Fecha_db($direc_fdiag);else $direc_fdiag='1000-01-01';	
				if ($f_huddlesson!='')$f_huddlesson=Fecha_db($f_huddlesson);else $f_huddlesson='1000-01-01';	
				if ($f_tsinme!='')$f_tsinme=Fecha_db($f_tsinme);else $f_tsinme='1000-01-01';	
				if ($f_tconme!='')$f_tconme=Fecha_db($f_tconme);else $f_tconme='1000-01-01';	
				if ($f_rbengala!='')$f_rbengala=Fecha_db($f_rbengala);else $f_rbengala='1000-01-01';	
				if ($f_fcomplem!='')$f_fcomplem=Fecha_db($f_fcomplem);else $f_fcomplem='1000-01-01';	
				if ($f_pcombs!='')$f_pcombs=Fecha_db($f_pcombs);else $f_pcombs='1000-01-01';	
				
			   $query="update epi.brucellosis set
							ape_pac='$ape_pac',
							nom_pac='$nom_pac',
							f_nacimiento='$f_nacimiento',
							sexo='$sexo',
							domicilio='$domicilio',
							localidad='$localidad',
							departamento='$departamento',
							dias_com='$dias_com',
							subito='$subito',
							insidioso='$insidioso',
							desc_clinica='$desc_clinica',
							terap_esp='$terap_esp',
							primera_dosis='$primera_dosis',
							ultima_dosis='$ultima_dosis',
							prev_diag='$prev_diag',
							primer_diag='$primer_diag', 
							direc_fdiag='$direc_fdiag',
						   	f_huddlesson='$f_huddlesson',
						   	res_huddlesson='$res_huddlesson', 
						   	lab_huddlesson='$lab_huddlesson', 
						   	f_tsinme='$f_tsinme',
						   	res_tsinme='$res_tsinme', 
						   	lab_tsinme='$lab_tsinme', 
						   	f_tconme='$f_tconme',
						   	res_tconme='$res_tconme',
						   	lab_tconme='$lab_tconme',
						   	f_rbengala='$f_rbengala',
						   	res_rbengala='$res_rbengala',
						   	lab_rbengala='$lab_rbengala',
						   	f_fcomplem='$f_fcomplem', 
						   	res_fcomplem='$res_fcomplem',
						   	lab_fcomplem='$lab_fcomplem',
						   	f_pcombs='$f_pcombs',
						   	res_pcombs='$res_pcombs',
						   	lab_pcombs='$lab_pcombs',
						   	dom_t='$dom_t', 
						   	oc_previa='$oc_previa',
						   	contacto_animal='$contacto_animal',
						   	esp_bovino='$esp_bovino',
						   	esp_cerdo='$esp_cerdo',
						   	esp_cabras='$esp_cabras',
						   	esp_otros='$esp_otros',
						   	vac_antibrucelosa='$vac_antibrucelosa',
						   	leche='$leche',
						   	leche_cruda='$leche_cruda',
							obs='$obs'
					where id_bucelosis=$id_bucelosis";	
			
			   
			    sql($query, "Error actualizar registro") or fin_pagina();
			    $accion="Los datos se actualizaron";  
		
  $db->CompleteTrans();    
}

if ($_POST['guardar']=='Guardar'){
	
				$f_nacimiento=Fecha_db($f_nacimiento);
	   			if ($primera_dosis!='')$primera_dosis=Fecha_db($primera_dosis);else $primera_dosis='1000-01-01';	
				if ($ultima_dosis!='')$ultima_dosis=Fecha_db($ultima_dosis);else $ultima_dosis='1000-01-01';	
				if ($primer_diag!='')$primer_diag=Fecha_db($primer_diag);else $primer_diag='1000-01-01';	
				if ($direc_fdiag!='')$direc_fdiag=Fecha_db($direc_fdiag);else $direc_fdiag='1000-01-01';	
				if ($f_huddlesson!='')$f_huddlesson=Fecha_db($f_huddlesson);else $f_huddlesson='1000-01-01';	
				if ($f_tsinme!='')$f_tsinme=Fecha_db($f_tsinme);else $f_tsinme='1000-01-01';	
				if ($f_tconme!='')$f_tconme=Fecha_db($f_tconme);else $f_tconme='1000-01-01';	
				if ($f_rbengala!='')$f_rbengala=Fecha_db($f_rbengala);else $f_rbengala='1000-01-01';	
				if ($f_fcomplem!='')$f_fcomplem=Fecha_db($f_fcomplem);else $f_fcomplem='1000-01-01';	
				if ($f_pcombs!='')$f_pcombs=Fecha_db($f_pcombs);else $f_pcombs='1000-01-01';	
				
		$query="insert into epi.brucellosis
			   	(id_bucelosis, id_denuncia, ape_pac, nom_pac, f_nacimiento,sexo,domicilio,localidad,departamento,dias_com,subito,insidioso,desc_clinica,terap_esp,primera_dosis,ultima_dosis,prev_diag, primer_diag, direc_fdiag,
			   	f_huddlesson,res_huddlesson, lab_huddlesson, f_tsinme,res_tsinme, lab_tsinme, f_tconme,res_tconme,lab_tconme,f_rbengala,res_rbengala,lab_rbengala,f_fcomplem, res_fcomplem,lab_fcomplem,f_pcombs,res_pcombs,lab_pcombs,
			   	dom_t, oc_previa,contacto_animal,esp_bovino,esp_cerdo,esp_cabras,esp_otros,vac_antibrucelosa,leche,leche_cruda,obs)
			   	values
			    (nextval('epi.brucellosis_id_bucelosis_seq'), '$id_denuncia','$ape_pac', '$a_prop', '$f_nacimiento', '$sexo', '$domicilio', '$localidad', '$departamento', '$dias_com','$subito',
			    '$insidioso','$desc_clinica','$terap_esp','$primera_dosis','$ultima_dosis','$prev_diag','$primer_diag','$direc_fdiag','$f_huddlesson','$res_huddlesson','$lab_huddlesson',
			    '$f_tsinme','$res_tsinme','$lab_tsinme',
			    '$f_tconme','$res_tconme','$lab_tconme','$f_rbengala','$res_rbengala','$lab_rbengala','$f_fcomplem','$res_fcomplem','$lab_fcomplem','$f_pcombs','$res_pcombs','$lab_pcombs','$dom_t',
			    '$oc_previa','$contacto_animal','$esp_bovino','$esp_cerdo','$esp_cabras','$esp_otros','$vac_antibrucelosa','$leche','$leche_cruda','$obs')";
				
			   sql($query, "Error al insertar t2") or fin_pagina();
			   $accion="Los datos se han guardado correctamente"; 
		
	if($$id_bucelosis){
			$q_bruc="SELECT DISTINCT *
					epi.brucellosis 
					where epi.brucellosis.id_denuncia = $id_denuncia
					ORDER BY
					epi.brucellosis.id_bucelosis DESC";
			$res_bruc=sql($q_bruc, "Error consulta t2") or fin_pagina();
			if($res_bruc->RecordCount()!=0){
				$id_bucelosis=$res_bruc->fields['id_bucelosis'];
					$ape_pac=$res_bruc->fields['ape_pac'];
					$nom_pac=$res_bruc->fields['nom_pac'];
					$f_nacimiento=fecha($res_bruc->fields['f_nacimiento']);
					$sexo=$res_bruc->fields['sexo'];
					$domicilio=$res_bruc->fields['domicilio'];
					$localidad=$res_bruc->fields['localidad'];
					$departamento=$res_bruc->fields['departamento'];
					$dias_com=$res_bruc->fields['dias_com'];
					$subito=$res_bruc->fields['subito'];
				    $insidioso=$res_bruc->fields['insidioso'];
				    $desc_clinica=$res_bruc->fields['desc_clinica'];
				    $terap_esp=$res_bruc->fields['terap_esp'];
				    $primera_dosis=fecha($res_bruc->fields['primera_dosis']);
				    $ultima_dosis=fecha($res_bruc->fields['ultima_dosis']);
				    $prev_diag=$res_bruc->fields['prev_diag'];
				    $primer_diag=fecha($res_bruc->fields['primer_diag']);
				    $direc_fdiag=fecha($res_bruc->fields['direc_fdiag']);
				    $f_huddlesson=fecha($res_bruc->fields['f_huddlesson']);
				    $res_huddlesson=$res_bruc->fields['res_huddlesson'];
				    $lab_huddlesson=$res_bruc->fields['lab_huddlesson'];
				    $f_tsinme=fecha($res_bruc->fields['f_tsinme']);
				    $res_tsinme=$res_bruc->fields['res_tsinme'];
				    $lab_tsinme=$res_bruc->fields['lab_tsinme'];
				    $f_tconme=fecha($res_bruc->fields['f_tconme']);
				    $res_tconme=$res_bruc->fields['res_tconme'];
				    $lab_tconme=$res_bruc->fields['lab_tconme'];
				    $f_rbengala=fecha($res_bruc->fields['f_rbengala']);
				    $res_rbengala=$res_bruc->fields['res_rbengala'];
				    $lab_rbengala=$res_bruc->fields['lab_rbengala'];
				    $f_fcomplem=fecha($res_bruc->fields['f_fcomplem']);
				    $res_fcomplem=$res_bruc->fields['res_fcomplem'];
				    $lab_fcomplem=$res_bruc->fields['lab_fcomplem'];
				    $f_pcombs=fecha($res_bruc->fields['f_pcombs']);
				    $res_pcombs=$res_bruc->fields['res_pcombs'];
				    $lab_pcombs=$res_bruc->fields['lab_pcombs'];
				    $dom_t=$res_bruc->fields['dom_t'];
				    $oc_previa=$res_bruc->fields['oc_previa'];
				    $contacto_animal=$res_bruc->fields['contacto_animal'];
				    $esp_bovino=$res_bruc->fields['esp_bovino'];
				    $esp_cerdo=$res_bruc->fields['esp_cerdo'];
				    $esp_cabras=$res_bruc->fields['esp_cabras'];
				    $esp_otros=$res_bruc->fields['esp_otros'];
				    $vac_antibrucelosa=$res_bruc->fields['vac_antibrucelosa'];
				    $leche=$res_bruc->fields['leche'];
				    $leche_cruda=$res_bruc->fields['leche_cruda'];	
					$obs=$res_bruc->fields['obs'];
			}	
}//fin $id_bucelosis

echo $html_header;
?>
<script>

//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevos(){ 
	 if(document.all.n_prof.value==""){
	  	alert('Debe ingresar el Nombre del Profesional');
	  	document.all.n_prof.focus();
	  	return false;
	 } 
	 if(document.all.a_prof.value==""){
	  	alert('Debe ingresar Apellido');
	 	document.all.a_prof.focus();
		return false;
	 } 
	 if(document.all.matricula.value==""){
	  alert('Debe ingresar Matricula');
	  document.all.matricula.focus();
	  return false;
	 	} 
	 if(document.all.dni_prof.value==""){
	  alert('Debe ingresar Numero de documento');
	  document.all.dni_prof.focus();
	  return false; 
	 } 
	 if(document.all.fecha_notif.value==""){
	  alert('Debe ingresar Fecha');
	  document.all.fecha_notif.focus();
	  return false;
	 	} 
	 
	 if(document.all.id_veterinaria.value==-1 ){
		alert('Debe ingresar Veterinaria');
		document.all.id_veterinaria.focus();
		return false;
		}
	if(document.all.id_tabla.value==-1 ){
		alert('Debe ingresar Tipo de Ficha');
		document.all.id_tabla.focus();
		return false;
		}
 if (confirm('Esta Seguro que Desea Agregar Registro?'))return true;
	 else return false;	
}//de function control_nuevos()


/**********************************************************/
//funciones para busqueda abreviada utilizando teclas en la lista que muestra los clientes.
var digitos=10; //cantidad de digitos buscados
var puntero=0;
var buffer=new Array(digitos); //declaración del array Buffer
var cadena="";

function buscar_combo(obj)
{
   var letra = String.fromCharCode(event.keyCode)
   if(puntero >= digitos)
   {
       cadena="";
       puntero=0;
   }   
   //sino busco la cadena tipeada dentro del combo...
   else
   {
       buffer[puntero]=letra;
       //guardo en la posicion puntero la letra tipeada
       cadena=cadena+buffer[puntero]; //armo una cadena con los datos que van ingresando al array
       puntero++;

       //barro todas las opciones que contiene el combo y las comparo la cadena...
       //en el indice cero la opcion no es valida
       for (var opcombo=1;opcombo < obj.length;opcombo++){
          if(obj[opcombo].text.substr(0,puntero).toLowerCase()==cadena.toLowerCase()){
          obj.selectedIndex=opcombo;break;
          }
       }
    }//del else de if (event.keyCode == 13)
   event.returnValue = false; //invalida la acción de pulsado de tecla para evitar busqueda del primer caracter
}//de function buscar_op_submit(obj)

</script>

<form name='form1' action='den_ad.php' method='POST' enctype='multipart/form-data'>
<input type="hidden" value="<?=$id_denuncia?>" name="id_denuncia">
<input type="hidden" value="<?=$id_bucelosis?>" name="id_bucelosis">

<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_bucelosis) {
    	?>  
    	<font size=+1><b>Nueva Denuncia</b></font>   
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
       <b> BRUCELOSIS </b>
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
   
   <tr><td colspan=9><div ><table width=100% align="center" >
          <tr>
         	<td align="right">
         	  <b>Nombre:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$n_prof;?>" name="n_prof" <? if ($id_denuncia) echo "disabled"?>>
            </td>
            <td align="right">
         	  <b>Apellido:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="50" value="<?=$a_prof;?>" name="a_prof" <? if ($id_denuncia) echo "disabled"?>>
            </td>
          </tr>  
	</table></div></td></tr> 
    <tr><td colspan=9><div><table width=75% align="center" >     
        <tr>
         	<td align="right">
         	  <b>DNI Nº:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$dni_prof;?>" name="dni_prof" <? if ($id_denuncia) echo "disabled"?>>
            </td>
            <td align="right">
         	  <b>Matricula Nº:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$matricula;?>" name="matricula" <? if ($id_denuncia) echo "disabled"?>>
            </td>
            <td align="right">
				<b>Fecha de Notificacion:</b> 
			</td>         	
			<td align='left'>
				<input type=text id=fecha_notif name='fecha_notif' value='<?if($fecha_notif=="01/01/1000")echo""; else echo $fecha_notif;?>' size=15 title="Fecha de Notificacion">
				<?=link_calendario("fecha_notif");?>
			</td>
		 </tr>
	</table></div></td></tr>
	<tr><td colspan=9><div ><table width=100% align="center" >     
		<tr>
	          	<td align="right">
					<b>Veterinaria:</b>
				</td>
				<td align='left'>
            		<select name=id_veterinaria Style="width=757px" <?if ($id_denuncia) echo 'disabled'?>>
							<option value=-1>Seleccione</option>
							<?$query10="SELECT DISTINCT *
										FROM epi.veterinarias
										ORDER BY
										epi.veterinarias.localidad ASC,
										epi.veterinarias.nom_veterinaria ASC";
								$res_10=sql($query10,"Error en consulta Nº 2");?>	
							 <? while (!$res_10->EOF){
									$id_veterinaria_temp=$res_10->fields['id_veterinaria'];
									$nom_veterinaria=$res_10->fields['localidad']." - ".$res_10->fields['nom_veterinaria'] ;?>
									<option value='<?=$id_veterinaria_temp?>' <? if(trim($id_veterinaria_temp)==trim($id_veterinaria))echo "selected"?>><?=$nom_veterinaria?></option>
									<?$res_10->movenext();
								}?>
					</select>
            	</td>
		 </tr>
		 <tr>
          <td align="right">
				<b>Tipo de Ficha:</b>
			</td>
			<td align='left'>
             <select name=id_tabla Style="width=757px" <?if ($id_denuncia) echo 'disabled'?>>
							<option value=-1>Seleccione</option>
							<?$query10="SELECT DISTINCT *
										FROM
										epi.ficha_epi
										ORDER BY
										epi.ficha_epi.descripcion ASC";
								$res_10=sql($query10,"Error en consulta Nº 2");?>	
							 <? while (!$res_10->EOF){
									$id_tabla_temp=$res_10->fields['id_tabla'];
									$descripcion=$res_10->fields['descripcion'];?>
									<option value='<?=$id_tabla_temp?>' <? if(trim($id_tabla_temp)==trim($id_tabla))echo "selected"?>><?=$descripcion?></option>
									<?$res_10->movenext();
								}?>
					</select>
            </td>
		 </tr>
	  <tr>
         
	</table></div></td></tr> 

       
<table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
   		<? if($id_denuncia){ ?>
			      <input type=button name="editar" value="Editar" onclick="editar_campos()" title="Edita Campos" style="width=130px"> &nbsp;&nbsp;
			      <input type="submit" name="guardar_editar" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
			      <input type="button" name="cancelar_editar" value="Cancelar" title="Cancela Edicion" disabled style="width=130px" onclick="document.location.reload()">		      
		   <?}else {?>
			      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		 <? } ?>
	    </td>
	</tr> 
</table>
	
<table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
   		<? if($id_tabla==5){ 
				$ref = encode_link("brus_can.php",array("id_denuncia"=>$id_denuncia,"pagina"=>"den_ad"));		   		
    			$onclick_ir="location.href='$ref'";?>
 				<input type=button name="Bruc_can" value="Brocelosis Canina" onclick'<?=$onclick_ir;?>' title="Ficha de Brucelosis Canina" style="width=150px"> 
		 <? } ?>
	    </td>
	</tr> 
</table>

<? if($id_tabla==1){//leptospirosis	?>
<tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> FICHA DE LEPTOSPIROSIS <?=$id_leptosp;?> </b>
      </td>
     </tr>
     <tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> DATOS DEL PACIENTE </b>
	           </td>
	         </tr>
    	</table></td></tr>	 
   <tr><td colspan=9><div ><table width=75% align="left" >
          <tr>
         	<td align="left">
         	  <b>Nombre:</b>
              <input type="text" size="50" value="<?=$ape_pac;?>" name="ape_pac" <? if ($id_leptosp) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Apellido:</b>
              <input type="text" size="50" value="<?=$nom_pac;?>" name="nom_pac" <? if ($id_leptosp) echo "disabled"?>>
            </td>
          </tr>  
	 </table></div></td></tr>
	 <tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         <td align="right">
         	  <b> Fecha de Nacimiento:</b>
             <input type='text' name='f_nacimiento' value='<?=fecha($f_nacimiento);?>' size=40 align='right' ></b>
           </td>
           
            <td align="left">
         	  <b>Sexo:</b>
      					<input type="radio" name="sexo" value="F" checked>Femenino
						<input type="radio" name="sexo" value="M">Masculino
					</td>
            </td>
		 </tr>
	</table></div></td></tr>	    
	  <tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
         	<td align="left">
         	  <b>Domicilio:</b>
         	
              <input type="text" size="75" value="<?=$domicilio;?>" name="domicilio" <? if ($id_leptosp) echo "disabled"?>>
            </td>
            <td align="left">
         	  <b>Localidad:</b>
         	
              <input type="text" size="20" value="<?=$localidad;?>" name="localidad" <? if ($id_leptosp) echo "disabled"?>>
            </td>
		 </tr>
		 <tr>
		 	<td align="left">
				<b>Departamento:</b>
         	
              <input type="text" size="20" value="<?=$departamento;?>" name="departamento" <? if ($id_leptosp) echo "disabled"?>>
            </td>
		 </tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=75% align="left" >     
        <tr>
               	<td align="left">
					<b>Ocupacion: Tareas Rurales:</b>
				
							<input type="radio" name="trurales" value="S" checked>Si
							<input type="radio" name="trurales" value="N">No
	            </td>
            	<td align="left">
					<b>Empleado en Frigorifico:</b>
				
							<input type="radio" name="e_frogorifico" value="S" checked>Si
							<input type="radio" name="e_frogorifico" value="N">No
				</td> 
				<td align='left'>
				<b>Desempleado:</b>
						<input type="checkbox" name="desempleado" value="S" >
	            </td>
		</tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=75% align="left" >     
		<tr>
			<td align="left">
				<b>Obrero:</b>
				<input type="text" size="70" value="<?=$obrero;?>" name="obrero" <? if ($id_leptosp) echo "disabled"?>>
            </td>
            <td align="left">
				<b>Otros:</b>
				<input type="text" size="70" value="<?=$otro;?>" name="otro" <? if ($id_leptosp) echo "disabled"?>>
			</td>         	
		</tr>
	</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>Detalle Epidemiologico:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='d_epidemio'  <? if($id_leptosp) echo "disabled"?>><?=$d_epidemio;?></textarea>
            </td>
		 </tr>
		 </table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		 <tr>
            <td align="left">
         	  <b>Examenes de laboratorio:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='laboratorios'  <? if($id_leptosp) echo "disabled"?>><?=$laboratorios;?></textarea>
            </td>
		 </tr>
	</table></div></td></tr>	


<table width=100% align="center" class="bordes">
 <? }//fin if $idtabla 
	if($id_tabla==1 || $id_tabla==2 ||$id_tabla==3 || $id_tabla==4 || $id_tabla==5){?>
 
 <table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
	   
   		<? 
   		 if($id_bruc_can || $id_lvc || $id_bucelosis || $id_hidat || $id_leptosp){ ?>
			      <input type=button name="editar" value="Editar" onclick="editar_campost5()" title="Edita Campos" style="width=130px"> &nbsp;&nbsp;
			      <input type="submit" name="guardar_editart5" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevost5()">&nbsp;&nbsp;
			      <input type="button" name="cancelar_editar" value="Cancelar" title="Cancela Edicion" disabled style="width=130px" onclick="document.location.reload()">		      
		   <?}else {?>
			      <input type="submit" name="guardart5" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevost5()">&nbsp;&nbsp;
		 <? } ?>
	    </td>
	</tr> 
</table>	
<? }//if por ninguna ?>
<table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
		     <input type=button name="volver" value="Volver" onclick="document.location='den_lis.php'"title="Volver al Listado" style="width=150px">     
		     </td>
	</tr> 
</table>	

</table></td></tr><?//table principal?> 	

</table>
 </form>
 
 <?=fin_pagina();// aca termino ?>