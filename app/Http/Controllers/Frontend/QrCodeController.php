<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeController extends Controller
{
    public function generate($ticketId)
    {
        $bookingDetails = BookingDetail::where('ticket_number', $ticketId)->first();
        //Check the status of ticket
        if ($bookingDetails->ticket_status == 'boarded') {
            return redirect()->route('confirmation');
        }

        // Create a URL that points to the 'board' route
        $url = route('board', ['ticketId' => $ticketId]);

        // Create a QR code with the URL
        $qrCode = new QrCode($url);
        $qrCode->setSize(200);
        $qrCode->setMargin(10);

        // Get the writer
        $writer = new PngWriter();

        // Create a QR code response
        $result = $writer->write($qrCode);

        // Generate a base64 encoded string of the QR code
        $qrCodeString = base64_encode($result->getString());

        return view('frontend.qrcode', compact('bookingDetails', 'qrCodeString'));
    }

    public function board($ticketId)
    {
        // Find the booking detail with the given ticket ID
        $bookingDetail = BookingDetail::where('ticket_number', $ticketId)->first();

        // Change the status of the ticket to 'boarded'
        $bookingDetail->ticket_status = 'boarded';
        $bookingDetail->save();

        // Redirect the user to a page that confirms the ticket has been boarded
        return redirect()->route('confirmation');
    }

    public function confirmation()
    {
        return view('frontend.confirmation');
    }
}
