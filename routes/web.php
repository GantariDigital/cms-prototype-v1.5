<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

use App\Http\Controllers\Auth\{
    Admin\LoginController as AdminLoginController,
    OtpUser\LoginController as OtpLoginController,
};

use App\Http\Controllers\Keuangan\{
    FileStorageController,
};

use App\Http\Livewire\Dashboard\{
    LvDashboard,
};

use App\Http\Livewire\Landing\{
    LvLandingPage,
};
use App\Http\Livewire\Wilayah\{
    LvWilayah,
};

use App\Http\Livewire\Tester\{
    LvFileStorage,
};

use App\Http\Livewire\Pelaksanaan\{
    LvPelaksanaan,
    LvManagePelaksanaan,
    Keuangan\LvKeuangan,
    Konstruksi\LvKonstruksi,
    Konstruksi\LvProgressKemajuan,
    Marketing\LvMarketing,
    Umum\LvUmum,
    Umum\LvAsetPerusahaan,    
    Umum\LvLegalitasPerusahaan,
};

use App\Http\Livewire\Perencanaan\{
    LvPerencanaan,
    LvManagePerencanaan,
    LvFinancialAnalysis,
    LvGambarUnitRumah,
    LvKonstruksiUnitRumah,
    LvItemUnitRumah,
    LvKonstruksiSarana,
    LvItemKonstruksiSarana,
    LvBrosurPerumahan,
};
use App\Http\Livewire\Master\{
    LvMasterAdmin,
    LvUserRoles as LvUserRolesAdmin,
    LvRoles as LvRolesAdmin,
    LvOtpUser,
    LvMsCode,
    LvMsSubCode,
};

use App\Http\Livewire\Manage\{
    DataMasuk\LvDataMasuk,
    DataMasuk\LvDataKeuangan,
    DataMasuk\LvDataKonstruksi,
    DataMasuk\LvDataMarketing,
    DataMasuk\LvDataUmum,
    DataMasuk\LvDataPerencanaan,
};

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', LvLandingPage::class)->name('landing.page');
Route::get('/wilayah', LvWilayah::class)->name('landing.sector');

Route::get('/file-storage', LvFileStorage::class);

