<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    use HasFactory;

    // モデルに関連付けるテーブル
    protected $table = 'todos';

    // テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'categories',
        'title',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'place',
        'description',
        'status',
        'is_all_day',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    /**
     * 一覧画面表示用にtodoテーブルから全てのデータを取得
     */
    public function findAllTodos()
    {
        return Todos::where('status', '予定')->get();
    }

    /**
     * 今日の一覧画面表示用にtodoテーブルから今日のデータを取得
     */
    public function findTodaysTodos($today)
    {
        return Todos::whereDate('start_date', $today)->get();
    }

    /**
     * 完了画面表示用にtodoテーブルから今日のデータを取得
     */
    public function findCompleteTodos()
    {
        return Todos::where('status', '完了')->get();
    }

    /**
     * データの登録
     */
    public function InsertTodo($request)
    {
        return $this->create([
            'categories'  => $request->categories,
            'title'       => $request->title,
            'is_all_day'  => $request->has('all_day')? 1 : 0,
            'start_date'  => $request->start_date,
            'start_time'  => $request->has('all_day') ? null : $request->start_time,
            'end_date'    => $request->has('all_day') ? null : $request->end_date,
            'end_time'    => $request->has('all_day') ? null : $request->end_time,
            'place'       => $request->place,
            'description' => $request->description,
            'status'      => "予定",
            'user_id'     => 1,
        ]);
    }

}
