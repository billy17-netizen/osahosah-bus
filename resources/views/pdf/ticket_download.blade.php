<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header, .footer {
            text-align: center;
        }

        .header img {
            max-width: 100px;
        }

        .title {
            background-color: #ff7f27;
            color: white;
            text-align: center;
            padding: 10px;
            margin: 20px 0;
        }

        .info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info th, .info td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .info th {
            background-color: #f2f2f2;
        }

        .terms {
            font-size: 12px;
        }

        .terms p {
            margin: 5px 0;
        }

        .terms ul {
            padding-left: 20px;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 10px;
            }

            .title h2, .title p {
                font-size: 16px;
            }

            .info th, .info td {
                font-size: 14px;
                padding: 5px;
            }

            .terms {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
@php
    $path = public_path('frontend/assets/img/logo.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    use Carbon\Carbon;
@endphp
<div class="container">
    <div class="header">
        <img src="{{ $base64 }}" alt="Bus Booking Company Logo">
    </div>
    <div class="title">
        <h2>{{$booking->bookingDetails->first()->busRoute->origin}}
            to {{$booking->bookingDetails->first()->busRoute->destination}}</h2>
        <p>{{Carbon::parse($booking->bookingDetails->first()->travel_date)->format('l, F j, Y')}}</p>
    </div>
    <table class="info">
        <tr>
            <th>Passenger</th>
            <th>OsahosahBus ticket #</th>
            <th>Seat number(s)</th>
            <th>Booking ID #</th>
        </tr>
        @foreach($customerDetails as $index => $customerDetail)
            <tr>
                <td>{{ $customerDetail->name }}</td>
                <td>{{ $booking->bookingDetails[$index]['ticket_number'] }}</td>
                <td>{{ $booking->bookingDetails[$index]['seat_number'] }}</td>
                <td>{{ $booking->id }}</td>
            </tr>
        @endforeach
        <tr>
            <th>Bus</th>
            <th>Pickup time</th>
            <th>Pickup point Location</th>
            <th></th>
        </tr>
        <tr>
            <td>{{$booking->bookingDetails[0]->bus->bus_name}}</td>
            <td>{{Carbon::parse($booking->bookingDetails[0]->busRoute->pickupService()->first()->pickup_time)->format('h:i A')}}
            <td>Location: {{$booking->bookingDetails[0]->busRoute->pickupService()->first()->pickup_location}}</td>
            <td></td>
        </tr>
        <tr>
            <th>Total Pay</th>
            <th>Dropping time</th>
            <th>Dropping location</th>
            <th>Pickup Fee</th>
        </tr>
        <tr>
            <td>Rp {{number_format($booking->total_amount, 0, ',', '.')}}</td>
            <td>{{Carbon::parse($booking->bookingDetails[0]->busRoute->pickupService()->first()->dropping_time)->format('h:i A')}}
            <td>Location: {{$booking->bookingDetails[0]->busRoute->pickupService()->first()->dropping_point}}</td>
            <td>
                Rp {{number_format($booking->bookingDetails[0]->busRoute->pickupService()->first()->pickup_fee, 0, ',', '.')}}</td>
        </tr>
    </table>
    <div class="terms">
        <h3>Terms and Conditions</h3>
        <p>1. OsahOsahBus is ONLY a bus ticket agent. It does not operate bus services of its own. In order to provide a
            comprehensive choice of bus operators, departure times, and prices to customers, it has tied up with many
            bus operators.</p>
        <p>OsahOsahBus' responsibilities include:</p>
        <ul>
            <li>Issuing a valid ticket (a ticket that will be accepted by the bus operator) for its network of bus
                operators
            </li>
            <li>Providing refund and support in the event of cancellation</li>
            <li>Providing customer support and information in case of any delays/inconvenience</li>
        </ul>
        <p>OsahOsahBus' responsibilities do NOT include:</p>
        <ul>
            <li>The bus operator's bus not departing/reaching on time</li>
            <li>The bus operator's employees being rude</li>
            <li>The bus operator's bus seats not being up to the customer's expectation</li>
            <li>The bus operator canceling the trip due to unavoidable reasons</li>
            <li>The baggage of the customer getting lost/stolen/damaged</li>
            <li>The bus operator changing a customer's seat at the last minute to accommodate a lady/child</li>
            <li>The customer waiting at the wrong boarding point. Please call the bus operator to find out the exact
                boarding point if you are not a regular traveler on that particular bus
            </li>
            <li>The bus operator changing the boarding point and/or using a pick-up vehicle at the boarding point to
                take customers to the bus departure point
            </li>
        </ul>
    </div>
    <div class="footer">
        <p>For any queries, contact us at <strong>osahsupporth@bus.in</strong></p>
        <p>Thank you for choosing OsahosahBus.in</p>
    </div>
</div>
</body>
</html>
