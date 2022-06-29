@extends('layout/master')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Rooms</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        {{-- <li><a class="parent-item" href="#">Other Staff</a>&nbsp;<i class="fa fa-angle-right"></i> --}}
                        </li>
                        <li class="active">Rooms</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line">
                        <ul class="nav customtab nav-tabs" role="tablist">
                            <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">List
                                    View</a></li>
                            <li class="nav-item"><a href="#tab2" class="nav-link" data-bs-toggle="tab">Grid
                                    View</a></li>
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
                                                    <div class="col-md-6 col-sm-6 col-6">
                                                        <div id="example4_filter" class="dataTables_filter">
                                                            <label>
                                                                <input type="text" style="margin-bottom: 10px"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Search" aria-controls="example4"
                                                                    id="search">
                                                            </label>
                                                        </div>
                                                        
                                                       
                                                    </div>

                                                     <div class="col-md-6 col-sm-6 col-6">
                                                            {{-- <label for="sort">Sort By</label> --}}
                                                            <select class="form-select input-height" style="margin-bottom: 10px" name="drink_id"
                                                                id="sort">
                                                                <option value="">Sort By</option>
                                                                <option value="">Today</option>
                                                                <option value="">Yesterday</option>
                                                                <option value="">All</option>
                                                            </select>
                                                        </div>
                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Name </th>
                                                            <th> Amount </th>
                                                            <th> Check In</th>
                                                            <th> Check Out </th>
                                                            <th> Day(s)</th>
                                                            {{-- <th> Leave Days </th> --}}
                                                            <th> Date </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="result"></tbody>
                                                    <tbody id="old">
                                                        @if (isset($bookings) && count($bookings) > 0)
                                                            @foreach ($bookings as $booking)
                                                                <tr class="odd gradeX">
                                                                    <td class="patient-img">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td>{{ $booking->room->name }}
                                                                    </td>
                                                                    <td class="center">{{ $booking->amount }}</td>
                                                                    <td>{{ 
                                                                        date('d-m-Y', strtotime($booking->check_in))
                                                                     }}</td>
                                                                    <td>{{ 
                                                                        date('d-m-Y', strtotime($booking->check_out))
                                                                     
                                                                     }}</td>
                                                                    <td>{{ date($booking->days) }}</td>
                                                                    </td>
                                                                    <td>
                                                                        {{ $booking->created_at->diffForHumans() }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                            @endif
                                                        </tbody>
                                                    </table>
                                                    {{-- {{ $bookings->links('vendor.pagination.bootstrap-4') }} --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab2">

                                <div class="row">
                                    @if (isset($bookings) && count($bookings) > 0)
                                        @foreach ($bookings as $booking)
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body no-padding ">
                                                        <div class="doctor-profile">
                                                            <div class="profile-usertitle">
                                                                <div class="doctor-name">{{ $booking->room->name }}
                                                                    
                                                                </div>
                                                                <div class="name-center"><b>Amount:</b>
                                                                    {{ $booking->amount }}
                                                                </div>
                                                            </div>
                                                            <p><b>Check In:</b> {{  date('d-m-Y', strtotime($booking->check_in)) }}</p>

                                                            <p><b>Check Out:</b>
                                                                {{date('d-m-Y', strtotime($booking->check_out))}}
                                                            </b>
                                                            </p>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
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
