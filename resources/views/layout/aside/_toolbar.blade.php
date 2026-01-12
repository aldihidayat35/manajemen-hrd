

<!--begin::User Info-->
<div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
    <!--begin::Wrapper-->
    <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
        <!--begin::Section-->
        <div class="d-flex">
            <!--begin::Info-->
            <!--begin::Avatar-->
            <div class="me-3">
                @if(Auth::user()->profile_photo ?? null)
                    <div class="symbol symbol-50px">
                        <img src="{{ Auth::user()->profile_photo }}" alt="user" />
                    </div>
                @else
                    <div class="symbol symbol-50px">
                        <span class="symbol-label bg-light-primary text-primary fs-5 fw-bold">
                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
                        </span>
                    </div>
                @endif
            </div>
            <!--end::Avatar-->
            <div class="flex-grow-1 me-2">
                <!--begin::Username-->
                <a href="#" class="text-white text-hover-primary fs-6 fw-bold">{{ Auth::user()->name ?? 'Admin' }}</a>
                <!--end::Username-->
                <!--begin::Description-->
                <span class="text-gray-600 fw-semibold d-block fs-8 mb-1">{{ ucfirst(Auth::user()->role ?? 'User') }}</span>
                <!--end::Description-->
                <!--begin::Label-->
                <div class="d-flex align-items-center text-success fs-9">
                    <span class="bullet bullet-dot bg-success me-1"></span>online
                </div>
                <!--end::Label-->
            </div>
            <!--end::Info-->
            <!--begin::User menu-->
            <div class="me-n2">
                <!--begin::Action-->
                {{-- <a href="#" class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
                    <i class="ki-duotone ki-setting-2 text-muted fs-1"><span class="path1"></span><span class="path2"></span></i>
                </a> --}}
{{-- @include('partials/menus/_user-account-menu') --}}
                <!--end::Action-->
            </div>
            <!--end::User menu-->
        </div>
        <!--end::Section-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::User Info-->
<!--begin::Aside search-->
{{-- <div class="aside-search py-5">
@include('partials/search/_inline')
</div> --}}
<!--end::Aside search-->
