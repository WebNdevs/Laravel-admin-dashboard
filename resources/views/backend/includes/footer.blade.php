<footer class="footer text-sm text-white">
    <div>
        <a href="/" class="text-white">{{app_name()}}</a>.
        @if(setting('show_copyright'))
        @lang('Copyright') &copy; {{ date('Y') }}
        @endif
    </div>
    <div class="ms-auto">{{app_name()}}</div>
    {{-- <div class="ms-auto">{!! setting('footer_text') !!}</div> --}}
</footer>