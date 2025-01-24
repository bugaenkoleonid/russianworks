<div class="card h-100">
    @if($article->thumbnail)
        <img src="{{ asset('storage/' . $article->thumbnail) }}" class="card-img-top" alt="{{ $article->title }}">
    @endif
    <div class="card-body">
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