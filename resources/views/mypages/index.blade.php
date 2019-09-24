@extends('layouts.mypage')

@section('title', 'DailyUseItems')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col">
            <a class="btn btn-outline-primary" href="/item/create">
                <i class="fas fa-plus-circle"></i>新規追加
            </a>
        </div>
        <div class="col">
            <form action="/" method="GET" class="input-group">
                @csrf
                <input type="text" name="searchWord" value="{{$searchWord}}" class="form-control" placeholder="カテゴリー検索">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-search"></i>
                    </button>
                </span>
            </form>
        </div>
    </div>
<!-- itemList -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">カテゴリー</th>
                <th scope="col">品名</th>
                <th scope="col">ストック</th>
                <th scope="col">開封日</th>
                <th scope="col">開封ペース</th>
                <th scope="col">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            @if ($item->stock === "0")
                <tr class="table-danger align-items-center align-middle clickable-row" data-href="/item/{{ $item->id }}/edit">
            @elseif ($item->stock <= $item->alertstock)
                <tr class="table-warning align-items-center align-middle clickable-row" data-href="/item/{{ $item->id }}/edit">
            @else
                <tr class="align-items-center align-middle clickable-row" data-href="/item/{{ $item->id }}/edit">
            @endif
                <td class="align-middle">{{$item->category}}</td>
                <td class="align-middle">{{$item->name}}</td>
                <td class="align-middle">{{$item->stock}}</td>
                <td class="align-middle">{{$item->dateopen->format('Y/m/d')}}</td>
                <td class="align-middle">{{$item->dayperstock}}日</td>
                <td class="row align-middle mr-0">
                    <form class="col-lg-4 my-1" action="/item/{{ $item->id }}/open" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-box-open"></i>開封
                        </button>
                    </form>
                    <form class="col-lg-4 my-1" action="/item/{{ $item->id }}/restock" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-box"></i>補充
                        </button>
                    </form>
                    <form class="col-lg-4 my-1" action="/item/{{ $item->id }}/destroy" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-trash"></i>削除
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $items->links() }}
</div>
@endsection
