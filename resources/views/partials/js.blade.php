<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>

<!-- Sparkline Js-->
<script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Js-->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Chart Custom Js-->
<script src="{{ asset('assets/pages/knob-chart-demo.js') }}"></script>

<!-- Morris Js-->
<script src="{{ asset('assets/plugins/morris-js/morris.min.js') }}"></script>

<!-- Raphael Js-->
<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('assets/pages/dashboard-demo.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/theme.js') }}"></script>

<!-- third party js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>

<!-- Sweet Alerts Js-->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ asset('assets/js/developer.js') }}"></script>

@if(request()->is('users')) <!-- Check if the current URL matches the "users" route -->
    <script src="{{ asset('assets/js/pages/users.js') }}"></script>
@endif

@if(request()->is('roles')) <!-- Check if the current URL matches the "roles" route -->
    <script src="{{ asset('assets/js/pages/roles.js') }}"></script>
@endif

@if(request()->is('states')) <!-- Check if the current URL matches the "states" route -->
    <script src="{{ asset('assets/js/pages/states.js') }}"></script>
@endif

@if(request()->is('districts')) <!-- Check if the current URL matches the "districts" route -->
    <script src="{{ asset('assets/js/pages/districts.js') }}"></script>
@endif

@if(request()->is('subdistricts')) <!-- Check if the current URL matches the "districts" route -->
    <script src="{{ asset('assets/js/pages/sub-districts.js') }}"></script>
@endif