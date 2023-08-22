<?php

namespace App\Http\Controllers\Diklat\MOU;

use App\Http\Controllers\Controller;
use App\Models\MasterDaftarMOUDiklat;
use App\Models\MasterHonorariumDiklat;
use App\Models\MasterJenisKegiatanDiklat;
use App\Models\MasterTarifDiklat;
use App\Models\MasterTarifPelatihanPreKlinik;
use App\Models\MasterUnitKerjaDiklat;
use App\Models\PGSQL\MasterUnitKerja;
use App\Models\TransPendaftaranDiklat;
use App\Models\TransPendapatanDiklat;
use App\Models\TransPesertaDiklat;
use App\Models\TransSuratDiklat;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class DataPendaftaranController extends Controller
{
    public function replaceAll($text) 
    { 
        $text = strtolower(htmlentities($text)); 
        $text = str_replace(get_html_translation_table(), "-", $text);
        $text = str_replace(" ", "_", $text);
        $text = preg_replace("/[-]+/i", "_", $text);
        return $text;
    }

    public function getTarifDiklat($jenis_kegiatan_id, $satuan_kegiatan_id, $jenis_praktikan_id)
    {
        if ($jenis_kegiatan_id == null || $satuan_kegiatan_id == null || $jenis_praktikan_id == null) {
            $dataTarif = [
                'id'            => 0,
                'jasa_sarana'   => '',
                'jasa_lainnya'  => '',
                'jumlah'        => '',
            ];
            return $dataTarif;
        } else {
            $query = DB::select("SELECT id, jasa_sarana, jasa_lainnya, jumlah
                FROM m_tarif_diklat
                WHERE status_tarif = '1'
                AND jenis_kegiatan_id = $jenis_kegiatan_id
                AND satuan_kegiatan_id = $satuan_kegiatan_id
                AND jenis_praktikan_id = $jenis_praktikan_id");
                
            foreach ($query as $item) {
                $dataTarif = [
                    'id'            => $item->id,
                    'jasa_sarana'   => $item->jasa_sarana,
                    'jasa_lainnya'  => $item->jasa_lainnya,
                    'jumlah'        => $item->jumlah
                ];
                return $dataTarif;
            }
        }
    }

    public function getHonorariumDiklat($opsi_honorarium, $satuan_kegiatan_id)
    {
        if ($opsi_honorarium == 'ya') {
            $query = MasterHonorariumDiklat::where('id', $satuan_kegiatan_id)->get(); 
            foreach ($query as $item) {
                $dataHonorarium = [
                    'id'                => $item->id,
                    'tarif_honorarium'  => $item->tarif_honorarium
                ];
                return $dataHonorarium;
            }
        } else {
            $dataHonorarium = [
                'id'                => '4',
                'tarif_honorarium'  => 0
            ];
            return $dataHonorarium;
        }
    }

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

        $getListDaftarDiklat = TransPendaftaranDiklat::select('t_pendaftaran_diklat.id as pendaftaran_diklat_id', 'kode_pendaftaran', 't_pendaftaran_diklat.jumlah_peserta', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 't_pendaftaran_diklat.tgl_pendaftaran', 'status_pendaftaran', 'm_tarif_diklat.jasa_sarana', 'm_tarif_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 'tarif_honorarium', 'total_waktu', 'total_tarif', 'f_status', 'no_surat_diklat', 'tgl_surat_diklat', 'perihal', 'surat_dari', 'nama_instansi', 'kota_instansi', 'nama_kegiatan', 'alias', 'jenis_praktikan', 't_pendapatan_diklat.jumlah_peserta_tambahan', 't_pendapatan_diklat.tarif_pre_klinik')
                            ->leftJoin('t_pendapatan_diklat', 't_pendaftaran_diklat.id', '=', 't_pendapatan_diklat.pendaftaran_diklat_id')
                            ->leftJoin('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                            // ->leftJoin('t_peserta_diklat', 't_pendaftaran_diklat.id', '=', 't_peserta_diklat.pendaftaran_diklat_id')
                            ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                            ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                            ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                            ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                            ->where('t_pendaftaran_diklat.id', base64_decode($pendaftaran_diklat_id))
                            ->orderBy('t_pendaftaran_diklat.id', 'DESC')
                            ->first();

        $resultUnitKerja = MasterUnitKerjaDiklat::all();
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
            'detail'                    => $getListDaftarDiklat
        ]));
    }

    public function update(Request $request, $kode)
    {
        $validatedData = $request->validate([
            'tgl_surat_diklat'      => 'required|date',
            'no_surat_diklat'       => 'required',
            'unit_kerja_id'         => 'required',
            'jenis_kegiatan_id'     => 'required',
            'satuan_kegiatan_id'    => 'required',
            'total_waktu'           => 'required',
            'tgl_mulai'             => 'required|date',
            'tgl_akhir'             => 'required|date',
            'jenis_praktikan_id'    => 'required',
            'jumlah_peserta'        => 'required',
            'jumlah_peserta_tambahan' => 'nullable',
            'surat_permohonan'      => 'required|mimes:pdf|max:512'
        ]);

        if (Auth::user()->daftar_mou_diklat_id == null) {
            dd('daftar_mou_diklat_id = NULL');
        }

        $cekData = TransPendaftaranDiklat::join('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                            ->where('t_pendaftaran_diklat.id', base64_decode($kode))
                            ->select('t_surat_diklat.file_surat_permohonan', 't_pendaftaran_diklat.surat_diklat_id')
                            ->first();

        $getDaftarMOU = MasterDaftarMOUDiklat::findOrFail(Auth::user()->daftar_mou_diklat_id);
        if ($request->hasFile('surat_permohonan')) {
            $path = 'assets/dokumen/surat_permohonan_diklat/'.$cekData->file_surat_permohonan;
            if (File::exists($path))
            {
                File::delete($path);
            }

            $surat = $request->file('surat_permohonan');
            $destinationPath = 'assets/dokumen/surat_permohonan_diklat/';
            $filename = date('YmdHis') . "-" . $this->replaceAll($getDaftarMOU->nama_instansi) . "." . $surat->getClientOriginalExtension();
            $surat->move($destinationPath, $filename);
            $uploadFile = "$filename";
        } else {
            $uploadFile = "";
        }

        $queryTarifPreKlinik = MasterTarifPelatihanPreKlinik::where('status_tarif', 1)->get();
        $jumlah_tarif_pre_klinik = '';
        foreach ($queryTarifPreKlinik as $item) {
            $jumlah_tarif_pre_klinik = $item->jumlah_tarif;
        }

        TransSuratDiklat::findOrFail($cekData->surat_diklat_id)->update([
            'user_id'           => Auth::user()->id,
            'no_surat_diklat'   => $validatedData['no_surat_diklat'],
            'tgl_surat_diklat'  => $validatedData['tgl_surat_diklat'],
            'file_surat_permohonan' => $uploadFile,
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_akhir'         => $validatedData['tgl_akhir'],
        ]);

        TransPendaftaranDiklat::findOrFail(base64_decode($kode))->update([
            'user_id'           => Auth::user()->id,
            'jumlah_peserta'    => $validatedData['jumlah_peserta'],
            'jumlah_peserta_tambahan' => $validatedData['jumlah_peserta_tambahan'],
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_akhir'         => $validatedData['tgl_akhir'],
            'tgl_pendaftaran'   => date('Y-m-d'),
            'status_pendaftaran'=> 0, // pending peserta (belum dikirim / submit permohonan)
        ]);

        $opsi_honoararium       = 'tidak';

        $tarif_diklat_id        = $this->getTarifDiklat($request->jenis_kegiatan_id, $request->satuan_kegiatan_id, $request->jenis_praktikan_id)['id'];
        $jasa_sarana            = $this->getTarifDiklat($request->jenis_kegiatan_id, $request->satuan_kegiatan_id, $request->jenis_praktikan_id)['jasa_sarana'];
        $jasa_lainnya           = $this->getTarifDiklat($request->jenis_kegiatan_id, $request->satuan_kegiatan_id, $request->jenis_praktikan_id)['jasa_lainnya'];
        $jumlah                 = $this->getTarifDiklat($request->jenis_kegiatan_id, $request->satuan_kegiatan_id, $request->jenis_praktikan_id)['jumlah'];
        $honorarium_diklat_id   = $this->getHonorariumDiklat($opsi_honoararium, $request->satuan_kegiatan_id)['id'];
        $tarif_honorarium       = $this->getHonorariumDiklat($opsi_honoararium, $request->satuan_kegiatan_id)['tarif_honorarium'];



        $total_tarif = (($jumlah * $request->jumlah_peserta) * $request->total_waktu) + (($tarif_honorarium * $request->jumlah_peserta) * $request->total_waktu);
        if ($validatedData['jumlah_peserta_tambahan']) {
            $fix_total_tarif = ($validatedData['jumlah_peserta_tambahan'] * $jumlah_tarif_pre_klinik) + $total_tarif;
        } else {
            $fix_total_tarif = $total_tarif;
        }

        TransPendapatanDiklat::where('pendaftaran_diklat_id', base64_decode($kode))->update([
            'tarif_diklat_id'       => $tarif_diklat_id,
            'honorarium_diklat_id'  => $honorarium_diklat_id,
            'user_id'               => Auth::user()->id,
            'jasa_sarana'           => $jasa_sarana,
            'jasa_lainnya'          => $jasa_lainnya,
            'tarif_honorarium'      => $tarif_honorarium,
            'jumlah_peserta'        => $validatedData['jumlah_peserta'],
            'jumlah_peserta_tambahan' => $validatedData['jumlah_peserta_tambahan'],
            'total_waktu'           => $validatedData['total_waktu'],
            'tarif_pre_klinik'      => $jumlah_tarif_pre_klinik,
            'total_tarif'           => $fix_total_tarif,
            'f_status'              => 3, // pending peserta (belum dikirim / submit permohonan)
        ]);

        return redirect('data-pendaftaran/')->with(['success' => 'Permohonan diklat berhasil di diperbarui.']);
    }

    public function storePerhonan(Request $request)
    {
        $validatedData = $request->validate([
            'kode_data'  => 'required',
        ]);

        TransPendaftaranDiklat::findOrFail(base64_decode($validatedData['kode_data']))->update([
            'status_pendaftaran'    => 1,
        ]);

        TransPendapatanDiklat::where('pendaftaran_diklat_id', base64_decode($validatedData['kode_data']))->update([
            'f_status'  => 0,
        ]);

        return redirect('data-pendaftaran')
                ->with(['success' => 'Permohonan diklat berhasil diajukan, harap tunggu 2x24 jam kami akan segera mengkonfirmasi permohonan anda. Terimakasih.']);
    }
}
