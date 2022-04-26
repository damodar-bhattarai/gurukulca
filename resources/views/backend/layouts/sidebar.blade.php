 <!--begin::Body-->

 <body id="kt_body"
     class="header-fixed header-tablet-and-mobile-fixed  toolbar-enabled toolbar-fixed @role('admin') aside-enabled aside-fixed @endrole "
     style="--kt-toolbar-height:10px;--kt-toolbar-height-tablet-and-mobile:10px">
     <!--begin::Main-->
     <!--begin::Root-->
     <div class="d-flex flex-column flex-root">
         <!--begin::Page-->
         <div class="page d-flex flex-row flex-column-fluid">
             <!--begin::Aside-->
             <div id="kt_aside" class=" @role('admin') aside  aside-dark aside-hoverable @endrole" data-kt-drawer="true"
                 data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
                 data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                 data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                 <!--begin::Brand-->
                 <div class="aside-logo flex-column-auto justify-content-center" id="kt_aside_logo">
                     <!--begin::Logo-->
                     <a href="{{ url('/') }}">
                         {{-- <img alt="Logo" src="{{ footerLogoUrl() }}" class="h-60px logo" /> --}}
                         {{-- <p style="font-size: 2rem;" class="text-light px-4">Gurukul CA</p> --}}
                     </a>
                     <!--end::Logo-->
                     <!--begin::Aside toggler-->
                     <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                         data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                         data-kt-toggle-name="aside-minimize">
                         <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                         <span class="svg-icon svg-icon-1 rotate-180">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                 <path opacity="0.5"
                                     d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                     fill="black" />
                                 <path
                                     d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                     fill="black" />
                             </svg>
                         </span>
                         <!--end::Svg Icon-->
                     </div>
                     <!--end::Aside toggler-->
                 </div>
                 <!--end::Brand-->
                 <!--begin::Aside menu-->
                 <div class="aside-menu flex-column-fluid">
                     <!--begin::Aside Menu-->
                     <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                         data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                         data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                         data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                         <!--begin::Menu-->
                         <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                             id="#kt_aside_menu" data-kt-menu="true">
                             <div class="menu-item">
                                 <a class="menu-link" href="{{ route('backend.dashboard') }}">
                                     <span class="menu-icon">
                                         <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                         <span class="svg-icon svg-icon-2">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
                                                 <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                 <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                     fill="black" />
                                                 <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                     fill="black" />
                                                 <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                     fill="black" />
                                             </svg>
                                         </span>
                                     </span>
                                     <!--end::Svg Icon-->
                                     <span class="menu-title">Dashboard</span>
                                 </a>
                             </div>


                             @role('admin')
                                 <div class="menu-item">
                                     <a class="menu-link" href="{{ route('backend.subjects') }}">
                                         <span class="menu-icon">
                                             <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                             <span class="svg-icon svg-icon-2">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                     <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                 </svg>
                                             </span>
                                         </span>
                                         <!--end::Svg Icon-->
                                         <span class="menu-title">Subjects</span>
                                     </a>
                                 </div>
                                 <div class="menu-item">
                                     <a class="menu-link" href="{{ route('backend.batches') }}">
                                         <span class="menu-icon">
                                             <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                             <span class="svg-icon svg-icon-2">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                     <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                 </svg>
                                             </span>
                                         </span>
                                         <!--end::Svg Icon-->
                                         <span class="menu-title">Batches</span>
                                     </a>
                                 </div>

                                 <div class="menu-item">
                                     <div class="menu-content pt-8 pb-2">
                                         <span class="menu-section text-muted text-uppercase fs-8 ls-1">Routines</span>
                                     </div>
                                 </div>


                                 <div class="menu-item">
                                     <a class="menu-link" href="{{ route('backend.routines.save') }}">
                                         <span class="menu-icon">
                                             <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                             <span class="svg-icon svg-icon-2">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                     <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                 </svg>
                                             </span>
                                         </span>
                                         <!--end::Svg Icon-->
                                         <span class="menu-title">Add Routine</span>
                                     </a>
                                 </div>
                                 <div class="menu-item">
                                     <a class="menu-link" href="{{ route('backend.routines.index') }}">
                                         <span class="menu-icon">
                                             <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                             <span class="svg-icon svg-icon-2">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                     <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                 </svg>
                                             </span>
                                         </span>
                                         <!--end::Svg Icon-->
                                         <span class="menu-title">View Routine</span>
                                     </a>
                                 </div>
                                 <div class="menu-item">
                                     <div class="menu-content pt-8 pb-2">
                                         <span class="menu-section text-muted text-uppercase fs-8 ls-1">Reports</span>
                                     </div>
                                 </div>
                                 <div class="menu-item">
                                     <a class="menu-link" href="{{ route('backend.routines.report') }}">
                                         <span class="menu-icon">
                                             <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                             <span class="svg-icon svg-icon-2">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                     <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                     <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                         fill="black" />
                                                 </svg>
                                             </span>
                                         </span>
                                         <!--end::Svg Icon-->
                                         <span class="menu-title">Generate Reports</span>
                                     </a>
                                 </div>


                                 <div class="menu-item">
                                     <div class="menu-content pt-8 pb-2">
                                         <span class="menu-section text-muted text-uppercase fs-8 ls-1">Teacher &
                                             Students</span>
                                     </div>
                                 </div>

                                 <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                     <span class="menu-link">
                                         <span class="menu-icon">
                                             <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                             <span class="svg-icon svg-icon-2">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                     <path
                                                         d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                                         fill="black" />
                                                     <path
                                                         d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                                         fill="black" />
                                                     <path opacity="0.3"
                                                         d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                                         fill="black" />
                                                 </svg>
                                             </span>
                                             <!--end::Svg Icon-->
                                         </span>
                                         <span class="menu-title">Manage Users</span>
                                         <span class="menu-arrow"></span>
                                     </span>
                                     <div class="menu-sub menu-sub-accordion menu-active-bg">
                                         <div class="menu-item">
                                             <a class="menu-link" href="{{ route('backend.user.admins') }}">
                                                 <span class="menu-bullet">
                                                     <span class="bullet bullet-dot"></span>
                                                 </span>
                                                 <span class="menu-title">Admin List</span>
                                             </a>
                                         </div>
                                         <div class="menu-item">
                                             <a class="menu-link" href="{{ route('backend.user.teachers') }}">
                                                 <span class="menu-bullet">
                                                     <span class="bullet bullet-dot"></span>
                                                 </span>
                                                 <span class="menu-title">Teacher List</span>
                                             </a>
                                         </div>
                                         <div class="menu-item">
                                             <a class="menu-link" href="{{ route('backend.user.students') }}">
                                                 <span class="menu-bullet">
                                                     <span class="bullet bullet-dot"></span>
                                                 </span>
                                                 <span class="menu-title">Student List</span>
                                             </a>
                                         </div>
                                         <div class="menu-item">
                                             <a class="menu-link" href="{{ route('backend.user.create') }}">
                                                 <span class="menu-bullet">
                                                     <span class="bullet bullet-dot"></span>
                                                 </span>
                                                 <span class="menu-title">Add User</span>
                                             </a>
                                         </div>
                                     </div>
                                     <div class="menu-item">
                                         <a class="menu-link" href="{{ route('backend.user.students.bulk') }}">
                                             <span class="menu-icon">
                                                 <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                                 <span class="svg-icon svg-icon-2">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                         <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                         <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                             fill="black" />
                                                         <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                             fill="black" />
                                                         <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                             fill="black" />
                                                     </svg>
                                                 </span>
                                             </span>
                                             <!--end::Svg Icon-->
                                             <span class="menu-title">Bulk Student Upload</span>
                                         </a>
                                     </div>
                                 </div>
                             @endrole





                         </div>
                         <!--end::Menu-->
                     </div>
                     <!--end::Aside Menu-->
                 </div>

             </div>
             <!--end::Aside-->



             <!--begin::Wrapper-->
             <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                 <!--begin::Header-->
                 <div id="kt_header" style="" class="header align-items-stretch">
                     <!--begin::Container-->
                     <div class="container-fluid d-flex align-items-stretch justify-content-between">
                         @role('admin')
                             <!--begin::Aside mobile toggle-->
                             <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                                 <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                     id="kt_aside_mobile_toggle">
                                     <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                     <span class="svg-icon svg-icon-1">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none">
                                             <path
                                                 d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                                 fill="black" />
                                             <path opacity="0.3"
                                                 d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                                 fill="black" />
                                         </svg>
                                     </span>
                                     <!--end::Svg Icon-->
                                 </div>
                             </div>
                             <!--end::Aside mobile toggle-->
                         @endrole
                         <!--begin::Mobile logo-->
                         <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                             <a href="{{ url('/') }}" class="d-lg-none">
                                 {{-- <img alt="Logo" src="{{ siteLogoUrl() }}" class="h-30px" /> --}}
                                 <p style="font-size: 2rem;" class="text-dark px-4 h-30px">Gurukul CA</p>

                             </a>
                         </div>
                         <!--end::Mobile logo-->
                         <!--begin::Wrapper-->
                         <div class="d-flex align-items-center justify-content-between flex-lg-grow-1">
                             <!--begin::Navbar-->
                             <div class="d-flex d-none d-md-block align-items-center w-full" id="kt_header_nav">
                                 <div class="text-center">
                                     <strong class="h1">Gurukul CA</strong>
                                 </div>
                             </div>
                             <!--end::Navbar-->
                             <!--begin::Toolbar wrapper-->
                             <div class="d-flex align-items-stretch flex-shrink-0">
                                 <!--begin::User menu-->
                                 <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                     <div class="mx-3 px-3">

                                     </div>
                                     <!--begin::Menu wrapper-->
                                     <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                         data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                         data-kt-menu-placement="bottom-end">
                                         <img src="{{ auth()->user()->avatar? Storage::url(auth()->user()->avatar): 'https://ui-avatars.com/api/?background=02AAE9&color=fff&name=' . auth()->user()->name }}"
                                             alt="User" style="height:40px; width:40px; object-fit:cover;">
                                     </div>
                                     <!--begin::User account menu-->
                                     <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                         data-kt-menu="true">
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-3">
                                             <div class="menu-content d-flex align-items-center px-3">
                                                 <!--begin::Avatar-->
                                                 <div class="symbol symbol-50px me-5">
                                                     <img src="{{ auth()->user()->avatar? Storage::url(auth()->user()->avatar): 'https://ui-avatars.com/api/?background=02AAE9&color=fff&name=' . auth()->user()->name }}"
                                                         alt="User" style="height:40px; width:40px; object-fit:cover;">
                                                 </div>
                                                 <!--end::Avatar-->
                                                 <!--begin::Username-->
                                                 <div class="d-flex flex-column">
                                                     <div class="fw-bolder d-flex align-items-center fs-5">
                                                         {{ auth()->user()->name }}
                                                     </div>
                                                     <div
                                                         class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">
                                                         @foreach (auth()->user()->getRoleNames()
    as $role)
                                                             @if (!$loop->last)
                                                                 {{ $role }} |
                                                             @else
                                                                 {{ $role }}
                                                             @endif
                                                         @endforeach
                                                     </div>
                                                     <a href="javascript:"
                                                         class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->phone }}</a>
                                                 </div>
                                                 <!--end::Username-->
                                             </div>
                                         </div>
                                         <!--end::Menu item-->
                                         <!--begin::Menu separator-->
                                         <div class="separator my-2"></div>
                                         <!--end::Menu separator-->
                                         <!--begin::Menu item-->
                                         <div class="menu-item px-5">
                                             <a href="{{ route('backend.dashboard') }}"
                                                 class="menu-link px-5">Dashboard</a>
                                         </div>
                                         <div class="menu-item px-5">
                                             <a href="{{ route('backend.user.password') }}"
                                                 class="menu-link px-5">Change Password</a>
                                         </div>
                                         <!--end::Menu item-->


                                         <!--begin::Menu separator-->
                                         <div class="separator my-2"></div>
                                         <!--end::Menu separator-->



                                         <!--begin::Menu item-->
                                         <div class="menu-item px-5">
                                             <!-- Authentication -->
                                             <form method="POST" class="menu-link px-5"
                                                 action="{{ route('logout') }}">
                                                 @csrf
                                                 <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                                     {{ __('Log Out') }}
                                                 </x-dropdown-link>
                                             </form>
                                         </div>
                                         <!--end::Menu item-->


                                         <!--end::Menu item-->
                                     </div>
                                     <!--end::User account menu-->
                                     <!--end::Menu wrapper-->
                                 </div>
                                 <!--end::User menu-->
                             </div>
                             <!--end::Toolbar wrapper-->
                         </div>
                         <!--end::Wrapper-->
                     </div>
                     <!--end::Container-->
                 </div>
                 <!--end::Header-->
