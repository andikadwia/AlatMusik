@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Komentar dan Ulasan</h2>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($reviews as $review)
            <x-ulasan-card :review="$review" />
        @endforeach
    </div>
</div>
@endsection
