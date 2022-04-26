<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $periodic = 0 ; 
        if($request->input('periodic')){
            $periodic = 1;
        };
        Event::create([
            'name'=>$request->input("name"),
            'description'=>$request->input("description"),
            'date'=>$request->input("date"),
            'periodic'=>$periodic,
        ]);

        $events=Event::orderBy('created_at' , 'desc')->get();

        return redirect( route("welcome", compact('events')));
    }

   /*  public function search(Request $request){
        
        $q = $request->input('q');
        $start = $request->input('start');
        $end = $request->input('end');
        if((!is_null($q)) && (is_null($start) || is_null($end))){
            $events = Event::where('name','LIKE','%'.$q.'%')->orderBy('created_at' , 'desc')->get();
        } elseif((is_null($q)) && (!is_null($start) && !is_null($end))){
            $events = Event::whereBetween('date', [$start , $end])->orderBy('created_at' , 'desc')->get();
        }
        else {
            $events = Event::where('name','LIKE','%'.$q.'%')->orWhereBetween('date', [$start , $end])->orderBy('created_at' , 'desc')->get();
        }
        

        return view ('welcome' , compact('events'))->with('message');
        }
    } */
    public function search(Request $request){
        
        $q = $request->name;
        $start = $request->start;
        $end = $request->end;
        if((!is_null($q)) && (is_null($start) || is_null($end))){
            $events = Event::where('name','LIKE','%'.$q.'%')->orderBy('created_at' , 'desc')->get();
        } elseif((is_null($q)) && (!is_null($start) && !is_null($end))){
            $events = Event::whereBetween('date', [$start , $end])->orderBy('created_at' , 'desc')->get();
            foreach ($events as $event){
                if($event->periodic == 1){
                    $event = Event::whereRaw('DATE_FORMAT(date , \'%m-%d\') BETWEEN DATE_FORMAT( \'' .$start. '\', \'%m-%d\') AND DATE_FORMAT( \'' .$end. '\'  , \'%m-%d\')')->orderBy('created_at' , 'desc')->get();
                }
            }
            /* $events[] = DB::table('events')
                           ->select('*') */
                           /* ->whereRaw('DATE_FORMAT(date , \'%m-%d\') BETWEEN DATE_FORMAT(\'' .$start. '\' , \'%m-%d\') AND DATE_FORMAT(\'' .$end. '\' , \'%m-%d\')') */
                  /*          ->whereRaw('DATE_FORMAT(date , \'%m-%d\') BETWEEN DATE_FORMAT( "2023-07-11" , \'%m-%d\') AND DATE_FORMAT( "2023-07-30" , \'%m-%d\')')
                           ->where('periodic' , 1)
                           ->orderBy('created_at' , 'desc')->get(); */
        } 
        else {
            $events = Event::where('name','LIKE','%'.$q.'%')->orWhereBetween('date', [$start , $end])->orderBy('created_at' , 'desc')->get();
        }
        /* return view ('welcome' , compact('events'))->with('message'); */

        return response()->json($events);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}