@section('title-page', ' - Divisi Umum')
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
            <h1>Divisi Umum</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pelaksanaan.index') }}">Pelaksanaan</a></div>
                <div class="breadcrumb-item">Divisi Umum</div>
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
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.umum.legalitas_perusahaan.index') }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">A. Legalitas Perusahaan Dan Perijinan Proyek</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'umum', 'menu' => 'laporan-kegiatan']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">B. Laporan Kegiatan Perijinan Proyek</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.umum.aset_perusahaan.index') }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">C. Daftar Aset Perusahaan</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'umum', 'menu' => 'inventori-perusahaan']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">D. Daftar Invetori Perusahaan</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'umum', 'menu' => 'sdm-perusahaan']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">E. SDM Perusahaan</h6>
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
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.umum.legalitas_perusahaan.index') }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    A. Legalitas Perusahaan Dan Perijinan Proyek
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'umum', 'menu' => 'laporan-kegiatan']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    B. Laporan Kegiatan Perijinan Proyek
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.umum.aset_perusahaan.index') }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    C. Daftar Aset Perusahaan
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'umum', 'menu' => 'inventori-perusahaan']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    D. Daftar Invetori Perusahaan
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.manage', ['divisi' => 'umum', 'menu' => 'sdm-perusahaan']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    E. SDM Perusahaan
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
