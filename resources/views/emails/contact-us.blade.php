@component('mail::message')

Pesan Kontak Baru

Anda telah menerima pesan kontak baru dari {{ $name }}.

Detail Pengirim:

Nama: {{ $name }}

Email: {{ $email }}

Telepon: {{ $phone }}

Subjek: {{ $subject }}

Isi Pesan:

@component('mail::panel')
{{ $msg }}
@endcomponent

Terima kasih.
Kami merekomendasikan untuk membalas email ini secara langsung (reply) karena sudah diatur untuk membalas ke email pengirim.
@endcomponent