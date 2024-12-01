@if (!empty($message))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@else
    <p>Tidak ada notifikasi baru</p>
@endif
