<?php

namespace App\Classes\vendor;

require_once('fpdf/fpdf.php');
//require_once('fpdi/autoload.php');
//require_once('autoload.php');


use \setasign\Fpdi\Fpdi;

class WatermarkPDF extends FPDI {

    public $_tplIdx;
    public $angle = 0;
    public $fullPathToFile;
    public $rotatedText = 'Muvi Entertainment Pvt. Ltd.';

    function __construct($fullPathToFile, $rotate_text) {
        $this->fullPathToFile = $fullPathToFile;
        if ($rotate_text)
            $this->rotatedText = $rotate_text;
        parent::__construct();
    }

    function Rotate($angle, $x = -1, $y = -1) {
        if ($x == -1)
            $x = $this->x;
        if ($y == -1)
            $y = $this->y;
        if ($this->angle != 0)
            $this->_out('Q');
        $this->angle = $angle;
        if ($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm', $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    function _endpage() {
        if ($this->angle != 0) {
            $this->angle = 0;
            $this->_out('Q');
        }
        parent::_endpage();
    }

    function Header() {
        //Put the watermark
        //$this->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World', 40, 100, 100, 0, 'PNG');
        if ($this->fullPathToFile) {
            if (is_null($this->_tplIdx)) {
                //dd($this->fullPathToFile);
                // THIS IS WHERE YOU GET THE NUMBER OF PAGES
                $this->numPages = $this->setSourceFile($this->fullPathToFile);
                $this->_tplIdx = $this->importPage(1);
            }
            $this->useTemplate($this->_tplIdx, 0, 0, 200);
        }
        if($this->PageNo() != 1)
        {
            $this->SetAlpha(0.2);
            $this->SetFont('Arial', 'B', 72);
            $this->SetTextColor(25, 25, 75);
            //$this->RotatedText(20, 230, $this->rotatedText, 45);
            $this->RotatedText(35, 230, $this->rotatedText, 45);
        }
    } 

    function RotatedText($x, $y, $txt, $angle) {
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }
    
    /*----------------------  Alpha PDF  --------------------------------*/
    var $extgstates = array();
    
    function SetAlpha($alpha, $bm='Normal')
    {
        // set alpha for stroking (CA) and non-stroking (ca) operations
        $gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
        $this->SetExtGState($gs);
    }

    function AddExtGState($parms)
    {
        $n = count($this->extgstates)+1;
        $this->extgstates[$n]['parms'] = $parms;
        return $n;
    }

    function SetExtGState($gs)
    {
        $this->_out(sprintf('/GS%d gs', $gs));
    }

    function _enddoc()
    {
        if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
            $this->PDFVersion='1.4';
        parent::_enddoc();
    }

    function _putextgstates()
    {
        for ($i = 1; $i <= count($this->extgstates); $i++)
        {
            $this->_newobj();
            $this->extgstates[$i]['n'] = $this->n;
            $this->_out('<</Type /ExtGState');
            $parms = $this->extgstates[$i]['parms'];
            $this->_out(sprintf('/ca %.3F', $parms['ca']));
            $this->_out(sprintf('/CA %.3F', $parms['CA']));
            $this->_out('/BM '.$parms['BM']);
            $this->_out('>>');
            $this->_out('endobj');
        }
    }

    function _putresourcedict()
    {
        parent::_putresourcedict();
        $this->_out('/ExtGState <<');
        foreach($this->extgstates as $k=>$extgstate)
            $this->_out('/GS'.$k.' '.$extgstate['n'].' 0 R');
        $this->_out('>>');
    }

    function _putresources()
    {
        $this->_putextgstates();
        parent::_putresources();
    }

}
