<?php
/*
AUTOR: Gabriel (15/11/2005)
MODIFICADO POR:
$Author: fernando $
$Revision: 1.4 $
$Date: 2007/03/02 20:24:23 $
*/

include("funciones_generales.php");

/////////////////////////////////// env�o de email al acercarse un vencimiento ////////////////////////////////
$consulta="select *
	from licitaciones_datos_adicionales.lic_gtia_contrato_vencimiento
	where ((fecha_registro - 2)=CURRENT_DATE) and (estado_garantia='np')";
$rta_consulta=$db->Execute($consulta) or die("c32: Error al traer los registros con pr�ximo vencimiento: ".$consulta);

if ($rta_consulta->recordCount()>0){
	$contenido="Las siguientes licitaciones tienen plazos de presentaci�n de garant�as de contrato que vencer�n en 2 d�as:\n";
	while (!$rta_consulta->EOF){
		$contenido.="Id. lic.: ".$rta_consulta->fields["id_licitacion"]."\n";
		$rta_consulta->moveNext();
	}
}
/////////////////////////////////////// monitoreo de vencimientos /////////////////////////////////////////////
$consulta="select *
	from licitaciones_datos_adicionales.lic_gtia_contrato_vencimiento
	where fecha_vencimiento_garantia <= CURRENT_DATE";
$rta_consulta=$db->Execute($consulta) or die("c48: Error al traer los registros de garant�as cerradas caducadas: ".$consulta."<br>\n".$db->ErrorMsg());

if ($rta_consulta->recordCount()>0){
	$contenido.="\n\n\nLas siguientes licitaciones poseen garant�as de contrato cerradas que han caducado:\n";
	while (!$rta_consulta->EOF){
		$contenido.="Id. lic.: ".$rta_consulta->fields["id_licitacion"]."\n";
		/*
		$db->Execute("update licitaciones_datos_adicionales.lic_gtia_contrato_vencimiento set estado_garantia='r'
				where id_licitacion=".$rta_consulta->fields["id_licitacion"])
			or die("c56: No se pudo cambiar el estado de la licitaci�n id=".$rta_consulta->fields["id_licitacion"]);
         */
		$rta_consulta->moveNext();
	}
}

if ($contenido){
	$contenido.="\n\nChequeo autom�tico de vencimiento de plazos: ".date("d/m/Y H:m")."\n";
	$asunto="Monitoreo autom�tico de garant�as de contrato";
	$mailto="adrian@coradir.com.ar, arrom@coradir.com.ar,irungaray@coradir.com.ar";
	enviar_mail($mailto, $asunto, $contenido, "", "", "", 0);
}
?>