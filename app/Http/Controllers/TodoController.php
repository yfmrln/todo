<?php

namespace App\Http\Controllers;
use App\Models\Todos;
use Carbon\Carbon; 
use Illuminate\Http\Request;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->todo = new Todos();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->todo->findAllTodos();
        return view('index', compact('todos'));
    }

    /**
     * Display a Today's listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function today()
    {

        // 今日の日付を取得
        $today = Carbon::today()->toDateString();
        $todos = $this->todo->findTodaysTodos($today);
        return view('index', compact('todos'));
    }

    /**
     * Display a complete listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete()
    {

        // 今日の日付を取得
        $todos = $this->todo->findCompleteTodos();
        return view('index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $registerTodo = $this->todo->InsertTodo($request);
        return redirect()->route('list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function getData($id)
    {
        // データベースからIDに基づいてデータを取得
        $data = Todos::find($id);

        // データが存在するかチェック
        if ($data) {
            // データをJSON形式で返す
            return response()->json($data);
        } else {
            // データが存在しない場合のエラーレスポンス
            return response()->json(['error' => 'データが見つかりません'], 404);
        }
    }

    /**
     * Update status data.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function updateStatus(Request $request)
    {
        // リクエストからタスクIDとステータスを取得
        $id = $request->input('id');
        $status = $request->input('status');

        // タスクを取得してステータスを更新
        $todo = Todos::find($id);
        if ($todo) {
            $todo->status = $status;
            $todo->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
