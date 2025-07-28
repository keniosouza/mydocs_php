<?php

/** Defino o local da classes */
namespace vendor\controller\PDF;

/** Importação de classes */
require_once __DIR__ . '/../../autoload.php';

use Mpdf\Mpdf;
use vendor\controller\main\Main;

class PdfGenerate
{

    /** Vairáveis da classe */
    private $mpdf = null;
    private $Main = null;
    private $preferences = null;
    private $html = null;
    private $dir = null;
    private $name = null;

    public function __construct()
    {
        /** Instânciamento da classe */
        $this->Main = new Main();
    }

    /** Método usado para gerar o PDF com mPDF */
    public function generate($html, $dir, $name, $preferences)
    {
        /** Atribuo os valores as variáveis */
        $this->html = $html;
        $this->dir = $dir;
        $this->name = $name;
        $this->preferences = $preferences;

        try {
            /** Configuração do mPDF */
            // Converte CM para MM para o mPDF
            $width_mm = $this->preferences->width * 10;
            $height_mm = $this->preferences->height * 10;

            // Pega a primeira letra da orientação (L ou P)
            $orientation = strtoupper(substr($this->preferences->orientation, 0, 1));

            /** Instancia o mPDF com as configurações da página */
            $this->mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => [$width_mm, $height_mm],
                'orientation' => $orientation,
                'tempDir' => __DIR__ . '/../../model/mpdf/tmp'
            ]);

            /** Escreve o HTML no PDF */
            $this->mpdf->WriteHTML($this->html);

            /** Caminho completo do arquivo */
            $full_path = '.' . $this->dir . $this->name;
            $directory_path = '.' . $this->dir;

            /** Verifico se a pasta do arquivo existe, se não, a crio */
            if (!is_dir($directory_path)) {
                if (!mkdir($directory_path, 0775, true)) {
                    // Não foi possível criar o diretório
                    return false;
                }
            }

            /** Salvo o arquivo PDF (sobrescreve se já existir) */
            $this->mpdf->Output($full_path, \Mpdf\Output\Destination::FILE);

            return true;

        } catch (\Mpdf\MpdfException $e) {
            // Em caso de erro, pode ser útil logar a mensagem
            // error_log($e->getMessage());
            return false;
        }
    }
}