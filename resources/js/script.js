const { isEmpty } = require("lodash");

$(function() {
   $(document).on('click' , '.form-events-filter-submit' , function(){
      let eventName = $('.form-events-filter').find('[name = "q"]').val();
      let eventStart = $('.form-events-filter').find('[name = "start"]').val();
      let eventEnd = $('.form-events-filter').find('[name = "end"]').val();
      
      $('.form-events-filter').find('[name = "start"]').removeClass('border-danger');
      $('.form-events-filter').find('[name = "end"]').removeClass('border-danger');

      if((!isEmpty(eventStart) && isEmpty(eventEnd)) || (isEmpty(eventStart) && !isEmpty(eventEnd))){
         if(isEmpty(eventStart)){
            $('.form-events-filter').find('[name = "start"]').addClass('border-danger');
         } else{
            $('.form-events-filter').find('[name = "end"]').addClass('border-danger');
         } 
      };

   
    
      
      $.ajax({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: "POST",
         url: "/search",
         data: { name: eventName , start: eventStart, end: eventEnd },
         success: function(data) {
            $('.card-holder').html('');
            $.each(data, function () {
               $('.card-holder').append(` 
                  <div class="col-12 col-sm-6 col-lg-4 col-xl-4 col-xxl-3 my-3 d-flex">
                     <div class="card" data-id="`+ this.id +`" style="width: 18rem;">
                        <div class="card-body">
                           <h5 class="card-title">Evento:</h5>
                           <p class="card-text card-name data-value="`+ this.name +`">`+ this.name + `</p>
                        </div>
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item card-description">Descrizione: `+ this.description + `</li>
                           <li class="list-group-item card-date data-value="`+ this.date +`">Data evento: `+ this.date + `</li>
                        </ul>
                        <button class="btn btn-primary card-clipboard">Copia Data</button>
                     </div>
                  </div>`
               )}
            );
         },   
         
         error: function(jqXHR, textStatus, errorThrown) {
            console.log("funzione chiamata quando la chiamata fallisce", jqXHR, textStatus, errorThrown);  
         }
      })
   });
});


$(function() {
   $(document).on('click' ,'.card-clipboard', function(){
      let copyName = $(this).parents('.card').find('.card-name');
      console.log(copyName);
      let copyDate = $(this).parents('.card').find('.card-date');
      
      navigator.clipboard.writeText(copyName.data('value') + ' - ' +copyDate.data('value'));
   
   });
})


$(function(){
   $(document).on('click' , '#fromCreated' , function (){
      let eventsId = [];
      $.each($('.card'), function(){
         eventsId.push($(this).data('id'));
      });
      
      $.ajax({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: "POST",
         url: "/sort/creation",
         data: { ids : eventsId },
         success: function(data) {
            $('.card-holder').html('');
            $.each(data, function () {
               $('.card-holder').append(` 
                  <div class="col-12 col-sm-6 col-lg-4 col-xl-4 col-xxl-3 my-3 d-flex">
                     <div class="card" data-id="`+ this.id +`" style="width: 18rem;">
                        <div class="card-body">
                           <h5 class="card-title">Evento:</h5>
                           <p class="card-text card-name data-value="`+ this.name +`">`+ this.name + `</p>
                        </div>
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item card-description">Descrizione: `+ this.description + `</li>
                           <li class="list-group-item card-date data-value="`+ this.date +`">Data evento: `+ this.date + `</li>
                        </ul>
                        <button class="btn btn-primary card-clipboard">Copia Data</button>
                     </div>
                  </div>`
               )}
            );
         },   
         
         error: function(jqXHR, textStatus, errorThrown) {
            console.log("funzione chiamata quando la chiamata fallisce", jqXHR, textStatus, errorThrown);  
         }
      });
   });
   
   $(document).on('click' , '#fromHappened' , function (){
      let eventsId = [];
      $.each($('.card'), function(){
         eventsId.push($(this).data('id'));
      });
      $.ajax({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: "POST",
         url: "/sort/happened",
         data: { ids : eventsId },
         success: function(data) {
            $('.card-holder').html('');
            $.each(data, function () {
               $('.card-holder').append(` 
                  <div class="col-12 col-sm-6 col-lg-4 col-xl-4 col-xxl-3 my-3 d-flex">
                     <div class="card" data-id="`+ this.id +`" style="width: 18rem;">
                        <div class="card-body">
                           <h5 class="card-title">Evento:</h5>
                           <p class="card-text card-name data-value="`+ this.name +`">`+ this.name + `</p>
                        </div>
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item card-description">Descrizione: `+ this.description + `</li>
                           <li class="list-group-item card-date data-value="`+ this.date +`">Data evento: `+ this.date + `</li>
                        </ul>
                        <button class="btn btn-primary card-clipboard">Copia Data</button>
                     </div>
                  </div>`
               )}
            );
         },   
         
         error: function(jqXHR, textStatus, errorThrown) {
            console.log("funzione chiamata quando la chiamata fallisce", jqXHR, textStatus, errorThrown);  
         }
      });
   });

});
