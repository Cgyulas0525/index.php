<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Szamla;
use App\Repositories\PartnerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Partner;
use App\Classes\ZarasClass;
use App\Classes\Koltseg;

class PartnerController extends AppBaseController
{
    /** @var  PartnerRepository */
    private $partnerRepository;

    public function __construct(PartnerRepository $partnerRepo)
    {
        $this->partnerRepository = $partnerRepo;
    }

    private function dataView($data) {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('partners.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('partners.destroy', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function mindenAdat()
    {
        return DB::table('partner')
                 ->join('dictionaries', 'dictionaries.id', '=', 'partner.tipus')
                 ->join('telepules', 'telepules.id', '=', 'partner.telepules')
                 ->select('partner.*', 'dictionaries.nev as tipusnev', DB::raw('Concat(partner.isz, " ", telepules.telepules, " ", partner.cim) as partnercim'))
                 ->whereNull('partner.deleted_at')
                 ->get();
    }


    /**
     * Display a listing of the Partner.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                return $this->dataView($this->mindenAdat());
            }

            return view('partners.index');

        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new Partner.
     *
     * @return Response
     */
    public function create()
    {
        return view('partners.create');
    }

    /**
     * Store a newly created Partner in storage.
     *
     * @param CreatePartnerRequest $request
     *
     * @return Response
     */
    public function store(CreatePartnerRequest $request)
    {
        $input = $request->all();

        $partner = $this->partnerRepository->create($input);
        return redirect(route('partners.create'));
    }

    /**
     * Display the specified Partner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            return redirect(route('partners.index'));
        }

        return view('partners.show')->with('partner', $partner);
    }

    /**
     * Show the form for editing the specified Partner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            return redirect(route('partners.index'));
        }

        return view('partners.edit')->with('partner', $partner);
    }

    /**
     * Update the specified Partner in storage.
     *
     * @param int $id
     * @param UpdatePartnerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePartnerRequest $request)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            return redirect(route('partners.index'));
        }

        $partner = $this->partnerRepository->update($request->all(), $id);
        return redirect(route('partners.index'));
    }

    /**
     * Remove the specified Partner from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            return redirect(route('partners.index'));
        }

        $this->partnerRepository->delete($id);
        return redirect(route('partners.index'));
    }

    public function destroyMe($id)
    {
        $partner = $this->partnerRepository->find($id);

        if (empty($partner)) {
            return redirect(route('partners.index'));
        }

        $this->partnerRepository->delete($id);
        return redirect(route('partners.index'));
    }

    public function PartnerOssz(Request $request)
    {
      if( Auth::check() ){

        if ($request->ajax()) {

            $data = DB::table('szamla')
                      ->join('partner', 'partner.id', '=', 'szamla.partner')
                      ->select('partner.nev', DB::raw(' sum(szamla.osszeg) as ossz'))
                      ->groupBy('partner.nev')
                      ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('home');

       }
       return view('auth.login');
    }

    public function HBK(Request $request)
    {
      if( Auth::check() ){


        if ($request->ajax()) {

            $kezdo = date('Y-m-d', strtotime('first day of january this year'));
            $veg   = date('Y-m-d', strtotime('last day of december this year'));

            $data = Koltseg::hetiBevetelKiadas($kezdo, $veg);

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('home');

       }
       return view('auth.login');
    }

    public function HaviBK(Request $request)
    {
        if( Auth::check() ){


            if ($request->ajax()) {

                $kezdo = date('Y-m-d', strtotime('first day of january this year'));
                $veg   = date('Y-m-d', strtotime('last day of december this year'));

                $data = Koltseg::haviBevetelKiadas($kezdo, $veg);

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('home');

        }
        return view('auth.login');
    }

}
