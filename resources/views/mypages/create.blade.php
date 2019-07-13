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
    <form class="pure-form pure-form-aligned" action="/item/store" method="POST">
        @csrf
        <legend>AddItem</legend>
        <fieldset>
            <div class="pure-control-group">
                <label for="category">カテゴリー</label>
                <input id="category" name="category" type="text" placeholder="category" value="{{old('category')}}">
                <span class="pure-form-message-inline">必須</span>
            </div>
            <div class="pure-control-group">
                <label for="name">品名</label>
                <input id="name" name="name" type="text" placeholder="name" value="{{old('name')}}">
                <span class="pure-form-message-inline">必須</span>
            </div>
            <div class="pure-control-group">
                <label for="stock">ストック</label>
                <input id="stock" name="stock" type="number" min="0" max="999" placeholder="0-999" value="{{old('stock')}}">
                <span class="pure-form-message-inline">必須（0-999）</span>
            </div>
            <div class="pure-control-group">
                <label for="dateopen">開封日</label>
                <input id="dateopen" name="dateopen" type="date" placeholder="dateopen" value="{{old('dateopen')}}">
                <span class="pure-form-message-inline">必須</span>
            </div>
            <div class="pure-controls">
                <button type="submit" class="pure-button pure-button-primary">
                    <i class="fas fa-plus-circle"></i>登録
                </button>
                <a class="button-secondary pure-button" href="/">
                    <i class="fas fa-window-close"></i>キャンセル
                </a>
            </div>
        </fieldset>
    </form>
@endsection
