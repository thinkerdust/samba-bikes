<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;

class SendEmailPembayaran extends Mailable
{
    use Queueable, SerializesModels;

    public $id_event;
    public $nama_event;
    public $name; 
    public $jersey;
    public $nomor_order;
    public $total;

    public function __construct($name)
    {
        $this->id_event     = $id_event;
        $this->nama_event   = $nama_event;
        $this->name         = [$nama]; 
        $this->jersey       = [$jersey];
        $this->nomor_order  = $nomor_order;
        $this->total        = $total;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registrasi ' . $this->nama_event,
        );
    }

    public function content(): Content
    {

        $data_event = Event::where('id', $this->id_event)->select('phone', 'bank', 'nama_rekening', 'nomor_rekening')->first();

        return new Content(
            view: 'email.registrasi',
            with: [
                'event'             => $this->event,
                'name'              => $this->name,
                'jersey'            => $this->jersey,
                'nomor_order'       => $this->nomor_order,
                'total'             => $this->total,
                'phone'             => $data_event->phone,
                'bank'              => $data_event->bank,
                'nama_rekening'     => $data_event->nama_rekening,
                'nomor_rekening'    => $data_event->nomor_rekening,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
