// author: Aaron Aquino Manyari
// Fecha: Octubre 2018
var a= 1 ;
var b = parseInt(screen.width);
wancho=b+3;
// wancho=1366;
wancho= wancho;

$('.unoinicial').click(function() {
    event.preventDefault();
    $('#zldrcontent').animate({
      scrollLeft: '-='+wancho*8
    }, "slow");
 });
 $('.unofinal').click(function() {
     event.preventDefault();
     $('#zldrcontent').animate({
       scrollLeft: '+='+wancho*8
     }, "slow");
  });

// $('.controlizquierda').click(function() {
//     event.preventDefault();
//     $('#multipleconcenter').animate({
//       scrollLeft: '-='+wancho
//     }, "slow");
//  });
//  $('.controlderecha').click(function() {
//      event.preventDefault();
//      $('#multipleconcenter').animate({
//        scrollLeft: '+='+wancho*1
//      }, "slow");
//   });

  $('.unoizquierda').click(function() {
      event.preventDefault();
      $('#zldrcontent').animate({
        scrollLeft: '-='+wancho
      }, "slow");
   });


   $('.unoderecha').click(function() {
       event.preventDefault();
       $('#zldrcontent').animate({
         scrollLeft: '+='+wancho*1
       }, "slow");
    });




   $('.ira').click(function() {
      event.preventDefault();
      $('#zldrcontent').animate({
        scrollLeft: '+='+wancho,

      }, "slow");
    });


$('#irpagdos').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+300
   }, "slow");
});
$('#irpagtres').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+wancho*2
   }, "slow");
});
$('#irpagcuatro').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+wancho*3
   }, "slow");
});
$('#irpagcinco').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+wancho*4
   }, "slow");
});
$('#irpagseis').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+wancho*5
   }, "slow");
});
$('#irpagsiete').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+wancho*6
   }, "slow");
});
$('#irpagocho').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+wancho*7
   }, "slow");
});
$('#irpagnueve').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+wancho*8
   }, "slow");
});
$('#irpagdiez').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '+='+wancho*9
   }, "slow");
});
$('.boxxboton').click(function() {
   event.preventDefault();
   $('#zldrcontent').animate({
     scrollLeft: '-='+wancho*4
   }, "slow");
});
