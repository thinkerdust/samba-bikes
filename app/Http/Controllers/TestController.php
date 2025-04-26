<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailRegistrasi;
use App\Mail\SendEmailPembayaran;

class TestController extends Controller
{
    public function testEmailPembayaran() {
        try {

            $recepientMail = 'okvadimas@gmail.com';

            $dataEmail = [
                'id_order'   => '8',
            ];
    
            Mail::to($recepientMail)->send(new SendEmailPembayaran($dataEmail));
    
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function testEmailRegistrasi() {
        try {

            $recepientMail = 'okvadimas@gmail.com';

            $dataEmail = [
                'nomor_order'   => 'ORD/202504/0006',
                'event'         => 'Event Test Registrasi',
            ];
    
            Mail::to($recepientMail)->send(new SendEmailRegistrasi($dataEmail));
    
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
