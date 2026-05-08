@php
    $context = $context ?? 'storefront';
    $messages = [];

    if (session('success')) {
        $messages[] = [
            'type' => 'success',
            'title' => 'Done',
            'message' => session('success'),
            'icon' => 'icofont-check-circled',
        ];
    }

    if (session('error')) {
        $messages[] = [
            'type' => 'error',
            'title' => 'Something needs attention',
            'message' => session('error'),
            'icon' => 'icofont-warning-alt',
        ];
    }

    if (session('warning')) {
        $messages[] = [
            'type' => 'warning',
            'title' => 'Almost there',
            'message' => session('warning'),
            'icon' => 'icofont-info-circle',
        ];
    }

    if ($errors->any()) {
        $messages[] = [
            'type' => 'error',
            'title' => 'Please review the form',
            'message' => $errors->first(),
            'icon' => 'icofont-warning-alt',
        ];
    }
@endphp

@if (! empty($messages))
    <div class="flash-stack flash-stack-{{ $context }}" data-flash-stack>
        @foreach ($messages as $message)
            <div class="flash-toast flash-toast-{{ $message['type'] }}" data-flash-toast role="status" aria-live="polite">
                <div class="flash-toast-icon">
                    <i class="{{ $message['icon'] }}"></i>
                </div>
                <div class="flash-toast-copy">
                    <strong>{{ $message['title'] }}</strong>
                    <span>{{ $message['message'] }}</span>
                </div>
                <button type="button" class="flash-toast-close" data-flash-dismiss aria-label="Dismiss notification">
                    <i class="icofont-close-line"></i>
                </button>
                <span class="flash-toast-bar"></span>
            </div>
        @endforeach
    </div>
@endif
