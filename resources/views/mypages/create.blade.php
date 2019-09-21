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
<div class="container">
    <form action="/item/store" method="POST">
        @csrf
        <legend class="shadow-sm p-2 mb-2 bg-white rounded">Add Item</legend>
        <fieldset>
            <div class="form-group col-md-4">
                <label for="category">カテゴリー</label>
                <input  class="form-control is-valid" id="category" name="category" type="text" placeholder="category" value="{{old('category')}}" required>
            </div>
            <div class="form-group col-md-4">
                <label for="name">品名</label>
                <input class="form-control is-valid" id="name" name="name" type="text" placeholder="name" value="{{old('name')}}" required>
            </div>
            <div class="form-group col-md-2">
                <label for="stock">ストック</label>
                <input class="form-control is-valid" id="stock" name="stock" type="number" min="0" max="999" placeholder="0-999" value="{{old('stock')}}" aria-describedby="stockHelpBlock" required>
                <small id="stockHelpBlock" class="form-text text-muted">
                    0-999
                </small>
            </div>
            <div class="form-group">
                <div class="col-md-2">
                    <label for="dateopen">開封日</label>
                    <input  class="form-control is-valid" id="dateopen" name="dateopen" type="date" placeholder="dateopen" value="{{old('dateopen')}}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-2">
                <i class="fas fa-plus-circle"></i>新規追加
            </button>
            <a class="btn btn-secondary col-2" href="/">
                <i class="fas fa-window-close"></i>キャンセル
            </a>
        </fieldset>
    </form>
</div>
@endsection
