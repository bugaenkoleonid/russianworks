<div class="card h-100">
    @if($article->thumbnail)
        <img src="{{ asset('storage/' . $article->thumbnail) }}" class="card-img-top" alt="{{ $article->title }}">
    @endif
    <div class="card-body">
        @if($article->image)
        <img src="https://images.placeholders.dev/300x200?text=Article+{{ $article->id }}" class="img-fluid rounded-start" alt="{{ $article->title }}">
        @endif
        <h5 class="card-title">
            <a href="{{ route('articles.show', $article->slug) }}" class="text-decoration-none">
                {{ $article->title }}
            </a>
        </h5>
        <p class="card-text">{{ $article->short_content }}</p>
        <div class="d-flex gap-2">
            @foreach($article->tags as $tag)
                <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}" 
                   class="badge bg-secondary text-decoration-none">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</div> 