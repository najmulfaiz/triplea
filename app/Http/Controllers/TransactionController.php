<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginMember;
use Hash;
use App\Token;
use Mail;
use App\Transaction;
use App\DetailTransaction;
use DNS2D;
use DNS1D;
use Crypt;
use QrCode;
use App\Lib\Log;
use App\Rekening;
use App\Notifikasi;
use App\Spintax;

class TransactionController extends Controller
{




    public function mail($code,$subject){



        // $code ='080070';
    $detailTransaction = DetailTransaction::where('id_transaction',$code);

            # code...
            $detail = $detailTransaction->first();
            $formParticipant = $detail->id_form_participant;
            $kategori = $detail->id_kategori;
            // echo "string";
            $transaction = Transaction::where('id',$code);
            // echo "string";
            // print_r($transaction->count());

            $dt = DetailTransaction::where('id_transaction',$code);

            // return view('invoice/invoice',compact('transaction','detail','dt'));
        // }

        // else{
        //  echo "string";
        // }



        $total = $dt->sum('harga');

        $userdata = LoginMember::where('id',$transaction->first()->id_login_member)->first();

            $to = $userdata->email;

        $tgl = $transaction->first()->tgl_transaksi;
        $tgl = date('d-m-Y',strtotime($tgl));
        $nohp = $userdata->nohp;
        $id_event = $transaction->first()->id_event;

        $output = $tgl.'|'.$id_event.'|'.$nohp;

        // echo $output;
        // echo $nohp;

        $encrypted = base64_encode($output);
        // $barcode= QrCode::encoding('UTF-8')->size(200)->generate($encrypted);

            $log = new Log;
            $url = url()->current();
            // $ip = $request->ip();
            // $sessid = session('userid');

            $log->log("Kirim Invoice Lunas ke  ".$to." | kode = ".$code,null);
        QrCode::format('png')->size(200)->generate($encrypted, public_path('barcode/'.md5($encrypted).'.png'));

// echo $barcode;
// echo $barcode;

// echo $barcode;
// $img= QrCode::format('png')->merge('https://ssl.gstatic.com/ui/v1/icons/mail/rfr/logo_gmail_lockup_default_1x.png', .3, true)->generate();
// echo $img;

// $decrypted = Crypt::decryptString($encrypte);

// echo base64_decode($encrypted);
/*echo $barcode;*/
// echo '<img src="data:image/png;base64,' .$barcode. '" alt="barcode"  style="width:200px;height:200px;" />';


                // return view('email.invoice-lunas',['transaction'=>$transaction,'detail'=>$detail,'dt'=>$dt,'total'=>$total,'barcode'=>$barcode]);


// $barcode= '<img src="data:image/png;base64,'.DNS2D::getBarcodePNG('8451703311075', 'QRCODE',10,10).'"'." alt='barcode'/>";
// echo '
//     <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFYAAAAeAQMAAACMk3u1AAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAABpJREFUGJVj+Hzmz5nzZ/6cP/PZhmGUTTM2AE4EC0BGiy0nAAAAAElFTkSuQmCC alt="barcode"/>';


// print_r($barcode);

$mail=    Mail::send('email.invoice-lunas', ['transaction'=>$transaction,'detail'=>$detail,'dt'=>$dt,'total'=>$total,'encrypted'=>$encrypted], function ($message)use(&$to,&$barcode,&$subject) {

        $message->from('no-reply@tripleasport.com', 'Triple A Sport Management');

        $message->to($to)->subject($subject);
        // $message->embedData($barcode, 'QrCode.png', 'image/png');


        // $message->embedData(QrCode::format('png')->generate('Make me into a QrCode!', ''), 'QrCode.png', 'image/png');

    });
// // echo "string";
// var_dump($mail);


    }

