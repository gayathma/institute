<?php

namespace Modules\Subjects\Repositories\Eloquent;

use Modules\Subjects\Contracts\SubjectsRepositoryContract;
use Rinvex\Repository\Repositories\EloquentRepository;
use Illuminate\Contracts\Container\Container;
use DB;


class SubjectsRepository extends EloquentRepository implements SubjectsRepositoryContract
{

    protected $skipPresenter = true;

    private $fillable = ['name', 'code'];

    // Instantiate repository object with required data
    public function __construct(Container $container)
    {
        $this->setContainer($container)
             ->setModel(\Modules\Subjects\Entities\Eloquent\Subject::class)
             ->setRepositoryId('rinvex.repository.uniqueid');

    }

    public function create(array $attributes = array())
    {
        DB::beginTransaction();

        try{
            $credit_card_type = 0;
            if($attributes['pay_credit_card_type_id'] != ''){
                $credit_card_type = $attributes['pay_credit_card_type_id'];
            }

            if($attributes['agent_com'] == ''){
                $attributes['agent_com'] = 0.0;
            }

            if($attributes['principal_com'] == ''){
                $attributes['principal_com'] = 0.0;
            }

            $passengers = $attributes['passengers'];

            /**
             * Remove Last hidden passenger row
             **/
            unset($attributes['passengers'][key(array_slice($attributes['passengers'], -1, 1, true))]);

            /** 
            * If there are more than one tickets entered , ticket will be saved as a 'Group' ticket
            * Therefore create a group with type as 'Ticket'
            **/
            $group_id = null;
            if(count($attributes['passengers']) > 1){
                $group = Group::create([
                        'type' => 'ticket'
                    ]);
                if(!is_null($group)){
                    $group_id = $group->id;
                }
            }

            foreach ($attributes['passengers'] as $key => $passenger) {

                $ticket = Ticket::create(array_only(array_merge($attributes, [
                    'created_by' => Auth::user()->id,
                    'amount_difference' => $attributes['total_paid_amount'] - $attributes['grand_total_amount'],
                    'pay_credit_card_type_id' => $credit_card_type,
                    'group_id' => $group_id
                ]), $this->fillable));


                $stock = $this->findTicketNoRange(trim($passenger['ticket_no']));
                if(!is_null($stock)){
                    $passenger['pax_stock_id'] = $stock->id;
                }else{
                    $passenger['pax_stock_id'] = null;
                }

                $pscount = count($passengers);
                $new_passenger = array();
                $new_passenger[] = $passenger;
                //set last hidden row again in order to satisfy the table cloning library
                $new_passenger[] = $passengers[$pscount-1];

                $table = PassengerTable::create($ticket, 'passengers', 'div');
                $table->saveData($new_passenger);

                $this->saveTabularData($ticket, $attributes); 
            }
            

            DB::commit();
          }catch(\Exception $e){
              DB::rollback();
          }
    }


    private function saveTabularData($ticket, array $attributes)
    {
        
        $table = ItineraryTable::create($ticket, 'itineraries', 'div');
        $table->saveData($attributes['itineraries']);

        $table = TaxTable::create($ticket, 'taxes', 'div');
        $table->saveData($attributes['taxes']);

        return true;
    }

    public function update($id, array $attributes = array())
    {
         DB::beginTransaction();

         try{
            $ticket = Ticket::find($id);
            $credit_card_type = 0;
            if($attributes['pay_credit_card_type_id'] != ''){
                $credit_card_type = $attributes['pay_credit_card_type_id'];
            }

            if($attributes['agent_com'] == ''){
                $attributes['agent_com'] = 0.0;
            }

            if($attributes['principal_com'] == ''){
                $attributes['principal_com'] = 0.0;
            }

            $ticket = parent::update($id, array_only(array_merge($attributes, [
                    'edited_by' => Auth::user()->id,
                    'amount_difference' => $attributes['total_paid_amount'] - $attributes['grand_total_amount'],
                    'pay_credit_card_type_id' => $credit_card_type
                ]), $this->fillable));
            list($status, $instance) = $ticket;

            $passengers = $attributes['passengers'];
            if(!is_null($passengers)){
                foreach ($passengers as $key => $passenger) {
                    $stock = $this->findTicketNoRange(trim($passenger['ticket_no']));
                    if(!is_null($stock)){
                        $passenger['pax_stock_id'] = $stock->id;
                    }else{
                        $passenger['pax_stock_id'] = null;
                    }
                    $passengers[$key] = $passenger;
                }
            }

            $table = PassengerTable::create($ticket, 'passengers', 'div');
            $table->saveData($passengers);

            $this->saveTabularData($instance, $attributes);
            DB::commit();
             return true;
         }catch(\Exception $e){
             DB::rollback();
         }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try{
            $ticket = Ticket::find($id);
            $ticket->cdnote()->delete();
            $ticket->invoice()->delete();
            $ticket->itineraries()->delete();
            $ticket->passengers()->delete();
            $ticket->refund()->delete();
            $ticket->refundcdnote()->delete();
            $ticket->taxes()->delete();
            $ticket->delete();


            DB::commit();
            return $ticket;
        }catch(\Exception $e){
            DB::rollback();
        }     
    }
    
}