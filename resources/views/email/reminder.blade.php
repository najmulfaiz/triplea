<p style="text-align: justify;"><em>Hai <strong>{{ $nama }}</strong>&nbsp;</em></p>

<p style="text-align: justify;"><em><br></em></p>

<p style="text-align: justify;"><em>Bagaimana Kabarmu? Semoga selalu sehat. Kami belum menerima pembayaran untuk Invoice <strong>{{ $invoice }}</strong> di Event <strong>{{ $event->nama }} {{ $event->kota->nama }} {{ date('d-m-Y', strtotime($event->tanggal)) }}</strong> sebesar IDR <strong>{{ number_format($harga_akhir, 2, '.', ',') }}</strong>.</em></p>

<p style="text-align: justify;"><em>Anda dapat melakukan pembayaran ke Rekening <strong>BCA</strong> Kami di <strong>{{ $rekening->no_rekening }}</strong> an. <strong>{{ $rekening->nama_pemilik }}</strong> sebelum <strong>{{ $tenggat }}</strong>.&nbsp;</em></p>

<p style="text-align: justify;"><em>Mohon bisa melakukan pembayaran sebelum expired ya..&nbsp;</em></p>

<p style="text-align: justify;"><em>Terima Kasih&nbsp;</em></p>

<p style="text-align: justify;"><em><br></em></p>

<p style="text-align: justify;"><em>Salam,&nbsp;</em></p>

<p style="text-align: justify;"><em><br></em></p>

<p style="text-align: justify;"><em>Management TRIPLEASPORT </em></p>