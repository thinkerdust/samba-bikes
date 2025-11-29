<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use DB;

class SendEmailPembayaran extends Mailable
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

        // get event using query builder
        $event = DB::table('order')
            ->join('event', 'order.id_event', '=', 'event.id')
            ->where('order.nomor', $this->participant['nomor_order'])
            ->select('event.*')
            ->first();

        return new Envelope(
            // from: new Address($this->participant['email'], $this->participant['event']),
            subject: 'Pembayaran ' . $event->nama,
            cc: [
                new Address('admin@sambabikes.com', $event->nama),
                new Address('thinkerdust.dev@gmail.com', $event->nama),
            ]
        );
    }

    public function content(): Content
    {
        $data = DB::table('order')
                ->join('order_detail as detail', 'order.nomor', '=', 'detail.nomor_order')
                ->join('event', 'order.id_event', '=', 'event.id')
                ->join('peserta', 'peserta.id', '=', 'detail.id_peserta')
                ->leftJoin('komunitas as k', 'peserta.id_komunitas', '=', 'k.id')
                ->where('order.nomor', $this->participant['nomor_order'])
                ->where('detail.status', 1)
                ->select('k.nama as komunitas', 'peserta.nama as nama_peserta', 'peserta.size_jersey', 'order.nomor as nomor_order', 'order.total', 'event.nama as nama_event', 'event.tanggal', 'event.tanggal_racepack', DB::raw('DATE_FORMAT(event.jam_mulai_racepack, "%H:%i") as jam_mulai_racepack'), DB::raw('DATE_FORMAT(event.jam_selesai_racepack, "%H:%i") as jam_selesai_racepack'), 'event.lokasi')
                ->get();

        return new Content(
            view: 'email.pembayaran',
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
