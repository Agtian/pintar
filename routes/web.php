<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterPartnership;
use App\Http\Controllers\BillingDiklat\PembayaranDiklatController;
use App\Http\Controllers\BillingDiklat\RekapPendapatan;
use App\Http\Controllers\Dashboard\DashboardAdmin;
use App\Http\Controllers\Dashboard\DashboardInstansi;
use App\Http\Controllers\Dashboard\DashboardKasir;
use App\Http\Controllers\Dashboard\DashboardPesertaDiklat;
use App\Http\Controllers\Dashboard\DashboardPetugasDiklat;
use App\Http\Controllers\Diklat\DaftarPesertaController;
use App\Http\Controllers\Diklat\MOU\DataPendaftaranController;
use App\Http\Controllers\Diklat\MOU\RegisterTrainingController;
use App\Http\Controllers\Diklat\PendaftaranDiklatController;
use App\Http\Controllers\Diklat\PendaftaranDiklatMOUController;
use App\Http\Controllers\Diklat\SuratBalasanController;
use App\Http\Controllers\HomeDashboard\HomeDashboard;
use App\Http\Controllers\KelolaPelatihan\DaftarPelatihanController;
use App\Http\Controllers\Master\DaftarMOU\DaftarMOUController;
use App\Http\Controllers\Master\HonorariumDiklat\HonorariumDiklatController;
use App\Http\Controllers\Master\JenisKegiatan\JenisKegiatanController;
use App\Http\Controllers\Master\JenisPraktikan\JenisPraktikanController;
use App\Http\Controllers\Master\Pegawai\PegawaiController;
use App\Http\Controllers\Master\SatuanKegiatan\SatuanKegiatanController;
use App\Http\Controllers\Master\TarifDiklat\TarifDiklatController;
use App\Http\Controllers\Master\TarifPelatihanPreKlinik\TarifPelatihanPreKlinikController;
use App\Http\Controllers\Master\UnitKerja\UnitKerjaController;
use App\Http\Controllers\Output\PrintOut\PdfDiklatController;
use App\Http\Controllers\Pelatihan\PendaftaranPelatihanController;
use App\Http\Controllers\SystemController\AuthController;
use App\Http\Controllers\SystemController\DropdownController;
use App\Http\Controllers\SystemController\GetDataController;
use App\Http\Controllers\SystemController\RedirectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/redirect', [RedirectController::class, 'cek']);
Route::get('/login/redirect', [RedirectController::class, 'cek']);

// Jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-app', [AuthController::class, 'dologin'])->name('dologin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Jika user petugas diklat
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'cek']);

    Route::get('/dashboard', [DashboardPetugasDiklat::class, 'index']);
});

// Jika user admin
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'cek']);

    Route::get('/dashboard', [DashboardAdmin::class, 'index']);
});

// Jika user kasir
Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'cek']);

    Route::get('/dashboard', [DashboardKasir::class, 'index']);
});

// Jika user peserta mou
Route::group(['middleware' => ['auth', 'checkrole:4']], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'cek']);

    Route::get('/dashboard', [DashboardInstansi::class, 'index']);
});

// Jika user peserta diklat
Route::group(['middleware' => ['auth', 'checkrole:5']], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'cek']);

    Route::get('/dashboard', [DashboardPesertaDiklat::class, 'index']);
});





// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/register-partnership', [RegisterPartnership::class, 'register'])->name('register-partnership');
Route::get('/register-user/{kode}/confirm', [RegisterPartnership::class, 'index']);
Route::post('/confirmation-register', [RegisterPartnership::class, 'confirmationRegister'])->name('confirmation-register');

// Route::get('/dashboard/dashboard-v1', [App\Http\Controllers\Dashboard\DashboardV1::class, 'index'])->name('dashboard-v1');
// Route::get('/dashboard/dashboard-v2', [App\Http\Controllers\Dashboard\DashboardV2::class, 'index'])->name('dashboard-v2');
// Route::get('/dashboard/dashboard-v3', [App\Http\Controllers\Dashboard\DashboardV3::class, 'index'])->name('dashboard-v3');

