 @yield('style')
 <!-- Fevicon -->
 {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}"> --}}

 <link href="{{ asset('assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ asset('assets/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

 <!-- Sweet Alert css -->
 <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

 <!-- Datepicker css -->
 <link href="{{ asset('assets/plugins/datepicker/datepicker.min.css') }}" rel="stylesheet" type="text/css">

 <style>
     .btnTopMargin {
         margin-top: 30px;
     }

     .formRepeterAddBtn {
         display: none;
         pointer-events: none;
     }

     .formRepeterAddBtn:last-child {
         display: initial;
         pointer-events: auto;
     }

     .radio-label {
         margin-top: -15px;
         padding-bottom: 7px;
     }

     .custom-radio-button .radio-pink input[type=radio]+label:before {
         border-color: #df4dbf;
     }

     .custom-radio-button .radio-pink input[type=radio]:checked+label:before {
         background-color: #df4dbf;
     }

     .empty-repeater-row:first-child {
         display: none;
     }

     .role_name {
         color: #777777;
     }

     .vertical-menu .vertical-submenu>li>a:before {
         content: "+";
     }

 </style>
