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
                        <li class="active">Food</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card card-box">
                        <div class="card-head">
                            <header>Food</header>
                            <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                data-upgraded=",MaterialButton">
                                <i class="material-icons">more_vert</i>
                            </button>
                            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                data-mdl-for="panel-button">
                                <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                                </li>
                                <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                                </li>
                                <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                                    here</li>
                            </ul>
                        </div>

                        <div class="panel tab-border card-box">
                            <header class="panel-heading panel-heading-gray custom-tab">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a href="#order_food" data-bs-toggle="tab" class="active">
                                        </i> Order Food
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#add_food" data-bs-toggle="tab">
                                        </i> Add Food
                                    </a>
                                </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane" id="add_food">
                                        <div class="card-body" id="bar-parent">
                                            @include('flash.flash')
                                            <form action="{{ route('add_food') }}" method="POST" id="form_sample_1"
                                                class="form-horizontal">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Food Name
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="text" name="food_name" data-required="1"
                                                                placeholder="Enter Food Name"
                                                                class="form-control input-height" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Price
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="number" name="food_price" data-required="1"
                                                                placeholder="Enter Food Price"
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
                                                <th> Food </th>
                                                <th> Price </th>
                                                {{-- <th>Available</th> --}}

                                                {{-- <th> Leave Days </th> --}}
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody id="result"></tbody>
                                        <tbody id="old">
                                            @if (isset($foods) && count($foods) > 0)
                                            @foreach ($foods as $food)
                                            <tr class="odd gradeX">
                                                <td class="patient-img">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{ $food->food_name }}
                                                </td>
                                                <td class="center">N{{ $food->food_price }}</td>
                                               


                                                <td>
                                                    <div class="justify-content-between">
                                                        
                                                        <button type="button" class="btn btn-primary btn-lg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit_modal{{ $food->id }}">
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </button>

                                                        <a onclick="return confirm('Are you sure you want to delete this food?')"
                                                            href="/delete_food/{{ base64_encode($food->id) }}"
                                                            class="btn btn-danger btn-lg">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>






                                            <!--Edit Modal -->
                                            <div class="modal fade" id="edit_modal{{ $food->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Edit
                                                                Food </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/edit_food" method="POST"
                                                                id="form_sample_1" class="form-horizontal">
                                                                @csrf
                                                                <div class="form-body">
                                                                    <input type="hidden" name="food_id"
                                                                        value="{{ $food->id }}" id="">
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Food
                                                                            Name
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="text" name="food_name"
                                                                                data-required="1"
                                                                                placeholder="Food Name"
                                                                                value="{{ $food->food_name }}"
                                                                                class="form-control input-height" />
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    <div class="form-group row">
                                                                        <label class="control-label col-md-3">Price
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="col-md-5">
                                                                            <input type="number" name="food_price"
                                                                                data-required="1"
                                                                                placeholder="Enter Food Price"
                                                                                value="{{ $food->food_price }}"
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

                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                      {{ $foods->links('vendor.pagination.bootstrap-4') }}
                                    </div>
                                    <div class="tab-pane active" id="order_food">
                                        <div class="card-body" id="bar-parent">
                                            @include('flash.flash')
                                            <form action="{{ route('order_food') }}" method="POST" id="form_sample_1"
                                                class="form-horizontal">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Food
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <select class="form-select input-height" name="food_id"
                                                                id="food_id">
                                                                <option value="">Select...</option>
                                                                @if (isset($foods) && count($foods) > 0)
                                                                    @foreach ($foods as $food)
                                                                        <option value="{{ $food->id }}">
                                                                            {{ $food->food_name }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="control-label col-md-3">Food Order Price
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-5">
                                                            <input type="number" name="ordered_food_price"
                                                                data-required="1" id="food_price"
                                                                placeholder="Enter Order Price"
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
    $(document).ready(function() {
        console.log('ready');
        $('#food_id').on('change', function() {
            $('#food_price').val('');
            let food_id = $(this).val();
            // console.log(food_id)
            if (food_id === null) {
                alert('Please select food');
                return false;
            }
            $.ajax({
                type: 'GET',
                url: `/food_price/${food_id}`,
                data: {
                    food_id: food_id
                },
                success: function(response) {
                    // alert('yes', response.room)
                    console.log('response', response);
                    var response = JSON.parse(response);
                    console.log('response', response);
                    // $('#sub_category').empty();
                    $('#error1').text('');
                    $('#food_price').val(response)
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Oops!", "An error occurred.");
                    console.log(XMLHttpRequest, textStatus, errorThrown);
                }
            });
        });
    });
</script>
