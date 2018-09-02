<div id=":tq" class="a3s aXjCH msg7953608123438635804"><u></u>


    
    
    
    


<div bgcolor="#f9f9f9" style="font-family:'Open Sans',sans-serif">
    <table align="center" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" style="background-color:#fff;margin:5% auto;width:100%;max-width:600px">
        
        <tbody><tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#fff" style="padding:10px 15px;font-size:14px">
                    <tbody><tr>
                        <td width="60%" align="left" style="padding:5px 0 0">
                            <img src="https://ci4.googleusercontent.com/proxy/boe6EhSxzsWedRrl6_jQnH-nUtVrxPwMroNPFRGV_ahcsdUEXiD06qYRLpTD11AiNUMcf_hGBZmGRtZgQg=s0-d-e1-ft#http://event.arayamedia.id/img/logo.jpg" alt="Logo Tokopedia" width="150" height="50" class="CToWUd">
                        </td>
                        <td width="40%" align="right" style="padding:5px 0 0">
                        <div style="width:50%;">
                        <div style="margin:0 auto;background: #2ecc71;padding: 10px;height: auto;">
                            
<center>                        <h3 style="margin: 0;padding: 0;color: #fff;text-transform: uppercase;letter-spacing: 2px;">Lunas</h3></center>
                        </div>
                            
                        </div>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        

		
		

		

        
        <tr>
            <td style="padding:25px 15px 10px">
                <table width="100%">
                    <tbody><tr>
                        <td>
                            <h1 style="margin:0;font-size:16px;font-weight:bold;line-height:24px;color:rgba(0,0,0,0.70)">Halo </h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin:0;font-size:16px;line-height:24px;color:rgba(0,0,0,0.70)">Selamat, Kamu Sudah Melakukan Pembayaran</p>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        <tr>
            <td style="padding:0 15px">
                
                <table width="100%" style="margin:15px 0;color:rgba(0,0,0,0.70);font-size:14px;border-collapse:collapse">
                    <tbody>
                        <tr>
                            <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12)" width="40%">No. <span class="il">Invoice</span></td>
                            <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold;color:#42b549" width="60%">
                              <b>#{{$transaction->first()->id}}</b>
                            </td>
                        </tr>
                        
                            <tr>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0" width="40%">Kepada</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">{{$detail->formParticipant->personalDetail->nama_awal.' '.$detail->formParticipant->personalDetail->nama_akhir}}</td>
                            </tr>
                        
                            <tr>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0" width="40%">Tanggal</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%"> {{date('d-m-y',strtotime($transaction->first()->tgl_transaksi))}}</td>
                            </tr>
                        
                            <tr>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0" width="40%">Keterangan Bank</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">{{$transaction->first()->keterangan_bank}}</td>
                            </tr>
                            <tr>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0" width="40%">Total</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">{{number_format($transaction->first()->harga_akhir,2,',','.')}}</td>
                            </tr>
                        
                        
                    </tbody>
                </table>

                

                <table width="100%" style="margin:15px 0;color:rgba(0,0,0,0.70);font-size:16px">
					
                    <tbody><tr>
                        <td style="padding:15px 0 10px;color:rgba(0,0,0,0.70);font-size:14px" align="center">
                           <div style="margin-bottom:5px"><h2>Rincian</h2>
                           </div>


                       </td>
                    </tr>
                </tbody></table>

{{--         {{$transaction->first()->event->nama.' - '.date('d-M-Y',strtotime($transaction->first()->event->tanggal)).' - '.$transaction->first()->event->kota->nama}} --}}

  <table width="100%" style="margin:15px 0;color:rgba(0,0,0,0.70);font-size:14px;border-collapse:collapse">

                    <tbody>

<tr style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px ;background: #fff;" width="40%">
  <td>Event</td><td>{{$transaction->first()->event->nama}}</td>
</tr>
<tr style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px ;background: #fff;" width="40%">
  <td>Tanggal</td><td>{{date('d-M-Y',strtotime($transaction->first()->event->tanggal))}}</td>
</tr>
<tr style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px ;background: #fff;" width="40%">
  <td>Kota</td><td>{{$transaction->first()->event->kota->nama}}</td>
</tr>


                        
                    </tbody>
                </table>


     <table width="100%" style="margin:15px 0;color:rgba(0,0,0,0.70);font-size:16px">
                    
                    <tbody><tr>
                        <td style="padding:15px 0 10px;color:rgba(0,0,0,0.70);font-size:14px" align="center">
                           <div style="margin-bottom:5px"><h2>Transaksi</h2></div>

                       </td>
                    </tr>
                </tbody></table>


                <table width="100%" style="margin:15px 0;color:rgba(0,0,0,0.70);font-size:14px;border-collapse:collapse">
                <thead>
                    <tr>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight: bold;" width="40%">Partisipan</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">Kategori</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">Harga</td>
                            </tr>
                </thead>
                    <tbody>



