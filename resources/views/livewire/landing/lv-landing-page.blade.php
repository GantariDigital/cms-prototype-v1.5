@section('page-title', '')
@section('css-libraries')
@endsection

@section('css')
@endsection

<div>
    <section class="section">
        {{-- <div class="section-header">
            <h1>Pages</h1>
            <div class="section-header-breadcrumb">
            </div>
        </div> --}}
        
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing pricing-highlight">
                        <div class="pricing-title">
                            Pusat
                        </div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>Menu</div>
                                <div>Page</div>
                            </div>
                            <div class="pricing-details">
                                <img class="w-100" style="height: 190px" src="{{ asset('assets/img/homepage/menu-page.png') }}" alt="Menu Page">
                            </div>
                        </div>
                        <div class="pricing-cta">
                            <a href="{{ route('login') }}">Login Pusat <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                        <div class="pricing-title">
                            Wilayah
                        </div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>Sector</div>
                                <div>Page</div>
                            </div>
                            <div class="pricing-details">
                                <img class="w-100" style="height: 190px" src="{{ asset('assets/img/homepage/sector-page.png') }}" alt="Sector Page">
                            </div>
                        </div>
                        <div class="pricing-cta">
                            <a href="{{ route('landing.sector') }}">Lokasi Proyek <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                        <div class="pricing-title">
                            Wilayah
                        </div>
                        <div class="pricing-padding">
                            <div class="pricing-price">
                                <div>Sector</div>
                                <div>Page</div>
                            </div>
                            <div class="pricing-details">
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">5 user agent</div>
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">Core features</div>
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">10GB storage</div>
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">10 Custom domain</div>
                                </div>
                                <div class="pricing-item">
                                    <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                    <div class="pricing-item-label">24/7 Support</div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-cta">
                            <a href="#">Subscribe <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
</div>


@push('script')
@endpush
