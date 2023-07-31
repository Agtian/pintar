<?php

namespace App\Http\Controllers\Diklat;

use App\Http\Controllers\Controller;
use App\Models\MasterHonorariumDiklat;
use App\Models\MasterJenisKegiatanDiklat;
use App\Models\MasterTarifDiklat;
use App\Models\MasterUnitKerjaDiklat;
use App\Models\TransPendaftaranDiklat;
use App\Models\TransPendapatanDiklat;
use App\Models\TransSuratDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendaftaranDiklatController extends Controller
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

        return view('layouts.diklat.pendaftaran-diklat.index', compact('resultUnitKerja', 'resultJenisKegiatan'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_surat_diklat'   => 'required|unique:t_surat_diklat,no_surat_diklat',
            'tgl_surat_diklat'  => 'required|date',
            'perihal'           => 'required',
            'surat_dari'        => 'required',
            'nama_instansi'     => 'required',
            'kota_instansi'     => 'required',
            'tgl_mulai'         => 'required|date',
            'tgl_akhir'         => 'required|date',

            'unit_kerja_id'     => 'required|integer',
            'jenis_kegiatan_id' => 'required|integer',
            'satuan_kegiatan_id'=> 'required|integer',
            'total_waktu'       => 'required|integer',
            'jenis_praktikan_id'=> 'required|integer',
            'jumlah_peserta'    => 'required|integer',

            'opsi_honorarium'   => 'required',
        ]);

        $insertSuratDiklat = TransSuratDiklat::create([
            'user_id'           => Auth::user()->id,
            'no_surat_diklat'   => $validatedData['no_surat_diklat'],
            'tgl_surat_diklat'  => $validatedData['tgl_surat_diklat'],
            'perihal'           => $validatedData['perihal'],
            'surat_dari'        => $validatedData['surat_dari'],
            'nama_instansi'     => $validatedData['nama_instansi'],
            'kota_instansi'     => $validatedData['kota_instansi'],
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_akhir'         => $validatedData['tgl_akhir'],
        ]);

        $insertPendaftaranDiklat = TransPendaftaranDiklat::create([
            'user_id'           => Auth::user()->id,
            'surat_diklat_id'   => $insertSuratDiklat['id'],
            'kode_pendaftaran'  => $this->getAutoKode(),
            'jumlah_peserta'    => $validatedData['jumlah_peserta'],
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_akhir'         => $validatedData['tgl_akhir'],
            'status_pendaftaran'=> 1, // aktif, belum lunas
        ]);

        $tarif_diklat_id        = $this->getTarifDiklat($request->jenis_kegiatan_id, $request->satuan_kegiatan_id, $request->jenis_praktikan_id)['id'];
        $jasa_sarana            = $this->getTarifDiklat($request->jenis_kegiatan_id, $request->satuan_kegiatan_id, $request->jenis_praktikan_id)['jasa_sarana'];
        $jasa_lainnya           = $this->getTarifDiklat($request->jenis_kegiatan_id, $request->satuan_kegiatan_id, $request->jenis_praktikan_id)['jasa_lainnya'];
        $jumlah                 = $this->getTarifDiklat($request->jenis_kegiatan_id, $request->satuan_kegiatan_id, $request->jenis_praktikan_id)['jumlah'];
        $honorarium_diklat_id   = $this->getHonorariumDiklat($request->opsi_honorarium, $request->satuan_kegiatan_id)['id'];
        $tarif_honorarium       = $this->getHonorariumDiklat($request->opsi_honorarium, $request->satuan_kegiatan_id)['tarif_honorarium'];

        $total_tarif = (($jumlah * $request->jumlah_peserta) * $request->total_waktu) + (($tarif_honorarium * $request->jumlah_peserta) * $request->total_waktu);

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
            'total_waktu'           => $validatedData['total_waktu'],
            'total_tarif'           => $total_tarif,
            'f_status'              => 0
        ]);

        return redirect('dashboard/admin/pendaftaran-diklat')
                ->with(['success' => 'Surat balasan dan rincian retribusi diklat berhasil dibuat. Selanjutnya segera input biodata masing-masing peserta agar peserta terdata oleh sistem.']);
    }
}
