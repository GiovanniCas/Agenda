<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Agenda</title>
    
</head>
<body>
    
    <div class="container-fluid">
        <div class="row d-flex ">
            <div  class="col-12 col-md-6 col-lg-4 col-xl-3 ">
                <div class="col-12 d-flex flex-direction-column">
                    <div class="box shadow-2-strong" style="border-radius: 1rem; height:500px">
                        <div class="card-body p-5 text-center">
                            <form method="POST" action="{{route("store")}}">
                                @csrf
                                <h3>Evento</h3>
                                
                                <div class="mb-3 my-5">
                                    <label for="eventName" class="form-label">Nome Evento</label>
                                    <input type="text" class="form-control" aria-describedby="emailHelp" name="name" value="{{old("product")}}">
                                </div>
                                <div >
                                    <label for="description" class="form-label">Descrizione</label>
                                    <textarea type="text" name="description"cols="55" rows="3" class="form-control" value="{{old("description")}}"></textarea> <br>
                                </div>
                                <div class="form-group">
                                    <label class="active" for="expireDate">Data Evento</label>
                                    <input type="date" id="expireDate" name="date">
                                    <label for="eventPeriodic" class="form-label mt-3">Vuoi ripetere l'evento ogni anno?</label>
                                    <input type="checkbox"  name="periodic">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Aggiungi</button>
                            </form>   
                        </div>
                    </div>
                </div> 
                <div class="row mt-5">
                   
                        <div class="form-events-filter">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Cerca Per Nome
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="q"
                                                    placeholder="Search users"> <span class="input-group-btn">
                                                    <!-- <button type="submit" class="btn btn-default">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </button> -->
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item" >
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Ordina per
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="box wide">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="order" id="fromCreated" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1" >
                                                        Data creazione
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="order" id="fromHappened">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Data evento
                                                    </label>
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Filtra Per Data
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="box wide">
                                                <h5>Seleziona un periodo</h5>
                                            </div>
                                            <div class="demo-section k-content">
                                                <h5 style="margin-top: 1em">Inizio</h5>
                                                <input name="start" style="width: 100%;" type="date"/>
                                                <h5 style="margin-top: 1em">Fine</h5>
                                                <input name="end" style="width: 100%;" type="date"/>
                                                <label for="ignoreDate" class="form-label mt-3">Ignora anno</label>
                                                <input type="checkbox"  name="ignore">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                </div>
              
                <button class="btn btn-primary mt-3 form-events-filter-submit">Cerca</button>
            </div>
           
        
            <div class="col-12 col-md-6 col-lg-8 col-xl-9">
                <div class="row card-holder">
                    @foreach($events as $event)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-4 col-xxl-3 my-3 d-flex ">
                            <div class="card" data-id="{{$event->id}}" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Evento:</h5>
                                    <p class="card-text card-name" data-value="{{$event->name}}">{{$event->name}}</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item card-description">Descrizione: {{$event->description}}</li>
                                    <li class="list-group-item card-date" data-value="{{$event->date}}">Data evento: {{$event->date}} </li>
                                    <button class="btn btn-primary card-clipboard">Copia Data</button>
                                    <!-- <li class="list-group-item">Data di creazione :{{$event->created_at}}</li> -->
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>  
    </div>



    
    <script src="{{asset("js/app.js")}}"></script>
    <script type="text/javascript">
        const events = @json($events);
        /* const nextEvents = events.filter(event=>{
            return moment(event.date, 'YYYY-MM-DD').isBetween(moment().subtract(1, 'days') ,  moment().add(30, 'days'))
        }).sort((eventA, eventB) => moment(eventA.date, 'YYYY-MM-DD').isAfter(moment(eventB.date, 'YYYY-MM-DD') ) ? 1 : -1) */
        const nextEvents = events.filter(alertFilter).sort((eventA, eventB) => moment(eventA.date, 'YYYY-MM-DD').isAfter(moment(eventB.date, 'YYYY-MM-DD') ) ? 1 : -1)
        console.log(nextEvents);
        
        if(nextEvents.length){
            const nextEvent = nextEvents[0]
            alert( nextEvent.name + ' ' +  nextEvent.description  + ' ' + nextEvent.date )
        }

        function alertFilter(event){
            return moment(event.date, 'YYYY-MM-DD').isBetween(moment().subtract(2, 'days') ,  moment().add(30, 'days'))
        }
    </script>
    
</body>
</html>