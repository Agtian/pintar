<?php

namespace App\Http\Controllers\Diklat\MOU;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisKegiatanDiklat;
use App\Models\MasterTarifDiklat;
use App\Models\MasterTarifPelatihanPreKlinik;
use App\Models\PGSQL\MasterUnitKerja;
use App\Models\TransPendaftaranDiklat;
use App\Models\TransSuratDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class DataPendaftaranController extends Controller
{
    public function index()
    {
        $getDaftarDiklat = TransPendaftaranDiklat::select('t_pendaftaran_diklat.id as pendaftaran_diklat_id', 'kode_pendaftaran', 't_pendaftaran_diklat.jumlah_peserta', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 't_pendaftaran_diklat.tgl_pendaftaran', 'status_pendaftaran', 'm_tarif_diklat.jasa_sarana', 'm_tarif_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 'tarif_honorarium', 'total_waktu', 'total_tarif', 'f_status', 'no_surat_diklat', 'tgl_surat_diklat', 'perihal', 'surat_dari', 'nama_instansi', 'kota_instansi', 'nama_kegiatan', 'alias', 'jenis_praktikan', 't_pendapatan_diklat.jumlah_peserta_tambahan', 't_pendapatan_diklat.tarif_pre_klinik')
                            ->leftJoin('t_pendapatan_diklat', 't_pendaftaran_diklat.id', '=', 't_pendapatan_diklat.pendaftaran_diklat_id')
                            ->leftJoin('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                            // ->leftJoin('t_peserta_diklat', 't_pendaftaran_diklat.id', '=', 't_peserta_diklat.pendaftaran_diklat_id')
                            ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                            ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                            ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                            ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                            ->where('daftar_mou_diklat_id', Auth::user()->daftar_mou_diklat_id)
                            ->orderBy('t_pendaftaran_diklat.id', 'DESC')
                            ->paginate(10);

        return view('layouts.diklat.mou.data-pendaftaran', with([
            'resultDataPendaftaran'     => $getDaftarDiklat,
        ]));
    }
    
    public function getSuratPermohonan($pendaftaran_diklat_id)
    {
        $html = view('layouts.output.diklat-pdf.surat-balasan-v-i')->with([
            'detail'    => (new TransSuratDiklat())->getDetailSuratBalasan(base64_decode($pendaftaran_diklat_id))
        ]);
        
        $nameFile = date('Ymd', strtotime($html['detail']->tgl_pendaftaran))." Surat Balasan ".$html['detail']->nama_instansi;

        PDF::SetTitle($nameFile);
        PDF::AddPage('P', [215,330]);
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output("$nameFile.pdf");
    }

    public function edit($pendaftaran_diklat_id)
    {
        $getDaftarDiklat = TransPendaftaranDiklat::select('t_pendaftaran_diklat.id as pendaftaran_diklat_id', 'kode_pendaftaran', 't_pendaftaran_diklat.jumlah_peserta', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 't_pendaftaran_diklat.tgl_pendaftaran', 'status_pendaftaran', 'm_tarif_diklat.jasa_sarana', 'm_tarif_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 'tarif_honorarium', 'total_waktu', 'total_tarif', 'f_status', 'no_surat_diklat', 'tgl_surat_diklat', 'perihal', 'surat_dari', 'nama_instansi', 'kota_instansi', 'nama_kegiatan', 'alias', 'jenis_praktikan', 't_pendapatan_diklat.jumlah_peserta_tambahan', 't_pendapatan_diklat.tarif_pre_klinik')
                            ->leftJoin('t_pendapatan_diklat', 't_pendaftaran_diklat.id', '=', 't_pendapatan_diklat.pendaftaran_diklat_id')
                            ->leftJoin('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                            // ->leftJoin('t_peserta_diklat', 't_pendaftaran_diklat.id', '=', 't_peserta_diklat.pendaftaran_diklat_id')
                            ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                            ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                            ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                            ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                            ->where('t_pendaftaran_diklat.id', base64_decode($pendaftaran_diklat_id))
                            ->orderBy('t_pendaftaran_diklat.id', 'DESC')
                            ->get();

        $resultUnitKerja = MasterUnitKerja::all();
        $resultJenisKegiatan = MasterJenisKegiatanDiklat::all();

        $queryTarifPreKlinik = MasterTarifPelatihanPreKlinik::where('status_tarif', 1)->get();
            $jumlah_tarif = 0;
        foreach ($queryTarifPreKlinik as $item) {
            $jumlah_tarif = number_format($item->jumlah_tarif, 2, '.',',');
        }

        return view('layouts.diklat.mou.form-edit-pendaftaran', with([
            'resultDataPendaftaran'     => $getDaftarDiklat,
            'resultUnitKerja'           => $resultUnitKerja,
            'resultJenisKegiatan'       => $resultJenisKegiatan,
            'jumlah_tarif'              => $jumlah_tarif,
        ]));
    }
}
