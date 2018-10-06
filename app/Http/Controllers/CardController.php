<?php

namespace App\Http\Controllers;

use App\Card;
use App\Http\Repositories\CardRepository;
use Illuminate\Http\Request;
use App\Liste;
use App;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $cardRepository;

    /**
     * CardController constructor.
     * @param $cardRepository
     */
    public function __construct(CardRepository $cardRepository)
    {
        $this->middleware('auth');
        $this->cardRepository = $cardRepository;
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
        $inputs = array_merge($request->all(),['liste_id'=>$request['idliste']]);
        $card=$this->cardRepository->createCard($inputs);
        return \Response::json($card);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $this->cardRepository->editCard($card,$request['description']);
        return \Response::json($card);
    }

    public function updateposition(Request $request)
    {
        $this->cardRepository->updatepos($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }

    public function addMemberToCard(Request $request,Card $card)
    {
        $inputs = array_merge($request->all());
        $this->cardRepository->addMember($inputs,$card);

    }

    public function addLabelToCard(Request $request,Card $card)
    {
        $inputs = array_merge($request->all());
        $this->cardRepository->addLabel($inputs,$card);


    }


}
