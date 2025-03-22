<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $orderDetails;
    public $qrCode;
    public function __construct($orderDetails)
    {
        $this->orderDetails = $orderDetails;

        $this->qrCode = QrCode::size(200)->generate($orderDetails['order_id']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Xác nhận đặt vé thành công')
                    ->view('mails.booksuccess')
                    ->with([
                        'orderDetails' => $this->orderDetails,
                        'qrCode' => $this->qrCode
                    ]);
    }
}