    public function test(){
        $rekening = Rekening::all();

        foreach ($rekening as $r) {
            # code...
            $no_rekening = $r->no_rekening;

            $data = $this->data($no_rekening);
/*return $data;*/
$data = json_decode($data,true);
$success = $data['success'];
$response = $data['response'];
// echo '<br>';
// echo json_encode($response);
// echo '<br>';
// echo json_encode($response);
if($success==1){

    foreach($response as $r){
        // echo json_encode($r);
        
        $amount = $r['amount'];
        $description = $r['description'];
        $type = $r['type'];
        $time = $r['unix_timestamp'];
        $rekening_api = $r['account_number'];
        
        
        // $balance = (int) $balance;
        $amount = (int) $amount;
        
        $from = date('Y-m-d', strtotime('-1 day')) . " 00:00:00";
        $to   = date("Y-m-d") . " 23:59:59";

        $transaction = Transaction::where('harga_akhir',$amount)
                                    ->whereBetween('tgl_transaksi', [$from, $to])
                                    ->where('status_bayar', 0)
                                    ->orWhere('status_bayar', 2);

        // jika ada transaksi dg nominal x
        if($transaction->count() == 1){

            // echo '<br>';
            // echo $description;
            // echo '<br>';

            echo '<br>';
            echo $amount . ' - ' . $rekening_api . ' - '  . $description . ' == ';
			$dt      = $transaction->first();
			$idt     = $dt->id;
			$tagihan = Transaction::find($idt);
            echo $jumlahTagihan = (int) $tagihan->harga_akhir;
            echo ' - ';
            echo $rekening_db = $tagihan->event->rekening->no_rekening;

            if($rekening_db == $rekening_api && $type == 'credit' && $amount == $jumlahTagihan && ($tagihan->status_bayar == 0 || $tagihan->status_bayar == 2)) {
                echo ' ? update status';
                $tagihan->status_bayar = 1;
                $tagihan->keterangan_bank = $description . '|' . date('d-m-Y h:i:s');
                $tagihan->save();
                $subj = '['.$idt.'] Payment Received/Paid For '.$tagihan->event->nama;
                $this->mail($tagihan->id,$subj);

				$trx            = $tagihan;
				$personalDetail = $trx->personal->first()->formParticipant->personalDetail;    
				$email          = $trx->user->email;
				$no_hp          = $trx->user->nohp;
				$nama           = $personalDetail->nama_awal . ' ' . $personalDetail->nama_akhir;
				$invoice        = '#' . strtoupper(substr($trx->event->nama, 0, 2)) . '-' . $trx->id;
				$event          = $trx->event;
				$harga_akhir    = $trx->harga_akhir;
				$rekening       = $trx->event->rekening;
				$tenggat        = date('d-m-Y h:i:s', $expired_time);

				$notifikasi     = Notifikasi::where('id_event', $trx->event->id)->where('kategori', 'lunas')->first();
				$pesan          = str_replace('{NAMA}', $nama, $notifikasi->isi_pesan);
				
				$this->sms($no_hp, $pesan);
            } else {
                echo ' ? stop';
            }

            // if($type == "credit")
            // {
            //     if($amount == $jumlahTagihan)
            //     {   
            //         if ($tagihan->status_bayar!=1) {
            //             # code...


            //             // $tagihan->status_bayar = 1;
            //             // $tagihan->keterangan_bank = $description;
            //             // $tagihan->save();
            //             // $subj = '['.$idt.'] Payment Received/Paid For '.$tagihan->event->nama;
            //             // $this->mail($tagihan->id,$subj);

            //         }
            //     }
            // }


        }
        
        
    }
        }

        // $this->sms('+6282213933187', 'Testing');

}


// echo $data['success'];
// print_r($data);
// foreach($data as $d){
//     // print_r($d);
//     if
// }

// print_r($data);


}


public function json(Request $request){
    if($request->success == "true"){

        $rekening = Rekening::all();
        foreach ($rekening as $r) {
            # code...
            // echo $r->no_rekening;
            $data = $this->data($r->no_rekening);
            return $data;
        }
    }
    //  return $this->data()   ;        
    
    // if

}

public function data($rekening){ 
// print_r($_SERVER);
$data = array(
    "search"  => array(
    "date"            => array(
            "from"    => date('Y-m-d', strtotime('-1 day')) . " 00:00:00",
            "to"      => date("Y-m-d") . " 23:59:59"
            ),
    "service_code"    => "bca",
    "account_number"  => $rekening,

    )
);
// print_r($_SERVER);
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL             => "https://api.cekmutasi.co.id/v1/bank/search",
    CURLOPT_POST            => true,
    CURLOPT_POSTFIELDS      => http_build_query($data),
    CURLOPT_HTTPHEADER      => ["API-KEY: 9fdb1fc48f5044cfb9d4086dc9bfa8d0"],
    CURLOPT_SSL_VERIFYHOST  => 0,
    CURLOPT_SSL_VERIFYPEER  => 0,
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_HEADER          => false
));
$result = curl_exec($ch);
curl_close($ch);

