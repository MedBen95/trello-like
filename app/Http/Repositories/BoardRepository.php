<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 18/07/2018
 * Time: 09:37
 */

namespace App\Http\Repositories;


use App\Board;
use App\User;
use App;

class BoardRepository
{
    protected $board;

    /**
     * BoardRepository constructor.
     * @param $board
     */
    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function createBoard($inputs)
    {
        /* Create a new board and attach the id of this board to the pivot table */
        $user = App\User::find($inputs['user_id']);
        $board=$this->board->create($inputs);

        /* Create default lists when the board is created */
        $data = array(
            array('titre'=>'To do', 'board_id'=>$board->id_board,'list_position'=>0),
            array('titre'=>'In progress', 'board_id'=>$board->id_board,'list_position'=>1),
            array('titre'=>'Done', 'board_id'=>$board->id_board,'list_position'=>2)
        );
        App\Liste::insert($data);
        $user->boards()->attach($board->id_board,['role'=>'owner']);

    }

    public function getAll($id)
    {
        $boards=App\User::find($id)->boards;
        return $boards;
    }

    public function destroy(Board $board){

        $board->users()->detach();
        $board->delete();

    }

    public function getLists(Board $board){

        $listes=$board->listes;
        return $listes;
    }





}