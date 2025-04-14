<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use App\Models\Order;

class SendEmailRegistrasi extends Mailable
{
    use Queueable, SerializesModels;

    public $id_event;
    public $nama_event;
    public $id_peserta; 
    public $nomor_order;

    public function __construct($id_event, $nama_event, $id_peserta, $nomor_order)
    {
        $this->id_event     = $id_event;
        $this->nama_event   = $nama_event;
        $this->id_peserta   = [$id_peserta]; 
        $this->nomor_order  = $nomor_order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registrasi ' . $this->nama_event,
        );
    }

    public function content(): Content
    {

        $data_event     = Event::where('id', $this->id_event)->select('phone', 'bank', 'nama_rekening', 'nomor_rekening')->first();
        $data_order     = Order::where('id', $this->nomor_order)->select('nomor_order', 'total')->first();
        $data_peserta   = Peserta::where('id', $this->id_event)->select('phone', 'bank', 'nama_rekening', 'nomor_rekening')->first();

        return new Content(
            view: 'email.registrasi',
            with: [
                'event'             => $data_event->nama,
                'nama'              => $data_peserta->nama,
                'jersey'            => $data_peserta->size_jersey,
                'nomor_order'       => $this->nomor_order,
                'total'             => $data_order->total,
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
