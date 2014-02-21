<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar_editar']=='Guardar'){
 $db->StartTrans();
 	if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
 	$n_prof=strtoupper($n_prof);     
   	$a_prof=strtoupper($a_prof);
   	$matricula=strtoupper($matricula);
  	$fecha_notif=fecha_db($fecha_notif);
  $usuario=$_ses_user['name'];
   $query="update epi.denuncia set 
			n_prof='$n_prof',
			a_prof='$a_prof',
			matricula='$matricula',
			dni_prof='$dni_prof',
			fecha_notif='$fecha_notif',
			id_veterinaria='$id_denuncia',
			id_tabla=$id_tabla,
			f_carga=now(),
			usuario='$usuario'
		where id_denuncia=$id_denuncia";	

   
    sql($query, "Error actualizar la Denuncia") or fin_pagina();
    $accion="Los datos se actualizaron";  
  $db->CompleteTrans();    
}

if ($_POST['guardar']=='Guardar'){
	
	if ($id_denuncia) {
	   $accion="Los datos se han guardado correctamente IF "; 
	}else{
		if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
		$db->StartTrans();
	    $n_prof=strtoupper($n_prof);     
	    $a_prof=strtoupper($a_prof);
	    $matricula=strtoupper($matricula);
		$usuario=$_ses_user['name'];
	    
		$query="insert into epi.denuncia
			   	(id_denuncia, n_prof, a_prof, matricula, dni_prof, fecha_notif, id_veterinaria, id_tabla, f_carga, usuario)
			   	values
			    (nextval('epi.denuncia_id_denuncia_seq'), '$n_prof', '$a_prof', '$matricula', '$dni_prof', '$fecha_notif', '$id_veterinaria', '$id_tabla', now(), '$usuario')";
				
			   sql($query, "Error al insertar la Veterinaria") or fin_pagina();
			 	 
			   $accion="Los datos se han guardado correctamente"; 
	    
	     $db->CompleteTrans();     
	}
}
/*------------------------- guardar o editar tabla nº 5 brucelosis canina-- t5------------------------*/
if ($_POST['guardar_editart5']=='Guardar'){
 $db->StartTrans();
 	if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
 	$n_prop=strtoupper($n_prop);     
   	$a_prop=strtoupper($a_prop);
   	$dom_prop=strtoupper($dom_prop);
  	$usuario=$_ses_user['name'];
   
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

   
    sql($query, "Error actualizar la Denuncia") or fin_pagina();
    $accion="Los datos se actualizaron";  
  $db->CompleteTrans();    
}

if ($_POST['guardart5']=='Guardar'){
	
	if ($id_bruc_can) {
	   $accion="Los datos se han guardado correctamente IF "; 
	}else{
		if ($fecha_notif!='')$fecha_notif=Fecha_db($fecha_notif);else $fecha_notif='1000-01-01';
		$db->StartTrans();
	    	$n_prop=strtoupper($n_prop);     
   	$a_prop=strtoupper($a_prop);
   	$dom_prop=strtoupper($dom_prop);
  	$usuario=$_ses_user['name'];
	    
		$query="insert into epi.brucel_can
			   	(id_bruc_can, id_denuncia, n_prop, a_prop, dom_prop, telef, d_animal, d_epidemio,laboratorios, f_carga, usuario)
			   	values
			    (nextval('epi.brucel_can_id_bruc_can_seq'), '$id_denuncia','$n_prop', '$a_prop', '$dom_prop', '$telef', '$d_animal', '$d_epidemio', '$laboratorios', now(), '$usuario')";
				
			   sql($query, "Error al insertar") or fin_pagina();
			 	 
			   $accion="Los datos se han guardado correctamente"; 
	    
	     $db->CompleteTrans();     
	}
}

/*------------------------- fin guardar o editar tabla nº 5 brucelosis canina--------------------------*/


