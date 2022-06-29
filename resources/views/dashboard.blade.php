@extends('layout/master')
@section('content')
    <!-- end sidebar menu -->
    <!-- start page content -->
    <div class="page-content-wrapper">
        <div class="page-content">
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
                </div>
            </div>
            <!-- start widget -->
            <div class="state-overview">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-green">
                            <span class="info-box-icon push-bottom"><i data-feather="users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Rooms</span>
                                <span class="info-box-number">{{ $total_rooms > 0 ? $total_rooms : 0 }} </span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 45%"></div>
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
                                    <div class="progress-bar" style="width: 40%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    40% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-yellow">
                            <span class="info-box-icon push-bottom"><i data-feather="user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Booked Rooms</span>
                                <span class="info-box-number">{{ $booked_rooms > 0 ? $booked_rooms : 0 }}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 40%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    40% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-green">
                            <span class="info-box-icon push-bottom"><i data-feather=""></i></span>
                            <div class="info-box-content">
                                {{-- <p style="font-size: 8px" >Booking and Restaurant</p> --}}
                                <span class="info-box-text">Total Sales</span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                {{-- <span>All</span> --}}
                                <span>N{{ number_format($total_sales) }}</span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 40%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    40% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
<hr>
            <div class="state-overview">
                <div class="row">
                    <h3 class="text-primary" >Today's Overview</h3>
                     <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-b-blue">
                            <span class="info-box-icon push-bottom"><i data-feather="money"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Bookings</span>
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <span>N {{ $today_sales }} </span>
                                
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 40%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    40% Increase in 28 Days
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
                                <span>N {{ $today_sales }} </span>
                                
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 40%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    40% Increase in 28 Days
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
                                <span>N {{ $today_sales }} </span>
                                
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 40%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    40% Increase in 28 Days
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
                                <span>N {{ $today_sales }} </span>
                                
                                {{-- <span class="info-box-number">{{ $available_rooms > 0 ? $available_rooms : 0 }}</span> --}}
                                <div class="progress">
                                    <div class="progress-bar" style="width: 40%"></div>
                                </div>
                                {{-- <span class="progress-description">
                                    40% Increase in 28 Days
                                </span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