Route::get('/home-dashboard', [HomeDashboard::class, 'index'])->name('home-dashboard');

Route::post('api/fetch-satuan-kegiatan-diklat', [DropdownController::class, 'getSatuanKegiatan']);
Route::post('api/fetch-jenis-praktikan-diklat', [DropdownController::class, 'getJenisPraktikan']);
Route::get('api/fetch-table-peserta-diklat/{kode}/result', [DropdownController::class, 'getTablePesertaDiklat']);
Route::get('/api/fetch-get-pegawai', [GetDataController::class, 'getSelectPegawais']);

Route::controller(RegisterTrainingController::class)->group(function () {
    Route::get('/register-training', 'index');
    Route::get('/register-training/create', 'create');
    Route::post('/register-training', 'store');
    Route::post('/register-training/kirim', 'kirimPermohonan');
    Route::post('/register-training/batal', 'batalPermohonan');
    Route::get('/register-training/{register}/resume', 'resume');
    Route::put('/register-training/{register}', 'update');
    Route::get('/register-training/{register}/delete', 'destroy');
});

// Route::controller(DataPendaftaranController::class)->group(function () {
//     Route::get('/data-pendaftaran', 'index');
//     Route::get('/data-pendaftaran/create', 'create');
//     Route::post('/data-pendaftaran', 'store');
//     Route::post('/data-pendaftaran/kirim-permohonan', 'storePerhonan');
//     Route::get('/data-pendaftaran/printout/{kode}/view', 'getSuratPermohonan');
//     Route::get('/data-pendaftaran/{kode}/edit', 'edit');
//     Route::put('/data-pendaftaran/{kode}', 'update');
//     Route::get('/data-pendaftaran/{kode}/delete', 'destroy');
// });

// Route::prefix('dashboard/admin')->middleware(['auth', 'isAdmin'])->group(function () {
//     // Route::controller(GetDataController::class)->group(function () {
//     //     Route::post('/api/fetch-get-pegawai', 'getSelectPegawais')->name('getSelectPegawais');
//     // });

//     Route::controller(UserController::class)->group(function () {
//         Route::get('/user', 'index');
//         Route::get('/user/create', 'create');
//         Route::post('/user', 'store');
//         Route::get('/user/{user}/edit', 'edit');
//         Route::put('/user/{user}', 'update');
//         Route::get('/user/{user}/delete', 'destroy');
//     });

//     Route::controller(PegawaiController::class)->group(function () {
//         Route::get('/master-pegawai', 'index');
//         Route::get('/master-pegawai/create', 'create');
//         Route::post('/master-pegawai', 'store');
//         Route::get('/master-pegawai/{pegawai}/edit', 'edit');
//         Route::put('/master-pegawai/{pegawai}', 'update');
//         Route::get('/master-pegawai/{pegawai}/delete', 'destroy');
//     });

//     Route::controller(DaftarMOUController::class)->group(function () {
//         Route::get('/master-daftar-mou', 'index');
//         Route::get('/master-daftar-mou/create', 'create');
//         Route::post('/master-daftar-mou', 'store');
//         Route::get('/master-daftar-mou/akses/{daftarmou}/edit', 'akses');
//         Route::get('/master-daftar-mou/{daftarmou}/edit', 'edit');
//         Route::put('/master-daftar-mou/{daftarmou}', 'update');
//         Route::get('/master-daftar-mou/{daftarmou}/delete', 'destroy');
//     });

//     Route::controller(HonorariumDiklatController::class)->group(function () {
//         Route::get('/master-honorarium', 'index');
//         Route::get('/master-honorarium/create', 'create');
//         Route::post('/master-honorarium', 'store');
//         Route::get('/master-honorarium/{honorarium}/edit', 'edit');
//         Route::put('/master-honorarium/{honorarium}', 'update');
//         Route::get('/master-honorarium/{honorarium}/delete', 'destroy');
//     });

