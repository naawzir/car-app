@if(session()->has('errors') || session()->has('error'))
    @if(session()->has('errors'))
        <div class="col-sm-23 alert-box warning">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @elseif(session()->has('error'))
        <div class="col-sm-23 alert-box warning">
            <p> {{ session()->get('error') }}</p>
        </div>
    @endif

	@push('scripts')
		{{--<script type="text/javascript">
            $(document).ready(function()
            {
                $('.warning').on('click', function ()
                {
                    this.remove();
                }).fadeOut(8000);
            });
		</script>--}}
	@endpush
@endif