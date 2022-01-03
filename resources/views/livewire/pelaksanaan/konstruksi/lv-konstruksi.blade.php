@section('title-page', ' - Divisi Konstruksi')
@section('css-libraries')
@endsection

@section('css')
<style>
    .custom-table-folder td {
        height: 40px !important;
    }
</style>
@endsection

<div>
    <section class="section">
        <div class="section-header">
            <h1>Divisi Konstruksi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pelaksanaan.index') }}">Pelaksanaan</a></div>
                <div class="breadcrumb-item">Divisi Konstruksi</div>
            </div>
        </div>
        
        <div x-data="{ layouts: { grid: true, details: false } }" class="section-body">
            <div class="w-100 mb-4 menu-layout">
                <div class="d-flex justify-content-end">
                    <div class="layout-item" :class="{ 'active': layouts.details }" x-on:click="layouts.grid = false; layouts.details = true;">
                        <i class="fas fa-list fa-1x-3"></i>
                    </div>
                    <div class="layout-item" :class="{ 'active': layouts.grid }" x-on:click="layouts.grid = true; layouts.details = false;">
                        <i class="fas fa-th fa-1x-3"></i>
                    </div>
                </div>
            </div>
            <div x-show="layouts.grid" class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'laporan-harian']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">A. Laporan Kegiatan Harian Proyek</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.konstruksi.progress_kemajuan.index') }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">B. Progress Kemajuan Proyek</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'photo-kegiatan']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">C. Photo Kegiatan Lapangan</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'control-stock']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">D. Control Stock Material</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'resume-kegiatan']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">E. Resume Kegiatan Bulanan Proyek</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'perjanjian-kontrak']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">F. Perjanjian Kontrak Pekerjaan Konstruksi</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div :class="{ 'd-none': !layouts.details }" class="row d-none">
                <div class="col-12">
                    <div class="card rounded-0 shadow-none border-bottom">
                        <div class="card-body py-3">
                            <h6 class="text-dark font-weight-normal mb-0">
                                Name
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table custom-table-folder mb-0">
                                <tbody>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'laporan-harian']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    A. Laporan Kegiatan Harian Proyek
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.konstruksi.progress_kemajuan.index') }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    B. Progress Kemajuan Proyek
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'photo-kegiatan']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    C. Photo Kegiatan Lapangan
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'control-stock']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    D. Control Stock Material
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'resume-kegiatan']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    E. Resume Kegiatan Bulanan Proyek
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'konstruksi', 'menu' => 'perjanjian-kontrak']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    F. Perjanjian Kontrak Pekerjaan Konstruksi
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@push('script')
@endpush
