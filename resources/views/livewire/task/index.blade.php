<div x-data="{showEdit:@entangle('showEdit'),showDelete:@entangle('showDelete')}" class="pt-5 pl-2">

    <div class="">
        <div x-data="{'showCreateTask':@entangle('showCreateTask')}" class=" ">
            <button @click="showCreateTask = true" class="px-3 py-1 rounded-lg bg-blue-400 text-white inline-flex items-center  " >
                <span class="pr-2">Create new task</span>

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
            </button>
            
            @if ($showCreateTask)

                <x-modal :show="$showCreateTask" :name="$showCreateTask">
                    <div x-data="{currentPage:1}" @click.outside="showCreateTask = false" class="mx-auto max-w-xl bg-white relative rounded-2xl px-5 py-5">
                        <div class=" flex justify-end">
                            <div class="p-2 cursor-pointer " @click="showCreateTask = false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" text-gray-600 w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>

                        </div>
                        <div class="text-center">
                            <span class="text-2xl text-gray-600 font-semibold">Create a Task</span>
                        </div>
                        <form wire:submit.prevent="submit" class="mt-5">
                            <div>
                                <input type="text" wire:model="name" class="rounded-lg outline-none border-gray-100 focus:border-none focus:outline-blue-500 w-full" placeholder="Task name" >
                                @error('name') <span class="text-sm text-red-400 block pt-2">{{$message}}</span> @enderror
                            </div>
                            <button type="submit" class="rounded-lg px-5 py-1 bg-blue-500 mt-4 text-white">Create task</button>
                        </form>
                        


                    </div>
                </x-modal>
            @endif
            
        </div>
    </div>

    @if (count($tasks) != 0)
        <div class="grid grid-cols-5 justify-between mt-5 text-left">
            <span class="px-3 py-1 border-l w-full " ></span>
            <span class="px-3 py-1 border-l w-full " >#Priority</span>
            <span class="px-3 py-1 border-l w-full " >Task name</span>
            <span class="px-3 py-1 border-l w-full " >Updated at</span>
            <span class="px-3 py-1 border-l w-full  border-r" >Actions</span>
            
        </div>
        <div wire:sortable="updateTaskOrder" >
            @foreach ($tasks as $task)
                <li wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}" class=" grid grid-cols-5 w-full justify-between cursor-move py-3 text-left">
                    <div wire:sortable.handle class="px-3 py-1 w-full border-b" >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                        </svg>
                    </div>
                    <div wire:sortable.handle class="px-3 py-1 w-full border-b" >
                        <span>{{$task->priority}}</span>
                    </div>
                    <div  class="px-3 py-1 w-full border-b" >
                        {{$task->name}}
                    </div>
                    <div class="px-3 py-1 w-full border-b" >
                        {{$task->created_at->diffForHumans()}}
                    </div>
                    
                    {{-- <div class="flex">
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
                    </div> --}}
                    
                    <livewire:task.list-card key="action-{{$task->id}}" :task="$task->id" />
                </li>
                {{-- {{$tasks}} --}}
            @endforeach
        </div>
    @else
    
        <div class="mt-5 w-full px-5">
            <div class="max-w-full flex justify-center h-full rounded-xl border border-dashed mx-auto py-10 ">
                <div>
                    <img src="{{asset('assets/no.gif')}}" alt="">
                    <span class="text-center mt-5 text-red-500 font-semibold">No task under This project.</span>
                </div>
            </div>
        </div>

    @endif
    

    {{-- @if ($showEdit)
                        
        <x-modal :show="$showEdit" :name="$showEdit">
            <div x-data="{currentPage:1}" @click.outside="showEdit = false" class="mx-auto max-w-xl bg-white relative rounded-2xl px-5 py-5">
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
                        <input type="text" wire:model="name" class="rounded-lg outline-none border-gray-100 focus:border-none focus:outline-blue-500 w-full" placeholder="Project name" >
                        @error('name') <span class="text-sm text-red-400 block pt-2">{{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="rounded-lg px-5 py-1 bg-blue-500 mt-4 text-white">Create</button>
                </form>
                


            </div>
        </x-modal>
    @endif


    @if ($showDelete)
                        
        <x-modal :show="$showDelete" :name="$showDelete">
            <div x-data="{currentPage:1}" @click.outside="showDelete = false" class="mx-auto max-w-xl bg-white relative rounded-2xl px-5 py-5">
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
    @endif --}}
</div>


@push('styles')
    <style>
        .draggable-mirror {
            background-color: gray;
            display: flex;
            justify-content: space-between;
            /* box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1); */

        }
    </style>
@endpush