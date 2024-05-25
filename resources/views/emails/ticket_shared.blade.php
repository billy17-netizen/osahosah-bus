@php use Carbon\Carbon; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking Details</title>
    <style>
        /* Reset some default styles */
        body, table, td, p {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Main container styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f5f5f5;
            padding: 20px;
        }

        /* Header styles */
        .header {
            background: linear-gradient(to right, #ff6b6b, #ffa500);
            color: #fff;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header img {
            max-width: 150px;
            margin-right: 20px;
        }

        .header h1 {
            margin: 0;
        }


        .header {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 767px) {
            .container {
                padding: 10px;
            }

            .booking-details th, .booking-details td {
                padding: 8px;
                font-size: 14px;
            }
        }

        /* Booking details styles */
        .booking-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .booking-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .booking-details th, .booking-details td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .booking-details th {
            background-color: #f5f5f5;
        }

        .booking-details tr:hover {
            background-color: #f9f9f9;
        }

        /* Customer details styles */
        .customer-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .customer-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .customer-details th, .customer-details td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .customer-details th {
            background-color: #f5f5f5;
        }

        /* Footer styles */
        .footer {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 20px;
        }

        /* Print button styles */
        .print-button {
            display: inline-block;
            background-color: #ff6b6b;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .print-button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
@php
    $path = public_path('frontend/assets/img/logo.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp
<div class="container">
    <div class="header">
        <img src="{{ $base64 }}" alt="Bus Booking Company Logo">
        <h1>Bus Booking Details</h1>
    </div>
    <div class="booking-details">
        <table>
            <tr>
                <th>Booking ID:</th>
                <td>{{$booking->id}}</td>
            </tr>
            <tr>
                <th>Origin:</th>
                <td>{{$booking->bookingDetails->first()->busRoute->origin}}</td>
            </tr>
            <tr>
                <th>Destination:</th>
                <td>{{$booking->bookingDetails->first()->busRoute->destination}}</td>
            </tr>
            <tr>
                <th>Pickup Location:</th>
                <td>{{$booking->bookingDetails->first()->busRoute->pickupService()->first()->pickup_location}}</td>
            </tr>
            <tr>
                <th>Pickup Location:</th>
                <td>{{$booking->bookingDetails->first()->busRoute->pickupService()->first()->dropping_point}}</td>
            </tr>
            <tr>
                <th>Travel Date:</th>
                <td>{{Carbon::parse($booking->bookingDetails->first()->travel_date)->toFormattedDateString()}}</td>
            </tr>
            <tr>
                <th>Pickup Time:</th>
                <td>{{Carbon::parse($booking->bookingDetails->first()->busRoute->pickupService()->first()->pickup_time)->format('h:i A')}}
            </tr>
            <tr>
                <th>Dropping Time:</th>
                <td>{{Carbon::parse($booking->bookingDetails->first()->busRoute->pickupService()->first()->dropping_time)->format('h:i A')}}
            </tr>
            <tr>
                <th>Passengers:</th>
                <td>{{$booking->bookingDetails->first()->total_seats}}</td>
            </tr>
            <tr>
                <th>Seat Numbers:</th>
                <td>
                    {{$seatNumbers = $booking->bookingDetails->pluck('seat_number')->implode(', ')}}
                </td>
            </tr>
            <tr>
                <th>Total Amount Pay:</th>
                <td>Rp {{number_format($booking->total_amount, 0, ',', '.')}}</td>
            </tr>
        </table>
    </div>
    <div class="customer-details">
        <h2>Customer Details</h2>
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->mobile_number}}</td>
                    <td>{{ $customer->address }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <a href="#" class="print-button" onclick="window.print()">Print Booking Details</a>
        <p>&copy; 2024 OsahOsahBus Company. All rights reserved.</p>
    </div>
</div>
</body>
</html>
