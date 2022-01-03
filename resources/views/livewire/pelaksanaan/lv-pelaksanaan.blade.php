@section('title-page', ' - Pelaksanaan')
@section('css-libraries')
@endsection

@section('css')
@endsection

@inject('rolesData', 'App\Helpers\RolesData')

<div>
  <section class="section">
    <div class="section-header">
      <h1>Pelaksanaan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Pelaksanaan</div>
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
        @canany($rolesData::getAllPermissionByDivision('Keuangan'))
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.keuangan.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">I. Divisi Keuangan</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endcanany
        @canany($rolesData::getAllPermissionByDivision('Konstruksi'))
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.konstruksi.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">II. Divisi Kontruksi</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endcanany
        @canany($rolesData::getAllPermissionByDivision('Marketing'))
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.marketing.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">III. Divisi Marketing</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endcanany
        @canany($rolesData::getAllPermissionByDivision('Umum'))
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.umum.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">IV. Divisi Umum</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endcanany
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
                  @canany($rolesData::getAllPermissionByDivision('Keuangan'))
                  <tr class="border-bottom">
                    <td>
                      <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.keuangan.index') }}">
                        <h6 class="text-uppercase mb-0">
                          <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                          I. Divisi Keuangan
                        </h6>
                      </a>
                    </td>
                  </tr>
                  @endcanany
                  @canany($rolesData::getAllPermissionByDivision('Konstruksi'))
                  <tr class="border-bottom">
                    <td>
                      <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.konstruksi.index') }}">
                        <h6 class="text-uppercase mb-0">
                          <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                          II. Divisi Kontruksi
                        </h6>
                      </a>
                    </td>
                  </tr>
                  @endcanany
                  @canany($rolesData::getAllPermissionByDivision('Marketing'))
                  <tr class="border-bottom">
                    <td>
                      <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.marketing.index') }}">
                        <h6 class="text-uppercase mb-0">
                          <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                          III. Divisi Marketing
                        </h6>
                      </a>
                    </td>
                  </tr>
                  @endcanany
                  @canany($rolesData::getAllPermissionByDivision('Umum'))
                  <tr class="border-bottom">
                    <td>
                      <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.umum.index') }}">
                        <h6 class="text-uppercase mb-0">
                          <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                          IV. Divisi Umum
                        </h6>
                      </a>
                    </td>
                  </tr>
                  @endcanany
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
