@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <article class="mb-4">
        @if($article->image)
            <img src="{{ $article->getImage(800, 600) }}" class="img-fluid mb-4 rounded" alt="{{ $article->title }}">
        @endif

        <h1 class="mb-4">{{ $article->title }}</h1>

        <div class="d-flex gap-3 mb-4">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-primary like-btn" data-id="{{ $article->id }}">
                    <span class="likes-count">{{ $article->likes_count }}</span>
                    <i class="bi bi-heart"></i>
                </button>
            </div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-eye"></i>
                <span class="views-count">{{ $article->views_count }}</span>
            </div>
        </div>

        <div class="content mb-4">
            {!! nl2br(e($article->content)) !!}
        </div>

        <div class="d-flex gap-2 mb-4">
            @foreach($article->tags as $tag)
                <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}" 
                   class="badge bg-secondary text-decoration-none">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </article>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-4">Оставить комментарий</h5>
            <form id="comment-form">
                <div class="mb-3">
                    <label for="subject" class="form-label">Тема</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Сообщение</label>
                    <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Увеличение счетчика просмотров
    setTimeout(function() {
        $.post('{{ route("articles.view", $article) }}', function(response) {
            $('.views-count').text(response.views_count);
        });
    }, 5000);

    // Обработка лайков
    $('.like-btn').click(function() {
        $.post('{{ route("articles.like", $article) }}', function(response) {
            $('.likes-count').text(response.likes_count);
        });
    });

    // Отправка комментария
    $('#comment-form').submit(function(e) {
        e.preventDefault();
        $.post('{{ route("comments.store") }}', {
            article_id: {{ $article->id }},
            subject: $('#subject').val(),
            body: $('#body').val()
        }, function(response) {
            $('#comment-form').replaceWith(
                '<div class="alert alert-success">Ваше сообщение успешно отправлено</div>'
            );
        });
    });
});
</script>
@endpush 