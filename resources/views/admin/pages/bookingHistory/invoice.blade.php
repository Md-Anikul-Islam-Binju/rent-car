@extends('admin.app')
@section('admin_content')

<section class="invoice_area">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Invoice Logo-->
                    <div class="clearfix">
                        <div class="float-start mb-3">
                            <img src="{{URL::to('backend/images/logo.jpeg')}}" alt="dark logo" height="50">
                        </div>
                        <div class="float-end">
                            <h4 class="m-0 d-print-none">Invoice</h4>
                        </div>
                    </div>

                    <!-- Invoice Detail-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="float-end mt-3">
                                <p><b>Hello, {{$bookingHistory->name}}</b></p>
                                <p class="text-muted fs-13">
                                    Please review your invoice carefully and ensure all details are correct. If you have any questions or notice any discrepancies, do not hesitate to contact us.
                                </p>
                            </div>

                        </div>
                        <div class="col-sm-4 offset-sm-2">
                            <div class="mt-3 float-sm-end">
                                <p class="fs-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; {{ Carbon\Carbon::parse($bookingHistory->created_at)->format('d M Y') }}</p>
                                <p class="fs-13"><strong>Order Status: </strong> <span class="badge bg-success float-end">
                                        @if($bookingHistory->payment_status == 'unpaid')
                                            Unpaid
                                        @elseif($bookingHistory->payment_status == 'paid')
                                            Paid
                                        @endif
									</span></p>
                                <p class="fs-13"><strong>Invoice : </strong> <span class="float-end">#{{$bookingHistory->id}}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <h6 class="fs-14">Address</h6>
                            <address>
                                {{$bookingHistory->email}}<br>
                                {{$bookingHistory->phone}}
                            </address>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                    <thead class="border-top border-bottom bg-light-subtle border-light">
                                    <tr>
                                        <th>Pickup Point</th>
                                        <th>Drop Point</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>{{ $bookingHistory->pickup_location }}</td>
                                            <td>{{$bookingHistory->drop_location}}</td>
                                            <td>{{$bookingHistory->date}}</td>
                                            <td>{{$bookingHistory->time}}</td>
                                            <td class="text-end">{{$bookingHistory->total_amount}} $</td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="clearfix pt-3">
                                <h6 class="text-muted fs-14">Notes:</h6>
                                <small>
                                    All accounts are to be paid within 7 days from receipt of
                                    invoice. To be paid by cheque or credit card or direct payment
                                    online. If account is not paid within 7 days the credits details
                                    supplied as confirmation of work undertaken will be charged the
                                    agreed quoted fee noted above.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="d-print-none mt-4">
                        <div class="text-center">
                            <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line"></i> Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
