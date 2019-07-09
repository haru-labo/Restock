@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
<form class="pure-form pure-form-aligned" action="item/{{ $item->id }}/edit" method="POST">
        @csrf
        <legend>EditItem</legend>
        <fieldset>
            <div class="pure-control-group">
                <label for="category">カテゴリー</label>
                <input id="category" type="text" placeholder="category" value="{{ $item->category }}">
                <span class="pure-form-message-inline">必須</span>
            </div>
            <div class="pure-control-group">
                <label for="name">品名</label>
                <input id="name" type="text" placeholder="name" value="{{ $item->name }}">
                <span class="pure-form-message-inline">必須</span>
            </div>
            <div class="pure-control-group">
                <label for="stock">ストック</label>
                <input id="stock" type="number" placeholder="stock" value="{{ $item->stock }}">
            </div>
            <div class="pure-control-group">
                <label for="dateopen">開封日</label>
                <input id="dateopen" type="date" placeholder="opening date" value="{{ $item->toYMD($item->dateopen) }}">
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
@endsection
