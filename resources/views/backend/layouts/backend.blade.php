@include('backend.layouts.header')
@include('backend.layouts.sidebar')
 <!--begin::Content-->
<div class="container-fluid" id="kt_content">
        @yield('content')
</div>
<!--end::Content-->
@include('backend.layouts.footer')
