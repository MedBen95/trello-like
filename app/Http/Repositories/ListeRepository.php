<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 23/07/2018
 * Time: 11:21
 */

namespace App\Http\Repositories;


use App\Liste;
use App;

class ListeRepository
{
    protected $liste;

    /**
     * ListeRepository constructor.
     * @param $liste
     */
    public function __construct(Liste $liste)
    {
        $this->liste = $liste;
    }

    public function create($inputs)
    {

        $this->liste->board_id = $inputs['board_id'];
        $this->liste->list_position = $inputs['list_position'];
        $liste = $this->liste->create($inputs);
        return $liste;

    }

    public function updatepos($inputs)
    {

        $id_liste = $inputs['id_liste'];
        $initial_position = $inputs['initial_position'];
        $changed_position = $inputs['dragged_position'];
        $id_board = $inputs['id_board'];
        $listesasc = collect();
        $listesdesc = collect();

        if ($initial_position > $changed_position) {

            for ($i = $changed_position; $i < $initial_position; $i++) {

                $item = App\Liste::where('board_id', $id_board)->where('list_position', $i)->first();
                $listesasc->push($item);
            }

            foreach ($listesasc as $liste) {
                $liste->list_position = $liste->list_position + 1;
                $liste->save();
            }

            $dragged_liste = $this->liste->find($id_liste);
            $dragged_liste->list_position = $changed_position;
            $dragged_liste->save();

        } elseif ($initial_position <$changed_position) {

            for ($j = $initial_position+1; $j <=$changed_position; $j++) {

                $item = App\Liste::where('board_id', $id_board)->where('list_position', $j)->first();
                $listesdesc->push($item);
            }


             foreach ($listesdesc as $liste){
                $liste->list_position=$liste->list_position-1;
                $liste->save();
             }

            $dragged_liste=$this->liste->find($id_liste);
            $dragged_liste->list_position=$changed_position;
            $dragged_liste->save();
        }



    }


}