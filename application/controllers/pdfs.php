<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Pdfs extends CI_Controller {
 
    function __construct() {
        parent::__construct();
        //$this->load->model('pdfs_model');
        //Cargo la libreria doctrine para poder usar la bd mapeada a objetos
        $this->load->library('doctrine');
        //Cargo el helper form para trabajar con la ayuda de codeignier para formularios
        $this->load->helper('form');
    }
    
    public function index()
    {
        //$data['provincias'] llena el select con las provincias españolas
        //$data['provincias'] = $this->pdfs_model->getProvincias();
        //cargamos la vista y pasamos el array $data['provincias'] para su uso
        //$this->load->view('pdfs_view', $data);
    }
 
    public function generar() {
         $email=$this->session->userdata('identity');         
        $repositorioUsers = $this->doctrine->em->getRepository('Entity\Users');
        $usuarioAutentificado = $repositorioUsers->findOneByEmail($email);  
        $idusuario=$usuarioAutentificado->getId();
        $repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
        $profesional=$repositorioProfesional->findOneByLogin($idusuario);
        $personas=$profesional->getIdpersonas();//obtengo el objeto personas
        $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas'); 
        $factura=$repositorioFacturas->findOneById($this->input->post('idfactura'));
        //echo $this->input->post('idfactura');
        //echo $factura->getId();
        $repositorioDetalles=$this->doctrine->em->getRepository('Entity\DetallesFactura');
        $detalles=$repositorioDetalles->findByIdfactura($this->input->post('idfactura'));
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Israel Parra');
        $pdf->SetTitle('Factura');
        //$pdf->SetSubject('Tutorial TCPDF');
        //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $image_file='C:\wamp\www\GestProf\application\images\logo.jpg';
        $pdf->Image($image_file,10,10,'','',
                      '','','T','','','C');
       // $tcpdf_header_logo ='C:\wamp\www\GestProf\application\images';
   // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
       // $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
       // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
       // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freesans', '', 12, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        // $provincia = $this->input->post('provincia');
        // $provincias = $this->pdfs_model->getProvinciasSeleccionadas($provincia);
        // foreach($provincias as $fila)
        // {
        //     $prov = $fila['p.provincia'];
        // }
        //preparamos y maquetamos el contenido a crear
        $html = "<style type=text/css>";
        $html .= "th{ background-color:'006699'}";
        $html .= "</style>";
        $html .= "<div>";
        $html .= "<table width='100%' class='table'>";
        $html .= "<tr><td>".$profesional->getIdpersonas()->getNombre()."</td><td></td><td>".$factura->getIdcliente()->getIdpersona()->getNombre()."</td></tr>";
        $html .= "<tr><td>".$profesional->getIdpersonas()->getDireccion()."</td><td></td><td>".$factura->getIdcliente()->getIdpersona()->getDireccion()."</td></tr>";
        $html .= "<tr><td>".$profesional->getIdpersonas()->getNif()."</td><td></td><td>".$factura->getIdcliente()->getIdpersona()->getNif()."</td></tr>";
        $html .= "</table></div>";
        $html .= "<div  id='datagrid'>";
        $html .= "<p>Nº Factura: ".$factura->getNumero()."</p>";
        $html .= "<table width='100%'>";
        $html .= "<tr><th>Descripcion</th><th>Precio Unitario</th><th>Cantidad</th><th>Iva</th><th>Descuento</th><th>Total</th></tr>";
        
        //Genero los detalles
        foreach ($detalles as $detalle) 
        {
            $html .= "<tr><td class='descripcion'>".$detalle->getDescripcion()."</td>";
            $html .= "<td class='preciounitario'>".$detalle->getPreciounitario()." €</td>";
            $html .="<td class='Cantidad'>".$detalle->getCantidad()."</td>";
             $html .="<td class='tipo'>".$detalle->getIdIva()->getTipo()." %</td>";
            $html .="<td class='descuento'>".$detalle->getDescuento()."</td>";
           
            $html .="<td class='total'>".$detalle->getTotal()." €</td></tr>";     
            //$html .= "<tr><td class='id'>" . $detalle->getDescripcion() . "</td><td class='localidad'>" . $detalle->getCantidad (). "</td></tr>";
        }
        $html .="<tr><td></td><td></td><td></td><td></td><td>Total</td><td>".$factura->getTotal()." €</td></tr>"; 
        $html .= "</table></div>";
 
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
 
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        //$nombre_archivo = utf8_decode("Localidades de ".$profesional->getIdpersonas()->getNombre().".pdf");
        $pdf->Output('ejemplo','I');
    }
}