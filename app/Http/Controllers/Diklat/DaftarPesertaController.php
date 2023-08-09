<?php

namespace App\Http\Controllers\Diklat;

use App\Http\Controllers\Controller;
use App\Models\MasterHonorariumDiklat;
use App\Models\MasterJenisKegiatanDiklat;
use App\Models\MasterTarifPelatihanPreKlinik;
use App\Models\MasterUnitKerjaDiklat;
use App\Models\TransPendaftaranDiklat;
use App\Models\TransPendapatanDiklat;
use App\Models\TransSuratDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DaftarPesertaController extends Controller
{
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
                            ->orderBy('t_pendaftaran_diklat.id', 'DESC')
                            ->paginate(10);
        return view('layouts.diklat.daftar-peserta.index', with([
            'resultDaftarPeserta'   => $getDaftarDiklat,
        ]));
    }

    public function edit($kode_pendaftaran)
    {
        $getDaftarDiklat = TransPendaftaranDiklat::select('t_pendaftaran_diklat.id as pendaftaran_diklat_id', 't_pendaftaran_diklat.surat_diklat_id', 't_pendaftaran_diklat.acara_diklat_id', 't_pendaftaran_diklat.jumlah_peserta_tambahan', 't_pendaftaran_diklat.tgl_pendaftaran','kode_pendaftaran', 't_pendaftaran_diklat.jumlah_peserta', 't_pendaftaran_diklat.tgl_mulai', 't_pendaftaran_diklat.tgl_akhir', 'status_pendaftaran', 'm_tarif_diklat.jasa_sarana', 'm_tarif_diklat.jasa_lainnya', 'm_tarif_diklat.jumlah', 'tarif_honorarium', 't_pendapatan_diklat.total_waktu', 'total_tarif', 'f_status', 'no_surat_diklat', 'tgl_surat_diklat', 'perihal', 'surat_dari', 'nama_instansi', 'kota_instansi', 'nama_kegiatan', 'alias', 'jenis_praktikan')
                            ->leftJoin('t_pendapatan_diklat', 't_pendaftaran_diklat.id', '=', 't_pendapatan_diklat.pendaftaran_diklat_id')
                            ->leftJoin('t_surat_diklat', 't_pendaftaran_diklat.surat_diklat_id', '=', 't_surat_diklat.id')
                            // ->leftJoin('t_peserta_diklat', 't_pendaftaran_diklat.id', '=', 't_peserta_diklat.pendaftaran_diklat_id')
                            ->leftJoin('m_tarif_diklat', 't_pendapatan_diklat.tarif_diklat_id', '=', 'm_tarif_diklat.id')
                            ->join('m_jenis_kegiatan', 'm_tarif_diklat.jenis_kegiatan_id', '=', 'm_jenis_kegiatan.id')
                            ->join('m_satuan_kegiatan', 'm_tarif_diklat.satuan_kegiatan_id', '=', 'm_satuan_kegiatan.id')
                            ->join('m_jenis_praktikan', 'm_tarif_diklat.jenis_praktikan_id', '=', 'm_jenis_praktikan.id')
                            ->where('kode_pendaftaran', base64_decode($kode_pendaftaran))
                            ->get();

        $detail = [];
        foreach ($getDaftarDiklat as $item) {
            $detail = [
                'pendaftaran_diklat_id' => $item->pendaftaran_diklat_id,
                'surat_diklat_id'   => $item->surat_diklat_id,
                'acara_diklat_id'   => $item->acara_diklat_id,
                'tgl_pendaftaran'   => $item->tgl_pendaftaran,
                'jumlah_peserta_tambahan' => $item->jumlah_peserta_tambahan,
                'kode_pendaftaran'  => $item->kode_pendaftaran,
                'jumlah_peserta'    => $item->jumlah_peserta,
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
            ];
        }

        $queryTarifPreKlinik = MasterTarifPelatihanPreKlinik::where('status_tarif', 1)->get();
            $jumlah_tarif = 0;
        foreach ($queryTarifPreKlinik as $item) {
            $jumlah_tarif = number_format($item->jumlah_tarif, 2, '.',',');
        }
        
        return view('layouts.diklat.daftar-peserta.edit', with([
            'detail'                => $detail,
            'resultUnitKerja'       => MasterUnitKerjaDiklat::all(),
            'resultJenisKegiatan'   => MasterJenisKegiatanDiklat::all(),
            'jumlah_tarif'          => $jumlah_tarif,
        ]));
    }

    public function update(Request $request, $pendaftaran_diklat_id)
    {
        $validatedData = $request->validate([
            'no_surat_diklat'       => 'required',
            'tgl_surat_diklat'      => 'required|date',
            'perihal'               => 'required',
            'surat_dari'            => 'required',
            'nama_instansi'         => 'required',
            'kota_instansi'         => 'required',
            'tgl_mulai'             => 'required|date',
            'tgl_akhir'             => 'required|date',

            'unit_kerja_id'         => 'required|integer',
            'jenis_kegiatan_id'     => 'required|integer',
            'satuan_kegiatan_id'    => 'required|integer',
            'total_waktu'           => 'required|integer',
            'jenis_praktikan_id'    => 'required|integer',
            'jumlah_peserta'        => 'required|integer',
            'opsi_honorarium'       => 'required',
            'jumlah_peserta_tambahan'   => 'nullable|integer',

            'surat_diklat_id'       => 'required',
            'kode_pendaftaran'      => 'required',
        ]);

        $queryTarifPreKlinik = MasterTarifPelatihanPreKlinik::where('status_tarif', 1)->get();
        $jumlah_tarif_pre_klinik = '';
        foreach ($queryTarifPreKlinik as $item) {
            $jumlah_tarif_pre_klinik = $item->jumlah_tarif;
        }

            TransSuratDiklat::findOrFail(base64_decode($validatedData['surat_diklat_id']))->update([
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

        TransPendaftaranDiklat::findOrFail(base64_decode($pendaftaran_diklat_id))->update([
            'user_id'           => Auth::user()->id,
            'surat_diklat_id'   => base64_decode($validatedData['surat_diklat_id']),
            'kode_pendaftaran'  => base64_decode($validatedData['kode_pendaftaran']),
            'jumlah_peserta'    => $validatedData['jumlah_peserta'],
            'jumlah_peserta_tambahan' => $validatedData['jumlah_peserta_tambahan'],
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
        if ($validatedData['jumlah_peserta_tambahan']) {
            $fix_total_tarif = ($validatedData['jumlah_peserta_tambahan'] * $jumlah_tarif_pre_klinik) + $total_tarif;
        } else {
            $fix_total_tarif = $total_tarif;
        }

        TransPendapatanDiklat::where('pendaftaran_diklat_id', base64_decode($pendaftaran_diklat_id))->update([
            'pendaftaran_diklat_id' => base64_decode($pendaftaran_diklat_id),
            'surat_diklat_id'       => base64_decode($validatedData['surat_diklat_id']),
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
            'f_status'              => 0
        ]);

        return redirect('dashboard/admin/daftar-peserta')
                ->with(['success' => 'Data berhasil di update.']);
    }

    public function cancelRegister(Request $request)
    {
        $validatedData = $request->validate([
            'id'       => 'required|string',
        ]);

        TransPendaftaranDiklat::findOrFail(base64_decode($validatedData['id']))->update([
            'status_pendaftaran'    => 4,
        ]);

        TransPendapatanDiklat::findOrFail(base64_decode($validatedData['id']))->update([
            'f_status'  => 2,
        ]);

        return redirect('dashboard/admin/daftar-peserta')->with(['success' => 'Data pendaftaran berhasil di batalkan.']);
    }
}
