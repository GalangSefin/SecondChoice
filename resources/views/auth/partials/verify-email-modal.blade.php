<div class="modal fade" id="verifyEmailModal" tabindex="-1" role="dialog" aria-labelledby="verifyEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifyEmailModalLabel">Verifikasi Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                    </div>
                @endif

                <p>{{ __('Sebelum melanjutkan, silakan periksa email Anda untuk link verifikasi.') }}</p>
                <p>{{ __('Email verifikasi telah dikirim ke: ') }} <strong>{{ Auth::user()->email }}</strong></p>
                
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> 