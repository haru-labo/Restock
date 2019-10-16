@extends('layouts.mypage')

@section('title', 'Restock!')

@section('content')

<div class="container">
    <div class="row mb-2">
        <div class="col">
            <a class="btn btn-outline-primary" href="/item/create">
                <i class="fas fa-plus-circle"></i>新規追加
            </a>
        </div>
        <div class="col">
            <form action={{ route('item.index') }} method="GET" class="input-group">
                @csrf
                <input type="text" name="searchWord" value="{{$searchWord}}" class="form-control" placeholder="検索">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-search"></i>
                    </button>
                </span>
            </form>
        </div>
    </div>
<!-- itemList -->
    <div class="row">
        <div class="col table-responsive">
            <table class="table table-hover text-nowrap">
                <thead></thead>
                <tbody>
                @foreach ($items as $item)
                @if ($item->stock === "0")
                    <tr class="table-danger align-items-center align-middle clickable-row" data-href={{ route('item.edit', ['id' => $item->id]) }}>
                @elseif ($item->stock <= $item->alertstock)
                    <tr class="table-warning align-items-center align-middle clickable-row" data-href={{ route('item.edit', ['id' => $item->id]) }}>
                @else
                    <tr class="align-items-center align-middle clickable-row" data-href={{ route('item.edit', ['id' => $item->id]) }}>
                @endif
                        <td class="align-middle text-wrap" aria-describedby="category" style="width: 16rem;">
                            <small id="category" class="form-text text-muted" style="width: 12rem;">
                                {{$item->category}}
                            </small>
                        {{$item->name}}
                        </td>
                        <td class="align-middle text-center" aria-describedby="stock">
                            <small id="stock" class="form-text text-muted">
                                ストック
                            </small>
                            {{$item->stock}}
                        </td>
                        <td class="align-middle text-center" aria-describedby="remainingDays">
                            <small id="remainingDays" class="form-text text-muted">
                                次回開封まで残り
                            </small>
                            {{$item->remainingdays}}日
                        </td>
                        <td class="align-middle text-center" aria-describedby="dayPerStock">
                            <small id="dayPerStock" class="form-text text-muted">
                                消費ペース
                            </small>
                            {{$item->dayperstock}}日&#047;ストック
                        </td>
                        <td class="align-middle">
                            <div class="d-flex flex-column flex-lg-row justify-content-around">
                                <form class="my-1 text-center" action={{ route('item.open', ['id' => $item->id]) }} method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-box-open"></i>開封
                                    </button>
                                </form>
                                <form class="my-1 text-center" action={{ route('item.restock', ['id' => $item->id]) }} method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-box"></i>補充
                                    </button>
                                </form>
                                <form class="my-1 text-center" action={{ route('item.destroy', ['id' => $item->id]) }} method="POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-trash"></i>削除
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
