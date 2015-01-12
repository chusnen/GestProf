<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
//Libreria propia que se encarga de calculas las bases computables y deducibles del modelo de hacienda
class Clasefichero130 {


   //funciones que queremos implementar en Miclase.
	
    public function calcularingresoscomputables($trimestre,$ano,$profesional){
    	$CI =& get_instance();
    	$CI->load->library('doctrine');	
    	$inicioano=date($ano.'/01/01');
        if ($trimestre=='1'){
            //Si estamos el el primer trimestre tenemos que calcular si se tiene derecho a la minoracion casilla 13 del modelo
            
            $fintrimestre=$ano.'/03/31';
        }
        elseif($trimestre=='2'){
            //$inicioTrimestre=$ano.'/01/01';
            $fintrimestre=$ano.'/06/30';
        }
        elseif($trimestre=='3'){
            $fintrimestre=$ano.'/09/30';
        }
        else{
            $fintrimestre=$ano.'/12/31';
        }
        $fintrimestre=date($fintrimestre);
        //Guardamos todas las facturas de ingresos que cumplen dicha condicion 
       $consulta=$CI->doctrine->em->createQuery("SELECT factura FROM Entity\Facturas factura WHERE factura.idproveedores IS NULL and factura.fecha BETWEEN '".$inicioano."' and '".$fintrimestre."' and factura.idprofesional ='".$profesional."'");
        $facturasingresoelegidas = $consulta->getResult();
        $baseimponibleingresos=0;
        foreach ($facturasingresoelegidas as $facturaingresoelegida) {
            $baseimponibleingresos=$baseimponibleingresos+$facturaingresoelegida->getBaseimponible();
        }
        return $baseimponibleingresos;
    }
    /**
     * Get calculargastoscomputables
     *
     * @return $baseimponibleingresos
     */
    public function calculargastoscomputables($trimestre,$ano,$profesional){
    	$CI =& get_instance();
    	$CI->load->library('doctrine');        
        $inicioano=date($ano.'/01/01');
        if ($trimestre=='1'){
            //Si estamos el el primer trimestre tenemos que calcular si se tiene derecho a la minoracion casilla 13 del modelo
            $fintrimestre=$ano.'/03/31';
        }
        elseif($trimestre=='2'){
            //$inicioTrimestre=$ano.'/01/01';
            $fintrimestre=$ano.'/06/30';
        }
        elseif($trimestre=='3'){
            $fintrimestre=$ano.'/09/30';
        }
        else{
            $fintrimestre=$ano.'/12/31';
           
        }
         $fintrimestre=date($fintrimestre);
        //vamos sacando las basesimponibles de los gastos
         //$sql = “SELECT nombre, precio, existencia FROM productos WHERE codigo='”
      //.$_POST[‘codigo’].”‘”
        $consulta=$CI->doctrine->em->createQuery("SELECT factura FROM Entity\Facturas factura WHERE factura.idcliente IS NULL and factura.fecha BETWEEN '".$inicioano."' and '".$fintrimestre."' and factura.idprofesional ='".$profesional."'");
        //Guardamos todas las facturas de gastos que cumplen dicha condicion 
        $facturasgastoselegidas = $consulta->getResult();
        $baseimponiblegastos=0;
        foreach ($facturasgastoselegidas as $facturagastoelegida) {
            $baseimponiblegastos=$baseimponiblegastos+$facturagastoelegida->getBaseimponible();
        }
        return $baseimponiblegastos;
    } 
    public function minoracion ($rendimientoprimertrimestre){
		if($rendimientoprimertrimestre<0){
			$minoracion=0;
			$porcentaje=0;
		}
		elseif($rendimientoprimertrimestre<=8000){
			$minoracion=100;
		}
		elseif($rendimientoprimertrimestre>8000 and $rendimientoprimertrimestre<=12000) {
			$minoracion=(400-0.1*(4*$rendimientoneto-8000))/4;
		}
		else{
			$minoracion=0;
		}
	    return $minoracion;
    }
    public function porcentaje($rendimientoneto){
    	$porcentaje=$rendimientoneto-(($rendimientoneto*20)/100);
		return $porcentaje;
    } 
    //Quita los acentos
    function quitaracentos($string){
		return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
		'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	}         
}

?>