//     Route::controller(TarifDiklatController::class)->group(function () {
//         Route::get('/master-tarif-diklat', 'index');
//         Route::get('/master-tarif-diklat/create', 'create');
//         Route::post('/master-tarif-diklat', 'store');
//         Route::get('/master-tarif-diklat/{tarifdiklat}/edit', 'edit');
//         Route::put('/master-tarif-diklat/{tarifdiklat}', 'update');
//         Route::get('/master-tarif-diklat/{tarifdiklat}/delete', 'destroy');
//     });

//     Route::controller(TarifPelatihanPreKlinikController::class)->group(function () {
//         Route::get('/master-tarif-pelatihan-pre-klinik', 'index');
//         Route::get('/master-tarif-pelatihan-pre-klinik/create', 'create');
//         Route::post('/master-tarif-pelatihan-pre-klinik', 'store');
//         Route::get('/master-tarif-pelatihan-pre-klinik/{tarifpreklinik}/edit', 'edit');
//         Route::put('/master-tarif-pelatihan-pre-klinik/{tarifpreklinik}', 'update');
//         Route::get('/master-tarif-pelatihan-pre-klinik/{tarifpreklinik}/delete', 'destroy');
//     });

//     Route::controller(JenisKegiatanController::class)->group(function () {
//         Route::get('/master-jenis-kegiatan', 'index');
//         Route::get('/master-jenis-kegiatan/create', 'create');
//         Route::post('/master-jenis-kegiatan', 'store');
//         Route::get('/master-jenis-kegiatan/{jeniskegiatan}/edit', 'edit');
//         Route::put('/master-jenis-kegiatan/{jeniskegiatan}', 'update');
//         Route::get('/master-jenis-kegiatan/{jeniskegiatan}/delete', 'destroy');
//     });

//     Route::controller(JenisPraktikanController::class)->group(function () {
//         Route::get('/master-jenis-praktikan', 'index');
//         Route::get('/master-jenis-praktikan/create', 'create');
//         Route::post('/master-jenis-praktikan', 'store');
//         Route::get('/master-jenis-praktikan/{jenispraktikan}/edit', 'edit');
//         Route::put('/master-jenis-praktikan/{jenispraktikan}', 'update');
//         Route::get('/master-jenis-praktikan/{jenispraktikan}/delete', 'destroy');
//     });

//     Route::controller(SatuanKegiatanController::class)->group(function () {
//         Route::get('/master-satuan-kegiatan', 'index');
//         Route::get('/master-satuan-kegiatan/create', 'create');
//         Route::post('/master-satuan-kegiatan', 'store');
//         Route::get('/master-satuan-kegiatan/{satuankegiatan}/edit', 'edit');
//         Route::put('/master-satuan-kegiatan/{satuankegiatan}', 'update');
//         Route::get('/master-satuan-kegiatan/{satuankegiatan}/delete', 'destroy');
//     });

//     Route::controller(UnitKerjaController::class)->group(function () {
//         Route::get('/master-unit-kerja', 'index');
//         Route::get('/master-unit-kerja/create', 'create');
//         Route::post('/master-unit-kerja', 'store');
//         Route::get('/master-unit-kerja/{unitkerja}/edit', 'edit');
//         Route::put('/master-unit-kerja/{unitkerja}', 'update');
//         Route::get('/master-unit-kerja/{unitkerja}/delete', 'destroy');
//     });

//     Route::controller(PendaftaranDiklatController::class)->group(function () {
//         Route::get('/pendaftaran-diklat', 'index');
//         Route::get('/pendaftaran-diklat/create', 'create');
//         Route::post('/pendaftaran-diklat', 'store');
//         Route::get('/pendaftaran-diklat/{pendaftarandiklat}/edit', 'edit');
//         Route::put('/pendaftaran-diklat/{pendaftarandiklat}', 'update');
//         Route::get('/pendaftaran-diklat/{pendaftarandiklat}/delete', 'destroy');
//     });

