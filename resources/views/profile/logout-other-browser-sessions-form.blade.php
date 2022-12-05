<x-jet-action-section>
    <x-slot name="title">
        
    </x-slot>

    <x-slot name="description">
       
    </x-slot>

    <x-slot name="content">
        

        @if (count($this->sessions) > 0)
           
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    

                        <div class="ml-3">
                            <div class="text-sm text-gray-600">
                                {{ $session->agent->platform() ? $session->agent->platform() : 'Unknown' }} - {{ $session->agent->browser() ? $session->agent->browser() : 'Unknown' }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                    @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            
        @endif

        

        
    </x-slot>
</x-jet-action-section>
