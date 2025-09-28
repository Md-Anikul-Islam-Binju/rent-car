
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
                        <th>Date</th>
                        <th>Time</th>
                        <th>Pickup Location</th>
                        <th>Drop Location</th>
                        <th>Total Destination</th>
                        <th>Total Fare</th>
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
                            <td>{{$bookingHistoryData->date}}</td>
                            <td>{{$bookingHistoryData->time}}</td>
                            <td>{{$bookingHistoryData->pickup_location}}</td>
                            <td>{{$bookingHistoryData->drop_location}} </td>
                            <td>{{$bookingHistoryData->total_kilometers}} </td>
                            <td>{{$bookingHistoryData->total_kilometers * $bookingHistoryData->fleet->per_kilometer_fare}} </td>
                           </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
