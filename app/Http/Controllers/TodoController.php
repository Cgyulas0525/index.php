<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Repositories\TodoRepository;
use Auth;
use DataTables;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Response;

class TodoController extends AppBaseController
{
    /** @var  TodoRepository */
    private $todoRepository;

    public function __construct(TodoRepository $todoRepo)
    {
        $this->todoRepository = $todoRepo;
    }

    /**
     * Display a listing of the Todo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      if( Auth::check() ){

        if ($request->ajax()) {

          $data = DB::table('todo')
                      ->join('users as p1', 'p1.id', 'todo.user')
                      ->select('todo.*', 'p1.name as nev')
                      ->whereNull('todo.deleted_at')
                      ->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route('todos.edit', [$row->id]) . '"
                               class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                    $btn = $btn.'<a href="' . route('TodoTorles', [$row->id]) . '"
                               class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                    $btn = $btn.'<a href="' . route('UpdateVege', [$row->id]) . '"
                               class="btn btn-warning btn-sm updateVege" title="Vége" id = "vege"><i class="glyphicon glyphicon-pencil"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('todos.index');

       }
       return view('auth.login');
    }

    /**
     * Show the form for creating a new Todo.
     *
     * @return Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created Todo in storage.
     *
     * @param CreateTodoRequest $request
     *
     * @return Response
     */
    public function store(CreateTodoRequest $request)
    {
        $input = $request->all();

        $todo = $this->todoRepository->create($input);
        return redirect(route('todos.create'));
    }

    /**
     * Display the specified Todo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $todo = $this->todoRepository->find($id);

        if (empty($todo)) {
            return redirect(route('todos.index'));
        }
        return view('todos.show')->with('todo', $todo);
    }

    /**
     * Show the form for editing the specified Todo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $todo = $this->todoRepository->find($id);

        if (empty($todo)) {
            return redirect(route('todos.index'));
        }

        return view('todos.edit')->with('todo', $todo);
    }

    /**
     * Update the specified Todo in storage.
     *
     * @param int $id
     * @param UpdateTodoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTodoRequest $request)
    {
        $todo = $this->todoRepository->find($id);

        if (empty($todo)) {
            return redirect(route('todos.index'));
        }

        $todo = $this->todoRepository->update($request->all(), $id);
        return redirect(route('todos.index'));
    }

    /**
     * Remove the specified Todo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $todo = $this->todoRepository->find($id);

        if (empty($todo)) {
            return redirect(route('todos.index'));
        }

        $this->todoRepository->delete($id);
        return redirect(route('todos.index'));
    }

    public function destroyMe($id)
    {
        $todos = $this->todoRepository->find($id);

        if (empty($todos)) {
            return redirect(route('todos.index'));
        }

        $this->todoRepository->delete($id);
        return redirect(route('todos.index'));
    }

    public function updateVege($id)
    {

        $vege = new DateTime();
        DB::table('todo')
            ->where('todo.id', '=', $id)
            ->update([
                'vege' => $vege
            ]);
        return redirect(route('todos.index'));
    }

}