// echo $result;
return $result;
}

public function callback(){
$tagihan = new Transaction;
        $tagihan->status_bayar = 1;
        $tagihan->keterangan_bank = "ok";
        $tagihan->save();
        
    
$post = file_get_contents("php://input");
$json = json_decode($post);
if( $json->action == "payment_report" )
{
    
    print_r($json);
    foreach( $json->content->data as $data )
    {
        # Waktu transaksi dalam format unix timestamp
        $time = $data->unix_timestamp;

        # Tipe transaksi : credit / debit
        $type = $data->type;

        # Jumlah (2 desimal) : 50000.00
        $amount = $data->amount;

        # Berita transfer
        $description = $data->description;

        # Saldo rekening (2 desimal) : 1500000.00
        $balance = $data->balance;
        $balance = (int) $balance;
        $amount = (int) $amount;
        $tagihan = new Transaction;
        $tagihan->status_bayar = 1;
        $tagihan->keterangan_bank = $description;
        $tagihan->save();
                
        $transaction = Transaction::where('harga_akhir',$amount);

        // jika ada transaksi dg nominal x
        if($transaction->count() == 1){


            $dt = $transaction->first();
            $idt = $dt->id;
            $tagihan = Transaction::find($idt);
            $jumlahTagihan = (int) $tagihan->harga_akhir;


        if( $type == "credit" )
        {
            


            if( $amount == $jumlahTagihan )
            {   
                $tagihan->status_bayar = 1;
                $tagihan->keterangan_bank = $description.' waktu  ='.$time.' tipe = '.$type;
                $tagihan->save();
    

            }
        }
        else{

            if( $amount == $jumlahTagihan )
            {   
                $tagihan->status_bayar = 1;
                $tagihan->keterangan_bank = $description.' waktu  ='.$time.' tipe = '.$type;
                $tagihan->save();
    

            }  
        }
        
            }
        }
    }
}
    
    public function expired() 
    {
        $transaksi = Transaction::where('status_bayar', 0)->orWhere('status_bayar', 2)->get();

        foreach ($transaksi as $key => $trx) {
			$expired_time   = strtotime($trx->tgl_transaksi) + (60*60*24);
			$remaining_time = $expired_time - time();

			$personalDetail = $trx->personal->first()->formParticipant->personalDetail;    
			$email          = $trx->user->email;
			$no_hp          = $trx->user->nohp;
			$nama           = $personalDetail->nama_awal . ' ' . $personalDetail->nama_akhir;
			$invoice        = '#' . strtoupper(substr($trx->event->nama, 0, 2)) . '-' . $trx->id;
			$event          = $trx->event;
			$harga_akhir    = $trx->harga_akhir;
			$rekening       = $trx->event->rekening;
			$tenggat        = date('d-m-Y h:i:s', $expired_time);
			$subject        = '[' . $invoice . '] Reminder Payment For ' . ucwords($event->nama);

            if($remaining_time <= 0) {
                // KADALUARSA
                $trx->status_bayar = 9;
                $trx->save();
            } else if($remaining_time <= 3600 && $trx->status_bayar != 2) {
            	// REMINDER
                $mail = Mail::send('email.reminder', ['nama' => $nama, 'invoice' => $invoice, 'event' => $event, 'harga_akhir' => $harga_akhir, 'rekening' => $rekening, 'tenggat' => $tenggat], function ($message) use ($subject, $email)
                {
                    $message->subject($subject);
                    $message->from('no-reply@tripleasport.com', 'Triple A Sport Management');
                    $message->to($email);
                });

				$notifikasi = Notifikasi::where('id_event', $trx->event->id)->where('kategori', 'reminder')->first();
				$pesan      = str_replace('{NAMA}', $nama, $notifikasi->isi_pesan);
				$pesan      = str_replace('{KODE_INVOICE}', $invoice, $pesan);
				$pesan      = str_replace('{TGL_KADALUARSA}', $tenggat, $pesan);

                $this->sms($no_hp, $pesan);

                $trx->status_bayar = 2;
                $trx->save();
            }
        }

        return '';
    }

    public function cekmutasi($account_number, $amount)
    {
        $data = array(
            "search" => array(
                "date" => array(
                    "from" => date('Y-m-d', strtotime('-1 day')) . " 00:00:00",
                    "to" => date("Y-m-d") . " 23:59:59"
                ),
                "service_code"    => "bca",
                "account_number"  => $account_number,
                "amount"          => $amount
            )
        );

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL             => "https://api.cekmutasi.co.id/v1/bank/search",
            CURLOPT_POST            => true,
            CURLOPT_POSTFIELDS      => http_build_query($data),
            CURLOPT_HTTPHEADER      => ["API-KEY: 9fdb1fc48f5044cfb9d4086dc9bfa8d0"],
            CURLOPT_SSL_VERIFYHOST  => 0,
            CURLOPT_SSL_VERIFYPEER  => 0,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HEADER          => false
        ));

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function mutasi()
    {
        $transaksi = Transaction::where('status_bayar', 0)
                                ->orWhere('status_bayar', 2)
                                ->get();

        foreach ($transaksi as $index => $transaksi) {
            echo $transaksi->id . ' | ';
            $account_number =  $transaksi->event->rekening->no_rekening;
            $amount = $transaksi->harga_akhir;

            $mutasi = json_decode($this->cekmutasi($account_number, $amount));
            $jumlah = count($mutasi->response);

            if($jumlah == 1) {
                $result       = $mutasi->response[0];
                $amount       = $result->amount;
                $description  = $result->description;
                $type         = $result->type;
                $time         = $result->unix_timestamp;
                $rekening_api = $result->account_number;

                if($mutasi->response[0]->type == 'credit') {
                    echo $keterangan_bank = $description . ' | ' . date('d-m-Y h:i:s');
                    $transaksi->status_bayar    = 1;
                    $transaksi->keterangan_bank = $keterangan_bank;
                    // $transaksi->save();
                    $subj = '['.$transaksi->id.'] Payment Received/Paid For '.$transaksi->event->nama;
                    // $this->mail($transaksi->id,$subj);

                    $trx            = $transaksi;
                    $personalDetail = $trx->personal->first()->formParticipant->personalDetail;    
                    $email          = $trx->user->email;
                    $no_hp          = $trx->user->nohp;
                    $nama           = $personalDetail->nama_awal . ' ' . $personalDetail->nama_akhir;
                    $invoice        = '#' . strtoupper(substr($trx->event->nama, 0, 2)) . '-' . $trx->id;
                    $event          = $trx->event;
                    $harga_akhir    = $trx->harga_akhir;
                    $rekening       = $trx->event->rekening;

                    // $notifikasi     = Notifikasi::where('id_event', $trx->event->id)->where('kategori', 'lunas')->first();
                    // $pesan          = str_replace('{NAMA}', $nama, $notifikasi->isi_pesan);
                    
                    // $this->sms($no_hp, $pesan);
                    echo ' | LUNAS';
                } else {
                    echo ' BUKAN MUTASI CREDIT';
                }
            } else if($jumlah > 1) {
                $transaksi->status_bayar = 3;
                // $transaksi->save();
                echo ' CEK MANUAL';
            } else {
                echo ' WAITING';
            }

            echo '<br>';
        }
    }

    public function sms($nohp, $pesan)
    {
        $sms = [
            'nohp' => $nohp,
            'pesan' => $pesan
        ];
         
        // Prepare dan Konfigurasi
        $baseUrl = 'https://reguler.zenziva.net/apps/smsapi.php';
        $config = [
            'userkey' => 'vin7tp',
            'passkey' => 'jlrzuhqd3d'
        ];
        $params = array_merge($config, $sms);
        $uri = $baseUrl . '?' . http_build_query($params);
         
        // Kirim HTTP GET
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $uri);
        $result = curl_exec($curl);
         
        // Tampilkan Hasil/Response dari Zenziva
        header('Content-type: application/xml');
        return $result;
    }
}