Route::middleware(['auth:web,otp_user,admin', 'verified'])->group(function () {
    Route::get('/dashboard', LvDashboard::class)->name('dashboard');
    
    /* MANAGE */
    Route::prefix('manage')->name('manage.')->group(function () {
        Route::get('tester/image', [FileStorageController::class, 'testerResponse']);
        Route::get('data-masuk', LvDataMasuk::class)->name('data_masuk.index');
        Route::middleware(['permission:filter-data-masuk divisi-keuangan view'])->group(function () {
            Route::get('data-masuk/divisi/keuangan', LvDataKeuangan::class)->name('data_masuk.keuangan.index');
        });
        Route::middleware(['permission:filter-data-masuk divisi-konstruksi view'])->group(function () {
           Route::get('data-masuk/divisi/konstruksi', LvDataKonstruksi::class)->name('data_masuk.konstruksi.index');
        });
        Route::middleware(['permission:filter-data-masuk divisi-marketing view'])->group(function () {
            Route::get('data-masuk/divisi/marketing', LvDataMarketing::class)->name('data_masuk.marketing.index');
        });
        Route::middleware(['permission:filter-data-masuk divisi-umum view'])->group(function () {
            Route::get('data-masuk/divisi/umum', LvDataUmum::class)->name('data_masuk.umum.index');
        });
        Route::middleware(['permission:filter-data-masuk perencanaan view'])->group(function () {
            Route::get('data-masuk/Perencanaan', LvDataPerencanaan::class)->name('data_masuk.perencanaan.index');
        });
    });
    /* END MANAGE */

    /* PELAKSANAAN */
    Route::prefix('pelaksanaan')->name('pelaksanaan.')->group(function () {
        Route::get('/', LvPelaksanaan::class)->name('index');

        Route::get('manage/{divisi}/{menu}/{sub_menu?}', LvManagePelaksanaan::class)->name('manage');
        
        Route::prefix('keuangan')->name('keuangan.')->group(function () {
            Route::get('/', LvKeuangan::class)->name('index');
        //     Route::middleware(['permission:pengajuan-dana view'])->group(function () {
        //         Route::get('/pengajuan-dana', LvPengajuanDana::class)->name('pengajuan_dana.index');
        //     });
        //     Route::middleware(['permission:jurnal-harian view'])->group(function () {
        //         Route::get('/jurnal-keuangan', LvJurnalHarian::class)->name('jurnal_keuangan.index');
        //         // Route::get('/jurnal-harian', LvJurnalHarian::class)->name('jurnal_harian.index');
        //     });
        //     Route::middleware(['permission:resume-jurnal view'])->group(function () {
        //         Route::get('/resume-jurnal', LvResumeJurnal::class)->name('resume_jurnal.index');
        //     });
        //     Route::middleware(['permission:realisasi-dana view'])->group(function () {
        //         Route::get('/realisasi-dana', LvRealisasiDana::class)->name('realisasi_dana.index');
        //     });
        //     Route::middleware(['permission:progress-keuangan view'])->group(function () {
        //         Route::get('/progress-keuangan', LvProgressKeuangan::class)->name('progress_keuangan.index');
        //     });
        });
        Route::prefix('umum')->name('umum.')->group(function () {
            Route::get('/', LvUmum::class)->name('index');
        //     Route::middleware(['permission:aset-perusahaan view'])->group(function () {
                Route::get('/aset-perusahaan', LvAsetPerusahaan::class)->name('aset_perusahaan.index');
        //         Route::get('/aset-perusahaan/{slug}', LvItemAsetPerusahaan::class)->name('aset_perusahaan.item.index');
        //     });
        //     Route::middleware(['permission:inventori-perusahaan view'])->group(function () {
        //         Route::get('/inventori-perusahaan', LvInventoriPerusahaan::class)->name('inventori_perusahaan.index');
        //     });
        //     Route::middleware(['permission:laporan-kegiatan view'])->group(function () {
        //         Route::get('/laporan-kegiatan', LvLaporanKegiatan::class)->name('laporan_kegiatan.index');
        //     });
        //     Route::middleware(['permission:legalitas-perusahaan view'])->group(function () {
                Route::get('/legalitas-perusahaan', LvLegalitasPerusahaan::class)->name('legalitas_perusahaan.index');
        //         Route::get('/legalitas-perusahaan/{slug}', LvItemLegalitasPerusahaan::class)->name('legalitas_perusahaan.item.index');
        //     });
        //     Route::middleware(['permission:sdm-perusahaan view'])->group(function () {
        //         Route::get('/sdm-perusahaan', LvSdmPerusahaan::class)->name('sdm_perusahaan.index');
        //     });
        });
        Route::prefix('marketing')->name('marketing.')->group(function () {
            // Route::middleware(['permission:marketing view'])->group(function () {
                Route::get('/', LvMarketing::class)->name('index');
                // Route::get('/marketing/{slug}', LvItemMarketing::class)->name('item.index');
            // });
        });
        Route::prefix('konstruksi')->name('konstruksi.')->group(function () {
            Route::get('/', LvKonstruksi::class)->name('index');
        //     Route::middleware(['permission:laporan-harian view'])->group(function () {
        //         Route::get('/laporan-harian', LvLaporanHarian::class)->name('laporan_harian.index');
        //     });
        //     Route::middleware(['permission:progress-kemajuan view'])->group(function () {
                Route::get('/progress-kemajuan', LvProgressKemajuan::class)->name('progress_kemajuan.index');
        //         Route::get('/progress-kemajuan/{slug}', LvItemProgressKemajuan::class)->name('progress_kemajuan.item.index');
        //     });
        //     Route::middleware(['permission:photo-kegiatan view'])->group(function () {
        //         Route::get('/photo-kegiatan', LvPhotoKegiatan::class)->name('photo_kegiatan.index');
        //     });
        //     Route::middleware(['permission:control-stock view'])->group(function () {
        //         Route::get('/control-stock', LvControlStock::class)->name('control_stock.index');
        //     });
        //     Route::middleware(['permission:resume-kegiatan view'])->group(function () {
        //         Route::get('/resume-kegiatan', LvResumeKegiatan::class)->name('resume_kegiatan.index');
        //     });
        //     Route::middleware(['permission:perjanjian-kontrak view'])->group(function () {
        //         Route::get('/perjanjian-kontrak', LvPerjanjianKontrak::class)->name('perjanjian_kontrak.index');
        //     });
        });
    });
    /* END PELAKSANAAN */
    
    /* PERENCANAAN */
    Route::prefix('perencanaan')->name('perencanaan.')->group(function () {
        Route::get('/', LvPerencanaan::class)->name('index');
        
        Route::get('manage/{menu}/{sub_menu?}', LvManagePerencanaan::class)->name('manage');
        // Route::middleware(['permission:financial-analysis view'])->group(function () {
        //     Route::get('financial-analysis', LvFinancialAnalysis::class)->name('financial_analysis.index');
        // });
        // Route::middleware(['permission:gambar-unit-rumah view'])->group(function () {
        //     Route::get('gambar-unit-rumah', LvGambarUnitRumah::class)->name('gambar_unit_rumah.index');
        // });
        // Route::middleware(['permission:konstruksi-unit-rumah view'])->group(function () {
            Route::get('konstruksi-unit-rumah', LvKonstruksiUnitRumah::class)->name('konstruksi_unit_rumah.index');
        //     Route::get('konstruksi-unit-rumah/{slug}', LvItemUnitRumah::class)->name('konstruksi_unit_rumah.item.index');
        // });
        // Route::middleware(['permission:konstruksi-sarana view'])->group(function () {
            Route::get('konstruksi-sarana', LvKonstruksiSarana::class)->name('konstruksi_sarana.index');
            // Route::get('konstruksi-sarana/{slug}', LvItemKonstruksiSarana::class)->name('konstruksi_sarana.item.index');
        // });
        // Route::middleware(['permission:brosur-perumahan view'])->group(function () {
        //     Route::get('brosur-perumahan', LvBrosurPerumahan::class)->name('brosur_perumahan.index');
        // });

    });
    /* END PERENCANAAN */
    
    /* FILE STORAGE */
    Route::get('files/image/stream', [FileStorageController::class, 'imageStream'])->name('files.image.stream');
    Route::get('files/image/sector/stream', [FileStorageController::class, 'imageSectorStream'])->name('files.image.sector.stream');
    Route::get('files/pdf/stream', [FileStorageController::class, 'pdfStream'])->name('files.pdf.stream');
    /* END FILE STORAGE */
});


