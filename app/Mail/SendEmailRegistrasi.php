<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use DB;

class SendEmailRegistrasi extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;

    /**
     * Create a new message instance.
     */
    public function __construct($participant)
    {
        $this->participant = $participant;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registrasi ' . $this->participant['event'],
        );
    }

    public function content(): Content
    {
        $data = DB::table('order')
                ->join('order_detail as detail', 'order.nomor', '=', 'detail.nomor_order')
                ->join('event', 'order.id_event', '=', 'event.id')
                ->join('peserta', 'peserta.id', '=', 'detail.id_peserta')
                ->where('order.nomor', $this->participant['nomor_order'])
                ->select('peserta.nama as nama_peserta', 'peserta.size_jersey', 'order.nomor as nomor_order', 'order.total', 'event.nama as nama_event', 'event.phone', 'event.bank', 'event.nama_rekening', 'event.nomor_rekening')
                ->get();

        return new Content(
            view: 'email.registrasi',
            with: [
                'data' => $data
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
