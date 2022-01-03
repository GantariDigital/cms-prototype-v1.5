@section('css-libraries')
@endsection

@section('css')
@endsection

@inject('rolesData', 'App\Helpers\RolesData')
<div>
  <section class="section">
    <div class="section-header">
      <h1>Top Navigation</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
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
          <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">A. Perencanaan Proyek</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">B. Pelaksanaan Proyek</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        @canany($rolesData::getMenus('Manage'))
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('manage.data_masuk.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">Manage</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endcanany
        @auth('admin')
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('master.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">Master Admin</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endauth
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
                                    <a class="text-decoration-none custom-color-inherit" href="{{ route('perencanaan.index') }}">
                                        <h6 class="text-uppercase mb-0">
                                            <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                            A. Perencanaan Proyek
                                        </h6>
                                    </a>
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <td>
                                    <a class="text-decoration-none custom-color-inherit" href="{{ route('pelaksanaan.index') }}">
                                        <h6 class="text-uppercase mb-0">
                                            <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                            B. Pelaksanaan Proyek
                                        </h6>
                                    </a>
                                </td>
                            </tr>
                            @canany($rolesData::getMenus('Manage'))
                            <tr class="border-bottom">
                                <td>
                                    <a class="text-decoration-none custom-color-inherit" href="{{ route('manage.data_masuk.index') }}">
                                        <h6 class="text-uppercase mb-0">
                                            <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                            Manage
                                        </h6>
                                    </a>
                                </td>
                            </tr>
                            @endcanany
                            @auth('admin')
                            <tr class="border-bottom">
                                <td>
                                    <a class="text-decoration-none custom-color-inherit" href="{{ route('master.index') }}">
                                        <h6 class="text-uppercase mb-0">
                                            <i class="fas fa-folder custom-fa-1x-2 custom-bg-folder ml-0 mr-2"></i>
                                            Master Admin
                                        </h6>
                                    </a>
                                </td>
                            </tr>
                            @endauth
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
