@extends('layouts.frontend')

@section('title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
@if($page->banner_image)
<section class="relative h-64 bg-cover bg-center" style="background-image: url('{{ Storage::url($page->banner_image) }}');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative container mx-auto px-6 h-full flex items-center">
        <h1 class="text-4xl font-bold text-white">{{ $page->title }}</h1>
    </div>
</section>
@else
<section class="bps-gradient text-white py-16">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold">{{ $page->title }}</h1>
    </div>
</section>
@endif

<section class="py-12 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto prose prose-lg">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endsection
