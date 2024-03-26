<div>
    @if (session()->has('message') && session()->has('type'))
        <div
            id="alert"
            class="alert

            @if(session('type') == 'success')
                alert-success border-success-bottom
            @elseif(session('type') == 'info')
                alert-info border-info-bottom
            @elseif(session('type') == 'warning')
                alert-warning border-warning-bottom
            @elseif(session('type') == 'danger')
                alert-danger border-danger-bottom
            @endif

            alert-dismissible fade show py-1"
        >
            @if(session('type') == 'success')
                <i class="fa fa-check-circle fa-lg me-1"></i>
            @elseif(session('type') == 'info')
                <i class="fa fa-info-circle fa-lg me-1"></i>
            @elseif(session('type') == 'warning')
                <i class="fa fa-exclamation-triangle fa-lg me-1"></i>
            @elseif(session('type') == 'danger')
                <i class="fa fa-times-circle fa-lg me-1"></i>
            @endif

            @if(session()->has('title'))
                <strong>{{ session('title') }}!</strong>
            @endif
            {{ session('message') }}
            <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