@if ($dt->count()>0)
@foreach ($dt->get() as $detailTransaction)

<tr>
  <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0" width="40%">{{$detailTransaction->formParticipant->personalDetail->nama_awal.' '.$detailTransaction->formParticipant->personalDetail->nama_akhir}}</td>

  <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0" width="40%">{{$detailTransaction->kategori->nama}}</td>
  <td  style="text-align: right;">{{number_format($detailTransaction->harga,2,',','.')}}</td>
</tr>
@endforeach
<tr style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;background: #ccc;" width="40%">
  <td></td><td></td><td style="text-align: right;"><b>IDR {{number_format($total,2,',','.')}}</b></td>
</tr>
@endif

{{--                             <tr>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0" width="40%">Harga</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">Rp 10.900</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">Rp 10.900</td>
                            </tr> --}}
                        
                    </tbody>
                </table>


<br><br>
                <table width="100%" style="margin:15px 0;color:rgba(0,0,0,0.70);font-size:14px;border-collapse:collapse">
                    <tbody>



{{-- <tr>
  <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0"><center>Deskripsi</center></td><td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;text-align: right;"><center>Harga</center></td>
</tr> --}}
  <tr>
    <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0">  Subtotal</td><td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;text-align: right;"> <b>IDR {{number_format($total,2,',','.')}}</b></td>
  </tr>
  <tr>
    <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0">Diskon
    {!! !empty($transaction->first()->diskon_data) ? "<span style='background-color:#26A65B;padding:5px;color:#fff'>".$transaction->first()->diskon_data->kode."</span>" :'' !!}

    </td><td  style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;text-align: right;"><b>{{!empty($transaction->first()->diskon_data) ? ($transaction->first()->diskon_data->jenis=='2'? $transaction->first()->diskon_data->potongan.'%':' IDR '.number_format($transaction->first()->diskon_data->potongan,2,',','.')) : ''}}</b></td>
  </tr>
  <tr>
    <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0">Kode Unik</td><td  style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;text-align: right;"><b>{{$transaction->first()->validasi_no}}</b></td>
  </tr>
  <tr style="background: #ccc;">
    <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0">Harga Akhir</td><td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;text-align: right;"><b>IDR <b>{{number_format($transaction->first()->harga_akhir,2,',','.')}}</b></b></td>
  </tr>

{{--                             <tr>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0" width="40%">Harga</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">Rp 10.900</td>
                                <td style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;font-weight:bold" width="60%">Rp 10.900</td>
                            </tr> --}}
                        
                    </tbody>
                </table>
                
               

                <div style="text-align:center">
                    <div style="text-align:left;font-size:13px;margin:30px 0 10px;color:#000">
Terima Kasih Sudah Melakukan Pembayaran,  Anda dapat menujukan Barcode Ini 

                    </div>
                </div>

            </td>
        </tr>
        

        <tr>
            <td style="padding:10px 15px 0">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td>
                            <center>
<img src="{!!$message->embedData(QrCode::format('png')->size(200)->generate("x"), 'qr.png', 'image/png')!!}">
{!!$message->embedData(QrCode::format('png')->size(200)->generate("x"), 'qr.png', 'image/png')!!}


                            </center>
