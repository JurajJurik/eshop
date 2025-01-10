<div>
    <div></div>
    @if ($style == 'advantages')
        @foreach($inputs as $index => $input)
            <div class="input-group flex items-center w-full my-3">
                <div class="border-solid border-t-2 border-l-2 border-b-2 rounded-l-lg border-zinc-500 h-12 px-4 bg-green-400">
                    <span class="bg-transparent size-full border-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span>   
                </div>
                <div class="border-solid border-2 border-zinc-500 h-12 w-2/3 flex justify-between rounded-r-lg">
                    <input type="text" wire:change="saveAdvantages($event.target.value)" name="advantages[]" class="bg-transparent size-full border-none focus:ring-0" placeholder="Write an advantage"/>
                </div>
                

                @if ($index <= 3)
                    <button class="bg-transparent border-none flex items-center justify-end px-2" wire:click.prevent="addInput()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>                        
                    </button>
                @endif
                @if ($index > 0)
                        <button class="bg-transparent border-none flex items-center justify-end px-2" wire:click.prevent="removeInput({{ $index }})">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>  
                        </button>
                @endif
            </div>
        @endforeach
    @elseif ($style == 'disadvantages')
        @foreach($inputs as $index => $input)
            <div class="input-group flex items-center w-full my-3">
                <div class="border-solid border-t-2 border-l-2 border-b-2 rounded-l-lg border-zinc-500 h-12 px-4 bg-red-400">
                    <span class="bg-transparent size-full border-none flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>   
                    </span>   
                </div>
                <div class="border-solid border-2 border-zinc-500 h-12 w-2/3 flex justify-between rounded-r-lg">
                    <input type="text" wire:change="saveDisadvantages($event.target.value)" name="disadvantages[]" class="bg-transparent size-full border-none focus:ring-0" placeholder="Write a disadvantage"/>
                </div>
                @if ($index <= 3)
                    <button class="bg-transparent border-none flex items-center justify-end px-2" wire:click.prevent="addInput()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>                        
                    </button>
                @endif
                @if ($index > 0)
                        <button class="bg-transparent border-none flex items-center justify-end px-2" wire:click.prevent="removeInput({{ $index }})">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>  
                        </button>
                @endif
            </div>
        @endforeach
    @endif
</div>
