<?php 

include('../../conex.php');

date_default_timezone_set('Europe/Lisbon');

//CARREGAR DOMPDF
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$id = $_GET['id'];



//ALIMENTAR OS DADOS NO RELATÓRIO
$html = utf8_encode(file_get_contents($url_sistema."/rel/recibo.php?id=".$id));



//INICIALIZAR A CLASSE DO DOMPDF
$pdf = new DOMPDF();

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html(utf8_decode($html));

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'Recibo.pdf',
array("Attachment" => false)
);


