

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm py-10 sm:rounded-lg">
                <div class="flex justify-between items-centers mx-5">
                    <div x-data="{showProject:false}" class="relative  inline-block text-left">
                        <div class=" w-40">
                            <button @click="showProject = !showProject" type="button" class="inline-flex w-full justify-between gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" >
                            {{$project != null ? $project['name'] : "Select a project"}}
                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                            </button>
                        </div>

                        
                        <div x-show="showProject" class="absolute left-0 mt-2 w-full z-20 overflow-y-auto origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            
                                <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                @foreach ($projects as $proj)
                                    @if (isset($project['id']) && $project['id'] == $proj->id)
                                        <a href="#" wire:click="updateSelectedProject"  @click="showProject = false" class="text-blue-700 bg-gray-100 block px-4 py-2 text-sm">{{$proj->name}}</a>    
                                    @else
                                        <a href="#" wire:click="updateSelectedProject({{$proj}})"  @click="showProject = false" class="text-gray-700 block px-4 py-2 text-sm">{{$proj->name}}</a>
                                    @endif
                                @endforeach
                                
                            
                        </div>
                    </div>
                    <div x-data="{'showCreateProject':@entangle('showCreateProject')}" class=" ">
                        <button @click="showCreateProject = true" class="px-3 py-1 rounded-lg bg-blue-400 text-white inline-flex items-center  " >
                            <span class="pr-2">Create new project</span>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </button>
                        
                        @if ($showCreateProject)
                        
                            <x-modal :show="$showCreateProject" :name="$showCreateProject">
                                <div x-data="{currentPage:1}" @click.outside="showCreateProject = false" class="mx-auto max-w-xl bg-white relative rounded-2xl px-5 py-5">
                                    <div class=" flex justify-end">
                                        <div class="p-2 cursor-pointer " @click="showCreateProject = false">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" text-gray-600 w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <span class="text-2xl text-gray-600 font-semibold">Create a project</span>
                                    </div>
                                    <form wire:submit.prevent="submit" class="mt-5">
                                        <div>
                                            <input type="text" wire:model="name" class="rounded-lg outline-none border-gray-100 focus:border-none focus:outline-blue-500 w-full" placeholder="Project name" >
                                            @error('name') <span class="text-sm text-red-400 block pt-2">{{$message}}</span> @enderror
                                        </div>
                                        <button type="submit" class="rounded-lg px-5 py-1 bg-blue-500 mt-4 text-white">Create</button>
                                    </form>
                                    


                                </div>
                            </x-modal>
                        @endif
                        
                    </div>
                </div>

                @if (session()->has('project'))
                    <div class="px-6 py-3 w-full rounded-sm mt-3 mx-2 text-white bg-green-500/50">
                        <span class="text-sm font-semibold">
                            {{session('project')}}
                        </span>
                    </div>
                    
                @endif

                @if ($project != null)
                    
                    <livewire:task.index :project="$project" :key="$project['id']" />
                @else
                    <div class="mt-5 w-full px-5">
                        <div class="max-w-full flex justify-center h-full rounded-xl border border-dashed mx-auto py-10 ">
                            <div>
                                <img src="{{asset('assets/select.gif')}}" alt="">
                                <span class="text-center mt-5 text-red-500 font-semibold">You haven't select a project.</span>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>