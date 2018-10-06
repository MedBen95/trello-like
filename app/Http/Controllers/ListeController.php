<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Repositories\ListeRepository;
use App\Liste;
use Illuminate\Http\Request;

class ListeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $listeRepository;

    /**
     * ListeController constructor.
     * @param $listeRepository
     */
    public function __construct(ListeRepository $listeRepository)
    {
        $this->listeRepository = $listeRepository;
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    public function store2(Request $request,$id)
    {
        $inputs = array_merge($request->all(),['board_id' =>$id]);
        $liste=$this->listeRepository->create($inputs);
        $output= '<div class="card card-style myList dynamiclists" style="background-color:#e2e4e6">
                            <input type="hidden" class="listids" value=' .$liste->id_liste.'>
                            <div class="content flex" style="padding-left: 4px;padding-right: 4px;">
                           <h5 class="text-center title-list" style="overflow-wrap: break-word;white-space: initial;">'.$liste->titre.'</h5>
                                <div class="card-body">
                                        <input type="hidden" class="listids" value='.$liste->id_liste.'>
                                        
                                         
                                        <div class="listcards pre-scrollable " style="padding-top: 20px">
                                        <div class=\'card form-card\' style=\'padding-top: 5px;padding-bottom: 20px;padding-left: 10px;padding-right: 10px;height:140px;display:none\'>
                                        <div class=\'card-body\'>
                                            <form >
                                                <textarea class="form-control cards-input" placeholder="Entrez une carte" style="height: 80px;" /></textarea>
                                                <div class="listinputs" style="margin-top: 9px;">
                                                 <button  class=\'btn btn-fill addCardButton\' style=\'background:#32CD32;border-radius:0px;float: left\'>Ajouter carte</button>
                                                <button type=\'button\' class=\'closeCard close\' aria-label=\'Close\' style="padding-right: 8px;padding-left: 8px;margin-left: 0px;padding-bottom: 10px;display: inline-block" ><span aria-hidden=\'true\'>&times;</span></button>
                                            </div>
                                            </form>                                            
                                        </div>
                                    </div>
                                        </div>
                                        <a class="addCard" href="#"><i class="ti-plus"></i> Ajouter une carte</a>

                              </div>
                            </div>
                        </div>';
        echo $output;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function show(Liste $liste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function edit(Liste $liste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liste $liste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liste $liste)
    {
        //
    }

    public function updatePosition(Request $request,Board $board){

        $inputs = array_merge($request->all(),['id_board' =>$board->id_board]);
        $this->listeRepository->updatepos($inputs);

    }


}
