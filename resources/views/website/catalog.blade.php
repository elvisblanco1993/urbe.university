@extends('layouts.website', ['settings' => $settings, 'title' => 'URBE University'])

@section('content')
    <div class="w-full h-56" style="background-image: url({{ asset('static_assets/page-header-bg.webp') }})">
        <div class="h-full flex items-center justify-center">
            <h1 class="text-5xl font-extrabold text-white">| URBE Catalogs</h1>
        </div>
    </div>
    <div class="py-12 max-w-5xl mx-auto">
        <h2 class="text-2xl font-semibold">Course catalog for the year {{$catalog->year}}</h2>
        <object data="{{asset($catalog->path)}}#toolbar=0&navpanes=0&scrollbar=0"
            type="application/pdf"
            width="100%"
            height="700px"
            class="mt-6"
        >
    </div>
@endsection
