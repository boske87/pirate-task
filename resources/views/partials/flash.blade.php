@if(session()->has('flash_message'))
    <section class="content-header">
        <div class="alert alert-{{ session('flash_message_type') }} alert-dismissable">
            <p>{{ session('flash_message') }}</p>
        </div>
    </section>
@endif