if ($id_denuncia) {
			$query="SELECT DISTINCT *
						FROM
						epi.denuncia	
						INNER JOIN epi.ficha_epi ON epi.denuncia.id_tabla = epi.ficha_epi.id_tabla					
					  WHERE epi.denuncia.id_denuncia=$id_denuncia";

	$res_persona =sql($query, "Error consulta 01") or fin_pagina();
	if($res_persona->RecordCount()!=0){
		$n_prof=$res_persona->fields['n_prof'];
		$a_prof=$res_persona->fields['a_prof'];
		$matricula=$res_persona->fields['matricula'];
		$dni_prof=$res_persona->fields['dni_prof'];
		$fecha_notif=$res_persona->fields['fecha_notif'];
		$id_denuncia=$res_persona->fields['id_veterinaria'];
		$id_tabla=$res_persona->fields['id_tabla'];		
		$id_denuncia=$res_persona->fields['id_denuncia'];	
		$detalle=$res_persona->fields['descripcion'];	
		
		if($id_tabla==5){ // brucelosis canina
	
		$q_12="SELECT * FROM epi.denuncia
				INNER JOIN epi.brucel_can ON epi.denuncia.id_denuncia = epi.brucel_can.id_denuncia
			";
		$res_q12 =sql($q_12, "Error consulta 02") or fin_pagina();
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
	}else {	//LEPTOSPIROSIS
		$q_lep="SELECT DISTINCT
				epi.leptospirosis.id_leptosp,
				epi.leptospirosis.ape_pac,
				epi.leptospirosis.nom_pac,
				epi.leptospirosis.f_nacimiento,
				epi.leptospirosis.sexo,
				epi.leptospirosis.domicilio,
				epi.leptospirosis.localidad,
				epi.leptospirosis.departamento,
				epi.leptospirosis.trurales,
				epi.leptospirosis.e_frogorifico,
				epi.leptospirosis.obrero,
				epi.leptospirosis.otro,
				epi.leptospirosis.f_psintoma,
				epi.leptospirosis.f_internacion,
				epi.leptospirosis.f_muestra,
				epi.leptospirosis.ictericia,
				epi.leptospirosis.cefalea,
				epi.leptospirosis.s_mengeo,
				epi.leptospirosis.iconjuntivalbilat,
				epi.leptospirosis.fiebre,
				epi.leptospirosis.mialgias,
				epi.leptospirosis.ers1hs,
				epi.leptospirosis.leucositosis,
				epi.leptospirosis.eutrofilia,
				epi.leptospirosis.uremia,
				epi.leptospirosis.bili_direc,
				epi.leptospirosis.tgp,
				epi.leptospirosis.cpk,
				epi.leptospirosis.a_domestico,
				epi.leptospirosis.roedores,
				epi.leptospirosis.rio_arroyo,
				epi.leptospirosis.laguna,
				epi.leptospirosis.alcantarilla,
				epi.leptospirosis.inundacion,
				epi.leptospirosis.f_notificacion,
				epi.leptospirosis.semana_epi,
				epi.leptospirosis.esablecimiento,
				epi.leptospirosis.serologia,
				epi.leptospirosis.positividad,
				epi.leptospirosis.titulo,
				epi.leptospirosis.aislamiento,
				epi.leptospirosis.obs 
				INNER JOIN epi.leptospirosis ON epi.leptospirosis.id_denuncia = epi.denuncia.id_denuncia
				ORDER BY
				epi.leptospirosis.id_leptosp ASC";
		$res_lep=sql($q_lep, "Error consulta 03") or fin_pagina();
		if($res_lep->RecordCount()!=0){
			$id_leptosp=$res_lep->fields['id_leptosp'];
			$ape_pac=$res_lep->fields['ape_pac'];
			$nom_pac=$res_lep->fields['nom_pac'];
			$f_nacimiento=$res_lep->fields['f_nacimiento'];
			$sexo=$res_lep->fields['sexo'];
			$domicilio=$res_lep->fields['domicilio'];
			$localidad=$res_lep->fields['localidad'];
			$departamento=$res_lep->fields['departamento'];
			$trurales=$res_lep->fields['trurales'];
			$e_frogorifico=$res_lep->fields['e_frogorifico'];
			$obrero=$res_lep->fields['obrero'];
			$otro=$res_lep->fields['otro'];
			$f_psintoma=$res_lep->fields['f_psintoma'];
			$f_internacion=$res_lep->fields['f_internacion'];
			$f_muestra=$res_lep->fields['f_muestra'];
			$ictericia=$res_lep->fields['ictericia'];
			$cefalea=$res_lep->fields['cefalea'];
			$s_mengeo=$res_lep->fields['s_mengeo'];
			$iconjuntivalbilat=$res_lep->fields['iconjuntivalbilat'];
			$fiebre=$res_lep->fields['fiebre'];
			$mialgias=$res_lep->fields['mialgias'];
			$ers1hs=$res_lep->fields['ers1hs'];
			$leucositosis=$res_lep->fields['leucositosis'];
			$eutrofilia=$res_lep->fields['eutrofilia'];
			$uremia=$res_lep->fields['uremia'];
			$bili_direc=$res_lep->fields['bili_direc'];
			$tgp=$res_lep->fields['tgp'];
			$cpk=$res_lep->fields['cpk'];
			$a_domestico=$res_lep->fields['a_domestico'];
			$roedores=$res_lep->fields['roedores'];
			$rio_arroyo=$res_lep->fields['rio_arroyo'];
			$laguna=$res_lep->fields['laguna'];
			$alcantarilla=$res_lep->fields['alcantarilla'];
			$inundacion=$res_lep->fields['inundacion'];
			$f_notificacion=$res_lep->fields['f_notificacion'];
			$semana_epi=$res_lep->fields['semana_epi'];
			$esablecimiento=$res_lep->fields['esablecimiento'];
			$serologia=$res_lep->fields['d_epidemio'];
			$positividad=$res_lep->fields['d_epidemio'];
			$titulo=$res_lep->fields['d_epidemio'];
			$aislamiento=$res_lep->fields['d_epidemio'];
			$obs=$res_lep->fields['d_epidemio'];
			
		}
		
	}
}

echo $html_header;
?>
<script>
//empieza funcion mostrar tabla
var img_ext='<?=$img_ext='../../imagenes/rigth2.gif' ?>';//imagen extendido
var img_cont='<?=$img_cont='../../imagenes/down2.gif' ?>';//imagen contraido

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


function editar_campos(){	
	document.all.n_prof.disabled=false;
	document.all.a_prof.disabled=false;	
	document.all.matricula.disabled=false;
	document.all.dni_prof.disabled=false;
	document.all.id_veterinaria.disabled=false;
	document.all.id_tabla.disabled=false;

	document.all.guardar_editar.disabled=false;
	document.all.cancelar_editar.disabled=false;
	document.all.borrar.disabled=false;
	return true;
}
//de function control_nuevos()
//controlan que ingresen todos los datos necesarios par el muleto
function control_nuevost5(){ 
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


function editar_campost5(){	
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
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_denuncia) {
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
       <b> Datos del Profesional Denunciante </b>
      </td>
     </tr>
     	<tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número del Dato: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    	</table></td></tr>	     
   
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

<? if($id_tabla==5){
	
	
	?>
<tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> FICHA DE <?=$detalle; ?> </b>
      </td>
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
   
	<tr><td colspan=9><div ><table width=65% align="left" >     
        <tr>
         	<td align="left">
				<b>Datos del Animal:</b>
			</td>         	
			<td align='left'>
			      <textarea cols='100' rows='4' name='d_animal'  <? if($id_bruc_can) echo "disabled"?>><?=$d_animal;?></textarea>
			</td>
		</tr>
		</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>Detalle Epidemiologico:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='d_epidemio'  <? if($id_bruc_can) echo "disabled"?>><?=$d_epidemio;?></textarea>
            </td>
		 </tr>
		 </table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		 <tr>
            <td align="left">
         	  <b>Examenes de laboratorio:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='laboratorios'  <? if($id_bruc_can) echo "disabled"?>><?=$laboratorios;?></textarea>
            </td>
		 </tr>
	</table></div></td></tr>	

<table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
	   
   		<? 
   		 if($id_bruc_can){ ?>
			      <input type=button name="editar" value="Editar" onclick="editar_campost5()" title="Edita Campos" style="width=130px"> &nbsp;&nbsp;
			      <input type="submit" name="guardar_editart5" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevost5()">&nbsp;&nbsp;
			      <input type="button" name="cancelar_editar" value="Cancelar" title="Cancela Edicion" disabled style="width=130px" onclick="document.location.reload()">		      
		   <?}else {?>
			      <input type="submit" name="guardart5" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevost5()">&nbsp;&nbsp;
		 <? } ?>
	    </td>
	</tr> 
</table>	
<table width=100% align="center" class="bordes">
 <? }//fin if $idtabla ?>  

 
<? if($id_tabla==1){
	
	$q_12="SELECT epi.brucel_can.n_prop,
			epi.brucel_can.d_epidemio,
			epi.brucel_can.laboratorios,
			epi.brucel_can.d_animal,
			epi.brucel_can.a_prop,
			epi.brucel_can.telef,
			epi.brucel_can.dom_prop,
			epi.brucel_can.id_bruc_can
			FROM epi.denuncia
			INNER JOIN epi.brucel_can ON epi.denuncia.id_denuncia = epi.brucel_can.id_denuncia
			";
	$res_q12 =sql($q_12, "Error consulta 02") or fin_pagina();
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
	?>
<tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> FICHA DE <?=$detalle; ?> </b>
      </td>
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
   
	<tr><td colspan=9><div ><table width=65% align="left" >     
        <tr>
         	<td align="left">
				<b>Datos del Animal:</b>
			</td>         	
			<td align='left'>
			      <textarea cols='100' rows='4' name='d_animal'  <? if($id_bruc_can) echo "disabled"?>><?=$d_animal;?></textarea>
			</td>
		</tr>
		</table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		<tr>
            <td align="left">
         	  <b>Detalle Epidemiologico:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='d_epidemio'  <? if($id_bruc_can) echo "disabled"?>><?=$d_epidemio;?></textarea>
            </td>
		 </tr>
		 </table></div></td></tr>	    
   
	<tr><td colspan=9><div ><table width=65% align="left" >   
		 <tr>
            <td align="left">
         	  <b>Examenes de laboratorio:</b>
         	</td>         	
            <td align='left'>
			      <textarea cols='100' rows='4' name='laboratorios'  <? if($id_bruc_can) echo "disabled"?>><?=$laboratorios;?></textarea>
            </td>
		 </tr>
	</table></div></td></tr>	

<table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
	   
   		<? 
   		 if($id_bruc_can){ ?>
			      <input type=button name="editar" value="Editar" onclick="editar_campost5()" title="Edita Campos" style="width=130px"> &nbsp;&nbsp;
			      <input type="submit" name="guardar_editart5" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevost5()">&nbsp;&nbsp;
			      <input type="button" name="cancelar_editar" value="Cancelar" title="Cancela Edicion" disabled style="width=130px" onclick="document.location.reload()">		      
		   <?}else {?>
			      <input type="submit" name="guardart5" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevost5()">&nbsp;&nbsp;
		 <? } ?>
	    </td>
	</tr> 
</table>	
<table width=100% align="center" class="bordes">
 <? }//fin if $idtabla ?>
 
 
 
 
 
 
 

		  <tr align="center">
		   <td>
		     <input type=button name="volver" value="Volver" onclick="document.location='den_lis.php'"title="Volver al Listado" style="width=150px">     
		     </td>
		  </tr>
</table></td></tr>
</table></td></tr><?//table principal?> 	

</table>
 </form>
 
 <?=fin_pagina();// aca termino ?>