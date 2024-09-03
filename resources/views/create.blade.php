
@extends('layout')

@section('main_content')
<!-- テーブル -->
<form action="{{ route('store') }}" method="POST">
@csrf
    <ul class="change_ul">
        <li class="label">タイトル</li>
        <li><input type="text" name="title"></li>
        <li class="label">開始日時</li>
        <li>
            <input type="date" id="start-date" name="start_date" value="{{ \Carbon\Carbon::today()->toDateString() }}">
            <input type="time" id="start-time" name="start_time">
            終日
            <input type="checkbox" id="all-day" name="all_day">
        </li>
        <li class="label" id="end-label">終了日時</li>
        <li>
            <input type="date" id="end-date" name="end_date">
            <input type="time" id="end-time" name="end_time">
        </li>
        <li class="label">詳細</li>
        <li>
            <textarea name="description" id="description" cols="50" rows="10"></textarea>
        </li>
        <li class="label">場所</li>
        <li><input type="text" name="place"></li>
        <!-- <li class="label">ステータス</li>
        <li>
            <select name="status" id="">
                <option value="予定">予定</option>
                <option value="完了">完了</option>
                <option value="未完了">未完了</option>
            </select>
        </li> -->
        <li class="label">カテゴリ</li>
        <li>
            <input type="text" name="categories">
        </li>
        <li class="label">ステータス</li>
        <li>
            <select name="priority" id="priority">
            　　<option value=""></option>
                <option value="高">高</option>
                <option value="中">中</option>
                <option value="低">低</option>
            </select>
        </li>
        <li>
            <button type="submit">登録</button>
        </li>
    </ul>
</form>
@endsection