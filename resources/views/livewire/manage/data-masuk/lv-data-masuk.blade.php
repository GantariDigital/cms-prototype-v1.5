@section('title-page', ' - Manage')
@section('css-libraries')
@endsection

@section('css')
@endsection

@inject('rolesData', 'App\Helpers\RolesData')

<div>
  <section class="section">
    <div class="section-header">
      <h1>Manage</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Manage</div>
      </div>
    </div>
    
    <div class="section-body">
      <div class="row">
        @can('filter-data-masuk perencanaan view')
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('manage.data_masuk.perencanaan.index') }}">
            <div class="card custom-card-folder">
              <div class="card-body">
                <div class="text-center">
                  <i class="fas fa-folder custom-fa-10x custom-bg-folder"></i>
                </div>
                <div class="w-100 mt-2">
                  <h6 class="text-uppercase mb-0">Perencanaan</h6>
                </div>
              </div>
            </div>
          </a>
        </div>
        @endcan
        @can('filter-data-masuk divisi-keuangan view')
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('manage.data_masuk.keuangan.index') }}">
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
        @endcan
        @can('filter-data-masuk divisi-konstruksi view')
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('manage.data_masuk.konstruksi.index') }}">
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
        @endcan
        @can('filter-data-masuk divisi-marketing view')
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('manage.data_masuk.marketing.index') }}">
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
        @endcan
        @can('filter-data-masuk divisi-umum view')
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
          <a class="text-decoration-none custom-color-inherit" href="{{ route('manage.data_masuk.umum.index') }}">
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
        @endcan
      </div>
    </div>
  </section>
</div>


@push('script')
@endpush
