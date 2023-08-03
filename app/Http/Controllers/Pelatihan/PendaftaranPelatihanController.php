<?php

namespace App\Http\Controllers\Pelatihan;

use App\Http\Controllers\Controller;
use App\Models\MasterAcaraDiklat;
use App\Models\TransPendaftaranDiklat;
use App\Models\TransPendapatanDiklat;
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
            'user_id'           => 'required|integer',
            'surat_diklat_id'   => 'nullable',
            'acara_diklat_id'   => 'required|integer',
            'jumlah_peserta'    => 'required|integer',
            'tgl_mulai'         => 'required|date',
            'tgl_selesai'       => 'required|date',
        ]);

        $tgl_pendaftaran = date_create('Y-m-d H:i:s');

        $insertPendaftaranDiklat = TransPendaftaranDiklat::create([
            'user_id'           => Auth::user()->id,
            'surat_diklat_id'   => '',
            'acara_diklat_id'   => base64_decode($validatedData['acara_diklat_id']),
            'kode_pendaftaran'  => $this->getAutoKode(),
            'jumlah_peserta'    => $validatedData['jumlah_peserta'],
            'tgl_mulai'         => $validatedData['tgl_mulai'],
            'tgl_akhir'         => $validatedData['tgl_selesai'],
            'tgl_pendaftaran'   => $tgl_pendaftaran,
            'status_pendaftaran'=> 1
        ]);

        $countData = count($data['nama_peserta']);
        if ($countData > 0) {
            foreach ($data['nama_peserta'] as $item => $value) {
                $dataInsert = [
                    'nama'  => $data['nama_peserta'][$item],
                    'email' => $data['email'][$item],
                    'no_hp' => $data['no_hp'][$item],
                ];
            }
        }

        $masterAcaraDiklat = MasterAcaraDiklat::findOrFail('acara_diklat_id');

        TransPendapatanDiklat::create([
            'pendaftaran_diklat_id' => $insertPendaftaranDiklat['id'],
            'surat_diklat_id'       => '',
            'tarif_diklat_id'       => '',
            'honorarium_diklat_id'  => '',
            'user_id'               => Auth::user()->id,
            'jasa_sarana'           => $masterAcaraDiklat->biaya_per_orang - 60/100,
            'jasa_lainnya'          => $masterAcaraDiklat->biaya_per_orang - 40/100,
            'tarif_honorarium'      => '',
            'jumlah_peserta'        => $validatedData['jumlah_peserta'],
            'total_waktu'           => $validatedData['total_waktu'],
            'total_tarif'           => $masterAcaraDiklat->biaya_per_orang * $validatedData['jumlah_peserta'],
            'f_status'              => 0
        ]);

        $max_time_bayar = date_add($tgl_pendaftaran, date_interval_create_from_date_string('30 minutes'));

        return redirect('dashboard/admin/pendaftaran-diklat/pembayaran/'.base64_encode($this->getAutoKode()))
                ->with(['success' => "Silahkan lakukan pembayaran paling lambat pukul $max_time_bayar dengan transfef Bank BRI / Bank BPD Jawa Tengah"]);
    }
}
