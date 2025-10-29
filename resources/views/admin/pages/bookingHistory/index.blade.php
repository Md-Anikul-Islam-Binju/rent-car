
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
                        <li class="breadcrumb-item active">Booking History!</li>
                    </ol>
                </div>
                <h4 class="page-title">Booking History!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Passenger Info</th>
                        <th>Service</th>
                        <th>Fleet</th>
                        <th>Date & Time</th>

                        <th>Location</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookingHistory as $key=>$bookingHistoryData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                {{$bookingHistoryData->name}}<br>
                                {{$bookingHistoryData->email}}<br>
                                {{$bookingHistoryData->phone}}
                            </td>
                            <td>{{$bookingHistoryData->service->name}}</td>
                            <td>
                                {{$bookingHistoryData->fleet->name}}<br>
                                {{$bookingHistoryData->fleet->model}}<br>
                                {{$bookingHistoryData->fleet->number}}
                            </td>
                            <td>
                                {{$bookingHistoryData->date}}<br>
                                {{$bookingHistoryData->time}}<br>
                            </td>

                            <td>
                                Pickup: {{$bookingHistoryData->pickup_location}}<br>
                                Drop: {{$bookingHistoryData->drop_location}}<br>
                            </td>
                            <td>
                                Destination: {{$bookingHistoryData->total_kilometers}} <br>
                                Fare: {{$bookingHistoryData->total_kilometers * $bookingHistoryData->fleet->per_kilometer_fare}} <br>
                            </td>
                            <td>
                                <a href="{{ route('booking.invoice', $bookingHistoryData->id) }}" class="btn btn-primary btn-sm" title="View Invoice"><i class="fa fa-eye"></i> View Invoice</a>
                            </td>
                           </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
