@extends('layout/master')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Food</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        {{-- <li><a class="parent-item" href="#">Other Staff</a>&nbsp;<i class="fa fa-angle-right"></i> --}}
                        </li>
                        <li class="active">Food</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <ul class="nav customtab nav-tabs" role="tablist">
                            <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Today</a></li>
                            <li class="nav-item"><a href="#tab2" class="nav-link" data-bs-toggle="tab">Yesterday</a></li>
                            <li class="nav-item"><a href="#tab3" class="nav-link" data-bs-toggle="tab">This week</a></li>
                            <li class="nav-item"><a href="#tab4" class="nav-link" data-bs-toggle="tab">All</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active fontawesome-demo" id="tab1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-head">
                                                <header></header>
                                                <div class="tools">
                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                    <a class="t-collapse btn-color fa fa-chevron-down"
                                                        href="javascript:;"></a>
                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                 @include('flash.flash')    
                                                <div class="row">
                                                    {{-- <div class="col-md-6 col-sm-6 col-6">
                                                        <div class="btn-group">
                                                            <a href="/add_rooms" id="addRow" class="btn btn-primary">
                                                                Add More Rooms <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>

                                                    </div> --}}
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <div id="example4_filter" class="dataTables_filter">
                                                            <label>
                                                                <input type="text" style="margin-bottom: 10px"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Search" aria-controls="example4"
                                                                    id="search">
                                                            </label>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        {{-- <b> Total Qty: {{ $total_qty_today }} </b> --}}
                                                        
                                                       
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                       <b>Total Amount: N{{ number_format($foodReports_amount) }}</b>
                                                        
                                                       
                                                    </div>

                                                     
                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Food </th>  
                                                            <th>Amount</th>
                                                            {{-- <th> Quantity </th> --}}
                                                            <th>TIme</th>
                                                            {{-- <th> Leave Days </th> --}}
                                                            {{-- <th> Date </th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody id="result"></tbody>
                                                    <tbody id="old">
                                                        @if (isset($foodReports) && count($foodReports) > 0)
                                                            @foreach ($foodReports as $food)
                                                                <tr class="odd gradeX">
                                                                    <td class="patient-img">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td>{{ $food->food->food_name }}
                                                                    </td>
                                                                    <td class="center">{{ $food->ordered_food_price }}</td>
{{--                                                                     
                                                                    <td>{{ 
                                                                        
                                                                        $food->ordered_food_quantity
                                                                
                                                                        
                                                                     
                                                                     }}</td> --}}
                                                                   
                                                                    </td>
                                                                    <td>
                                                                       {{ $food->created_at->format('y-m-d H:m:s') }} ({{ $food->created_at->diffForHumans() }})
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    {{ $foodReports->links('vendor.pagination.bootstrap-4') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="tab2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-head">
                                                <header></header>
                                                <div class="tools">
                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                    <a class="t-collapse btn-color fa fa-chevron-down"
                                                        href="javascript:;"></a>
                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                 @include('flash.flash')    
                                                <div class="row">
                                                    {{-- <div class="col-md-6 col-sm-6 col-6">
                                                        <div class="btn-group">
                                                            <a href="/add_rooms" id="addRow" class="btn btn-primary">
                                                                Add More Rooms <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>

                                                    </div> --}}
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <div id="example4_filter" class="dataTables_filter">
                                                            <label>
                                                                <input type="text" style="margin-bottom: 10px"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Search" aria-controls="example4"
                                                                    id="search">
                                                            </label>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        {{-- <b> Total Qty: {{ $total_qty_yesterday }} </b> --}}
                                                        
                                                       
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                       <b>Total Amount: N{{ number_format($foodReports_yesterday_amount) }}</b>
                                                        
                                                       
                                                    </div>

                                                     
                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Food </th>
                                                            
                                                            <th>Amount</th>
                                                            {{-- <th> Quantity </th> --}}
                                                            <th>Time</th>
                                                            {{-- <th> Leave Days </th> --}}
                                                            {{-- <th> Date </th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody id="result"></tbody>
                                                    <tbody id="old">
                                                        @if (isset($foodReports_yesterday) && count($foodReports_yesterday) > 0)
                                                            @foreach ($foodReports_yesterday as $food)
                                                                <tr class="odd gradeX">
                                                                    <td class="patient-img">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td>{{ $food->food->food_name }}
                                                                    </td>
                                                                    <td class="center">{{ $food->ordered_food_price }}</td>
{{--                                                                     
                                                                    <td>{{ 
                                                                        
                                                                        $food->ordered_food_quantity
                                                                
                                                                        
                                                                     
                                                                     }}</td> --}}
                                                                   
                                                                    </td>
                                                                    <td>
                                                                       {{ $food->created_at->format('y-m-d H:m:s') }} ({{ $food->created_at->diffForHumans() }})
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    {{ $foodReports_yesterday->links('vendor.pagination.bootstrap-4') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="tab3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-head">
                                                <header></header>
                                                <div class="tools">
                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                    <a class="t-collapse btn-color fa fa-chevron-down"
                                                        href="javascript:;"></a>
                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                 @include('flash.flash')    
                                                <div class="row">
                                                    {{-- <div class="col-md-6 col-sm-6 col-6">
                                                        <div class="btn-group">
                                                            <a href="/add_rooms" id="addRow" class="btn btn-primary">
                                                                Add More Rooms <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>

                                                    </div> --}}
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <div id="example4_filter" class="dataTables_filter">
                                                            <label>
                                                                <input type="text" style="margin-bottom: 10px"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Search" aria-controls="example4"
                                                                    id="search">
                                                            </label>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        {{-- <b> Total Qty: {{ $total_qty_week }} </b> --}}
                                                        
                                                       
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                       <b>Total Amount: N{{ number_format($foodReports_week_amount) }}</b>
                                                        
                                                       
                                                    </div>

                                                     
                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Food </th>
                                                            
                                                            <th>Amount</th>
                                                            {{-- <th> Quantity </th> --}}
                                                            <th>TIme</th>
                                                            {{-- <th> Leave Days </th> --}}
                                                            {{-- <th> Date </th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody id="result"></tbody>
                                                    <tbody id="old">
                                                        @if (isset($foodReports_week) && count($foodReports_week) > 0)
                                                            @foreach ($foodReports_week as $food)
                                                                <tr class="odd gradeX">
                                                                    <td class="patient-img">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td>{{ $food->food->food_name }}
                                                                    </td>
                                                                    <td class="center">{{ $food->ordered_food_price }}</td>
                                                                    
                                                                    <td>{{ 
                                                                        $food->ordered_food_quantity         
                                                                     }}</td>
                                                                   
                                                                    </td>
                                                                    <td>
                                                                       {{ $food->created_at->format('y-m-d H:m:s') }} ({{ $food->created_at->diffForHumans() }})
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    {{ $foodReports_week->links('vendor.pagination.bootstrap-4') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="tab4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-head">
                                                <header></header>
                                                <div class="tools">
                                                    <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                    <a class="t-collapse btn-color fa fa-chevron-down"
                                                        href="javascript:;"></a>
                                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                                </div>
                                            </div>
                                            <div class="card-body ">
                                                 @include('flash.flash')    
                                                <div class="row">
                                                    {{-- <div class="col-md-6 col-sm-6 col-6">
                                                        <div class="btn-group">
                                                            <a href="/add_rooms" id="addRow" class="btn btn-primary">
                                                                Add More Rooms <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>

                                                    </div> --}}
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <div id="example4_filter" class="dataTables_filter">
                                                            <label>
                                                                <input type="text" style="margin-bottom: 10px"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Search" aria-controls="example4"
                                                                    id="search">
                                                            </label>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        {{-- <b> Total Qty: {{ $total_qty_all }} </b> --}}
                                                        
                                                       
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                       <b>Total Amount: N{{ number_format($foodReports_all_amount) }}</b>
                                                        
                                                       
                                                    </div>

                                                     
                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Food </th>
                                                            
                                                            <th>Amount</th>
                                                            {{-- <th> Quantity </th> --}}
                                                            <th>TIme</th>
                                                            {{-- <th> Leave Days </th> --}}
                                                            {{-- <th> Date </th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody id="result"></tbody>
                                                    <tbody id="old">
                                                        @if (isset($foodReports_all) && count($foodReports_all) > 0)
                                                            @foreach ($foodReports_all as $food)
                                                                <tr class="odd gradeX">
                                                                    <td class="patient-img">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td>{{ $food->food->food_name }}
                                                                    </td>
                                                                    <td class="center">{{ $food->ordered_food_price }}</td>
{{--                                                                     
                                                                    <td>{{ 
                                                                        
                                                                        $food->ordered_food_quantity
                                                                
                                                                        
                                                                     
                                                                     }}</td> --}}
                                                                   
                                                                    </td>
                                                                    <td>
                                                                       {{ $food->created_at->format('y-m-d H:m:s') }} ({{ $food->created_at->diffForHumans() }})
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    {{ $foodReports_all->links('vendor.pagination.bootstrap-4') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="http://code.jquery.com/jquery-3.4.1.js"></script>

<script>
    var searchRquest = [];
    var minLength = 3;
    $(function() {
        $("#search").keyup(function() {
            console.log('search');
            let value = $(this).val();
            console.log('value', value);
            if (value.length >= minLength) {
                if (searchRquest != null) {
                    // searchRquest.abort();

                    searchRquest = $.ajax({
                        url: "/search_staffs",
                        type: "GET",
                        data: {
                            search: value
                        },
                        success: function(data) {
                            console.log('data success', data);
                            var html = '';
                            var response = JSON.parse(data);
                            console.log('response', response);

                            if (response.length > 0) {
                                $.each(response, function(key, value) {
                                    console.log('value', value);
                                    html += `
                                <tr class="odd gradeX">
                                    <td class="patient-img">
                                        ${key + 1}  </td>
                                        <td>${value.first_name} ${value.last_name}
                                        </td>
                                        <td class="center">${value.rank}</td>
                                        <td>${value.unit}</td>
                                        <td>${30 - parseInt(value.leave_days) == 0 ? 30 : 30 - parseInt(value.leave_days)}
                                        </td>
                                        <td>
                                            <div class="profile-userbuttons">
                                                <a href="/leave_request/${btoa(value.id)}" class="btn btn-circle deepPink-bgcolor btn-sm">Request
                                                    Leave</a>
                                            </div>
                                            </td>
                                            </tr>
                                            `;
                                    $('#old').hide();
                                    $('#result').empty().append(html);
                                });
                            } else {
                                $('#result').empty();
                                $('#old').hide();
                                $('#result').append(`
                                <div>
                                   
                                        <h3>No Result Found</h3>
                                   
                                 </div>
                                    `);
                            }

                        },
                        error: function(data) {
                            console.log('data error', data);
                        }
                    });
                }
            } else {
                $('#result').empty();
                $('#old').show();
            }
        });
    });
</script>
