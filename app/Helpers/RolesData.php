<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class RolesData
{
    private static $permission_datas = [
        'Menus' => [
            'Pelaksanaan' => [
                'type' => 'Sub',
                'type_key' => 'Division',
                'items' => [
                    'Keuangan',
                    'Konstruksi',
                    'Marketing',
                    'Umum',
                ],
            ],
            'Perencanaan' => [
                'type' => 'Main',
                'items' => [
                    'financial-analysis view',
                    'financial-analysis add',
                    'financial-analysis delete',
                    'gambar-unit-rumah view',
                    'gambar-unit-rumah add',
                    'gambar-unit-rumah delete',
                    'konstruksi-unit-rumah view',
                    'konstruksi-unit-rumah add',
                    'konstruksi-unit-rumah delete',
                    'item-unit-rumah view',
                    'item-unit-rumah add',
                    'item-unit-rumah delete',
                    'konstruksi-sarana view',
                    'item-konstruksi-sarana add',
                    'item-konstruksi-sarana delete',
                    'brosur-perumahan view',
                    'brosur-perumahan add',
                    'brosur-perumahan delete',
                ],
            ],
            'Manage' => [
                'type' => 'Main',
                'items' => [
                    'filter-data-masuk divisi-keuangan view',
                    'filter-data-masuk divisi-konstruksi view',
                    'filter-data-masuk divisi-marketing view',
                    'filter-data-masuk divisi-umum view',
                    'filter-data-masuk perencanaan view',
                ],
            ],
        ],
        'Division' => [
            'Keuangan' => [
                'pengajuan-dana view',
                'pengajuan-dana add', 
                'pengajuan-dana delete',
                'realisasi-dana view',
                'realisasi-dana add', 
                'realisasi-dana delete',
                'jurnal-harian view', 
                'jurnal-harian add', 
                'jurnal-harian delete',
                'progress-keuangan view', 
                'progress-keuangan add', 
                'progress-keuangan delete',
            ],
            'Konstruksi' => [
                'laporan-harian view',
                'laporan-harian add',
                'laporan-harian delete',
                'progress-kemajuan view',
                'item-progress-kemajuan add',
                'item-progress-kemajuan delete',
                'photo-kegiatan view',
                'photo-kegiatan add',
                'photo-kegiatan delete',
                'control-stock view',
                'control-stock add',
                'control-stock delete',
                'resume-kegiatan view',
                'resume-kegiatan add',
                'resume-kegiatan delete',
                'perjanjian-kontrak view',
                'perjanjian-kontrak add',
                'perjanjian-kontrak delete',
            ],
            'Marketing' => [
                'marketing view',
                'item-marketing add',
                'item-marketing delete',
            ],
            'Umum' => [
                'aset-perusahaan view',
                'item-aset-perusahaan add',
                'item-aset-perusahaan delete',
                'inventori-perusahaan view',
                'inventori-perusahaan add',
                'inventori-perusahaan delete',
                'laporan-kegiatan view',
                'laporan-kegiatan add',
                'laporan-kegiatan delete',
                'legalitas-perusahaan view',
                'item-legalitas-perusahaan add',
                'item-legalitas-perusahaan delete',
                'sdm-perusahaan view',
                'sdm-perusahaan add',
                'sdm-perusahaan delete',
            ],
        ],
    ];
    
    public static function getAllPermissionByDivision($division_name)
    {
        return self::$permission_datas['Division'][$division_name] ?? [];
    }

    public static function getMenus($menu_name)
    {
        $menu = self::$permission_datas['Menus'][$menu_name] ?? null;
        $permission = [];
        if($menu) {
            if($menu['type'] == 'Sub') {
                $sub = $menu['type_key'];
                foreach ($menu['items'] as $key => $value) {
                    $permission[] = self::getAllPermissionByDivision($value);
                }
                $permission = Arr::collapse($permission);
            } else {
                $permission = $menu['items'];
            }
        }
        return $permission;
    }
}