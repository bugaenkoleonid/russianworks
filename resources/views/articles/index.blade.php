@extends('layouts.app')

@section('title', 'Каталог статей')

@section('content')
    <h1 class="mb-4">Каталог статей</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
        @foreach($articles as $article)
            <div class="col">
                <x-article-card :article="$article" />
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection 