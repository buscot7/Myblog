@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Ajouter un article')
        @endslot
        <form method="POST" action="{{ route('article.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="category_id">@lang('Catégorie')</label>
                <select id="category_id" name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @include('partials.form-group', [
                'title' => __('Titre'),
                'type' => 'text',
                'name' => 'description',
                'required' => true,
                ])
            <div id="textarea" class="form-group{{ $errors->has('article') ? ' is-invalid' : '' }}">
                <label class="custom-file">
                    <textarea type="text" id="article" name="article" rows="13" cols="50" class="form-control{{ $errors->has('article') ? ' is-invalid ' : '' }}" required></textarea>
                    @if ($errors->has('article'))
                        <div class="invalid-feedback">
                            {{ $errors->first('article') }}
                        </div>
                    @endif
                </label>
            </div>
            @component('components.button')
                @lang('Envoyer')
            @endcomponent
        </form>
    @endcomponent
@endsection
@section('script')
    <script>
        $(function() {
            $('input[type="file"]').on('change',function(){
                var fileName = $(this).val().replace(/^.*[\\\/]/, '')
                $(this).next('.form-control-file').html(fileName)
            })
        })
    </script>
@endsection