@extends('layouts.mypage')
@section('title', 'Restock!')
@section('content')
<div class="container">
    <form action={{ route('item.store') }} method="POST">
        @csrf
        <legend class="shadow-sm p-2 mb-2 bg-white rounded">新規追加</legend>
        <fieldset>
            <div class="form-group col-lg-8 col-xl-6">
                <label for="category">カテゴリー</label>
                <input class="form-control is-valid" id="category" name="category" type="text" placeholder="category" value="{{old('category')}}" aria-describedby="categoryHelpBlock" required>
                <small id="categoryHelpBlock" class="form-text text-muted">
                    36文字以内
                </small>
            </div>
            <div class="form-group col-lg-10 col-xl-8">
                <label for="name">品名</label>
                <input class="form-control is-valid" id="name" name="name" type="text" placeholder="name" value="{{old('name')}}" aria-describedby="nameHelpBlock" required>
                <small id="nameHelpBlock" class="form-text text-muted">
                    48文字以内
                </small>
            </div>
            <div class="form-group col-md-2">
                <label for="stock">ストック</label>
                <input class="form-control is-valid" id="stock" name="stock" type="number" min="0" max="999" placeholder="0-999" value="{{old('stock')}}" aria-describedby="stockHelpBlock" required>
                <small id="stockHelpBlock" class="form-text text-muted">
                    0-999
                </small>
            </div>
            <div class="form-group">
                <div class="col-md-4 col-lg-3">
                    <label for="dateopen">開封日</label>
                <input  class="form-control is-valid" id="dateopen" name="dateopen" type="date" placeholder="dateopen" value="{{old('dateopen')}}" value="{{old('dateopen')}}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3 col-xl-2">
                    <label for="alertstock">お知らせストック数</label>
                    <input class="form-control is-valid" id="alertstock" name="alertstock" type="number" min="0" max="999" placeholder="0-999" value="{{old('alertstock')}}"　aria-describedby="alertstockHelpBlock" required>
                    <small id="alertstockHelpBlock" class="form-text text-muted">
                        ストック数がこの数値以下になると黄色で表示
                    </small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary col-md-4 mb-1">
                <i class="fas fa-plus-circle"></i>新規追加
            </button>
            <a class="btn btn-secondary col-md-4 mb-1" href={{ route('item.index') }}>
                <i class="fas fa-window-close"></i>キャンセル
            </a>
        </fieldset>
    </form>
</div>
@endsection
