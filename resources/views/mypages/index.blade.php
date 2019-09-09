@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
<div class="input-group mb-3">
    <div class="pure-u">
        <a class="btn btn-primary" href="/item/create">
            <i class="fas fa-plus-circle"></i>新規追加
        </a>
    </div>
    <div class="pure-u">
        <form class="pure-form" action="/" method="GET">
            @csrf
            <input type="text" name="input" value="{{$input}}" class="form-control" placeholder="カテゴリー検索">
            <button type="submit" class="btn btn-info">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>
<!-- itemList -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>カテゴリー</th>
                <th>品名</th>
                <th>ストック</th>
                <th>開封日</th>
                <th>消費ペース</th>
                <th>操作</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($items as $item)
            @if ($loop->iteration % 2 == 0)
            <tr>
            @else
            <tr class="pure-table-odd">
            @endif
                <td class="align-items-center">{{$item->category}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->stock}}</td>
                <td>{{$item->dateopen->format('Y/m/d')}}</td>
                <td>{{$item->getDayPerStock()}}日</td>
                <form class="col" action="/item/{{ $item->id }}/open" method="POST">
                    @csrf
                    <td>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-box-open"></i>開封
                         </button>
                    </td>
                </form>
                <form class="col" action="/item/{{ $item->id }}/edit" method="GET">
                    @csrf
                    <td>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-edit"></i>編集
                        </button>
                    </td>
                </form>
                <form  class="col" action="/item/{{ $item->id }}/delete" method="POST">
                    @csrf
                    <td>
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-trash"></i>削除
                        </button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
