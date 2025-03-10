<?php
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardControllerNonSiswa;
use App\Http\Controllers\DashboardControllerSU;
use App\Http\Controllers\DashboardControllerSUSiswa;
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\DashboardControllerKepalaSekolah;
use App\Http\Controllers\DashboardControllerKurikulum;
use App\Http\Controllers\DashboardControllerGuru;
use App\Http\Controllers\DashboardControllerSiswa;
use App\Http\Controllers\EkstrakulikulerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\InfoUserControllerAdmin;
use App\Http\Controllers\InfoUserControllerKepalaSekolah;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\InfoUserControllerKurikulum;
use App\Http\Controllers\InfoUserControllerGuru;
use App\Http\Controllers\InfoUserControllerSiswa;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\InfoUserControllerNonSiswa;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\TahunakademikController;
use App\Http\Controllers\TombolController;
use App\Http\Controllers\MatapelajaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileSekolahController;

use App\Http\Controllers\DatamengajarController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\KGSNController;
use App\Http\Controllers\KGSController;
use App\Http\Controllers\ValidasiController;
use App\Http\Controllers\DatasiswaController;
use App\Http\Controllers\ArsipSiswaController;
use App\Http\Controllers\DataguruController;
use App\Http\Controllers\InformasippdbController;
use App\Http\Controllers\OrganisasisiswaController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\PengaturankelasdatamengajarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OsisController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SiswalulusController;
use App\Http\Controllers\EkstrasiswaController;
use App\Http\Controllers\OrganisasikuController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\AdminKepalaSekolahController;
use App\Http\Controllers\KelassiswaController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\EkstrakuController;
use App\Http\Controllers\PengaturankelasController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\StellaController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::group(['middleware' => 'auth'], function () {





//     Route::get('virtual-reality', function () {
// 		return view('virtual-reality');
// 	})->name('virtual-reality');

//     Route::get('static-sign-in', function () {
// 		return view('static-sign-in');
// 	})->name('sign-in');

//     Route::get('static-sign-up', function () {
// 		return view('static-sign-up');
// 	})->name('sign-up');

//     // Route::get('/logout', [SessionsController::class, 'destroy']);
// 	  Route::match(['GET', 'POST'], '/logout', [SessionsController::class, 'destroy'])
//         ->name('logout')
//         ->middleware('auth');
// 	Route::get('/user-profile', [InfoUserController::class, 'create']);
// 	Route::post('/user-profile', [InfoUserController::class, 'store']);
// });
Route::group(['middleware' => 'guest'], function () {
    // Route::get('/register', [RegisterController::class, 'create']);
    // Route::post('/register', [RegisterController::class, 'store']);
    // // Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    // Route::get('/login/forgot-password', [ResetController::class, 'create']);
    // Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    // Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    // Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});
// routes semua roles
Route::middleware(['auth', 'can:isSemua', 'prevent.xss'])->group(function () {
    Route::get('/pengumuman/download/{id}', [PengumumanController::class, 'downloadPengumuman'])->name('download.pengumuman');


});
// route kurikulum, guru, siswa, nonsiswa
Route::middleware(['auth', 'can:isKGSN', 'prevent.xss'])->group(function () {

    Route::get('/pengumumansemua/data', [KGSNController::class, 'getPengumumanKGSN'])->name('pengumumansemua.data');


});
//    kurikulum guru siswa
Route::middleware(['auth', 'can:isKGS', 'prevent.xss'])->group(function () {
    Route::get('/DatasiswaKGS', [KGSController::class, 'indexSiswa'])->name('DatasiswaKGS.index');
    Route::get('/datasiswaKGS/datadatasiswaKGS', [KGSController::class, 'getDatasiswaKGS'])->name('datasiswaKGS.datadatasiswaKGS');
    Route::get('/DataguruKGS', [KGSController::class, 'indexGuru'])->name('DataguruKGS.index');
    Route::get('/dataguruKGS/datadatasiswaKGS', [KGSController::class, 'getDataguruKGS'])->name('dataguruKGS.datadataguruKGS');



});
//    voting su kepsek siswa guru kur admin
Route::middleware(['auth', 'can:isvoting', 'prevent.xss'])->group(function () {

    Route::get('/Voting', [VotingController::class, 'index'])->name('Voting.index');
    Route::post('/Voting', [VotingController::class, 'store'])->name('Voting.store');
    Route::get('/voting/voting', [VotingController::class, 'getVoting'])->name('voting.voting');
    Route::get('/hasil/hasil', [VotingController::class, 'getHasil'])->name('hasil.hasil');


});

//    adminkepalasekolah
Route::middleware(['auth', 'can:isAdminKepalaSekolah', 'prevent.xss'])->group(function () {
    Route::get('/pengumuman/data', [AdminKepalaSekolahController::class, 'getPengumuman'])->name('pengumuman.data');
    Route::post('/dashboardAdmin/store', [AdminKepalaSekolahController::class, 'store'])->name('dashboardAdmin.store');
    Route::post('/dashboardKepalaSekolah/store', [AdminKepalaSekolahController::class, 'storeKP'])->name('dashboardKepalaSekolah.store');
    Route::delete('/pengumuman/delete', [AdminKepalaSekolahController::class, 'deletePengumuman'])->name('pengumuman.delete');
    //kurikulum
    Route::get('/Kurikulum', [KurikulumController::class, 'index'])->name('Kurikulum.index');
    Route::get('/kurikulum/datakurikulum', [KurikulumController::class, 'getUsers'])->name('kurikulum.datakurikulum');
    Route::delete('/kurikulum/delete', [KurikulumController::class, 'deleteUsers'])->name('kurikulum.delete');
    Route::get('Kurikulum/create', [KurikulumController::class, 'create'])->name('Kurikulum.create');
    Route::post('/Kurikulum', [KurikulumController::class, 'store'])->name('Kurikulum.store');
    Route::get('/Kurikulum/edit/{hashedId}', [KurikulumController::class, 'edit'])->name('Kurikulum.edit');
    Route::put('/Kurikulum/{hashedId}', [KurikulumController::class, 'update'])->name('Kurikulum.update');
    // Tahunakademik
    Route::get('/Tahunakademik', [TahunakademikController::class, 'index'])->name('Tahunakademik.index');
    Route::get('/Tahunakademik/datatahunakademik', [TahunakademikController::class, 'getTahunakademik'])->name('tahunakademik.datatahunakademik');
    Route::delete('/Tahunakademik/delete', [TahunakademikController::class, 'deleteTahunakademik'])->name('tahunakademik.delete');
    Route::get('Tahunakademik/create', [TahunakademikController::class, 'create'])->name('Tahunakademik.create');
    Route::post('/Tahunakademik', [TahunakademikController::class, 'store'])->name('Tahunakademik.store');
    Route::get('/Tahunakademik/edit/{hashedId}', [TahunakademikController::class, 'edit'])->name('Tahunakademik.edit');
    Route::put('/Tahunakademik/{hashedId}', [TahunakademikController::class, 'update'])->name('Tahunakademik.update');
    //matapelajaran
    Route::get('/Matapelajaran', [MatapelajaranController::class, 'index'])->name('Matapelajaran.index');
    Route::get('/Matapelajaran/datamatapelajaran', [MatapelajaranController::class, 'getMatapelajaran'])->name('matapelajaran.datamatapelajaran');
    Route::delete('/Matapelajaran/delete', [MatapelajaranController::class, 'deleteMatapelajaran'])->name('matapelajaran.delete');
    Route::get('Matapelajaran/create', [MatapelajaranController::class, 'create'])->name('Matapelajaran.create');
    Route::post('/Matapelajaran', [MatapelajaranController::class, 'store'])->name('Matapelajaran.store');
    Route::get('/Matapelajaran/edit/{hashedId}', [MatapelajaranController::class, 'edit'])->name('Matapelajaran.edit');
    Route::put('/Matapelajaran/{hashedId}', [MatapelajaranController::class, 'update'])->name('Matapelajaran.update');
    //kelas
    Route::get('/Kelas', [KelasController::class, 'index'])->name('Kelas.index');
    Route::get('/Kelas/datakelas', [KelasController::class, 'getKelas'])->name('kelas.datakelas');
    Route::delete('/Kelas/delete', [KelasController::class, 'deleteKelas'])->name('kelas.delete');
    Route::get('Kelas/create', [KelasController::class, 'create'])->name('Kelas.create');
    Route::post('/Kelas', [KelasController::class, 'store'])->name('Kelas.store');
    Route::get('/Kelas/edit/{hashedId}', [KelasController::class, 'edit'])->name('Kelas.edit');
    Route::put('/Kelas/{hashedId}', [KelasController::class, 'update'])->name('Kelas.update');
    //ekstrakulikuler
    Route::get('/Ekstrakulikuler', [EkstrakulikulerController::class, 'index'])->name('Ekstrakulikuler.index');
    Route::get('/Ekstrakulikuler/dataekstrakulikuler', [EkstrakulikulerController::class, 'getEkstrakulikuler'])->name('ekstrakulikuler.dataekstrakulikuler');
    Route::delete('/Ekstrakulikuler/delete', [EkstrakulikulerController::class, 'deleteekstrakulikuler'])->name('ekstrakulikuler.delete');
    Route::get('Ekstrakulikuler/create', [EkstrakulikulerController::class, 'create'])->name('Ekstrakulikuler.create');
    Route::post('/Ekstrakulikuler', [EkstrakulikulerController::class, 'store'])->name('Ekstrakulikuler.store');
    Route::get('/Ekstrakulikuler/edit/{hashedId}', [EkstrakulikulerController::class, 'edit'])->name('Ekstrakulikuler.edit');
    Route::put('/Ekstrakulikuler/{hashedId}', [EkstrakulikulerController::class, 'update'])->name('Ekstrakulikuler.update');
    //organisasi
    Route::get('/Organisasi', [OrganisasiController::class, 'index'])->name('Organisasi.index');
    Route::get('/Organisasi/dataorganisasi', [OrganisasiController::class, 'getOrganisasi'])->name('organisasi.dataorganisasi');
    Route::delete('/Organisasi/delete', [OrganisasiController::class, 'deleteOrganisasi'])->name('organisasi.delete');
    Route::get('Organisasi/create', [OrganisasiController::class, 'create'])->name('Organisasi.create');
    Route::post('/Organisasi', [OrganisasiController::class, 'store'])->name('Organisasi.store');
    Route::get('/Organisasi/edit/{hashedId}', [OrganisasiController::class, 'edit'])->name('Organisasi.edit');
    Route::put('/Organisasi/{hashedId}', [OrganisasiController::class, 'update'])->name('Organisasi.update');
    //tombol
    Route::get('/Tombol', [TombolController::class, 'index'])->name('Tombol.index');
    Route::get('/Tombol/datatombol', [TombolController::class, 'getTombol'])->name('tombol.datatombol');
    Route::delete('/Tombol/delete', [TombolController::class, 'deleteTombol'])->name('tombol.delete');
    Route::get('Tombol/create', [TombolController::class, 'create'])->name('Tombol.create');
    Route::post('/Tombol', [TombolController::class, 'store'])->name('Tombol.store');
    Route::get('/Tombol/edit/{hashedId}', [TombolController::class, 'edit'])->name('Tombol.edit');
    Route::put('/Tombol/{hashedId}', [TombolController::class, 'update'])->name('Tombol.update');
    //Osis
    Route::get('/Osis', [OsisController::class, 'index'])->name('Osis.index');
    Route::get('/Osis/dataosis', [OsisController::class, 'getOsis'])->name('osis.dataosis');
    Route::delete('/Osis/delete', [OsisController::class, 'deleteOsis'])->name('osis.delete');
    Route::get('Osis/create', [OsisController::class, 'create'])->name('Osis.create');
    Route::post('/Osis', [OsisController::class, 'store'])->name('Osis.store');
    Route::get('/Osis/edit/{hashedId}', [OsisController::class, 'edit'])->name('Osis.edit');
    Route::put('/Osis/{hashedId}', [OsisController::class, 'update'])->name('Osis.update');
    // dataguru
    Route::get('/Dataguru', [DataguruController::class, 'index'])->name('Dataguru.index');
    Route::get('/dataguru/datadataguru', [DataguruController::class, 'getDataguru'])->name('dataguru.datadataguru');
    Route::get('/Dataguru/edit/{hashedId}', [DataguruController::class, 'edit'])->name('Dataguru.edit');
    Route::put('/Dataguru/{hashedId}', [DataguruController::class, 'update'])->name('Dataguru.update');
    Route::get('/Dataguruall', [DataguruController::class, 'indexGuruall'])->name('Dataguruall.index');
    Route::get('/dataguruall/datadataguruall', [DataguruController::class, 'getDataguruall'])->name('dataguruall.datadataguruall');
    // datasiswa
    Route::get('/datasiswa/datadatasiswa', [DatasiswaController::class, 'getDatasiswa'])->name('datasiswa.datadatasiswa');
    Route::get('/Datasiswa', [DatasiswaController::class, 'index'])->name('Datasiswa.index');
    Route::get('/Datasiswa/edit/{hashedId}', [DatasiswaController::class, 'edit'])->name('Datasiswa.edit');
    Route::put('/Datasiswa/{hashedId}', [DatasiswaController::class, 'update'])->name('Datasiswa.update');
    Route::get('/Datasiswaall', [DatasiswaController::class, 'indexSiswaall'])->name('Datasiswaall.index');
    Route::get('/datasiswaall/datadatasiswaall', [DatasiswaController::class, 'getDatasiswaall'])->name('datasiswaall.datadatasiswaall');
    // Route::post('/update-status', [DatasiswaController::class, 'updateStatus'])->name('Datasiswa.updateStatus');
// Route::post('/siswa/update-status', [DatasiswaController::class, 'updateStatus'])->name('siswa.updateStatus');
    Route::post('/datasiswa/update-status', [DatasiswaController::class, 'updateStatus'])->name('Datasiswa.updateStatus');

    //siswa lulus
    Route::get('/Siswalulus', [SiswalulusController::class, 'index'])->name('Siswalulus.index');
    Route::get('/Siswalulusall', [SiswalulusController::class, 'indexSiswalulusall'])->name('Siswalulusall.index');
    Route::get('/siswalulus/datasiswalulus', [SiswalulusController::class, 'getSiswalulus'])->name('siswalulus.datasiswalulus');
    Route::get('/siswalulusall/datasiswalulusall', [SiswalulusController::class, 'getSiswalulusall'])->name('siswalulusall.datasiswalulusall');
    Route::get('/siswalulus/edit/{hashedId}', [SiswalulusController::class, 'edit'])->name('Siswalulus.edit');
    Route::post('/siswalulus/update-status=alumni', [SiswalulusController::class, 'updateStatusalumni'])->name('Siswalulus.updateStatusalumni');

    //Arsip
    Route::get('/Siswaarsip', [ArsipSiswaController::class, 'index'])->name('Siswaarsip.index');
    Route::get('/Uploadarsip', [ArsipSiswaController::class, 'indexUpload'])->name('Uploadarsip.index');
    Route::post('/Uploadarsip/store', [ArsipSiswaController::class, 'store'])->name('Uploadarsip.store');
    Route::get('/Siswaarsip/dataarsipsiswa', [ArsipSiswaController::class, 'getArsipsiswa'])->name('arsipsiswa.dataarsipsiswa');
    //Arsipall
    Route::get('/Siswaarsipall', [ArsipSiswaController::class, 'indexArsipall'])->name('Siswaarsip.indexArsipall');
    Route::get('/Siswaarsipall/dataarsipsiswaall', [ArsipSiswaController::class, 'getArsipsiswaall'])->name('arsipsiswaall.dataarsipsiswaall');
    // datamengajar
    Route::get('/Datamengajar', [DatamengajarController::class, 'index'])->name('Datamengajar.index');
    Route::get('/Datamengajar/datamengajar', [DatamengajarController::class, 'getDatamengajar'])->name('datamengajar.datamengajar');
    Route::delete('/Datamengajar/delete', [DatamengajarController::class, 'deleteDatamengajar'])->name('datamengajar.delete');
    Route::get('Datamengajar/create', [DatamengajarController::class, 'create'])->name('Datamengajar.create');
    Route::post('/Datamengajar', [DatamengajarController::class, 'store'])->name('Datamengajar.store');
    Route::get('/Datamengajar/edit/{hashedId}', [DatamengajarController::class, 'edit'])->name('Datamengajar.edit');
    Route::put('/Datamengajar/{hashedId}', [DatamengajarController::class, 'update'])->name('Datamengajar.update');
    // kelassiswa

    Route::get('/Kelassiswa', [KelassiswaController::class, 'index'])->name('Kelassiswa.index');
    Route::get('/Kelassiswa/kelassiswa', [KelassiswaController::class, 'getKelassiswa'])->name('kelassiswa.kelassiswa');
    Route::delete('/Kelassiswa/delete', [KelassiswaController::class, 'deleteKelassiswa'])->name('kelassiswa.delete');
    Route::get('Kelassiswa/create', [KelassiswaController::class, 'create'])->name('Kelassiswa.create');
    Route::get('/Kelassiswa/edit/{hashedId}', [KelassiswaController::class, 'edit'])->name('Kelassiswa.edit');
    Route::put('/Kelassiswa/{hashedId}', [KelassiswaController::class, 'update'])->name('Kelassiswa.update');
    Route::get('/siswa', [KelassiswaController::class, 'getSiswa'])->name('siswa.siswa');
    Route::get('/mengajar', [KelassiswaController::class, 'getDatamengajar'])->name('mengajar.mengajar');
    Route::delete('/Kelassiswashow/hapus', [KelassiswaController::class, 'deleteSiswadarikelas'])->name('kelassiswashow.hapus');
    Route::get('/Kelassiswa/show/{hashedId}', [KelassiswaController::class, 'show'])
        ->name('Kelassiswa.show');
    Route::get('/Kelassiswa/showmatapelajaran/{hashedId}', [KelassiswaController::class, 'showmatapelajaran'])
        ->name('Kelassiswa.showmatapelajaran');
    Route::get('/getkelassiswadetail/{hashedId}', [KelassiswaController::class, 'getSiswa'])->name('getkelassiswadetail.getkelassiswadetail');
    Route::get('/getkelassiswamata/{hashedId}', [KelassiswaController::class, 'getMatapelajaran'])->name('getkelassiswamata.getkelassiswamata');

    Route::post('/Kelassiswa', [KelassiswaController::class, 'store'])->name('Kelassiswa.store');

    Route::get('/Kelassiswa/download/{hashedId}', [KelassiswaController::class, 'previewkelas'])
        ->name('Kelassiswa.download');
    Route::get('/Kelassiswa/{hashedId}', [KelassiswaController::class, 'downloadkelas'])->name('Kelassiswa.downloadkelas');
    Route::get('/Kelassiswa/downloadmata/{hashedId}', [KelassiswaController::class, 'previewmatapelajaran'])
        ->name('Kelassiswa.downloadmata');
    Route::get('/Kelassiswa/{hashedId}', [KelassiswaController::class, 'downloadkelas'])->name('Kelassiswa.downloadkelas');
    Route::get('/Kelassiswadownloadmatapelajaran/{hashedId}', [KelassiswaController::class, 'downloadmatapelajaran'])->name('Kelassiswa.downloadmatapelajaran');


    Route::get('/getSiswadankelas', [KelassiswaController::class, 'getSiswadankelas'])->name('Kelassiswa.getSiswadankelas');
    // pengaturan kelas
    Route::get('/Pengaturankelas', [PengaturankelasController::class, 'index'])->name('Pengaturankelas.index');
    Route::get('/Pengaturankelas/pengaturankelas', [PengaturankelasController::class, 'getPengaturankelas'])->name('pengaturankelas.pengaturankelas');
    Route::delete('/Pengaturankelas/delete', [PengaturankelasController::class, 'deletePengaturankelas'])->name('pengaturankelas.delete');
    Route::get('Pengaturankelas/create', [PengaturankelasController::class, 'create'])->name('Pengaturankelas.create');
    Route::post('/Pengaturankelas', [PengaturankelasController::class, 'store'])->name('Pengaturankelas.store');
    Route::get('/Pengaturankelas/edit/{hashedId}', [PengaturankelasController::class, 'edit'])->name('Pengaturankelas.edit');
    Route::put('/Pengaturankelas/{hashedId}', [PengaturankelasController::class, 'update'])->name('Pengaturankelas.update');

    // //pengaturankelasdatamengajaar
// Route::get('/Pengaturankelasdatamengajar', [PengaturankelasdatamengajarController::class, 'index'])->name('Pengaturankelasdatamengajar.index');
//     Route::get('/Pengaturankelasdatamengajar/Pengaturankelasdatamengajar', [PengaturankelasdatamengajarController::class, 'getPengaturankelasatamengajar'])->name('pengaturankelasdatamengajar.pengaturankelasdatamengajar');
//     Route::delete('/Pengaturankelasdatamengajar/delete', [PengaturankelasdatamengajarController::class, 'deleteKelasdatamengajar'])->name('pengaturankelasdatamengajar.delete');
//     Route::get('Pengaturankelasdatamengajar/create', [PengaturankelasdatamengajarController::class, 'create'])->name('Pengaturankelasdatamengajar.create');
//     Route::get('/Pengaturankelasdatamengajar/edit/{hashedId}', [PengaturankelasdatamengajarController::class, 'edit'])->name('Pengaturankelasdatamengajar.edit');
//     Route::put('/Pengaturankelasdatamengajar/{hashedId}', [PengaturankelasdatamengajarController::class, 'update'])->name('Pengaturankelasdatamengajar.update');

    //ekstrasiswa
    Route::get('/Ekstrasiswa', [EkstrasiswaController::class, 'index'])->name('Ekstrasiswa.index');
    Route::get('/Ekstrasiswa/ekstrasiswa', [EkstrasiswaController::class, 'getEkstrasiswa'])->name('ekstrasiswa.ekstrasiswa');
    Route::get('/ekstrasiswa/downloadekstrasiswa/{hashedId}', [EkstrasiswaController::class, 'previewekstrasiswa'])
        ->name('Ekstrasiswa.previewekstrasiswa');
    Route::get('/Ekstrasiswa/{hashedId}', [EkstrasiswaController::class, 'downloadekstrasiswa'])->name('Ekstrasiswa.downloadekstrasiswa');
    Route::get('/Ekstrasiswa/show/{hashedId}', [EkstrasiswaController::class, 'show'])
        ->name('Ekstrasiswa.show');
    Route::get('/getekstrasiswadetail/{hashedId}', [EkstrasiswaController::class, 'getEkstra'])->name('getekstrasiswadetail.getekstrasiswadetail');
    Route::delete('/Ekstrasiswashow/hapus', [EkstrasiswaController::class, 'deleteSiswadarikelas'])->name('ekstrasiswashow.hapus');
    Route::delete('/Ekstrasiswa/delete', [EkstrasiswaController::class, 'deleteEkstrasiswa'])->name('ekstrasiswa.delete');
    Route::get('/Ekstrasiswa/download/{hashedId}', [EkstrasiswaController::class, 'previewekstrasiswa'])
        ->name('Ekstrasiswa.download');
    // Route::get('/Kelassiswadownloadmatapelajaran/{hashedId}', [KelassiswaController::class, 'downloadmatapelajaran'])->name('Kelassiswa.downloadmatapelajaran');
// 
//organisasi siswa
    Route::get('/Organisasisiswa', [OrganisasisiswaController::class, 'index'])->name('Organisasisiswa.index');
    Route::get('/Organisasisiswa/organisasisiswa', [OrganisasisiswaController::class, 'getOrganisasisiswa'])->name('organisasisiswa.organisasisiswa');
    Route::get('/organisasisiswa/downloadorganisasisiswa/{hashedId}', [OrganisasisiswaController::class, 'previeweOrganisasisiswa'])
        ->name('Organisasisiswa.previeworganisasisiswa');
    Route::get('/Organisasisiswa/{hashedId}', [OrganisasisiswaController::class, 'downloadorganisasisiswa'])->name('Organisasisiswa.downloadorganisasisiswa');
    Route::get('/Organisasisiswa/show/{hashedId}', [OrganisasisiswaController::class, 'show'])
        ->name('Organisasisiswa.show');
    Route::get('/getorganisasisiswadetail/{hashedId}', [OrganisasisiswaController::class, 'getOrganisasi'])->name('getorganisasisiswadetail.getorganisasisiswadetail');
    Route::delete('/Organisasisiswashow/hapus', [OrganisasisiswaController::class, 'deleteSiswadarikelas'])->name('organisasisiswashow.hapus');
    Route::delete('/Organisasisiswa/delete', [OrganisasisiswaController::class, 'deleteOrganisasisiswa'])->name('organisasisiswa.delete');
    Route::get('/Organisasisiswa/download/{hashedId}', [OrganisasisiswaController::class, 'previeworganisasisiswa'])
        ->name('Organisasisiswa.download');
    // siswa baru
    Route::get('/Siswabaru', [PpdbController::class, 'indexppdb'])->name('Siswabaru.indexppdb');
    Route::get('/siswabaru/siswabaru', [PpdbController::class, 'getPpdbs'])->name('siswabaru.siswabaru');
    Route::delete('/siswabaru/delete', [PpdbController::class, 'deletesiswabaru'])->name('siswabaru.delete');
    Route::get('/Siswabaru/edit/{hashedId}', [PpdbController::class, 'edit'])->name('Siswabaru.edit');
    Route::put('/Siswabaru/{hashedId}', [PpdbController::class, 'update'])->name('Siswabaru.update');
    Route::post('/Siswabaru/updatestatus', [PpdbController::class, 'updateStatus'])->name('siswabaru.updateStatus');
    // validasi
    Route::get('/Validasi', [ValidasiController::class, 'index'])->name('Validasi.index');
    Route::get('/validasi/validasi', [ValidasiController::class, 'getValidasi'])->name('validasi.validasi');
    Route::get('/Validasi/edit/{hashedId}', [ValidasiController::class, 'edit'])->name('Validasi.edit');
    Route::put('/Validasi/{hashedId}', [ValidasiController::class, 'update'])->name('Validasi.update');
    //url youtube
    Route::get('/Youtube', [YoutubeController::class, 'index'])->name('Youtube.index');
    Route::get('/youtube/youtube', [YoutubeController::class, 'getYoutube'])->name('youtube.youtube');
    Route::delete('/Youtube/delete', [YoutubeController::class, 'deleteYoutube'])->name('youtube.delete');
    Route::get('Youtube/create', [YoutubeController::class, 'create'])->name('Youtube.create');
    Route::post('/Youtube', [YoutubeController::class, 'store'])->name('Youtube.store');
    Route::get('/Youtube/edit/{hashedId}', [YoutubeController::class, 'edit'])->name('Youtube.edit');
    Route::put('/Youtube/{hashedId}', [YoutubeController::class, 'update'])->name('Youtube.update');
    //url Berita
    Route::get('/Berita', [BeritaController::class, 'index'])->name('Berita.index');
    Route::get('/berita/berita', [BeritaController::class, 'getBerita'])->name('berita.berita');
    Route::delete('/Berita/delete', [BeritaController::class, 'deleteBerita'])->name('berita.delete');
    Route::get('Berita/create', [BeritaController::class, 'create'])->name('Berita.create');
    Route::post('/Berita', [BeritaController::class, 'store'])->name('Berita.store');
    Route::get('/Berita/edit/{hashedId}', [BeritaController::class, 'edit'])->name('Berita.edit');
    Route::put('/Berita/{hashedId}', [BeritaController::class, 'update'])->name('Berita.update');
    //url profile
    Route::get('/Profile', [ProfileController::class, 'index'])->name('Profile.index');
    Route::get('/profile/profile', [ProfileController::class, 'getProfile'])->name('profile.profile');
    Route::delete('/Profile/delete', [ProfileController::class, 'deleteProfile'])->name('profile.delete');
    Route::get('Profile/create', [ProfileController::class, 'create'])->name('Profile.create');
    Route::post('/Profile', [ProfileController::class, 'store'])->name('Profile.store');
    Route::get('/Profile/edit/{hashedId}', [ProfileController::class, 'edit'])->name('Profile.edit');
    Route::put('/Profile/{hashedId}', [ProfileController::class, 'update'])->name('Profile.update');
    //url profile sekolah
    Route::get('/Sekolah', [ProfilesekolahController::class, 'index'])->name('Sekolah.index');
    Route::get('/sekolah/sekolah', [ProfilesekolahController::class, 'getSekolah'])->name('sekolah.sekolah');
    Route::delete('/Sekolah/delete', [ProfilesekolahController::class, 'deleteSekolah'])->name('sekolah.delete');
    Route::get('Sekolah/create', [ProfilesekolahController::class, 'create'])->name('Sekolah.create');
    Route::post('/Sekolah', [ProfilesekolahController::class, 'store'])->name('Sekolah.store');
    Route::get('/Sekolah/edit/{hashedId}', [ProfilesekolahController::class, 'edit'])->name('Sekolah.edit');
    Route::put('/Sekolah/{hashedId}', [ProfilesekolahController::class, 'update'])->name('Sekolah.update');
 //Informasi
 Route::get('/Informasi', [InformasippdbController::class, 'index'])->name('Informasi.index');
 Route::get('/informasi/informasi', [InformasippdbController::class, 'getInformasippdb'])->name('informasi.informasi');
 Route::delete('/Informasi/delete', [InformasippdbController::class, 'deleteInformasippdb'])->name('informasi.delete');
 Route::get('Informasi/create', [InformasippdbController::class, 'create'])->name('Informasi.create');
 Route::post('/Informasi', [InformasippdbController::class, 'store'])->name('Informasi.store');
 Route::get('/Informasi/edit/{hashedId}', [InformasippdbController::class, 'edit'])->name('Informasi.edit');
 Route::put('/Informasi/{hashedId}', [InformasippdbController::class, 'update'])->name('Informasi.update');
    // Route::get('/Kelassiswa/showmatapelajaran/{hashedId}', [KelassiswaController::class, 'showmatapelajaran'])
 Route::get('/Alumniall', [AlumniController::class, 'Alumniall'])->name('Alumniall.index');
 Route::get('/alumniall/alumniall', [AlumniController::class, 'getAlumniall'])->name('alumniall.alumniall');
 Route::get('/Alumniall/edit/{hashedId}', [AlumniController::class, 'edit'])->name('Alumniall.edit');
 Route::put('/Alumniall/{hashedId}', [AlumniController::class, 'update'])->name('Alumniall.update');
    // Route::get('/Kelassiswa/showmatapelajaran/{hashedId}', [KelassiswaController::class, 'showmatapelajaran'])
// ->name('Kelassiswa.showmatapelajaran');
});
Route::middleware(['auth', 'can:isSU', 'prevent.xss'])->group(function () {
    // Route::get('/', [HomeController::class, 'home']);
    // Route::get('dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    // // Route::get('/logout', [SessionsController::class, 'destroy']);

    // Route::get('billing', function () {
    //     return view('billing');
    // })->name('billing');

    // Route::get('profile', function () {
    //     return view('profile');
    // })->name('profile');

    // Route::get('rtl', function () {
    //     return view('rtl');
    // })->name('rtl');

    // Route::get('user-management', function () {
    //     return view('laravel-examples/user-management');
    // })->name('user-management');

    // Route::get('tables', function () {
    //     return view('tables');
    // })->name('tables');
    // SU

    Route::get('/dashboardSU', [DashboardControllerSU::class, 'index'])->name('dashboardSU.index');
    Route::get('/users/dataguru', [DashboardControllerSU::class, 'getUsers'])->name('users.dataguru');
    Route::delete('/users/delete', [DashboardControllerSU::class, 'deleteUsers'])->name('users.delete');
    Route::get('/user-profileSU', [InfoUserController::class, 'create'])->name('user-profileSU.create');
    Route::put('/user-profileSU', [InfoUserController::class, 'store'])->name('user-profileSU.store');
    Route::get('/DatakuSU', [InfoUserController::class, 'createdataku'])->name('DatakuSU.createdataku');
    Route::put('/DatakuSU', [InfoUserController::class, 'storeall'])->name('DatakuSU.storeall');
    Route::get('dashboardSU/create', [DashboardControllerSU::class, 'create'])->name('dashboardSU.create');
    Route::post('/dashboardSU', [DashboardControllerSU::class, 'store'])->name('dashboardSU.store');
    Route::get('/dashboardSU/edit1/{hashedId}', [DashboardControllerSU::class, 'edit'])->name('dashboardSU.edit1');
    Route::put('/dashboardSU/{hashedId}', [DashboardControllerSU::class, 'update'])->name('dashboardSU.update');

    //    SUSiswa
    Route::get('/dashboardSUSiswa', [DashboardControllerSUSiswa::class, 'indexSiswa'])->name('dashboardSUSiswa.indexSiswa');
    Route::get('/users/data', [DashboardControllerSUSiswa::class, 'getUsersSiswa'])->name('users.data');
    Route::delete('/users/delete', [DashboardControllerSUSiswa::class, 'deleteUsersSiswa'])->name('users.delete');
    Route::get('dashboardSUSiswa/createSiswa', [DashboardControllerSUSiswa::class, 'createSiswa'])->name('dashboardSUSiswa.createSiswa');
    Route::post('/dashboardSUSiswa', [DashboardControllerSUSiswa::class, 'storeSiswa'])->name('dashboardSUSiswa.storeSiswa');
    Route::get('/dashboardSUSiswa/editSiswa/{hashedId}', [DashboardControllerSUSiswa::class, 'editSiswa'])->name('dashboardSUSiswa.editSiswa');
    Route::put('/dashboardSUSiswa/{hashedId}', [DashboardControllerSUSiswa::class, 'updateSiswa'])->name('dashboardSUSiswa.updateSiswa');




});
Route::middleware(['auth', 'can:isAdmin', 'prevent.xss'])->group(function () {
    // Admin
    Route::get('/dashboardAdmin', [DashboardControllerAdmin::class, 'index'])->name('dashboardAdmin.index');
    Route::get('/DatakuAdmin', [InfoUserControllerAdmin::class, 'createdataku'])->name('DatakuAdmin.createdataku');
    Route::put('/DatakuAdmin', [InfoUserControllerAdmin::class, 'storeall'])->name('DatakuAdmin.storeall');
    Route::get('/user-profileAdmin', [InfoUserControllerAdmin::class, 'create'])->name('user-profileAdmin.create');
    Route::put('/user-profileAdmin', [InfoUserControllerAdmin::class, 'store'])->name('user-profileAdmin.store');
    //   Route::get('billing', function () {
//     return view('billing');
// })->name('billing');

    // Route::get('profile', function () {
//     return view('profile');
// })->name('profile');

    // Route::get('rtl', function () {
//     return view('rtl');
// })->name('rtl');

    // Route::get('user-management', function () {
//     return view('laravel-examples/user-management');
// })->name('user-management');

    // Route::get('tables', function () {
//     return view('tables');
// })->name('tables');
});

// kurikulum
Route::middleware(['auth', 'can:isKepalaSekolah', 'prevent.xss'])->group(function () {
    // Kepala Sekolah
    Route::get('/dashboardKepalaSekolah', [DashboardControllerKepalaSekolah::class, 'index'])->name('dashboardKepalaSekolah.index');

    Route::get('/user-profileKepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'create'])->name('user-profileKepalaSekolah.create');
    Route::put('/user-profileKepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'store'])->name('user-profileKepalaSekolah.store');
    Route::get('/DatakukepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'createdataku'])->name('DatakukepalaSekolah.createdataku');
    Route::put('/DatakukepalaSekolah', [InfoUserControllerKepalaSekolah::class, 'storeall'])->name('DatakukepalaSekolah.storeall');


});
Route::middleware(['auth', 'can:isKurikulum', 'prevent.xss'])->group(function () {
    // Kurikulum
    Route::get('/dashboardKurikulum', [DashboardControllerKurikulum::class, 'index'])->name('dashboardKurikulum.index');

    Route::get('/DatakuKurikulum', [InfoUserControllerKurikulum::class, 'createdataku'])->name('DatakuKurikulum.createdataku');
    Route::put('/DatakuKurikulum', [InfoUserControllerKurikulum::class, 'storeall'])->name('DatakuKurikulum.storeall');
    Route::get('/user-profileKurikulum', [InfoUserControllerKurikulum::class, 'create'])->name('user-profileKurikulum.create');
    Route::put('/user-profileKurikulum', [InfoUserControllerKurikulum::class, 'store'])->name('user-profileKurikulum.store');

});
Route::middleware(['auth', 'can:isGuru', 'prevent.xss'])->group(function () {
    Route::get('/dashboardGuru', [DashboardControllerGuru::class, 'index'])->name('dashboardGuru.index');

    Route::get('/user-profileGuru', [InfoUserControllerGuru::class, 'create'])->name('user-profileGuru.create');
    Route::put('/user-profileGuru', [InfoUserControllerGuru::class, 'store'])->name('user-profileGuru.store');
    Route::get('/DatakuGuru', [InfoUserControllerGuru::class, 'createdataku'])->name('DatakuGuru.createdataku');
    Route::put('/DatakuGuru', [InfoUserControllerGuru::class, 'storeall'])->name('DatakuGuru.storeall');
});
Route::middleware(['auth', 'can:isSiswa', 'prevent.xss'])->group(function () {
    Route::get('/DatakuSiswa', [InfoUserControllerSiswa::class, 'createdataku'])->name('DatakuSiswa.createdataku');
    Route::put('/DatakuSiswa', [InfoUserControllerSiswa::class, 'storeall'])->name('DatakuSiswa.storeall');
    Route::get('/dashboardSiswa', [DashboardControllerSiswa::class, 'index'])->name('dashboardSiswa.index');

    Route::get('/user-profileSiswa', [InfoUserControllerSiswa::class, 'create'])->name('user-profileSiswa.create');
    Route::put('/user-profileSiswa', [InfoUserControllerSiswa::class, 'store'])->name('user-profileSiswa.store');
    // ekstraku 
    Route::get('/Ekstra-ku', [EkstrakuController::class, 'index'])->name('Ekstra-ku.index');
    Route::post('/Ekstra-ku', [EkstrakuController::class, 'store'])->name('Ekstra-ku.store');
    Route::get('/Ekstra-ku/getekstraku', [EkstrakuController::class, 'getEkstraku'])->name('getekstraku.getekstraku');
    Route::get('/Ekstra-ku/getekstraku', [EkstrakuController::class, 'getEkstraku'])->name('getekstraku.getekstraku');
    Route::delete('/Ekstra-ku/hapus', [EkstrakuController::class, 'deleteEkstraku'])->name('ekstraku.hapus');
    // organisasiku 
    Route::get('/Organisasi-ku', [OrganisasikuController::class, 'index'])->name('Organisasi-ku.index');
    Route::post('/Organisasi-ku', [OrganisasikuController::class, 'store'])->name('Organisasi-ku.store');
    Route::get('/Organisasi-ku/getorganisasiku', [OrganisasikuController::class, 'getOrganisasiku'])->name('getorganisasiku.getorganisasiku');
    Route::delete('/Organisasi-ku/hapus', [OrganisasikuController::class, 'deleteOrganisasiku'])->name('organisasiku.hapus');

});
Route::middleware(['auth', 'can:isNonSiswa', 'prevent.xss'])->group(function () {
    Route::get('/dashboardNonSiswa', [DashboardControllerNonSiswa::class, 'index'])->name('dashboardNonSiswa.index');

    Route::get('/user-profileNonSiswa', [InfoUserControllerNonSiswa::class, 'create'])->name('user-profileNonSiswa.create');
    Route::put('/user-profileNonSiswa', [InfoUserControllerNonSiswa::class, 'store'])->name('user-profileNonSiswa.store');
    Route::get('/pengumumannonsiswa/data', [DashboardControllerNonSiswa::class, 'getPengumuman'])->name('pengumumannonsiswa.data');
    Route::post('/dashboardNonSiswa', [DashboardControllerNonSiswa::class, 'store'])->name('dashboardNonSiswa.store');
    Route::get('/dashboardNonSiswa/dashboardNonSiswa', [DashboardControllerNonSiswa::class, 'getPembayaran'])->name('pembayaran.pembayaran');
    // Route::get('/dashboard-nonsiswa/{id_hashed}/edit', [DashboardControllerNonSiswa::class, 'edit'])->name('dashboardNonSiswa.edit');
    Route::get('/dashboardNonSiswa/edit/{hashedId}', [DashboardControllerNonSiswa::class, 'edit'])->name('dashboardNonSiswa.edit');

    Route::put('/dashboardNonSiswa/{id_hashed}', [DashboardControllerNonSiswa::class, 'update'])->name('dashboardNonSiswa.update');
});

// Route::middleware(['guest', 'prevent.xss', 'throttle:10,1'])->group(function () {
//     Route::get('/login', [SessionsController::class, 'create'])->name('login');
//     Route::get('/Ppdb', [PpdbController::class, 'index'])->name('Ppdb.index');
//     Route::post('/Ppdb', [PpdbController::class, 'store'])->name('Ppdb.store');

//     Route::get('/Beranda', [ProfileSekolahController::class, 'Beranda'])->name('Beranda.index');
//     Route::get('/Alumni', [AlumniController::class, 'Alumni'])->name('Alumni.index');
//     Route::get('/Alumni', [AlumniController::class, 'store'])->name('Alumni.store');
//     Route::get('/Berita/show/{slug}', [BeritaController::class, 'show'])->name('Berita.show');
//     Route::get('/Profile/show/{slug}', [ProfileController::class, 'show'])->name('Profile.show');
//     Route::get('/Informasi/{slug}', [InformasippdbController::class, 'show'])->name('Informasi.show');

//     Route::get('/', function () {
//         return redirect()->route('Beranda.index');
//     });
// });
Route::middleware(['guest', 'prevent.xss'])->group(function () {
    // Halaman login dengan throttle (karena rentan brute force)
    Route::middleware(['throttle:10,1'])->group(function () {
        Route::get('/login', [SessionsController::class, 'create'])->name('login');
        Route::post('/Ppdb', [PpdbController::class, 'store'])->name('Ppdb.store'); 
        Route::post('/Alumni', [AlumniController::class, 'store'])->name('Alumni.store');


        // Pastikan ini adalah POST, bukan GET
    });

    // Route tanpa throttle
    Route::get('/Stella', [StellaController::class, 'index'])->name('Stella.index');
    Route::get('/Ppdb', [PpdbController::class, 'index'])->name('Ppdb.index');
    Route::get('/Beranda', [ProfileSekolahController::class, 'Beranda'])->name('Beranda.index');
    Route::get('/navbar', [ProfileSekolahController::class, 'Beranda2'])->name('navbar');

    Route::get('/Alumni', [AlumniController::class, 'Alumni'])->name('Alumni.index');
    Route::get('/Berita/show/{slug}', [BeritaController::class, 'show'])->name('Berita.show');
    Route::get('/Profile/show/{slug}', [ProfileController::class, 'show'])->name('Profile.show');
    Route::get('/Informasi/{slug}', [InformasippdbController::class, 'show'])->name('Informasi.show');
    Route::get('/Listalumni', [AlumniController::class, 'index'])->name('Listalumni.index');
    Route::get('/alumni/alumni', [AlumniController::class, 'getAlumni'])->name('alumni.alumni');
    Route::get('/', function () {
        return redirect()->route('Beranda.index');
    });
});



Route::match(['GET', 'POST'], '/logout', [SessionsController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');





// Guru

// Siswa
// Route::get('dashboardSiswa', function () {
//     return view('dashboardSiswa');  // Halaman untuk Siswa
// })->middleware('can:isSiswa');

// Calon Siswa
