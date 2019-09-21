@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col">
            <a class="btn btn-primary" href="/item/create">
                <i class="fas fa-plus-circle"></i>新規追加
            </a>
        </div>
        <div class="col">
            <form action="/" method="GET" class="input-group">
                @csrf
                <input type="text" name="input" value="{{$input}}" class="form-control" placeholder="カテゴリー検索">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-search"></i>
                    </button>
                </span>
            </form>
        </div>
    </div>
<!-- itemList -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">カテゴリー</th>
                <th scope="col">品名</th>
                <th scope="col">ストック</th>
                <th scope="col">開封日</th>
                <th scope="col">開封ペース</th>
                <th colspan="3" scope="colgroup">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            @if ($item->stock === "1")
                <tr class="table-warning">
            @elseif ($item->stock === "0")
                <tr class="table-danger">
            @else
                <tr>
            @endif
                <td class="align-items-center align-middle">{{$item->category}}</td>
                <td class="align-middle">{{$item->name}}</td>
                <td class="align-middle">{{$item->stock}}</td>
                <td class="align-middle">{{$item->dateopen->format('Y/m/d')}}</td>
                <td class="align-middle">{{$item->getDayPerStock()}}日</td>
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
                <form class="col" action="/item/{{ $item->id }}/destroy" method="POST">
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
</div>
@endsection
