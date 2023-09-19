<div x-data="{showEdit:@entangle('showEdit'),showDelete:@entangle('showDelete')}" class="px-3 py-1 w-full border-b flex" >
    <div @click="showEdit = true" class="pr-2 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>

    </div>
    <div @click="showDelete = true" class=" cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-400">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
        </svg>

    </div>
    
    
    @if ($showEdit)
                        
        <x-modal :show="$showEdit" :name="$showEdit">
            <div x-data="{currentPage:1}" @click.outside="showEdit = false" class=" cursor-auto mx-auto max-w-xl bg-white relative rounded-2xl px-5 py-5">
                <div class=" flex justify-end">
                    <div class="p-2 cursor-pointer " @click="showEdit = false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" text-gray-600 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                </div>
                <div class="text-center">
                    <span class="text-2xl text-gray-600 font-semibold">Edit Task</span>
                </div>
                <form wire:submit.prevent="edit" class="mt-5">
                    <div>
                        <input type="text" wire:model="name" class="rounded-lg outline-none border-gray-100 focus:border-none focus:outline-blue-500 w-full" placeholder="Task name" >
                        @error('name') <span class="text-sm text-red-400 block pt-2">{{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="rounded-lg px-5 py-1 bg-blue-500 mt-4 text-white">Update</button>
                </form>
                


            </div>
        </x-modal>
    @endif


    @if ($showDelete)
                        
        <x-modal :show="$showDelete" :name="$showDelete">
            <div x-data="{currentPage:1}" @click.outside="showDelete = false" class=" cursor-auto mx-auto max-w-xl bg-white relative rounded-2xl px-5 py-5">
                <div class=" flex justify-end">
                    <div class="p-2 cursor-pointer " @click="showDelete = false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" text-gray-600 w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>

                </div>
                <div class="text-center">
                    <span class="text-xl text-gray-600 font-semibold">Are you sure you want to delete this task?</span>
                    <span class="text-lg text-red-400 font-semibold block">{{$task->name}}</span>
                </div>
                <form wire:submit.prevent="delete" class="mt-5">
                    
                    <button type="submit" class="rounded-lg px-5 py-1 bg-red-500 mt-4 text-white">
                        <span>Delete</span>
                        
                    </button>
                </form>
                


            </div>
        </x-modal>
    @endif
</div>
