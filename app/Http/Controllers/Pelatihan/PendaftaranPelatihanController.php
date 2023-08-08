<?php

namespace App\Http\Controllers\Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\MasterAcaraDiklat;
use App\Models\TransPendaftaranDiklat;
use App\Models\TransPendapatanDiklat;
use App\Models\TransPesertaDiklat;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PendaftaranPelatihanController extends Controller
{
    public function getKuotaPendaftarPelatihan($id)
    {
        $query = TransPendaftaranDiklat::where('acara_diklat_id', $id)->get();
        return $query->count();
    }

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

    public function index()
    {
        $resultAcaraPelatihan = MasterAcaraDiklat::where('status', 1)->orderBy('id', 'DESC')->get();
        return view('layouts.pelatihan.pendaftaran-pelatihan.index', compact('resultAcaraPelatihan'));
    }

    public function registrasi($id)
    {
        $detail                 = MasterAcaraDiklat::findOrFail(base64_decode($id));
        $sisa_kuota_pendaftar   = $detail->role_max_peserta - $this->getKuotaPendaftarPelatihan(base64_decode($id));
        return view('layouts.pelatihan.pendaftaran-pelatihan.registrasi', compact('detail', 'sisa_kuota_pendaftar'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([
            'surat_diklat_id'   => 'nullable',
            'acara_diklat_id'   => 'required',
            'jumlah_peserta'    => 'required|integer',
            'tgl_mulai'         => 'required|date',
            'tgl_selesai'       => 'required|date',
        ]);

        $tgl_pendaftaran = date('Y-m-d H:i:s');

        $insertPendaftaranDiklat = TransPendaftaranDiklat::create([
            'user_id'           => Auth::user()->id,
            'surat_diklat_id'   => NULL,
            'acara_diklat_id'   => base64_decode($validatedData['acara_diklat_id']),
            'kode_pendaftaran'  => $this->getAutoKode(),
            'jumlah_peserta'    => $validatedData['jumlah_peserta'],
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_akhir'         => $validatedData['tgl_selesai'],
            'tgl_pendaftaran'   => $tgl_pendaftaran,
            'status_pendaftaran'=> 0
        ]);

        $countData = count($data['nama_peserta']);
        if ($countData > 0) {
            foreach ($data['nama_peserta'] as $item => $value) {
                $dataInsert = [
                    'pendaftaran_diklat_id' => $insertPendaftaranDiklat['id'],
                    'surat_diklat_id'   => NULL,
                    'jenis_praktikan_id'=> NULL,
                    'user_id'   => Auth::user()->id,
                    'nama'  => $data['nama_peserta'][$item],
                    'email' => $data['email'][$item],
                    'no_hp' => $data['no_hp'][$item],
                ];
                TransPesertaDiklat::create($dataInsert);
            }
        }

        $masterAcaraDiklat = MasterAcaraDiklat::findOrFail(base64_decode($validatedData['acara_diklat_id']));

        TransPendapatanDiklat::create([
            'pendaftaran_diklat_id' => $insertPendaftaranDiklat['id'],
            'surat_diklat_id'       => NULL,
            'tarif_diklat_id'       => NULL,
            'honorarium_diklat_id'  => NULL,
            'user_id'               => Auth::user()->id,
            'jasa_sarana'           => $masterAcaraDiklat->biaya_per_orang - 60/100,
            'jasa_lainnya'          => $masterAcaraDiklat->biaya_per_orang - 40/100,
            'tarif_honorarium'      => 0,
            'jumlah_peserta'        => $validatedData['jumlah_peserta'],
            'total_waktu'           => 1,
            'total_tarif'           => $masterAcaraDiklat->biaya_per_orang * $validatedData['jumlah_peserta'],
            'f_status'              => 3,
        ]);

        return redirect('dashboard/admin/pendaftaran-pelatihan/resume/'.base64_encode($insertPendaftaranDiklat['id']).'/paket')
                ->with(['success' => "Silahkan lakukan pembayaran paling lambat pukul XXX dengan transfef Bank BRI / Bank BPD Jawa Tengah"]);
    }

    public function resume($kode)
    {
        $getPendaftaranDiklat = TransPendaftaranDiklat::findOrFail(base64_decode($kode));

        $detailTransPendaftaran = TransPendaftaranDiklat::select('t_pendaftaran_diklat.id as pendaftaran_diklat_id', 't_pendaftaran_diklat.surat_diklat_id', 't_pendaftaran_diklat.acara_diklat_id', 't_pendaftaran_diklat.jumlah_peserta_tambahan', 't_pendaftaran_diklat.tgl_pendaftaran','kode_pendaftaran', 't_pendaftaran_diklat.jumlah_peserta', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 'status_pendaftaran', 'm_tarif_diklat.jasa_sarana', 'm_tarif_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 'tarif_honorarium', 't_pendapatan_diklat.total_waktu', 'total_tarif', 'f_status', 'no_surat_diklat', 'tgl_surat_diklat', 'perihal', 'surat_dari', 'nama_instansi', 'kota_instansi', 'nama_kegiatan', 'alias', 'jenis_praktikan', 'file_surat_permohonan', 'tarif_pre_klinik', 'nama_diklat', 'browsur', 'catatan', 'biaya_per_orang')
                            ->leftJoin('t_pendapatan_diklat', 't_pendaftaran_diklat.id', '=', 't_pendapatan_diklat.pendaftaran_diklat_id')
                            ->leftJoin('m_acara_diklat', 't_pendaftaran_diklat.acara_diklat_id', '=', 'm_acara_diklat.id')
                            ->leftJoin('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                            ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                            ->leftJoin('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                            ->leftJoin('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                            ->leftJoin('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                            ->where('t_pendaftaran_diklat.id', base64_decode($kode))
                            ->get();

        $detail = [];
        foreach ($detailTransPendaftaran as $item) {
            $detail = [
                'nama_diklat'       => $item->nama_diklat,
                'browsur'           => $item->browsur,
                'catatan'           => $item->catatan,
                'biaya_per_orang'   => $item->biaya_per_orang,

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
                'total_biaya_prelatihan' => $item->biaya_per_orang * $item->jumlah_peserta,
                'total_tarif_praktik' => $item->jumlah * ($item->jumlah_peserta + $item->jumlah_peserta_tambahan) * $item->total_waktu,
                'total_tarif_pre_klinik' => $item->tarif_pre_klinik * ($item->jumlah_peserta + $item->jumlah_peserta_tambahan),
                'total_biaya_diklat' => ($item->jumlah * ($item->jumlah_peserta + $item->jumlah_peserta_tambahan) * $item->total_waktu) + $item->tarif_pre_klinik * ($item->jumlah_peserta + $item->jumlah_peserta_tambahan),
            ];  
        }

        if ($getPendaftaranDiklat->count() == 0) {
            return view('inc.error-page-404');
        }

        return view('layouts.pelatihan.pendaftaran-pelatihan.resume', with([
            'detail'        => $detail,
            'resultPeserta' => TransPesertaDiklat::where('pendaftaran_diklat_id', base64_decode($kode))->get()
        ]));
    }
}
