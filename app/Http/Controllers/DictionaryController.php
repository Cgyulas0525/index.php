<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDictionaryRequest;
use App\Http\Requests\UpdateDictionaryRequest;
use App\Repositories\DictionaryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Dictionary;

class DictionaryController extends AppBaseController
{
    /** @var  DictionaryRepository */
    private $dictionaryRepository;

    public function __construct(DictionaryRepository $dictionaryRepo)
    {
        $this->dictionaryRepository = $dictionaryRepo;
    }

    /**
     * Display a listing of the Dictionary.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if( Auth::check() ){

          if ($request->ajax()) {

            $data = DB::table('dictionaries')
                          ->join('types AS p1', 'p1.id', 'dictionaries.tipus' )
                          ->select('dictionaries.*', 'p1.nev as tnev')
                          ->whereNull('dictionaries.deleted_at')
                          ->get();

              return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){

                        $btn = '<a href="' . route('dictionaries.edit', [$row->id]) . '"
                                 class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';

                         $btn = $btn.'<a href="' . route('SZT', [$row->id]) . '"
                                       class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';

                              return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('dictionaries.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new Dictionary.
     *
     * @return Response
     */
    public function create()
    {
        return view('dictionaries.create');
    }

    public function createMe($id)
    {
        return view('dictionaries.createMe')->with('id', $id);
    }


    /**
     * Store a newly created Dictionary in storage.
     *
     * @param CreateDictionaryRequest $request
     *
     * @return Response
     */
    public function store(CreateDictionaryRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $dictionary = $this->dictionaryRepository->create($input);
        return redirect(route('SzotarInsert', $input['tipus']));
    }

    /**
     * Display the specified Dictionary.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dictionary = $this->dictionaryRepository->find($id);

        if (empty($dictionary)) {
            Flash::error('Nem található tétel!');

            return redirect(route('dictionaries.index'));
        }

        return view('dictionaries.show')->with('dictionary', $dictionary);
    }

    /**
     * Show the form for editing the specified Dictionary.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dictionary = $this->dictionaryRepository->find($id);

        if (empty($dictionary)) {
            return redirect(route('dictionaries.index'));
        }

        return view('dictionaries.edit')->with('dictionary', $dictionary);
    }

    /**
     * Update the specified Dictionary in storage.
     *
     * @param int $id
     * @param UpdateDictionaryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDictionaryRequest $request)
    {
        $dictionary = $this->dictionaryRepository->find($id);

        if (empty($dictionary)) {
            return redirect(route('types.edit', $dictionary['tipus']));
        }

        $dictionary = $this->dictionaryRepository->update($request->all(), $id);
        return redirect(route('types.edit', $dictionary['tipus']));
    }

    /**
     * Remove the specified Dictionary from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dictionary = $this->dictionaryRepository->find($id);

        if (empty($dictionary)) {
            return redirect(route('dictionaries.index'));
        }

        $this->dictionaryRepository->delete($id);
        return redirect(route('dictionaries.index'));
    }

    public function destroyMe($id)
    {
      $dictionary = $this->dictionaryRepository->find($id);
      if (empty($dictionary)) {
          return redirect(route('TipusEdit', $dictionary->tipus));
      }

      $this->dictionaryRepository->delete($id);
      return redirect(route('TipusEdit', $dictionary->tipus));
    }

    public function torles($id)   // mint az edit
    {
        $dictionary = $this->dictionaryRepository->find($id);

        if (empty($dictionary)) {
            return redirect(route('types.edit', $dictionary['tipus']));
        }
        return view('dictionaries.torles')->with('dictionary', $dictionary);

    }
}
