<nav x-data="{
        active_menu: '',
        mobile_menu: false,
        active_mobile_menu: '',
    }"
    x-on:click.outside="active_menu=''"
    x-on:mouseleave="active_menu=''"
    class="bg-white border-b relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20">
        <div class="h-full flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('static_assets/urbe-logo.svg') }}" alt="URBE Logo" class="h-12 w-auto">
            </a>

            <ul class="hidden md:flex md:h-full items-center text-base font-medium text-slate-700">
                @forelse (\App\Models\Menu::whereNull('parent')->where('location', 'navbar')->orderBy('order', 'asc')->get() as $item)
                    <li class="block h-full">
                        @if ($item->type == 'dropdown' || $item->type == 'megamenu')
                            <button
                                x-on:click="active_menu = (active_menu == `{{ $item->uuid }}`) ? '' : `{{ $item->uuid }}`"
                                :class="active_menu == `{{ $item->uuid }}` ? 'text-sky-500' : ''"
                                class="h-full px-3 flex items-center hover:text-sky-500 transition-all"
                            >{{ $item->label }}
                            </button>
                        @else

                        @endif
                    </li>
                @empty
                @endforelse
            </ul>

            <div class="flex items-center space-x-4" x-on:mouseover="active_menu = ''">
                <a href="https://admissions.urbe.university"
                    class="text-white bg-sky-500 hover:bg-sky-400 focus:ring-4 focus:ring-sky-300 font-medium rounded-md text-base px-5 py-2 md:px-6 md:py-3 mr-1 md:mr-0 focus:outline-none"
                >{{ __('Apply Now') }}</a>

                {{-- Mobile Menu --}}
                <div class="flex items-center md:hidden">
                    <button x-on:click="mobile_menu = !mobile_menu" class="p-2 bg-slate-100 rounded-md">
                        <svg x-show="!mobile_menu" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="mobile_menu" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Desktop Menu Items --}}
    @forelse (\App\Models\Menu::whereNull('parent')->where('location', 'navbar')->where('type', 'dropdown')->orWhere('type', 'megamenu')->orderBy('order', 'asc')->get() as $submenu)
        <div x-show="active_menu == `{{$submenu->uuid}}`" x-cloak
            class="bg-white w-full absolute z-50 border-t border-t-slate-100 shadow-md ease-in delay-300"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-4 grid grid-cols-4 gap-1">
                    @forelse (\App\Models\Menu::where('location', 'navbar')->whereNotNull('parent')->where('parent', $submenu->id)->orderBy('order', 'ASC')->get() as $child)
                        <div class="col-span-4 md:col-span-2 lg:col-span-1">
                            <a href="{{ $child->url }}" @if ($child->opens_in_new_tab) target="_blank" @endif
                                class="block w-full py-4 rounded-md hover:bg-slate-100 text-center text-base transition-all"
                            >{{$child->label}}</a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @empty
    @endforelse

    {{-- Mobile Menu --}}
    <div x-cloak x-show="mobile_menu" class="md:hidden absolute z-50 w-full h-screen bg-white">
        <div class="mt-4 px-4 sm:px-6">
            <h1 class="text-2xl font-black uppercase underline text-slate-300">Menu</h1>

            @forelse (\App\Models\Menu::whereNull('parent')->where('location', 'navbar')->where('type', 'dropdown')->orWhere('type', 'megamenu')->orderBy('order', 'asc')->get() as $submenu)
                <div class="block w-full">
                    <button x-on:click="active_mobile_menu = (active_mobile_menu == `{{ $submenu->uuid }}`) ? '' : `{{ $submenu->uuid }}`"
                        :class="active_mobile_menu == `{{ $submenu->uuid }}` ? 'text-sky-500 bg-slate-100' : ''"
                        class="w-full flex items-center justify-between font-bold text-xl py-3 px-3 mt-2 hover:bg-slate-50"
                    >
                        <span>{{ $submenu->label }}</span>
                        <svg x-show="active_mobile_menu != `{{$submenu->uuid}}`" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                        </svg>
                        <svg x-show="active_mobile_menu == `{{$submenu->uuid}}`" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="active_mobile_menu == `{{$submenu->uuid}}`" x-cloak class="bg-slate-50 py-4 px-4">
                        @forelse (\App\Models\Menu::where('location', 'navbar')->whereNotNull('parent')->where('parent', $submenu->id)->orderBy('order', 'ASC')->get() as $child)
                            <a href="{{ $child->url }}" @if ($child->opens_in_new_tab) target="_blank" @endif class="flex items-center justify-between">
                                <span>{{ $child->label }}</span>
                                <svg x-cloak @class([
                                        "w-6 h-6",
                                        "hidden" => $child->opens_in_new_tab,
                                    ]) xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                </svg>
                                <svg x-cloak @class([
                                        "w-6 h-6",
                                        "hidden" => !$child->opens_in_new_tab,
                                    ])
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </a>
                        @empty

                        @endforelse
                    </ul>
                </div>
            @empty

            @endforelse
        </div>
    </div>
</nav>
