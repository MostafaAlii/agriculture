<span class="font-weight-bold badge badge-pill badge-{{ $payment->sandbox == 1 ? 'success' : 'danger'  }}">
    {{ $payment->sandbox == 1 ? __('Admin/payments.live') : __('Admin/payments.sandbox') }}
</span>