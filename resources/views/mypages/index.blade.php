@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
    <a class="button-secondary pure-button" href="#"><i class="fas fa-plus-circle"></i>追加</a>
    <form class="pure-form" action="/" method="GET">
        @csrf
        <input type="text" name="input" value="{{$input}}" class="pure-input-rounded">
        <button type="submit" class="pure-button">カテゴリー検索</button>
    </form>
<!-- itemList -->
    <table class="pure-table">
        <tr>
            <th>カテゴリー</th>
            <th>品名</th>
            <th>ストック</th>
            <th>開封日</th>
            <th>詰め替え頻度（日/個）</th>
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
                <form action="edit/{{ $item->id }}" method="POST">
                    @csrf
                    <button type="submit" class="button-warning pure-button">編集</button>
                </form>
                <form action="destroy/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button-error pure-button">
                        <i class="fa fa-trash"></i>削除
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
