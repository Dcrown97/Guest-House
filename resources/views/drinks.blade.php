@extends('layout/master')
@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Restaurant</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="/">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Drinks</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card card-box">
                    <div class="card-head">
                        <header>Drinks</header>
                        <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                            data-upgraded=",MaterialButton">
                            <i class="material-icons">more_vert</i>
                        </button>

                    </div>

                    <div class="panel tab-border card-box">
                        <header class="panel-heading panel-heading-gray custom-tab">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#order_food" data-bs-toggle="tab" class="active">
                                        </i> Order Drinks
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#add_food" data-bs-toggle="tab">
                                        </i> Add Drinks
                                    </a>
                                </li>

                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="add_food">
                                    <div class="card-body" id="bar-parent">
                                        @include('flash.flash')
                                        <form action="{{ route('add_drinks') }}" method="POST" id="form_sample_1"
                                            class="form-horizontal">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Drink Name
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="text" name="drink_name" data-required="1"
                                                            placeholder="Enter Drink Name"
                                                            class="form-control input-height" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Number Of Drink
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="number" name="num_of_drink" data-required="1"
                                                            placeholder="Enter Drink Price"
                                                            class="form-control input-height" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Price
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="number" name="drink_price" data-required="1"
                                                            placeholder="Enter Drink Price"
                                                            class="form-control input-height" />
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="offset-md-3 col-md-9">
                                                            <button type="submit"
                                                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary">Submit</button>
                                                            <button type="button"
                                                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <table
                                        class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                        id="example4">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th> Drinks </th>
                                                <th> Price </th>
                                                <th>Available</th>

                                                {{-- <th> Leave Days </th> --}}
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody id="result"></tbody>
                                        <tbody id="old">
                                            @if (isset($drinks) && count($drinks) > 0)
                                            @foreach ($drinks as $drink)
                                            <tr class="odd gradeX">
                                                <td class="patient-img">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $drink->drink_name }}
                                                </td>
                                                <td class="center">{{ $drink->drink_price }}</td>
                                                <td>{{ $drink->num_of_drink }}</td>


                                                <td>
                                                    <div class="justify-content-between">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#add_modal{{ $drink->id }}">
                                                            <i class="fa fa-plus"></i>
                                                            Add More
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update_modal{{ $drink->id }}">
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </button>

                                                        <a onclick="return confirm('Are you sure you want to delete this drink?')"
                                                            href="/delete_drink/{{ base64_encode($drink->id) }}"
                                                            class="btn btn-danger btn-lg">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>






                                            <!--Edit Modal -->
                                            <div class="modal fade" id="update_modal{{ $drink->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Edit
                                                                Drink </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/update_drink" method="POST"
                                                                id="form_sample_1" class="form-horizontal">
                                                                @csrf
                                                                <div class="form-body">
                                                                    <input type="hidden" name="drink_id"
                                                                        value="{{ $drink->id }}" id="">
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Drink
                                                                            Name
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="text" name="drink_name"
                                                                                data-required="1"
                                                                                placeholder="Enter Drink Name"
                                                                                value="{{ $drink->drink_name }}"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Number
                                                                            Of Drink
                                                                            <span class="required"> *
                                                                            </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="number" name="num_of_drink"
                                                                                data-required="1"
                                                                                placeholder="Enter Drink Price"
                                                                                value="{{ $drink->num_of_drink }}"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Price
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="number" name="drink_price"
                                                                                data-required="1"
                                                                                placeholder="Enter Drink Price"
                                                                                value="{{ $drink->drink_price }}"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Available
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="number" name="available"
                                                                                data-required="1"
                                                                                placeholder="Enter Available"
                                                                                value="{{ $drink->num_of_drink }}"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End of edit modal --}}

                                            {{-- Add more --}}
                                            <div class="modal fade" id="add_modal{{ $drink->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Add
                                                                More
                                                                Drink </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/add_more_drinks" method="POST"
                                                                id="form_sample_1" class="form-horizontal">
                                                                @csrf
                                                                <div class="form-body">
                                                                    <input type="hidden" name="drink_id"
                                                                        value="{{ $drink->id }}" id="">
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Drink
                                                                            Name
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="text" name="drink_name"
                                                                                data-required="1"
                                                                                placeholder="Enter Drink Name" readonly
                                                                                value="{{ $drink->drink_name }}"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Number
                                                                            Of Drink
                                                                            <span class="required"> *
                                                                            </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="number" name="num_of_drink"
                                                                                data-required="1"
                                                                                placeholder="Enter number of drink"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Price
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="number" name="drink_price"
                                                                                data-required="1"
                                                                                placeholder="Enter Drink Price"
                                                                                value="{{ $drink->drink_price }}"
                                                                                class="form-control input-height" />
                                                                            <small class="text-danger">
                                                                                {{ $drink->drink_name }} price
                                                                                will be update to this</small>
                                                                        </div>
                                                                    </div>
                                                                  
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Add
                                                                        More</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    {{ $drinks->links('vendor.pagination.bootstrap-4') }}

                                </div>
                                <div class="tab-pane active" id="order_food">
                                    <div class="card-body" id="bar-parent">
                                        <b id="available" class="text-success h3"></b>
                                        @include('flash.flash')
                                        <form action="{{ route('order_drinks') }}" method="POST" id="form_sample_1"
                                            class="form-horizontal">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Drink
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <select class="form-select input-height" name="drink_id"
                                                            id="drink_id">
                                                            <option value="">Select...</option>
                                                            @if (isset($drinks) && count($drinks) > 0)
                                                            @foreach ($drinks as $drink)
                                                            <option value="{{ $drink->id }}">
                                                                {{ $drink->drink_name }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Drink Order Price
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="number" name="ordered_drink_price"
                                                            data-required="1" id="drink_price"
                                                            placeholder="Enter Order Price"
                                                            class="form-control input-height" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Drink Quantity
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input type="number" name="ordered_drink_quantity"
                                                            data-required="1" id="ordered_drink_quantity"
                                                            placeholder="Enter Drink Quantity"
                                                            class="form-control input-height" min="0" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-md-3">Total Price
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="col-md-5">
                                                        <input readonly type="number" name="ordered_total_price"
                                                            data-required="1" id="ordered_total_price" placeholder=""
                                                            class="form-control input-height" />
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="offset-md-3 col-md-9">
                                                            <button type="submit"
                                                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary">Submit</button>
                                                            <a type="button" href="/drinks"
                                                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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


<script src="../leave_report/assets/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        console.log('ready');
        $('#drink_id').on('change', function () {
            $('#drink_price').val('');
            let drink_id = $(this).val();
            // console.log(drink_id)
            if (drink_id === null) {
                alert('Please select drink');
                return false;
            }
            $.ajax({
                type: 'GET',
                url: `/drink_price/${drink_id}`,
                data: {
                    drink_id: drink_id
                },
                success: function (response) {
                    // alert('yes', response.drink)
                    console.log('response', response);
                    var response = JSON.parse(response);
                    console.log('responsuuue', response);
                    // $('#sub_category').empty();
                    $('#error1').text('');
                    $('#drink_price').val(response.price)
                    $('#available').html(
                        `<b class="text-success h3">Available: ${response.quantity}</b>`
                    );
                    $('#ordered_drink_quantity').attr('max', response.quantity);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Oops!", "An error occurred.");
                    console.log(XMLHttpRequest, textStatus, errorThrown);
                }
            });
        });

        $('#ordered_drink_quantity').on('change', function () {
            console.log("fsdfsdyu")
            let total_price = $(this).val() * $('#drink_price').val();
            $('#ordered_total_price').val(total_price);
            // console.log(total_price)
        });
    });
</script>