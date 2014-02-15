<?
require_once ("../../config.php");

extract($_POST,EXTR_SKIP);
if ($parametros) extract($parametros,EXTR_OVERWRITE);
cargar_calendario();

if ($_POST['guardar_editar']=='Guardar'){
 $db->StartTrans();
   $nom_veterinaria=strtoupper($nom_veterinaria);     
   $localidad=strtoupper($localidad);
   $departamento=strtoupper($departamento);
   $domicilio=strtoupper($domicilio);
  
   $query="update epi.veterinarias set 
		nom_veterinaria='$nom_veterinaria',
		domicilio='$domicilio',
		localidad='$localidad',
		departamento='$departamento',
		numero='$numero',
		email='$email',
		tel='$tel'	
		where id_veterinaria=$id_veterinaria";	

    sql($query, "Error actualizar la Veterinaria") or fin_pagina();
    $accion="Los datos se actualizaron";  
  $db->CompleteTrans();    
}

if ($_POST['guardar']=='Guardar'){
	
	if ($id_veterinaria) {
	   $accion="Ya se guardado"; 
	}else{
	
		$db->StartTrans();
	   $nom_veterinaria=strtoupper($nom_veterinaria);     
	   $localidad=strtoupper($localidad);
	   $departamento=strtoupper($departamento);
	   $domicilio=strtoupper($domicilio);
			   
			   $query="insert into epi.veterinarias
			   	(id_veterinaria, nom_veterinaria, localidad, departamento, domicilio, numero, tel, email)
			   	values
			    (nextval('epi.veterinarias_id_veterinaria_seq'), '$nom_veterinaria', '$localidad', '$departamento', '$domicilio', '$numero', '$tel', '$email')";
				
			   sql($query, "Error al insertar la Veterinaria") or fin_pagina();
			 	 
			   $accion="Los datos se han guardado correctamente"; 
	    
	     $db->CompleteTrans();     
	}
}
if ($id_veterinaria) {
			$query=" SELECT  *
					FROM
						epi.veterinarias
					  WHERE epi.veterinarias.id_veterinaria=$id_veterinaria ";

	$res_persona =sql($query, "Error consulta 01") or fin_pagina();
	if($res_persona->RecordCount()!=0){
		$nom_veterinaria=$res_persona->fields['nom_veterinaria'];
		$localidad=$res_persona->fields['localidad'];
		$departamento=$res_persona->fields['departamento'];
		$domicilio=$res_persona->fields['domicilio'];
		$numero=$res_persona->fields['numero'];
		$tel=$res_persona->fields['tel'];
		$email=$res_persona->fields['email'];
		
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
function control_nuevos()
{ 
 if(document.all.nom_veterinaria.value==""){
  alert('Debe ingresar el Nombre o Razon Social');
  return false;
 } 
 if (confirm('Esta Seguro que Desea Agregar Registro?'))return true;
	 else return false;	
}//de function control_nuevos()

function editar_campos(){	
	document.all.nom_veterinaria.disabled=false;
	document.all.localidad.disabled=false;	
	document.all.departamento.disabled=false;
	document.all.domicilio.disabled=false;
	document.all.numero.disabled=false;
	document.all.tel.disabled=false;
	document.all.email.disabled=false;
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



//---------------------scrip para provincia------------------------------

</script>

<form name='form1' action='vet_ad.php' method='POST' enctype='multipart/form-data'>
<input type="hidden" value="<?=$id_veterinaria?>" name="id_veterinaria">
<?echo "<center><b><font size='+1' color='red'>$accion</font></b></center>";?>
<table width="85%" cellspacing=0 border=1 bordercolor=#E0E0E0 align="center" bgcolor='<?=$bgcolor_out?>' class="bordes">
 <tr id="mo">
    <td>
    	<?
    	if (!$id_veterinaria) {
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
       <b> Veterinaria </b>
      </td>
     </tr>
     	<tr><td><table>
	         <tr>	           
	           <td align="right" colspan="2">
	            <b> Número del Dato: <font size="+1" color="Red"><?=($id_veterinaria)? $id_veterinaria : "Nuevo Dato"?></font> </b>
	           </td>
	         </tr>
    	</table></td></tr>	     
   
   <tr><td colspan=9><div id=<?=$id_tabla?> style='display:none'><table width=100% align="center" >
          <tr>
         	<td align="right">
         	  <b>Razon Social:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="70" value="<?=$nom_veterinaria;?>" name="nom_veterinaria" <? if ($id_veterinaria) echo "disabled"?>>
            </td>
          </tr>  
	</table></div></td></tr> 
    <tr><td colspan=9><div id=<?=$id_tabla?> style='display:none'><table width=75% align="center" >     
        <tr>
         	<td align="right">
         	  <b>Domicilio/Calle:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="70" value="<?=$domicilio;?>" name="domicilio" <? if ($id_veterinaria) echo "disabled"?>>
            </td>
            <td align="right">
         	  <b>Numero:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="20" value="<?=$numero;?>" name="numero" <? if ($id_veterinaria) echo "disabled"?>>
            </td>
		 </tr>
	</table></div></td></tr>
	<tr><td colspan=9><div id=<?=$id_tabla?> style='display:none'><table width=100% align="center" >     
		<tr>
          <td align="right">
				<b>Localidad:</b>
			</td>
			<td align='left'>
              <input type="text" size="70" value="<?=$localidad;?>" name="localidad" <? if ($id_veterinaria) echo "disabled"?>>
            </td>
		 </tr>
		 <tr>
          <td align="right">
				<b>Departamento:</b>
			</td>
			<td align='left'>
              <input type="text" size="70" value="<?=$departamento;?>" name="departamento" <? if ($id_veterinaria) echo "disabled"?>>
            </td>
		 </tr>
	  <tr>
         	<td align="right">
         	  <b>E-mail:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="60" value="<?=$email;?>" name="email" <? if ($id_veterinaria) echo "disabled"?>>
            </td>            
         </tr> 	  
		   <tr >
         	<td align="right">
         	  <b>Telefono:</b>
         	</td>         	
            <td align='left'>
              <input type="text" size="60" value="<?=$tel;?>" name="tel" <? if ($id_veterinaria) echo "disabled"?>>
            </td>
         </tr>
	</table></div></td></tr> 

       
<table border="1" align="center" width="100%">
	<tr>
	   <td align="center">
   		<? if($id_veterinaria){ ?>
			      <input type=button name="editar" value="Editar" onclick="editar_campos()" title="Edita Campos" style="width=130px"> &nbsp;&nbsp;
			      <input type="submit" name="guardar_editar" value="Guardar" title="Guardar" disabled style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
			      <input type="button" name="cancelar_editar" value="Cancelar" title="Cancela Edicion" disabled style="width=130px" onclick="document.location.reload()">		      
		   <?}else {?>
			      <input type="submit" name="guardar" value="Guardar" title="Guardar" style="width=130px" onclick="return control_nuevos()">&nbsp;&nbsp;
		 <? } ?>
	    </td>
	</tr> 
</table>	
<table width=100% align="center" class="bordes">
		  <tr align="center">
		   <td>
		     <input type=button name="volver" value="Volver" onclick="document.location='vet_lis.php'"title="Volver al Listado" style="width=150px">     
		     </td>
		  </tr>
</table></td></tr>
</table></td></tr><?//table principal?> 	

</table>
 </form>
 
 <?=fin_pagina();// aca termino ?>