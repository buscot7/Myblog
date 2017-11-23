@extends('layouts.app')

@section('content')

    <main class="container-fluid">
        <div class="container">
            @isset($category)
                <h2 class="text-title mb-3">{{ $category->name }}</h2>
            @endif
            @isset($user)
                <h2 class="text-title mb-3">{{ __('Articles de ') . $user->name }}</h2>
            @endif
            <div class="card-columns" id="homecard">
                @foreach($articles as $article)
                    <div class="card">
                        <h3 class="text-title">{{$article->title}}</h3>

                        <div class="card-body">
                            <p class="card-text">{{ $article->content }}</p>
                        </div>
                        <div class="card-footer text-muted">
                            <small><em>
                                    <a href="{{ route('user', $article->user->id) }}" data-toggle="tooltip" title="{{ __('Voir les articles de ') . $article->user->name }}">{{ $article->user->name }}</a>
                                </em></small>
                            <small class="pull-right">
                                <em>
                                    {{ $article->created_at }}
                                    @adminOrOwner($article->user_id)
                                    <a href="{{ route('article.edit', $article->id) }}" data-toggle="tooltip" title="@lang('Modifier cet article')">modifier</a> -
                                    <a class="form-delete" href="{{ route('article.destroy', $article->id) }}" data-toggle="tooltip" title="@lang('Supprimer cet article')">supprimer</a>
                                    <form action="{{ route('article.destroy', $article->id) }}" method="POST" class="hide">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                    @endadminOrOwner
                                </em>
                            </small>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $articles->links() }}
                    </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        $(function() {
            $('a.form-delete').click(function(e) {
                e.preventDefault();
                var href = $(this).attr('href')
                $("form[action='" + href + "'").submit()
            })
        })
    </script>
@endsection