Route::prefix('/admin')->name('admin.')->group(function(){
    //Login Routes
    Route::get('/login',[AdminLoginController::class, 'loginForm'])->name('login');
    Route::post('/login',[AdminLoginController::class, 'login']);
    Route::post('/logout',[AdminLoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth:admin', 'verified'])->prefix('admin')->group(function () {
    
    /* MASTER */
    Route::prefix('master')->name('master.')->group(function () {
        Route::get('/', LvMasterAdmin::class)->name('index');
        Route::get('/otp-user', LvOtpUser::class)->name('otp_user.index');
        Route::get('/user-roles', LvUserRolesAdmin::class)->name('user_roles.index');
        Route::get('/roles', LvRolesAdmin::class)->name('roles.index');
        Route::get('/code', LvMsCode::class)->name('code.index');
        Route::get('/code/{parent_code_id}/sub-codes', LvMsSubCode::class)->name('code.sub_code');
    });
    /* END MASTER */
    
    
});

Route::get('otp-user/login', [OtpLoginController::class, 'loginForm'])->name('otp_user.form_login');
Route::post('otp-user/login', [OtpLoginController::class, 'login'])->name('otp_user.login');
Route::post('otp-user/logout', [OtpLoginController::class, 'logout'])->name('otp_user.logout');

Route::get('test/roles', [FileStorageController::class, 'tester']);
