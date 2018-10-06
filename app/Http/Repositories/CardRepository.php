<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 07/08/2018
 * Time: 15:57
 */

namespace App\Http\Repositories;


use App\Card;
use App;
use phpDocumentor\Reflection\Types\Null_;

class CardRepository
{
     protected $card;

    /**
     * CardRepository constructor.
     * @param $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function createCard($array)
    {
        $card=$this->card->create($array);
        return $card;


    }

    public function editCard(Card $card,$input)
    {
        $card->description=$input;
        $card->save();


    }

    public function updatepos($inputs)
    {
        $initiallisteid=$inputs['id_liste_initial'];
        $draggedlisteid=$inputs['id_liste_dragged'];
        $id_card=$inputs['card_id'];
        $lastposition=$inputs['last_position'];

        $card_id_dragged=$inputs['card_id_dragged'];

        $initialcardposition=$inputs['card_initial_position'];
        $draggedcardposition=$inputs['card_dragged_position'];
        $finalposition=$inputs['finalposition'];

        $cardssasc = collect();
        $cardsdesc = collect();



        if($initiallisteid==$draggedlisteid)
        {
            if($initialcardposition > $draggedcardposition)
            {
                for ($i = $draggedcardposition ;$i < $initialcardposition; $i++)
                {

                    $item = App\Card::where('liste_id', $initiallisteid)->where('card_position', $i)->first();
                    $cardssasc->push($item);
                }

                foreach ($cardssasc as $card)
                {
                    $card->card_position = $card->card_position + 1;
                    $card->save();
                }

                $dragged_card = $this->card->find($id_card);
                $dragged_card->card_position = $draggedcardposition;
                $dragged_card->save();


            }

            elseif ($initialcardposition < $draggedcardposition)
            {

                for ($j = $initialcardposition+1; $j <=$draggedcardposition; $j++) {

                    $item = App\Card::where('liste_id', $initiallisteid)->where('card_position', $j)->first();
                    $cardsdesc->push($item);
                }

                    foreach ($cardsdesc as $card){
                        $card->card_position=$card->card_position-1;
                        $card->save();
                    }



                $dragged_card=$this->card->find($id_card);
                $dragged_card->card_position=$draggedcardposition;
                $dragged_card->save();

            }
        }

        else{

            for ($l = $initialcardposition+1; $l <=$finalposition; $l++) {

                $item = App\Card::where('liste_id', $initiallisteid)->where('card_position', $l)->first();
                $cardssasc->push($item);
            }

            foreach ($cardssasc as $card){
                $card->card_position=$card->card_position-1;
                $card->save();
            }

            
            for ($k = $draggedcardposition; $k <$lastposition; $k++) {

                $item = App\Card::where('liste_id', $draggedlisteid)->where('card_position', $k)->first();
                $cardsdesc->push($item);
            }

            //echo $cardsdesc;



            foreach ($cardsdesc as $card){
                $card->card_position=$card->card_position+1;
                $card->save();
            }

             $initialcard=$this->card->find($id_card);
             $initialcard->liste_id=$draggedlisteid;
             $initialcard->card_position=$draggedcardposition;
             $initialcard->save();



        }



    }

    public function addMember($inputs,$card)
    {
        $card->users()->attach($inputs['user_id']);

    }

    public function addLabel($inputs,$card)
    {
        $card->labels()->attach($inputs['label_id']);

    }





}