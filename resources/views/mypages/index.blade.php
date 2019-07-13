@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
    <a class="button-secondary pure-button" href="/item/create">
        <i class="fas fa-plus-circle"></i>追加
    </a>
    <form class="pure-form" action="/" method="GET">
        @csrf
        <input type="text" name="input" value="{{$input}}" class="pure-input-rounded">
        <button type="submit" class="pure-button">
            <i class="fas fa-search"></i>カテゴリー検索
        </button>
    </form>
<!-- itemList -->
    <table class="pure-table">
        <thead>
            <tr>
                <th>カテゴリー</th>
                <th>品名</th>
                <th>ストック</th>
                <th>開封日</th>
                <th>消費ペース</th>
                <th>編集／削除</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($items as $item)
            @if ($loop->iteration % 2 == 0)
            <tr>
            @else
            <tr class="pure-table-odd">
            @endif
                <td>{{$item->category}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->stock}}</td>
                <td>{{$item->dateopen->format('Y/m/d')}}</td>
                <td>{{$item->getDayPerStock()}}日</td>
                <td>
                    <form action="/item/{{ $item->id }}/edit" method="GET">
                        @csrf
                        <button type="submit" class="button-warning pure-button">
                            <i class="fas fa-edit"></i>編集
                        </button>
                    </form>
                    <form action="/item/{{ $item->id }}/delete" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button-error pure-button">
                            <i class="fa fa-trash"></i>削除
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
