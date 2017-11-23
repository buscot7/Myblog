@extends('layouts.form')
@section('card')
    @component('components.card')
        @slot('title')
            @lang('Modifer le profil')
        @endslot
        <form method="POST" action="{{ route('profile.update', $user->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('partials.form-group', [
            'title' => __('Adresse email'),
            'type' => 'email',
            'name' => 'email',
            'required' => true,
            'value' => $user->email,
            ])
            @include('partials.form-group', [
            'title' => __('Nom'),
            'type' => 'text',
            'name' => 'name',
            'required' => true,
            'value' => $user->name,
            ])
            @component('components.button')
                @lang('Envoyer')
            @endcomponent
        </form>
    @endcomponent
@endsection