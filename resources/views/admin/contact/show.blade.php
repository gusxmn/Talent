@extends('admin.layout')

@section('content')
<div class="container">
    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">

            <div class="mb-2 d-flex">
                <strong class="me-2" style="width:87px;">Pesan dari:</strong>
                <span>{{ $message->name ?? '-' }}</span>
            </div>

            <div class="mb-2 d-flex">
                <strong class="me-2" style="width:87px;">Subject:</strong>
                <span>{{ $message->subject ?? '-' }}</span>
            </div>

            <div class="mb-2 d-flex">
                <strong class="me-2" style="width:87px;">Email:</strong>
                <span>{{ $message->email ?? '-' }}</span>
            </div>

            <div class="mb-2 d-flex">
                <strong class="me-2" style="width:87px;">Kontak:</strong>
                <span>{{ $message->phone ?? '-' }}</span>
            </div>

            <div class="mb-2 d-flex align-top">
                <strong class="me-2" style="width:87px;">Isi Pesan:</strong>
                <span>{!! nl2br(e($message->message)) !!}</span>
            </div>

        </div>

        <div class="card-footer text-muted">
            Diterima: {{ \Carbon\Carbon::parse($message->created_at)->locale('id')->translatedFormat('H:i d M Y') }}
            {{-- Menggunakan kolom read_at untuk tampilan Dibaca --}}
            @if($message->read_at) 
                | Dibaca: {{ \Carbon\Carbon::parse($message->read_at)->locale('id')->translatedFormat('H:i d M Y') }}
            @endif
        </div>
    </div>
</div>
@endsection