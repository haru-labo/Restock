@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
@if (count($errors) > 0)
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="pure-g">
    <div class="pure-u">
    <form class="pure-form pure-form-aligned" action="/item/{{ $item->id }}/edit" method="POST">
        @csrf
        <legend>EditItem</legend>
        <fieldset>
            <div class="pure-control-group">
                <label for="category">カテゴリー</label>
                <input id="category" name="category" type="text" placeholder="category" value="{{ $item->category }}">
                <span class="pure-form-message-inline">必須</span>
            </div>
            <div class="pure-control-group">
                <label for="name">品名</label>
                <input id="name" name="name" type="text" placeholder="name" value="{{ $item->name }}">
                <span class="pure-form-message-inline">必須</span>
            </div>
            <div class="pure-control-group">
                <label for="stock">ストック</label>
                <input id="stock" name="stock" type="number" min="0" max="999" placeholder="stock" value="{{ $item->stock }}">
                <span class="pure-form-message-inline">必須（0-999）</span>
            </div>
            <div class="pure-control-group">
                <label for="dateopen">開封日</label>
                <input id="dateopen" name="dateopen" type="date" placeholder="dateopen">
                <span class="pure-form-message-inline">必須</span>
            </div>
            <div class="pure-control-group">
                <label for="datelastopen">前回開封日</label>
                <input id="datelastopen" name="datelastopen" type="date" placeholder="datelastopen" value="{{ $item->dateopen->format('Y-m-d') }}">
            </div>
            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-secondary">
                    <i class="fas fa-edit"></i>更新
                </button>
                <a class="button-secondary pure-button" href="/">
                    <i class="fas fa-window-close"></i>キャンセル
                </a>
            </div>
        </fieldset>
    </form>
    </div>
</div>
@endsection