<br>
<br><br>

                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
      {{--   <tr>
            <td style="padding:10px 15px 0">
                <table width="100%">
                    <tbody><tr>
                        <td bgcolor="#fbe3e4" style="border-top:3px solid #f9bcbe;border-bottom:3px solid #f9bcbe;padding:0">
                            <p style="margin:0;font-size:13px;line-height:18px;padding:10px 15px">
                                Hati-hati terhadap pihak yang mengaku dari Tokopedia, membagikan voucher belanja, atau meminta data pribadi. Tokopedia tidak pernah meminta password dan data pribadi melalui email, pesan pribadi, maupun channel lainnya. Untuk semua email dengan link dari Tokopedia, pastikan alamat URL di browser sudah di alamat
                                <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFg1LHU8UFR9HC1NWEVZdDVMaBlkL" style="text-decoration:none;color:#42b549" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFg1LHU8UFR9HC1NWEVZdDVMaBlkL&amp;source=gmail&amp;ust=1535550842233000&amp;usg=AFQjCNHylzLQzupA-B0pOw6jzXprWwQ37g">tokopedia.com</a> bukan alamat lainnya. Jaga keamanan akun Anda, baca panduannya di <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFkReHRcBDl5USkxWClxJAVZdBBgFWA4fB1YJB0xSXUsWVgpWTQIMHFgBWVQAXVgKH0AKXQlHBlRcBxc=" style="text-decoration:none;color:#42b549" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFkReHRcBDl5USkxWClxJAVZdBBgFWA4fB1YJB0xSXUsWVgpWTQIMHFgBWVQAXVgKH0AKXQlHBlRcBxc%3D&amp;source=gmail&amp;ust=1535550842233000&amp;usg=AFQjCNFLb1cs9Uyp2Fz05KBAZJCY-DLVWg">sini</a>
                            </p>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
         --}}

      {{--   
        <tr>
            <td bgcolor="#FFFFFF" style="padding:20px 15px">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;font-size:13px">
                    <tbody><tr>
                        <td>
                            <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse">
                                <tbody><tr>
                                    <td width="280" align="left">
                                        <table border="0" style="border-collapse:collapse;margin-top:10px">
                                            <tbody><tr>
                                                <td style="font-size:13px;color:#999999;margin-bottom:10px">Download Aplikasi Tokopedia
                                                    <br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:2px"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse">
                                                        <tbody><tr>
                                                            <td>
                                                                <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFkReHRcKFkRdAUsXAENJCFcaBlkLGBZDGgdIQkwWCg8JRwFWUQJNWFdVCAlQAABQAARU&amp;ext=bHM9MSZtdD04" style="padding:0 5px 0 0" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFkReHRcKFkRdAUsXAENJCFcaBlkLGBZDGgdIQkwWCg8JRwFWUQJNWFdVCAlQAABQAARU%26ext%3DbHM9MSZtdD04&amp;source=gmail&amp;ust=1535550842233000&amp;usg=AFQjCNHu2ftab35e9rPmFigbjzKgUwrRFg"><img src="https://ci4.googleusercontent.com/proxy/FyPfQWTC6ljI7B4MuIcErV2YdEMRNtRtKapH_5ruRz45U_sEsEHfXtF_KDJ8TnpgqsqsjLOa6K6OtVhmAlDqtny_M8xBpJdzTmGKqe1GP2CCa8LXVROqzO1Fd5bd=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/205872016/07/1468233846.png" alt="Appstore" height="44" class="CToWUd"></a>
                                                            </td>
                                                            <td>
                                                                <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFg1LHVkTEh9SFEhKB19AAUAaBlkLGABfWEhMXQgNFQECXgUcTAgSVQ==&amp;ext=cGlkPUdtYWlsX1Nwb25zb3JlZF9Qcm9tb3Rpb24mYz1FbWFpbA==" style="padding:0 5px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFg1LHVkTEh9SFEhKB19AAUAaBlkLGABfWEhMXQgNFQECXgUcTAgSVQ%3D%3D%26ext%3DcGlkPUdtYWlsX1Nwb25zb3JlZF9Qcm9tb3Rpb24mYz1FbWFpbA%3D%3D&amp;source=gmail&amp;ust=1535550842234000&amp;usg=AFQjCNHCJ77CDOCZ6RlSFH5PNpMofm3Jng"><img src="https://ci6.googleusercontent.com/proxy/E6hTAYHPt-lyWiKTrmsdtDVMIBkHYzUUuNsNC7mRIgiiMAuzQdJmf93N2GMl6SU1m89dkb3dT5rGKTtVH4TIzDMsWJuTnD6b83LEzqXmM4uapTIXBljxon6RZL7z=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/205872016/07/1468233889.png" alt="Playstore" height="44" class="CToWUd"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                    <td width="280" align="right">
                                        <table border="0" style="border-collapse:collapse;margin-top:10px">
                                            <tbody><tr>
                                                <td style="font-size:13px;color:#999999;margin-bottom:10px" align="right">Ikuti Kami</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:2px"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse">
                                                        <tbody><tr>
                                                            <td>
                                                                <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFg1LHV0MA1JfDxZaDl4WCwFQEVsBZg4CQEk=" style="padding:0 5px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFg1LHV0MA1JfDxZaDl4WCwFQEVsBZg4CQEk%3D&amp;source=gmail&amp;ust=1535550842234000&amp;usg=AFQjCNEizfbv4G7sEns4FpNspKj0L4kwoQ"><img src="https://ci6.googleusercontent.com/proxy/oMFiUDYcrKcirtZ3R5xbZDNaG0iQhiTt_dxozWKyurEj6z0N9lyboKGpr5pWrh_PeP_4PQHTjgRUV27f7ULDz8BXpGLwGXblNShaPpmnL6yL-aihPGPzscXtG6vM=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307802.png" alt="Google plus" height="44" class="CToWUd"></a>
                                                            </td>
                                                            <td>
                                                                <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFg1LHV0MA1JfDxZaDl4WK0UHXQQQQRFyXEk=" style="padding:0 5px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFg1LHV0MA1JfDxZaDl4WK0UHXQQQQRFyXEk%3D&amp;source=gmail&amp;ust=1535550842234000&amp;usg=AFQjCNFv_SKJi5mEMplHVFEcU2b9910deg"><img src="https://ci5.googleusercontent.com/proxy/tbXrKw5Mk6YRyVWDAx7VAuMZgATn5WhIVOO6m3bOYd4Hp_dvfyJ02DclBC5Fyz-74EploLqOwoOob-Rkr9MQMW6Dh2O-qOP4fpYO3I1RVEEaIEpap5zeWuHdY-8n=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307762.png" alt="Facebook" height="44" class="CToWUd"></a>
                                                            </td>
                                                            <td>
                                                                <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFg1LHV0MA1JfDxZaDl4WMwNOK2ERUDV3Rg==" style="padding:0 5px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFg1LHV0MA1JfDxZaDl4WMwNOK2ERUDV3Rg%3D%3D&amp;source=gmail&amp;ust=1535550842234000&amp;usg=AFQjCNHVpWHr2P5rSWNUHlUY83Fb1se2BA"><img src="https://ci3.googleusercontent.com/proxy/whkvLviXsRcYOwldUYhj9pzCGhE9U8nO6U528mcdNmKP16da_i_LNKYLMCH5hPCRBRVvntD_dZlWEK6EwoOxyB511uO-D3Jij1nnpKPCoAB81pKxqUou3pZdXj8v=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307869.png" alt="Twitter" height="44" class="CToWUd"></a>
                                                            </td>
                                                            <td>
                                                                <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFg1LHV0MA1JfDxZaDl4WJgJNAEENWBdgWw==" style="padding:0 0 0 5px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFg1LHV0MA1JfDxZaDl4WJgJNAEENWBdgWw%3D%3D&amp;source=gmail&amp;ust=1535550842234000&amp;usg=AFQjCNE16Olj9Rdd2tyQF0vFC3V43B4qgQ"><img src="https://ci5.googleusercontent.com/proxy/mI2EDT38-neBpbn3i2hWIO_6upHpSsj4njT4g6hzdZ-Pjsyu4GF8xoReYpHZEDRts51DXV9SQjD_GtNrFNJIgSemuwU2IPAVxNGQQd6TE-CpVRalThv9cXUeIqZX=s0-d-e1-ft#https://s3.amazonaws.com/www.betaoutcdn.com/300452016/11/1480307832.png" alt="Instagram" height="44" class="CToWUd"></a>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
         --}}
                    
        
        <tr>
            <td>
                <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse;background-color:#f7f7f7;font-size:13px;color:#999999;border-top:1px solid #dddddd">
                    <tbody><tr>
                        <td width="560" align="center" style="padding:30px 20px 0">
{{--                             Jika butuh bantuan, gunakan halaman
                            <a href="http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=IRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==&amp;fl=ChEQFkReHRcUFUYdEFdSDkNcAFtVS1UJWkxTWghMUwAWSBEV" style="text-decoration:none;color:#42b549" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://fapp1.tokopedia.com/linktrack/lt.pl?id%3D16114%3DIRlUVgZSAwlXHgEDVAgJUQMJVE4%3DWQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ%3D%3D%26fl%3DChEQFkReHRcUFUYdEFdSDkNcAFtVS1UJWkxTWghMUwAWSBEV&amp;source=gmail&amp;ust=1535550842234000&amp;usg=AFQjCNHUdXmXatmV6ovYgoAeL-hv2etK3w">
                                Kontak Kami
                            </a> --}}
                        </td>
                    </tr>
                    <tr>
                        <td width="560" align="center" style="padding:10px 20px 30px">
                    &copy; {{date('Y')}} Triple A
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
        
    </tbody></table>
<p>&nbsp;<br></p>
<img id="m_7953608123438635804SBBBB" src="https://ci6.googleusercontent.com/proxy/GDu1iFKXeQR9e0tkOwa0x_3nIbuw3wKANxaaLIoC2W6eMrgqzEZ_TcboiISfRQv-CLVZG2weKATVNkd-C5hMDLB-mvHrRdMPyMcI--zqCdCrUxSqK-hBntIW7PEUMiestHhISAeyQhANxTiEgHYaT80lG_5ZjdwYnE_MP1YJkrzd7V34pnpJYCBO0H_WntntT0BpK2XVm2z1pX0=s0-d-e1-ft#http://fapp1.tokopedia.com/linktrack/lt.pl?id=16114=LRlUVgZSAwlXHgEDVAgJUQMJVE4=WQBEB18IX1EDeFUOAwwISFQLX0RSVwMLUg0MVQMLVAENUwVWAQ==" class="CToWUd"></div><div class="yj6qo"></div><div class="adL">


</div></div>