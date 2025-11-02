@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Luxury Chauffeur</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Fleet!</li>
                    </ol>
                </div>
                <h4 class="page-title">Fleet!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Car Info</th>
                        <th>Seats & Bag</th>
                        <th>Fare</th>
                        <th>image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fleets as $key=>$fleetData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                Name: {{$fleetData->name}}<br>
                                Model: {{$fleetData->model}}<br>
                                Number: {{$fleetData->number}}<br>
                            </td>
                            <td>
                                Seats: {{$fleetData->total_seats}}<br>
                                Checking Bag: {{$fleetData->checking_bag}}<br>
                                Carry Bag: {{$fleetData->carry_bag}}<br>
                            </td>
                            <td>
                                Base Fare: {{$fleetData->base_fare	}} $ <br>
                                Per Kilo Fare: {{$fleetData->per_kilometer_fare}} $ <br>
                                Per Kilo Fare Duration Wise:{{$fleetData->per_kilometer_fare_duration_wise}} $
                            </td>

                            <td>
                                <img src="{{asset('images/fleet/'. $fleetData->image )}}" alt="Current Image" style="max-width: 50px;">
                            </td>
                            <td>{{$fleetData->status=='active'? 'Active':'Inactive'}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$fleetData->id}}">Edit</button>
                                    <a href="{{route('fleet.destroy',$fleetData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$fleetData->id}}">Delete</a>
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$fleetData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$fleetData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$fleetData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('fleet.update', $fleetData->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT') <!-- Important for update -->
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" id="name" name="name"
                                                                   class="form-control" placeholder="Enter Name" value="{{ $fleetData->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="model" class="form-label">Model</label>
                                                            <input type="text" id="model" name="model"
                                                                   class="form-control" placeholder="Enter Model" value="{{  $fleetData->model }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="number" class="form-label">Number</label>
                                                            <input type="text" id="number" name="number"
                                                                   class="form-control" placeholder="Enter Number" value="{{  $fleetData->number }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="total_seats" class="form-label">Total Seats</label>
                                                            <input type="number" id="total_seats" name="total_seats"
                                                                   class="form-control" placeholder="Enter Seats" value="{{ $fleetData->total_seats }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="checking_bag" class="form-label">Checking Bags</label>
                                                            <input type="number" id="checking_bag" name="checking_bag"
                                                                   class="form-control" placeholder="Enter Bags" value="{{ $fleetData->checking_bag }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="carry_bag" class="form-label">Carry Bags</label>
                                                            <input type="number" id="carry_bag" name="carry_bag"
                                                                   class="form-control" placeholder="Enter Bags" value="{{ $fleetData->carry_bag }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="base_fare" class="form-label">Car Base Fare</label>
                                                            <input type="text" id="base_fare" name="base_fare"
                                                                   class="form-control" placeholder="Car Base Fare" value="{{ $fleetData->base_fare }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="per_kilometer_fare" class="form-label">Per Kilometer Fare</label>
                                                            <input type="text" id="per_kilometer_fare" name="per_kilometer_fare"
                                                                   class="form-control" placeholder="Per Kilometer Fare" value="{{ $fleetData->per_kilometer_fare }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="per_kilometer_fare_duration_wise" class="form-label">Per Kilometer Fare Duration Wise (Per hr)</label>
                                                            <input type="text" id="per_kilometer_fare_duration_wise" name="per_kilometer_fare_duration_wise"
                                                                   class="form-control" placeholder="Per Kilometer Fare Duration Wise" value="{{ $fleetData->per_kilometer_fare_duration_wise }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="total_bag" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="active" {{ $fleetData->status == 'active' ? 'selected' : '' }}>Active</option>
                                                                <option value="inactive" {{ $fleetData->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Image</label>
                                                            <input type="file" name="image" id="image" class="form-control">
                                                            @if($fleetData->image)
                                                                <img src="{{ asset('images/fleet/'.$fleetData->image) }}" alt="Fleet Image" class="mt-2" style="max-width: 50px;">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label>Short Details</label>
                                                            <input type="text" name="short_details" value="{{$fleetData->short_details}}" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label>Details</label>
                                                            <textarea id="summernoteEdit{{ $fleetData->id }}" name="details">{{ $fleetData->details }}</textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal -->
                            <div id="danger-header-modal{{$fleetData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$fleetData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$fleetData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('fleet.destroy',$fleetData->id)}}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--Add Modal -->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('fleet.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" id="model" name="model"
                                           class="form-control" placeholder="Enter Model" value="{{ old('model') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="number" class="form-label">Number</label>
                                    <input type="text" id="number" name="number"
                                           class="form-control" placeholder="Enter Number" value="{{ old('number') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="total_seats" class="form-label">Total Seats</label>
                                    <input type="number" id="total_seats" name="total_seats"
                                           class="form-control" placeholder="Enter Seats" value="{{ old('total_seats') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="checking_bag" class="form-label">Checking Bags</label>
                                    <input type="number" id="checking_bag" name="checking_bag"
                                           class="form-control" placeholder="Enter Bags" value="{{ $fleetData->checking_bag }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="carry_bag" class="form-label">Carry Bags</label>
                                    <input type="number" id="carry_bag" name="carry_bag"
                                           class="form-control" placeholder="Enter Bags" value="{{ $fleetData->carry_bag }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="base_fare" class="form-label">Car Base Fare</label>
                                    <input type="text" id="base_fare" name="base_fare"
                                           class="form-control" placeholder="Car Base Fare" value="{{ old('base_fare') }}">
                                </div>
                            </div>



                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="per_kilometer_fare" class="form-label">Per Kilometer Fare</label>
                                    <input type="text" id="per_kilometer_fare" name="per_kilometer_fare"
                                           class="form-control" placeholder="Per Kilometer Fare" value="{{ old('per_kilometer_fare') }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="per_kilometer_fare_duration_wise" class="form-label">Per Kilometer Fare Duration Wise (Per hr)</label>
                                    <input type="text" id="per_kilometer_fare_duration_wise" name="per_kilometer_fare_duration_wise"
                                           class="form-control" placeholder="Per Kilometer Fare Duration Wise" value="{{ old('per_kilometer_fare_duration_wise') }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Short Details</label>
                                    <input type="text" name="short_details" class="form-control">
                                </div>
                            </div>





                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label> Details </label>
                                        <textarea id="summernote" name="details"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
