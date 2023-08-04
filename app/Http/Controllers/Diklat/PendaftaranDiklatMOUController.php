<?php

namespace App\Http\Controllers\Diklat;

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

class PendaftaranDiklatMOUController extends Controller
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

        $resultDaftarMOU = MasterDaftarMOUDiklat::paginate(10);

        return view('layouts.diklat.pendaftaran-diklat-mou.index', compact('resultUnitKerja', 'resultJenisKegiatan', 'jumlah_tarif', 'resultDaftarMOU'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customRadioPilih'  => 'required',
            'surat_permohonan'  => 'required|mimes:pdf|max:2048',
            'unit_kerja_id'     => 'required|integer',
            'jenis_kegiatan_id' => 'required|integer',
            'satuan_kegiatan_id'=> 'required|integer',
            'jenis_praktikan_id'=> 'required|integer',

            'total_waktu'       => 'required|integer',
            'tgl_mulai'         => 'required|date',
            'tgl_akhir'         => 'required|date',
            'jumlah_peserta'    => 'required|integer',
            'jumlah_peserta_tambahan' => 'nullable',

            'nama_peserta'      => 'required',
            'email'             => 'required|unique:t_pendaftaran_diklat',
            'no_hp'             => 'required',
        ]);

        $getDaftarMOU = MasterDaftarMOUDiklat::findOrFail(base64_decode($validatedData['customRadioPilih']));

        $queryTarifPreKlinik = MasterTarifPelatihanPreKlinik::where('status_tarif', 1)->get();
        $jumlah_tarif_pre_klinik = '';
        foreach ($queryTarifPreKlinik as $item) {
            $jumlah_tarif_pre_klinik = $item->jumlah_tarif;
        }

        $insertSuratDiklat = TransSuratDiklat::create([
            'user_id'           => Auth::user()->id,
            'no_surat_diklat'   => '',
            'tgl_surat_diklat'  => date_create('Y-m-d'),
            'perihal'           => 'Permohonan Ijin Diklat',
            'surat_dari'        => $getDaftarMOU->jabatan_tdd_mou.' '.$getDaftarMOU->nama_instansi,
            'nama_instansi'     => $getDaftarMOU->nama_instansi,
            'kota_instansi'     => $getDaftarMOU->kota_instansi,
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_akhir'         => $validatedData['tgl_akhir'],
        ]);

        $insertPendaftaranDiklat = TransPendaftaranDiklat::create([
            'user_id'           => Auth::user()->id,
            'surat_diklat_id'   => $insertSuratDiklat['id'],
            'kode_pendaftaran'  => $this->getAutoKode(),
            'jumlah_peserta'    => $validatedData['jumlah_peserta'],
            'jumlah_perserta_tambahan' => $validatedData['jumlah_perserta_tambahan'],
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_akhir'         => $validatedData['tgl_akhir'],
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
        if ($validatedData['jumlah_perserta_tambahan']) {
            $fix_total_tarif = ($validatedData['jumlah_perserta_tambahan'] * $jumlah_tarif_pre_klinik) + $total_tarif;
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
            'jumlah_perserta_tambahan' => $validatedData['jumlah_perserta_tambahan'],
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
                    'email'                 => $validatedData['email'][$item],
                    'no_hp'                 => $validatedData['no_hp'][$item],
                ];
                TransPesertaDiklat::create($dataArrInsert);
            }
        }

        return redirect('dashboard/admin/pendaftaran')
                ->with(['success' => 'Permohonan diklat berhasil di ajukan.']);
    }
}
