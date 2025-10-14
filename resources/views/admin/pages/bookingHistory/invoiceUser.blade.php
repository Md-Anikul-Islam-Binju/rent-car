<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $bookingHistory->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .invoice_area {
            padding: 50px 0;
        }
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 12px;
        }
        .invoice-header {
            border-bottom: 2px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .invoice-header img {
            height: 50px;
        }
        .table thead {
            background-color: #f2f2f2;
        }
        @media print {
            .btn-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

<section class="invoice_area">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center invoice-header">
                    <img src="{{ asset('backend/images/logo.jpeg') }}" alt="Logo">
                    <h4 class="m-0">Invoice</h4>
                </div>

                <!-- Details -->
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Hello, {{ $bookingHistory->name }}</strong></p>
                        <p class="text-muted small">
                            Please review your invoice carefully and ensure all details are correct.
                            If you have any questions, contact us anytime.
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($bookingHistory->created_at)->format('d M Y') }}</p>
                        <p><strong>Status:</strong>
                            @if($bookingHistory->payment_status == 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-danger">Unpaid</span>
                            @endif
                        </p>
                        <p><strong>Invoice #{{ $bookingHistory->id }}</strong></p>
                    </div>
                </div>

                <hr>

                <!-- Address -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Customer Info</h6>
                        <address>
                            {{ $bookingHistory->email }}<br>
                            {{ $bookingHistory->phone }}
                        </address>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
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
                            <td>{{ $bookingHistory->drop_location }}</td>
                            <td>{{ $bookingHistory->date }}</td>
                            <td>{{ $bookingHistory->time }}</td>
                            <td class="text-end">${{ $bookingHistory->total_amount }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Notes -->
                <div class="mt-4">
                    <h6>Notes:</h6>
                    <small>
                        All accounts must be paid within 7 days from receipt of invoice.
                        Payments can be made via credit card or bank transfer.
                    </small>
                </div>

                <!-- Print Button -->
                <div class="text-center mt-4 btn-print">
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="bi bi-printer"></i> Print Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

