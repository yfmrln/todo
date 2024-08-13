
@extends('layout')

@section('main_content')
    <div>
        @foreach($todos as $todo)
            <div class="todos" data-id="{{ $todo->id }}">
                <input type="checkbox" name="status" class="status_check" {{ $todo->status == '完了' ? 'checked' : '' }} >
                <div class="title">{{ $todo->title }}</div>
                <div class="categories">
                    @if( $todo->categories != "" )
                    <span>{{ $todo->categories }}</span>
                    @endif
                </div>
                <div class="date">
                    @if($todo->is_all_day)
                    {{ Carbon\Carbon::parse($todo->start_date)->format('Y/m/d') }} 終日
                    @elseif($todo->start_time)
                    {{ Carbon\Carbon::parse($todo->start_date)->format('Y/m/d') }} {{ Carbon\Carbon::parse($todo->start_time)->format('h:s') }}
                    @else
                    {{ Carbon\Carbon::parse($todo->start_date)->format('Y/m/d') }}
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div>
        <ul class="detail_ul">
            <li class="label">タイトル</li>
            <li><span id="title"></span></li>
            <li class="label">詳細</li>
            <li><span id="description"></span></li>
            <li class="label">開始日時</li>
            <li><span id="start-date"></span></li>
            <li class="label" id="end-date-label">終了日時</li>
            <li><span id="end-date"></span></li>
            <li class="label">場所</li>
            <li><span id="place"></span></li>
            <li class="label">カテゴリ</li>
            <li><span id="categories"></span></li>
        </ul>
    </div>

@endsection