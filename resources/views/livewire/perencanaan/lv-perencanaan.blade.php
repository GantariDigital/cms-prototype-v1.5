@section('title-page', ' - Perencanaan')
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
            <h1>Perencanaan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Perencanaan</div>
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
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.manage', ['menu' => 'financial-analysis']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">I. Financial Analysis Proyek</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.manage', ['menu' => 'gambar-unit-rumah']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">II. Gambar Unit-Unit Rumah</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.konstruksi_unit_rumah.index') }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">III. Perencanaan Konstruksi Unit-Unit Rumah</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.konstruksi_sarana.index') }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">IV. Perencanaan Prasarana & Sarana Umum</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.manage', ['menu' => 'brosur-perumahan']) }}">
                        <div class="card custom-card-folder">
                            <div class="card-body">
                                <div class="text-center">
                                    <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                                </div>
                                <div class="w-100 mt-2">
                                    <h6 class="text-uppercase mb-0">V. Brosur Perumahan</h6>
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
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.manage', ['menu' => 'financial-analysis']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    I. Financial Analysis Proyek
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.manage', ['menu' => 'gambar-unit-rumah']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    II. Gambar Unit-Unit Rumah
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.konstruksi_unit_rumah.index') }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    III. Perencanaan Konstruksi Unit-Unit Rumah
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.konstruksi_sarana.index') }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    IV. Perencanaan Prasarana & Sarana Umum
                                                </h6>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>
                                            <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.manage', ['menu' => 'brosur-perumahan']) }}">
                                                <h6 class="text-uppercase mb-0">
                                                    <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                                    V. Brosur Perumahan
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
