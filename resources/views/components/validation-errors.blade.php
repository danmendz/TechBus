@if ($errors->any())
    <div {{ $attributes }}>
        <div class="bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert" tabindex="-1"
            aria-labelledby="hs-with-list-label">
            <div class="flex">
                <div class="shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-4 mt-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>                      
                </div>
                <div class="ms-4">
                    <h3 id="hs-with-list-label" class="text-sm font-semibold">
                        {{ __('Whoops! Something went wrong.') }}
                    </h3>

                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc space-y-1 ps-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
@endif
