@extends('layout/master')
@section('content')
    <!-- end sidebar menu -->
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!--Notification Modal -->  
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Notifications</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul id="notification" style="list-style-type: none"></ul>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Dashboard</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div>
                        <button class="btn mt-3 ms-5" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                class="fa fa-bell"></i>Notifications <sup class="bold text-danger h5"
                                id="count"></sup></button>

                    </div>
                </div>
            </div>
            <!-- start widget -->
            <div class="state-overview">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-purple">
                            <span class="info-box-icon push-bottom"><i data-feather="users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Rooms</span>
                                <span class="info-box-number">{{ $total_rooms > 0 ? $total_rooms : 0 }} </span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-green">
                            <span class="info-box-icon push-bottom"><i data-feather="user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Available Rooms</span>
                                <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    100% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-pink">
                            <span class="info-box-icon push-bottom"><i data-feather="user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Booked Rooms</span>
                                <span class="info-box-number">{{ $booked_rooms > 0 ? $booked_rooms : 0 }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    100% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-yellow">
                            <span class="info-box-icon push-bottom"><i data-feather=""></i></span>
                            <div class="info-box-content">
                                {{-- <p style="font-size: 8px" >Booking and Restaurant</p> --}}
                                <span class="info-box-text">Total Sales<sup>(All TIme)</sup></span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                {{-- <span>All</span> --}}
                                <span>N{{ number_format($total_sales) }}</span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    100% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <div class="state-overview">
                <div class="row">
                    <h3 class="text-primary">Today's Overview</h3>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-blue">
                            <span class="info-box-icon push-bottom"><i data-feather="money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Bookings</span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <span>N {{ number_format($today_sales) }} </span>

                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    100% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-blue">
                            <span class="info-box-icon push-bottom"><i data-feather="money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Food</span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <span>N {{ number_format($today_food_sales) }} </span>

                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    100% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-blue">
                            <span class="info-box-icon push-bottom"><i data-feather="money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Drinks</span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <span>N {{ number_format($today_drink_sales) }} </span>

                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    100% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-blue">
                            <span class="info-box-icon push-bottom"><i data-feather="money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total</span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <span>N {{ number_format($total_today_sales) }} </span>

                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    40% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent activities $recent_orders --}}
            <p class="h3">Recent activities...</p>
            @forelse($recent_orders as $order)
                @if ($order->food !== null)
                    <p class="text-success h5">...N{{ number_format($order->ordered_food_price) }}
                        {{ $order->food->food_name }} ...{{ $order->created_at->diffForHumans() }}</p>
                @endif
                @if ($order->drink !== null)
                    <p class="text-success h5">...N{{ number_format($order->ordered_drink_price) }}
                        {{ $order->drink->drink_name }} ...{{ $order->created_at->diffForHumans() }}</p>
                @endif
                @if ($order->room !== null)
                    <p class="text-success h5">...N{{ number_format($order->amount) }} {{ $order->room->name }}
                        ...{{ $order->created_at->diffForHumans() }}</p>
                @endif
            @empty
                <div class="text-danger">
                    <strong>No Recent Orders</strong>
                </div>
            @endforelse


        </div>
    </div>
@endsection
<script src="../leave_report/assets/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: '/notifications',

            success: function(response) {
                let data = JSON.parse(response);
                console.log('check out date', data);
                if(data.length > 0){
                  $.each(data, function(index, value) {
                    $('#notification').append(`
                        <li class="text-danger"> ${index+1}. Mr/Mrs ${value.customer_name} in ${value.room.name} would check out by 12 noon today!<li>
                `);
                 });
              

                       
                        $('#count').html(data.length);
                        
                }else{
                   $('#notification').html('<p class="text-danger">No Notifications</p>');
                }

                
                },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("Oops!", "An error occurred.");
                console.log(XMLHttpRequest, textStatus, errorThrown);
            }

        })
    });

    //empty the notification section by 12:10 pm


</script>
