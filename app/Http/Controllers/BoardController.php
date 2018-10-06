<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Repositories\BoardRepository;
use App\Http\Requests\BoardRequest;
use App\Liste;
use App\Events\StatusLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Pusher\Laravel\Facades\Pusher;

class BoardController extends Controller
{
    /**
     * BoardController constructor.
     */
    protected $boardRepository;

    public function __construct(BoardRepository $boardRepository)
    {
        $this->middleware('auth');
        $this->boardRepository=$boardRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $boards=$this->boardRepository->getAll($request->user()->id);
        return view('dashboard',["boards"=>$boards]);
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
    public function store(Request $request,Board $board)
    {
        $inputs = array_merge($request->all(), ['user_id' =>$request->user()->id]);
        $this->boardRepository->createBoard($inputs);
        return redirect()->route('board.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        $listes=$board->listes()->orderBy('list_position','asc')->get();
        $array=array('listes'=>$listes,'board'=>$board,'members'=>$board->users);
        return view('listes', compact('array'));
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
    public function destroy(Board $board)
    {
        $this->boardRepository->destroy($board);
        return redirect()->route('board.index');
    }
}
