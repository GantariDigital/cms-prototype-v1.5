<?php

namespace App\Helpers;

class MainData
{
    private static $db_name;
    private static $table_datas = [
        'Menu' => [
            'Perencanaan' => [
                ['id' => 'P-BP', 'slug_name' => 'brosur-perumahan', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Perencanaan\BrosurPerumahan', 'menu_name' => 'Brosur Perumahan', 'table_name' => 'brosur_perumahans'],
                ['id' => 'P-FA', 'slug_name' => 'financial-analysis', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Perencanaan\FinancialAnalysis', 'menu_name' => 'Financial Analysis', 'table_name' => 'financial_analyses'],
                ['id' => 'P-GUR', 'slug_name' => 'gambar-unit-rumah', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Perencanaan\GambarUnitRumah', 'menu_name' => 'Gambar Unit Rumah', 'table_name' => 'gambar_unit_rumahs'],
                ['id' => 'P-KS', 'slug_name' => 'konstruksi-sarana', 'week_view' => false, 'type' => 'parent', 'model' => 'App\Models\Perencanaan\KonstruksiSarana', 'parent_key' => 'konstruksi_sarana_id', 'child_permission' => 'item-konstruksi-sarana', 'child_model' => 'App\Models\Perencanaan\ItemKonstruksiSarana', 'menu_name' => 'Konstrusi Sarana', 'table_name' => 'item_konstruksi_saranas'],
                ['id' => 'P-KUR', 'slug_name' => 'konstruksi-unit-rumah', 'week_view' => false, 'type' => 'parent', 'model' => 'App\Models\Perencanaan\KonstruksiUnitRumah', 'parent_key' => 'konstruksi_unit_id', 'child_permission' => 'item-unit-rumah', 'child_model' => 'App\Models\Perencanaan\ItemUnitRumah', 'menu_name' => 'Konstruksi Unit Rumah', 'table_name' => 'item_unit_rumahs'],
            ],
        ],
        'Division' => [
            'Keuangan' => [
                [
                    'id' => 'K-JH', 'slug_name' => 'jurnal-harian', 'week_view' => false, 'type' => 'list',
                    'lists' => [
                        ['slug_name' => 'jurnal-harian','menu_name' => 'Jurnal Harian', 'model' => 'App\Models\Keuangan\JurnalHarian', 'table_name' => 'jurnal_harians'],
                        ['slug_name' => 'resume-jurnal','menu_name' => 'Resume Jurnal', 'model' => 'App\Models\Keuangan\ResumeJurnal', 'table_name' => 'resume_jurnals'],
                    ],
                    'menu_name' => 'Jurnal Harian',
                    'first_slug_list' => 'jurnal-harian',
                ],
                ['id' => 'K-PD', 'slug_name' => 'pengajuan-dana', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Keuangan\PengajuanDana', 'menu_name' => 'Pengajuan Dana', 'table_name' => 'pengajuan_danas'],
                ['id' => 'K-PK', 'slug_name' => 'progress-keuangan', 'week_view' => true, 'type' => 'main', 'model' => 'App\Models\Keuangan\ProgressKeuangan', 'menu_name' => 'Progress Keuangan', 'table_name' => 'progress_keuangans'],
                ['id' => 'K-RD', 'slug_name' => 'realisasi-dana', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Keuangan\RealisasiDana', 'menu_name' => 'Realisasi Dana', 'table_name' => 'realisasi_danas'],
                ['id' => 'K-RJ', 'slug_name' => 'resume-jurnal', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Keuangan\ResumeJurnal', 'menu_name' => 'Resume Jurnal', 'table_name' => 'resume_jurnals'],
            ],
            'Konstruksi' => [
                ['id' => 'C-CS', 'slug_name' => 'control-stock', 'week_view' => true, 'type' => 'main', 'model' => 'App\Models\Konstruksi\ControlStock', 'menu_name' => 'Control Stock', 'table_name' => 'control_stocks'],
                ['id' => 'C-PRK', 'slug_name' => 'progress-kemajuan', 'week_view' => true, 'type' => 'parent', 'model' => 'App\Models\Konstruksi\ProgressKemajuan', 'parent_key' => 'progress_kemajuan_id', 'child_permission' => 'item-progress-kemajuan', 'child_model' => 'App\Models\Konstruksi\ItemProgressKemajuan', 'menu_name' => 'Progress Kemajuan', 'table_name' => 'item_progress_kemajuans'],
                ['id' => 'C-LH', 'slug_name' => 'laporan-harian', 'week_view' => true, 'type' => 'main', 'model' => 'App\Models\Konstruksi\LaporanHarian', 'menu_name' => 'Laporan Harian', 'table_name' => 'laporan_harians'],
                ['id' => 'C-PJK', 'slug_name' => 'perjanjian-kontrak', 'week_view' => true, 'type' => 'main', 'model' => 'App\Models\Konstruksi\PerjanjianKontrak', 'menu_name' => 'Perjanjian Kontrak', 'table_name' => 'perjanjian_kontraks'],
                ['id' => 'C-PHK', 'slug_name' => 'photo-kegiatan', 'week_view' => true, 'type' => 'main', 'model' => 'App\Models\Konstruksi\PhotoKegiatan', 'menu_name' => 'Photo Kegiatan', 'table_name' => 'photo_kegiatans'],
                ['id' => 'C-RK', 'slug_name' => 'resume-kegiatan', 'week_view' => true, 'type' => 'main', 'model' => 'App\Models\Konstruksi\ResumeKegiatan', 'menu_name' => 'Resume Kegiatan', 'table_name' => 'resume_kegiatans'],
            ],
            'Marketing' => [
                ['id' => 'M-IM', 'slug_name' => 'marketing', 'week_view' => false, 'type' => 'parent', 'model' => 'App\Models\Marketing\Marketing', 'parent_key' => 'marketing_id', 'child_permission' => 'item-marketing', 'child_model' => 'App\Models\Marketing\ItemMarketing', 'menu_name' => 'Marketing', 'table_name' => 'item_marketings'],
            ],
            'Umum' => [
                ['id' => 'U-AP', 'slug_name' => 'aset-perusahaan', 'week_view' => false, 'type' => 'parent', 'model' => 'App\Models\Umum\AsetPerusahaan', 'parent_key' => 'aset_id', 'child_permission' => 'item-aset-perusahaan', 'child_model' => 'App\Models\Umum\ItemAsetPerusahaan', 'menu_name' => 'Aset Perusahaan', 'table_name' => 'item_aset_perusahaans'],
                ['id' => 'U-IP', 'slug_name' => 'inventori-perusahaan', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Umum\InventoriPerusahaan', 'menu_name' => 'Inventori Perusahaan', 'table_name' => 'inventori_perusahaans'],
                ['id' => 'U-LP', 'slug_name' => 'legalitas-perusahaan', 'week_view' => false, 'type' => 'parent', 'model' => 'App\Models\Umum\LegalitasPerusahaan', 'parent_key' => 'legalitas_perusahaan_id', 'child_permission' => 'item-legalitas-perusahaan', 'child_model' => 'App\Models\Umum\ItemLegalitasPerusahaan', 'menu_name' => 'Legalitas Perusahaan', 'table_name' => 'item_legalitas_perusahaans'],
                ['id' => 'U-LK', 'slug_name' => 'laporan-kegiatan', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Umum\LaporanKegiatan', 'menu_name' => 'Laporan Kegiatan', 'table_name' => 'laporan_kegiatans'],
                ['id' => 'U-SP', 'slug_name' => 'sdm-perusahaan', 'week_view' => false, 'type' => 'main', 'model' => 'App\Models\Umum\SdmPerusahaan', 'menu_name' => 'SDM Perusahaan', 'table_name' => 'sdm_perusahaans'],
            ],
        ],
    ];
    
    public static function getAllTableByDivision($division_name)
    {
        return self::$table_datas['Division'][$division_name] ?? [];
    }
    public static function getAllTableByMenu($menu_name)
    {
        return self::$table_datas['Menu'][$menu_name] ?? [];
    }
    
    public static function getDivisionTableById($division_name, $id)
    {
        $datas = self::$table_datas['Division'][$division_name];
        $item = collect($datas)->where('id', $id)->first();
        return $item;
    }
    public static function getDivisionTable($division_name, $slug_name)
    {
        if(($datas = (self::$table_datas['Division'][$division_name] ?? false))) {
            $item = collect($datas)->where('slug_name', $slug_name)->first();
            if($item) {
                return (object) $item;
            }
        }
        return [];
    }
    public static function getMenuTable($menu_name, $slug_name)
    {
        if(($datas = (self::$table_datas['Menu'][$menu_name] ?? false))) {
            $item = collect($datas)->where('slug_name', $slug_name)->first();
            if($item) {
                return (object) $item;
            }
        }
        return [];
    }
    public static function getMenuTableById($menu_name, $id)
    {
        $datas = self::$table_datas['Menu'][$menu_name];
        $item = collect($datas)->where('id', $id)->first();
        return $item;
    }
    
}