//     Route::controller(PendaftaranDiklatMOUController::class)->group(function () {
//         Route::get('/pendaftaran', 'index');
//         Route::get('/pendaftaran/create', 'create');
//         Route::post('/pendaftaran', 'store');
//         Route::post('/pendaftaran/kirim', 'kirimPermohonan');
//         Route::post('/pendaftaran/batal', 'batalPermohonan');
//         Route::get('/pendaftaran/{pendaftaran}/resume', 'resume');
//         Route::get('/pendaftaran/{pendaftaran}/edit', 'edit');
//         Route::put('/pendaftaran/{pendaftaran}', 'update');
//         Route::get('/pendaftaran/{pendaftaran}/delete', 'destroy');
//     });

//     Route::controller(DaftarPesertaController::class)->group(function () {
//         Route::get('/daftar-peserta', 'index');
//         Route::get('/daftar-peserta/create', 'create');
//         Route::post('/daftar-peserta', 'store');
//         Route::get('/daftar-peserta/{daftarpeserta}/edit', 'edit');
//         Route::put('/daftar-peserta/{daftarpeserta}', 'update');
//         Route::get('/daftar-peserta/{daftarpeserta}/delete', 'destroy');
//     });

//     Route::controller(PembayaranDiklatController::class)->group(function () {
//         Route::get('/pembayaran-diklat', 'index');
//         Route::get('/pembayaran-diklat/create', 'create');
//         Route::post('/pembayaran-diklat', 'store');
//         Route::get('/pembayaran-diklat/{pembayarandiklat}/edit', 'edit');
//         Route::put('/pembayaran-diklat/{pembayarandiklat}', 'update');
//         Route::get('/pembayaran-diklat/{pembayarandiklat}/delete', 'destroy');
//     });

//     Route::controller(RekapPendapatan::class)->group(function () {
//         Route::get('/rekap-pendapatan', 'index');
//         Route::get('/rekap-pendapatan/create', 'create');
//         Route::post('/rekap-pendapatan', 'store');
//         Route::post('/rekap-pendapatan/filter', 'filter');
//         Route::get('/rekap-pendapatan/{rekappendapatan}/edit', 'edit');
//         Route::put('/rekap-pendapatan/{rekappendapatan}', 'update');
//         Route::get('/rekap-pendapatan/{rekappendapatan}/delete', 'destroy');
//     });

//     Route::controller(PendaftaranPelatihanController::class)->group(function () {
//         Route::get('/pendaftaran-pelatihan', 'index');
//         Route::get('/pendaftaran-pelatihan/create', 'create');
//         Route::post('/pendaftaran-pelatihan', 'store');
//         Route::get('/pendaftaran-pelatihan/registrasi/{namapelatihan}/reg', 'registrasi');
//         Route::get('/pendaftaran-pelatihan/resume/{namapelatihan}/paket', 'resume');
//         Route::get('/pendaftaran-pelatihan/{pendaftaranpelatihan}/edit', 'edit');
//         Route::put('/pendaftaran-pelatihan/{pendaftaranpelatihan}', 'update');
//         Route::get('/pendaftaran-pelatihan/{pendaftaranpelatihan}/delete', 'destroy');
//     });

//     Route::controller(DaftarPelatihanController::class)->group(function () {
//         Route::get('/daftar-pelatihan', 'index');
//         Route::get('/daftar-pelatihan/create', 'create');
//         Route::post('/daftar-pelatihan', 'store');
//         Route::get('/daftar-pelatihan/{daftarpelatihan}/edit', 'edit');
//         Route::put('/daftar-pelatihan/{daftarpelatihan}', 'update');
//         Route::get('/daftar-pelatihan/{daftarpelatihan}/delete', 'destroy');
//     });

//     Route::controller(PdfDiklatController::class)->group(function () {
//         Route::get('/printout-diklat', 'index');
//         Route::get('/printout-diklat/create', 'create');
//         Route::post('/printout-diklat', 'store');
//         Route::get('/printout-diklat/{kode}/edit', 'edit');
//         Route::put('/printout-diklat/{kode}', 'update');
//         Route::get('/printout-diklat/{kode}/delete', 'destroy');

//         Route::get('/printout-diklat/surat-balasan/{kode}/pdf', 'suratBalasan');
//         Route::get('/printout-diklat/surat-balasan-i/{kode}/pdf', 'suratBalasanV1');
//     });
// });
