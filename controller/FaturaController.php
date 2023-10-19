<?php

require 'html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class FaturaController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function gerarFatura($idPedido)
    {
        if (is_numeric($idPedido)) {
            $data = $this->model->selectPedido($idPedido);
            if (empty($data)) {
                echo "Pedido não encontrado";
            } else {
                $idPedido = $data['pedido']['id'];
                $html = getFile("partials/modals/comprobantePDF", $data);
                // $html2pdf = new Html2Pdf('p', 'A4', 'pt-br', 'true', 'UTF-8');
                $html2pdf = new Html2Pdf();
                $html2pdf->writeHTML($html);
                ob_end_clean();
                $html2pdf->output('factura-' . $idPedido . '.pdf');
            }
        } else {
            echo "Dato no válido";
        }
    }
}
