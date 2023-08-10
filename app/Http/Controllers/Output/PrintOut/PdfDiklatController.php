<?php

namespace App\Http\Controllers\Output\PrintOut;

use App\Http\Controllers\Controller;
use App\Models\TransSuratDiklat;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;

class PdfDiklatController extends Controller
{
    public function suratBalasan($kode)
    {
        $html = view('layouts.output.diklat-pdf.surat-balasan')->with([
            'detail'    => (new TransSuratDiklat())->getDetailSuratBalasan(base64_decode($kode))
        ]);
        
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, '');

        PDF::Output('hello_world.pdf');
    }
}
