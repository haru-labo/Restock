@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
<!-- modal start createNewItemForm -->
    <from action="/additem" method="POST">
        {{ csrf_field() }}

    </from>
<!-- modal end createNewItemForm -->
    <a class="button-secondary pure-button" href="#"><i class="fas fa-plus-circle"></i>追加</a>
    <form class="pure-form" action="/catserch">
        {{ csrf_field() }}
        <input type="text" class="pure-input-rounded">
        <button type="submit" class="pure-button">CategorySearch</button>
    </form>
<!-- itemList -->
    <table class="pure-table">
        <tr>
            <th>カテゴリー</th>
            <th>品名</th>
            <th>ストック</th>
            <th>開封日</th>
            <th>消費量（/日）</th>
            <th>編集／削除</th>
        </tr>
        @foreach ($items as $item)
        @if ($loop->iteration % 2 == 0)
        <tr>
        @else
        <tr class="pure-table-odd">
        @endif
            <td>{{$item->category}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->stock}}</td>
            <td>{{$item->dateopen}}</td>
            <td></td>
            <td>
                <button class="button-warning pure-button">編集</button>
                <button class="button-error pure-button">
                    <i class="fa fa-trash"></i>削除
                </button>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
