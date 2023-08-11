<style>
    .print {
        font-family: "Times New Roman", Times, serif;
        font-size: 11pt;
    }
</style>

<div class="print">
    <img src="assets/images/system/kop_surat.png" alt="Kop Surat">

    <table>
        <tr>
            <td></td>
            <td align="center">Jepara, {{ date('d F Y') }}</td>
        </tr>
        <tr>
            <td width="80">
                <ul style="list-style-type:none;">
                    <li>Nomor</li>
                    <li>Lamp</li>
                    <li>Perihal</li>
                </ul>
            </td>
            <td width="200">
                <ul style="list-style-type:none;">
                    <li>: 445/191/III/2023</li>
                    <li>: -</li>
                    <li>: Ijin Penelitian</li>
                </ul>
            </td>
            <td width="250" align="left">Kepada <br>Yth. {{ $detail->surat_dari }}<br>Di <b>{{ $detail->kota_instansi }}</b>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td width="20"></td>
            <td>Dengan hormat, </td>
        </tr>
        <tr>
            <td width="20"></td>
            <td width="490" style="text-align: justify; text-justify: inter-word;">
                &nbsp; Berdasarkan surat {{ $detail->surat_dari }} nomor {{ $detail->no_surat_diklat }} tentang {{ strtolower($detail->perihal) }} bersama ini kami beritahukan bahwa 
                sebagai upaya peningkatan mutu dan keselamatan pasien didalam kegiatan pendidikan klinis, maka prosedur penerimaan peserta pendidikan klinis di 
                RSUD dr. Rehatta Provinsi Jawa Tengah adalah sebagai berikut: <br>
                A. Tahap Pre Klinik (dilaksanakan sebelum masa pembelajaran klinik dimulai)
            </td>
            <td width="20"></td>
        </tr>
        <tr>
            <td width="20"></td>
            <td width="490" style="text-align: justify; text-justify: inter-word;">
                <ol style="text-align: justify; text-justify: inter-word;">
                    <li>Pelatihan Kompetensi Dasar (1 hari).</li> 
                    <li>Assesmen Kompetensi Dasar (1 hari).</li>
                    <li>Penerbitan Sertifikat Kompetensi Dasar (berlaku 1 tahun).</li>
                    <li>Kredensial Peserta Didik dan Tenaga Pendidik Klinis (Pembimbing Akademik).</li>
                    <li>Penerbitan Surat Penugasan Klinik dan Rincian Kewenangan Klinik oleh direktur RSUD dr. Rehatta Provinsi Jawa Tengah (berlaku 1 tahun).</li>
                    <li>Biaya kegiatan pre klinik di bebenkan kepada instansi pengingim peserta didik klinis sebesar Rp. {{ number_format($detail->tarif_pre_klinik, 2, ',', '.') }} / peserta.</li>
                </ol>
            </td>
        </tr>
        <tr>
            <td width="20"></td>
            <td width="490" style="text-align: justify; text-justify: inter-word;">
                B. Proses Pembelajaran Klinis
            </td>
            <td width="20"></td>
        </tr>
        <tr>
            <td width="20"></td>
            <td width="490" style="text-align: justify; text-justify: inter-word;">
                <ol style="text-align: justify; text-justify: inter-word;">
                    <li>Koordinasi tantang kompetensi dan batasan kewenangan klinis.</li>
                    <li>Serah terima.</li>
                    <li>Pelaksanaan pembelajaran klinis.</li>
                    <li>Pengumpulan nilai.</li>
                    <li>Penarikan peserta didik klinis.</li>
                </ol>
            </td>
            <td width="20"></td>
        </tr>
        <tr>
            <td width="20"></td>
            <td width="490" style="text-align: justify; text-justify: inter-word;">
                Untuk melengkapi administrasi kegiatan tersebut mohon institusi pendidikan dapat melampirkan:
            </td>
            <td width="20"></td>
        </tr>
        <tr>
            <td width="20"></td>
            <td width="490" style="text-align: justify; text-justify: inter-word;">
                <ol style="text-align: justify; text-justify: inter-word;">
                    <li>Melampirkan Surat Penyataan bahwa calon peserta pendidik klinis yang akan dikirimkan sudah dinyatakan kompeten melalui penilaian/asessmen akademik pada aspek kompetensi yang akan dicapai di dalam pendidik klinis.</li>
                    <li>Melampirkan Daftar Kompetensi.</li>
                    <li>Melampirkan daftar calon peserta pendidikan klinis.</li>
                    <li>Praktik dilaksanakan pada tanggal <b>{{ date('d F Y', strtotime($detail->tgl_mulai)) . ' s.d ' . date('d F Y', strtotime($detail->tgl_akhir)) }}</b>.</li>
                    <li>Jumlah peserta sebanyak {{ $detail->jumlah_peserta }} peserta dengan tingkat pendidikan {{ $detail->jenis_praktikan }}.</li>
                    <li>Biaya administrasi {{ strtolower($detail->nama_kegiatan) }} adalah sebagai berikut:</li>
                </ol>
            </td>
            <td width="20"></td>
        </tr>
        <tr>
            <td width="50"></td>
            <td width="490">
                <table border="0.1" cellpadding="1" width="100%">
                    <tr>
                        <td rowspan="2" width="30" align="center">No</td>
                        <td rowspan="2" width="150" align="center">Unsur Pembiayaan</td>
                        <td colspan="2" width="280" align="center">Detail Administrasi</td>
                    </tr>
                    <tr>
                        <td width="180" align="center">Rincian</td>
                        <td width="100" align="center">Jumlah</td>
                    </tr>
                    <tr>
                        <td align="center">1</td>
                        <td>Biaya {{ strtolower($detail->nama_kegiatan) }} (Pergub Jateng Nomor 58 tahun 2020)</td>
                        <td width="180">Rp. {{ number_format($detail->jumlah, 2, ',', '.') }} <b>x</b> {{ $detail->jumlah_peserta }} Org <b>x</b> {{ $detail->total_waktu . ' ' . $detail->alias }}</td>
                        <td width="100" align="right">Rp. {{ number_format($detail->jumlah * $detail->jumlah_peserta * $detail->total_waktu, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td align="center">2</td>
                        <td>Pelatihan Kompetensi Dasar & Kredensial (Perdir nomor 910/304/VII/2023)</td>
                        <td>Rp. {{ number_format($detail->tarif_pre_klinik, 2, ',', '.') }} <b>x</b> {{ $detail->jumlah_peserta_tambahan }} Org</td>
                        <td align="right">Rp. {{ number_format($detail->tarif_pre_klinik * $detail->jumlah_peserta_tambahan, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">TOTAL</td>
                        <td align="right">Rp. {{ number_format($detail->total_tarif, 2, ',', '.') }}</td>
                    </tr>
                </table>
            </td>
            <td width="20"></td>
        </tr>
        <tr><td></td></tr>
        <tr>
            <td width="20"></td>
            <td style="text-align: justify; text-justify:
            inter-word;">
                &nbsp;&nbsp;&nbsp; Untuk koordinasi selanjutnya dapat menghubung CP Diklitbang RSUD dr. Rehatta Provinsi Jawa Tengah Ns. Andy Sofyan P. M.Kep (081390411944).
                Demikian, atas perhatian dan kerjasamanya disampaikan terimakasih.
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td></td>
            <td align="center"><b>DIREKTUR RSUD dr. REHATTA</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>PROVINSI JAWA TENGAH</b></td>
        </tr>
    </table>
    <br><br><br><br>
    <table>
        <tr>
            <td></td>
            <td align="center"><b><u>dr. Agung Pribadi, M,Kes. M.Si. Med. Sp.B</u></b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>Pembina TK I</b></td>
        </tr>
        <tr>
            <td></td>
            <td align="center"><b>NIP. 197011112005011003</b></td>
        </tr>
    </table>
</div>
