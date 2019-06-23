@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
<!-- createNewItemForm -->
    <from action="/additem" method="POST">
        {{ csrf_field() }}

        <div>
            <label for="">追加</label>
        </div>
    </from>
<!-- itemList -->
    <table class="pure-table">
        <tr>
            <th>カテゴリー</th>
            <th>品名</th>
            <th>ストック</th>
            <th>開封日</th>
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
        </tr>
        @endforeach
    </table>
@endsection
