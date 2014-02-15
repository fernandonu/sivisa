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
if ($id_denuncia) {
			$query="SELECT DISTINCT *
						FROM
						epi.denuncia						
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

<tr><td><table width=90% align="center" class="bordes">
     <tr>
      <td id=mo colspan="2">
       <b> Ficha de <?=$detalle; ?> </b>
      </td>
     </tr>
     	<tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número del Dato: <font size="+1" color="Red"><?=($id_denuncia)? $id_denuncia: "Nuevo Dato";?></font> </b>
	           </td>
	         </tr>
    	</table></td></tr>	     




<table border="1" align="center" width="100%">

<table width=100% align="center" class="bordes">
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