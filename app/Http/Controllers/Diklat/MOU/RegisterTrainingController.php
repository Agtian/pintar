<?php

namespace App\Http\Controllers\Diklat\MOU;

use App\Http\Controllers\Controller;
use App\Models\MasterDaftarMOUDiklat;
use App\Models\MasterHonorariumDiklat;
use App\Models\MasterJenisKegiatanDiklat;
use App\Models\MasterTarifDiklat;
use App\Models\MasterTarifPelatihanPreKlinik;
use App\Models\MasterUnitKerjaDiklat;
use App\Models\TransPendaftaranDiklat;
use App\Models\TransPendapatanDiklat;
use App\Models\TransPesertaDiklat;
use App\Models\TransSuratDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterTrainingController extends Controller
{
    public function getAutoKode()
    {
        $query = DB::select("SELECT RIGHT(kode_pendaftaran, 2) as kode_pendaftaran
            FROM t_pendaftaran_diklat
            ORDER BY id DESC
            LIMIT 1");
        
        if (count($query) == 0) {
            $nomor = 1;
            return '3320021.DIKLAT.' . date('y') . '.' . str_pad($nomor, 5, "0", STR_PAD_LEFT);
        } else {
            foreach ($query as $item) {
                $kode_pendaftaran = $item->kode_pendaftaran;
                $nomor = intval($kode_pendaftaran) + 1;
                return '3320021.DIKLAT.' . date('y') . '.' . str_pad($nomor, 5, "0", STR_PAD_LEFT);
            }
        }
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

    public function replaceAll($text) 
    { 
        $text = strtolower(htmlentities($text)); 
        $text = str_replace(get_html_translation_table(), "-", $text);
        $text = str_replace(" ", "_", $text);
        $text = preg_replace("/[-]+/i", "_", $text);
        return $text;
    }

    public function index()
    {
        $resultUnitKerja = MasterUnitKerjaDiklat::all();
        $resultJenisKegiatan = MasterJenisKegiatanDiklat::all();

        $query = MasterTarifDiklat::select('jenis_praktikan_id', 'jenis_praktikan')
                    ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                    ->where('m_tarif_diklat.satuan_kegiatan_id', 2)
                    ->distinct()
                    ->get();

        $queryTarifPreKlinik = MasterTarifPelatihanPreKlinik::where('status_tarif', 1)->get();
            $jumlah_tarif = 0;
        foreach ($queryTarifPreKlinik as $item) {
            $jumlah_tarif = number_format($item->jumlah_tarif, 2, '.',',');
        }
        
        return view('layouts.diklat.mou.form-register', compact('resultUnitKerja', 'resultJenisKegiatan', 'jumlah_tarif'));
    }

    public function resume($id)
    {
        $detailTransPendaftaran = TransPendaftaranDiklat::select('t_pendaftaran_diklat.id as pendaftaran_diklat_id', 't_pendaftaran_diklat.surat_diklat_id', 't_pendaftaran_diklat.acara_diklat_id', 't_pendaftaran_diklat.jumlah_peserta_tambahan', 't_pendaftaran_diklat.tgl_pendaftaran','kode_pendaftaran', 't_pendaftaran_diklat.jumlah_peserta', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 'status_pendaftaran', 'm_tarif_diklat.jasa_sarana', 'm_tarif_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 'tarif_honorarium', 't_pendapatan_diklat.total_waktu', 'total_tarif', 'f_status', 'no_surat_diklat', 'tgl_surat_diklat', 'perihal', 'surat_dari', 'nama_instansi', 'kota_instansi', 'nama_kegiatan', 'alias', 'jenis_praktikan', 'file_surat_permohonan', 'tarif_pre_klinik')
                            ->leftJoin('t_pendapatan_diklat', 't_pendaftaran_diklat.id', '=', 't_pendapatan_diklat.pendaftaran_diklat_id')
                            ->leftJoin('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                            ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                            ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                            ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                            ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                            ->where('t_pendaftaran_diklat.id', base64_decode($id))
                            ->get();

        $detail = [];
        foreach ($detailTransPendaftaran as $item) {
            $detail = [
                'pendaftaran_diklat_id' => $item->pendaftaran_diklat_id,
                'surat_diklat_id'   => $item->surat_diklat_id,
                'acara_diklat_id'   => $item->acara_diklat_id,
                'tgl_pendaftaran'   => $item->tgl_pendaftaran,
                'jumlah_peserta_tambahan' => $item->jumlah_peserta_tambahan,
                'kode_pendaftaran'  => $item->kode_pendaftaran,
                'jumlah_peserta'    => $item->jumlah_peserta,
                'file_surat_permohonan' => $item->file_surat_permohonan,
                'tgl_mulai'         => $item->tgl_mulai,
                'tgl_akhir'         => $item->tgl_akhir,
                'status_pendaftaran'=> $item->status_pendaftaran,
                'jasa_sarana'       => $item->jasa_sarana,
                'jumlah'            => $item->jumlah,
                'tarif_honorarium'  => $item->tarif_honorarium,
                'total_tarif'       => $item->total_tarif,
                'total_waktu'       => $item->total_waktu,
                'f_status'          => $item->f_status,
                'no_surat_diklat'   => $item->no_surat_diklat,
                'tgl_surat_diklat'  => $item->tgl_surat_diklat,
                'perihal'           => $item->perihal,
                'surat_dari'        => $item->surat_dari,
                'nama_instansi'     => $item->nama_instansi,
                'kota_instansi'     => $item->kota_instansi,
                'nama_kegiatan'     => $item->nama_kegiatan,
                'alias'             => $item->alias,
                'jenis_praktikan'   => $item->jenis_praktikan,
                'tarif_pre_klinik'  => $item->tarif_pre_klinik,
                'total_tarif_praktik' => $item->jumlah * ($item->jumlah_peserta + $item->jumlah_peserta_tambahan) * $item->total_waktu,
                'total_tarif_pre_klinik' => $item->tarif_pre_klinik * ($item->jumlah_peserta + $item->jumlah_peserta_tambahan),
                'total_biaya_diklat' => ($item->jumlah * ($item->jumlah_peserta + $item->jumlah_peserta_tambahan) * $item->total_waktu) + $item->tarif_pre_klinik * ($item->jumlah_peserta + $item->jumlah_peserta_tambahan),
            ];  
        }

        return view('layouts.diklat.mou.form-resume', compact('detail'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tgl_surat_diklat'      => 'required|date',
            'no_surat_diklat'       => 'required',
            'unit_kerja_id'         => 'required',
            'jenis_kegiatan_id'     => 'required',
            'satuan_kegiatan_id'    => 'required',
            'total_waktu'           => 'required',
            'tgl_awal'              => 'required|date',
            'tgl_akhir'             => 'required|date',
            'jenis_praktikan_id'    => 'required',
            'jumlah_peserta'        => 'required',
            'jumlah_peserta_tambahan' => 'nullable',
            'nama_peserta'          => 'required',
            'email'                 => 'required',
            'no_hp'                 => 'required',
            'surat_permohonan'      => 'required|mimes:pdf|max:512'
        ]);

        if (Auth::user()->daftar_mou_diklat_id == null) {
            dd('daftar_mou_diklat_id = NULL');
        }

        $getDaftarMOU = MasterDaftarMOUDiklat::findOrFail(Auth::user()->daftar_mou_diklat_id);
        if ($surat = $request->file('surat_permohonan')) {
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

        $insertSuratDiklat = TransSuratDiklat::create([
            'user_id'           => Auth::user()->id,
            'no_surat_diklat'   => $validatedData['no_surat_diklat'],
            'tgl_surat_diklat'  => $validatedData['tgl_surat_diklat'],
            'file_surat_permohonan' => $uploadFile,
            'perihal'           => 'Permohonan Ijin Diklat',
            'surat_dari'        => $getDaftarMOU->jabatan_tdd_mou.' '.$getDaftarMOU->nama_instansi,
            'nama_instansi'     => $getDaftarMOU->nama_instansi,
            'kota_instansi'     => $getDaftarMOU->kota_instansi,
            'tgl_mulai'         => $validatedData['tgl_awal'],
            'tgl_akhir'         => $validatedData['tgl_akhir'],
        ]);

        $insertPendaftaranDiklat = TransPendaftaranDiklat::create([
            'user_id'           => Auth::user()->id,
            'surat_diklat_id'   => $insertSuratDiklat['id'],
            'kode_pendaftaran'  => $this->getAutoKode(),
            'jumlah_peserta'    => $validatedData['jumlah_peserta'],
            'jumlah_peserta_tambahan' => $validatedData['jumlah_peserta_tambahan'],
            'tgl_mulai'         => $validatedData['tgl_awal'],
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

        TransPendapatanDiklat::create([
            'pendaftaran_diklat_id' => $insertPendaftaranDiklat['id'],
            'surat_diklat_id'       => $insertSuratDiklat['id'],
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

        $countData = count($validatedData['nama_peserta']);
        if ($countData > 0) {
            foreach ($validatedData['nama_peserta'] as $item => $value) {
                $dataArrInsert = [
                    'pendaftaran_diklat_id' => $insertPendaftaranDiklat->id,
                    'surat_diklat_id'       => $insertSuratDiklat->id,
                    'jenis_praktikan_id'    => $validatedData['jenis_praktikan_id'],
                    'user_id'               => Auth::user()->id,
                    'nama'                  => $validatedData['nama_peserta'][$item],
                    'email'                 => $validatedData['email'][$item],
                    'no_hp'                 => $validatedData['no_hp'][$item],
                ];
                TransPesertaDiklat::create($dataArrInsert);
            }
        }

        return redirect('register-training/'.base64_encode($insertPendaftaranDiklat['id']).'/resume')
                ->with(['success' => 'Permohonan diklat berhasil di ajukan.']);
    }

    public function kirimPermohonan(Request $request)
    {
        $validatedData = $request->validate([
            'pendaftaran_diklat_id'  => 'required',
        ]);

        TransPendaftaranDiklat::findOrFail(base64_decode($validatedData['pendaftaran_diklat_id']))->update([
            'status_pendaftaran'    => 1,
        ]);

        TransPendapatanDiklat::where('pendaftaran_diklat_id', base64_encode($validatedData['pendaftaran_diklat_id']))->update([
            'f_status'  => 0,
        ]);

        return redirect('register-training')
                ->with(['success' => 'Permohonan diklat berhasil diajukan, harap tunggu 2x24 jam kami akan segera mengkonfirmasi permohonan anda. Terimakasih.']);
    }

    public function batalPermohonan(Request $request)
    {
        $validatedData = $request->validate([
            'pendaftaran_diklat_id'  => 'required',
        ]);
        
        TransPendaftaranDiklat::findOrFail(base64_decode($validatedData['pendaftaran_diklat_id']))->update([
            'status_pendaftaran'    => 4,
        ]);

        TransPendapatanDiklat::where('pendaftaran_diklat_id', base64_encode($validatedData['pendaftaran_diklat_id']))->update([
            'f_status'  => 2,
        ]);

        return redirect('register-training')
                ->with(['success' => 'Permohonan diklat telah dibatalkan, terimakasih.']);
    }
}
