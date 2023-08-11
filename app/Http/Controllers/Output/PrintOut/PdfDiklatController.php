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
        
        $nameFile = date('Ymd', strtotime($html['detail']->tgl_pendaftaran))." Surat Balasan ".$html['detail']->nama_instansi;

        PDF::SetTitle($nameFile);
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output("$nameFile.pdf");
    }

    public function suratBalasanV1($kode)
    {
        $html = view('layouts.output.diklat-pdf.surat-balasan-v-i')->with([
            'detail'    => (new TransSuratDiklat())->getDetailSuratBalasan(base64_decode($kode))
        ]);
        
        $nameFile = date('Ymd', strtotime($html['detail']->tgl_pendaftaran))." Surat Balasan ".$html['detail']->nama_instansi;

        PDF::SetTitle($nameFile);
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output("$nameFile.pdf");
    }
}
