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
                            <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Today</a>
                            </li>
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
                                                        <b> Total Bookings: {{ $bookings_count }} </b>


                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <b>Total Amount: N{{ number_format($bookings_amount) }}</b>


                                                    </div>


                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Room </th>
                                                            <th> Customer Name </th>
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
                                                                    <td>{{ $booking->customer_name }}</td>
                                                                    <td class="center">{{ $booking->amount }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($booking->check_in)) }}
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($booking->check_out)) }}
                                                                    </td>
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
                                                {{ $bookings->links('vendor.pagination.bootstrap-4') }}
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
                                                        <b> Total Bookings: {{ $bookings_yesterday_count }} </b>


                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <b>Total Amount: N{{ number_format($bookings_yesterday_amount) }}</b>


                                                    </div>


                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Room </th>
                                                            <th> Customer Name </th>
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
                                                        @if (isset($bookings_yesterday) && count($bookings_yesterday) > 0)
                                                            @foreach ($bookings_yesterday as $booking)
                                                                <tr class="odd gradeX">
                                                                    <td class="patient-img">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td>{{ $booking->room->name }}
                                                                    </td>
                                                                    <td>{{ $booking->customer_name }}</td>
                                                                    <td class="center">{{ $booking->amount }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($booking->check_in)) }}
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($booking->check_out)) }}
                                                                    </td>
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
                                                {{ $bookings_yesterday->links('vendor.pagination.bootstrap-4') }}
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
                                                        <b> Total Bookings: {{ $bookings_this_week_count }} </b>


                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <b>Total Amount: N{{ number_format($bookings_this_week_amount) }}</b>


                                                    </div>


                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Room </th>
                                                            <th> Customer Name </th>
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
                                                        @if (isset($bookings_this_week) && count($bookings_this_week) > 0)
                                                            @foreach ($bookings_this_week as $booking)
                                                                <tr class="odd gradeX">
                                                                    <td class="patient-img">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td>{{ $booking->room->name }}
                                                                    </td>
                                                                    <td>{{ $booking->customer_name }}</td>
                                                                    <td class="center">{{ $booking->amount }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($booking->check_in)) }}
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($booking->check_out)) }}
                                                                    </td>
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
                                                {{ $bookings_this_week->links('vendor.pagination.bootstrap-4') }}
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
                                                        <b> Total Bookings: {{ $bookings_all_time_count }} </b>


                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-4">
                                                        <b>Total Amount: N{{ number_format($bookings_all_time_amount) }}</b>


                                                    </div>


                                                </div>
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                    id="example4">
                                                    <thead>
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th> Room </th>
                                                            <th> Customer Name </th>
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
                                                        @if (isset($bookings_all_time) && count($bookings_all_time) > 0)
                                                            @foreach ($bookings_all_time as $booking)
                                                                <tr class="odd gradeX">
                                                                    <td class="patient-img">
                                                                        {{ $loop->iteration }}
                                                                    </td>
                                                                    <td>{{ $booking->room->name }}
                                                                    </td>
                                                                    <td>{{ $booking->customer_name }}</td>
                                                                    <td class="center">{{ $booking->amount }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($booking->check_in)) }}
                                                                    </td>
                                                                    <td>{{ date('d-m-Y', strtotime($booking->check_out)) }}
                                                                    </td>
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
                                                {{ $bookings_all_time->links('vendor.pagination.bootstrap-4') }}
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
