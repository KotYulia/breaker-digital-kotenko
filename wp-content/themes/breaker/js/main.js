jQuery(function($) {
   $(document).ready(function() {
       $('.popup-youtube-link').magnificPopup({
           disableOn: 700,
           type: 'iframe',
           mainClass: 'mfp-fade',
           removalDelay: 160,
           preloader: false,

           fixedContentPos: false
       });

       $('.container').each(function(){
           var highestBox = 0;
           $('.col-md-4 ', this).each(function(){
               if($(this).height() > highestBox) {
                   highestBox = $(this).height();
               }
           });
           $('.col-md-4 ',this).height(highestBox);
       });
   });
});