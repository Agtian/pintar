<style>
    .print {
        font-family: "Times New Roman", Times, serif;
    }
</style>

<div class="print">
    <img src="assets/image_akun/kop_surat.png" alt="Kop Surat">

    <table>
        <tr>
            <td></td>
            <td></td>
        </tr>
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
            <td>
                <ul style="list-style-type:none;">
                    <li>: 445/191/III/2023</li>
                    <li>: -</li>
                    <li>: Ijin Penelitian</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td width="280"></td>
            <td width="250" align="left">Kepada <br>Yth. {{ $detail->surat_dari }} <br>Di
                <b>{{ $detail->kota_instansi }}</b>
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
            <td width="490" style="text-align: justify; text-justify:
            inter-word;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Memperhatikan surat dari {{ $detail->kota_instansi }}
                Nomor {{ $detail->no_surat_diklat }} tanggal
                {{ date('d F Y', strtotime($detail->tgl_surat_diklat)) }}, perihal
                {{ $detail->perihal }}, pada prinsipnya kami menyetujui RSUD Kelet Provinsi Jawa Tengah sebagai tempat
                {{ strtolower($detail->nama_kegiatan) }}, dengan ketentuan sebagai berikut :
            </td>
            <td width="20"></td>
        </tr>
        <tr>
            <td width="20"></td>
            <td>
                <ol>
                    <li>{{ $detail->nama_kegiatan }} dilaksanakan Tanggal
                        {{ date('d F', strtotime($detail->tgl_mulai)) . ' s.d ' . date('d F', strtotime($detail->tgl_akhir)) }}.
                    </li>
                    <li>Peserta {{ strtolower($detail->nama_kegiatan) }} berjumlah
                        {{ $detail->jumlah_peserta }} orang.</li>
                    <li>Biaya administrasi {{ strtolower($detail->nama_kegiatan) }}, dan sesuai Peraturan Gubernur Jawa
                        Tengah Nomor : 58 Tahun 2020, dengan rincian :
                        <ul style="list-style-type:none;">
                            <li>
                                <table style="margin-left= 600px;">
                                    @if ($detail['tarif_honorarium'] == 0)
                                        <tr>
                                            <td width="280">- Biaya {{ $detail->nama_kegiatan }} Rp
                                                {{ number_format($detail->jumlah, 2, ',', '.') }} <b>*</b>
                                                {{ $detail->jumlah_peserta }} Org <b>*</b>
                                                {{ $detail->total_waktu . ' ' . $detail->alias }}</td>
                                            <td> = Rp {{ number_format($detail->total_tarif, 2, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td width="280"> &nbsp;Total biaya</td>
                                            <td> = Rp {{ number_format($detail->total_tarif, 2, ',', '.') }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td width="280">- Biaya Honorarium, CI Rp.
                                                {{ number_format($detail->jumlah, 2, ',', '.') }}
                                                <b>*</b>
                                                {{ $detail->jumlah_peserta }} Org <b>*</b>
                                                {{ $detail->total_waktu . ' ' . $detail->alias }}
                                            </td>
                                            <td> = Rp
                                                {{ number_format($detail->jumlah * $detail->jumlah_peserta * $detail->total_waktu, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="280">- Biaya Honorarium, CI Rp
                                                {{ number_format($detail->tarif_honorarium, 2, ',', '.') }} <b>*</b>
                                                {{ $detail->jumlah_peserta }} Org <b>*</b>
                                                {{ $detail->total_waktu . ' ' . $detail->alias }}
                                            </td>
                                            <td> = Rp
                                                {{ number_format($detail->tarif_honorarium * $detail->jumlah_peserta * $detail->total_waktu, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="280"> &nbsp;Total biaya</td>
                                            <td> = Rp. {{ $detail->total_tarif }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </li>
                        </ul>
                    </li>
                </ol>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td width="20"></td>
            <td style="text-align: justify; text-justify:
            inter-word;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat persetujuan ijin magang/praktik kerja, atas perhatian
                dan
                kerjasamanya
                kami ucapkan terima kasih
            </td>
        </tr>
    </table>
    <br><br>
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
    <br><br><br><br><br>
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

    <br>
    <ol>
        <li>Ka. Bid Pelayanan dan Keperawatan</li>
        <li>Ka. Sie Pelayanan dan Penunjang</li>
        <li>Arsip</li>
    </ol>
</div>
