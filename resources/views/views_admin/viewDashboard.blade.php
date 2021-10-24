@extends('layouts/layout_admin')

@section('page_title', 'Dashboard')

@section('module_title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active"> </li>
@endsection

@section('content')
    @include('views_admin.php_inc.alertNotification')

    
      
    <script> 
    $('#navDashboard').addClass('active'); 

    var route_index = "{{ route('dashboard') }}";
    var route_data = "";
    var route_confirm_edit = "";
    var route_confirm_delete = "";
    var route_confirm_detail = "";
    var column_data = [];
    </script>
@endsection