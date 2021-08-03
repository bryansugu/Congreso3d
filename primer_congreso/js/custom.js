$("#main").mousemove(function(e) {
  parallaxIt(e, ".field--name-hero-body--titleh1", -10);
  parallaxIt(e, ".field--name-hero-body--titleh2", -10);
  parallaxIt(e, ".field--name-hero-body--titleh3", -10);
  parallaxIt(e, ".field--name-hero-image", -50);
  parallaxIt(e, ".field--name-hero-body--date", 10);
  parallaxIt(e, ".field--name-hero-body--mes", 10);
  parallaxIt(e, ".field--name-hero-body--lugar", 10);
  parallaxIt(e, ".field--name-hero-body--titlevertical", -10);
});

function parallaxIt(e, target, movement) {
  var $this = $("#main");
  var relX = e.pageX - $this.offset().left;
  var relY = e.pageY - $this.offset().top;

  TweenMax.to(target, 1, {
    x: (relX - $this.width() / 2) / $this.width() * movement,
    y: (relY - $this.height() / 2) / $this.height() * movement
  });
}
window.onload = function() {
    var img1 = document.getElementsByClassName("field--name-hero-body--titleh1");
    var img2 = document.getElementsByClassName("field--name-hero-body--titleh2");
    var img3 = document.getElementsByClassName("field--name-hero-body--titleh3");
    var img5 = document.getElementsByClassName("field--name-hero-body--date");
    var img6 = document.getElementsByClassName("field--name-hero-body--mes");
    var img7 = document.getElementsByClassName("field--name-hero-body--lugar");

    TweenMax.set([img1, img2, img3],
        {
            //ease: easeIn,
            opacity:0, 
            y:50
        });
    TweenMax.staggerTo([img1, img2, img3], 0.5, 
    {
        opacity:1,
        y:0
    }, 0.3);

    TweenMax.set([img5, img6, img7],
        {
            opacity:0, 
        });
    TweenMax.staggerTo([img5, img6, img7], 1,  
    {
        delay: 1.2,
        opacity:1,

    }, 0.5);

    var tl = new TimelineMax();

    tl
    .fromTo('.field--name-hero-body--titlevertical', 1, 
    {
        opacity: 0,
        y:50
    },
    {
        opacity: 1, 
        y: 0
    });
    tl
    .fromTo('.field--name-hero-image', 2, 
    {
        delay: 1.2,
        opacity: 0,
        x:150
    },
    {
        opacity: 1, 
        x: 0
    });



}
// seccion About
var controller = new ScrollMagic.Controller();
var img8 = document.getElementsByClassName("field--name-about-destacado");
var img9 = document.getElementsByClassName("field--name-about-body");
// build tween
TweenMax.set([img8, img9], {yPercent: -100})
var tween = TweenMax.to([img8, img9 ], 0.5, {yPercent: 0, opacity:1});
// build scene
var scene = new ScrollMagic.Scene({triggerElement: "#trigger1", triggerHook: 'onEnter', offset: 203, duration: 300})
  .setTween(tween)
  //.addIndicators() // add indicators (requires plugin)
  .addTo(controller);

// seccion invitados
var tle1 = document.getElementsByClassName("field--name-invitados-title");
var card1 = document.getElementById("trigger2").childNodes[1];
var card2 = document.getElementById("trigger2").childNodes[3];
var card3 = document.getElementById("trigger2").childNodes[5];
var card4 = document.getElementById("trigger2").childNodes[7];
var card5 = document.getElementById("trigger2").childNodes[9];
var card6 = document.getElementById("trigger2").childNodes[11];
var card7 = document.getElementById("trigger2").childNodes[13];
var card8 = document.getElementById("trigger2").childNodes[15];
var card9 = document.getElementById("trigger2").childNodes[17];
var card10 = document.getElementById("trigger2").childNodes[19];
// build tween
TweenMax.set([card1,card2,card3,card4,card5,card6,card7,card8,card9,card10], {yPercent: -20})
var tween1 = TweenMax.to([tle1], 0.5, {yPercent: 0, opacity:1});
var tween2 = TweenMax.to([card1], 0.5, {yPercent: 0, opacity:1});
var tween3 = TweenMax.to([card2], 0.5, {yPercent: 0, opacity:1});
var tween4 = TweenMax.to([card3], 0.5, {yPercent: 0, opacity:1});
var tween5 = TweenMax.to([card4], 0.5, {yPercent: 0, opacity:1});
var tween6 = TweenMax.to([card5], 0.5, {yPercent: 0, opacity:1, delay:0.5});
var tween7 = TweenMax.to([card6], 0.5, {yPercent: 0, opacity:1, delay:0.5});
var tween12 = TweenMax.to([card7], 0.5, {yPercent: 0, opacity:1, delay:0.5});
var tween13 = TweenMax.to([card8], 0.5, {yPercent: 0, opacity:1, delay:0.5});
var tween14 = TweenMax.to([card9], 0.5, {yPercent: 0, opacity:1, delay:1});
var tween144 = TweenMax.to([card10], 0.5, {yPercent: 0, opacity:1, delay:1});
// build scene          
var scene2 = new ScrollMagic.Scene({triggerElement: "#trigger2",triggerHook: 'onEnter', offset: 0, duration: 900})
    .setTween([tween1,tween2,tween3,tween4,tween5,tween6,tween7,tween12,tween13,tween14,tween144])
    //.addIndicators() // add indicators (requires plugin)
    .addTo(controller);


// seccion inversion
var tle4 = document.getElementsByClassName("field--name-inversion-title");
var tween20 = TweenMax.to([tle4], 0.5, {yPercent: 0,opacity:1});
// build scene          
var scene7 = new ScrollMagic.Scene({triggerElement: "#trigger5", duration: 200})
    .setTween([tween20])
    //.addIndicators() // add indicators (requires plugin)
    .addTo(controller);

var cmy11 = document.getElementById("trigger5wrap").childNodes[1];
var cmy22 = document.getElementById("trigger5wrap").childNodes[3];
var cmy33 = document.getElementById("trigger5wrap").childNodes[5];
var cmy44 = document.getElementById("trigger5wrap").childNodes[7];
var cmy55 = document.getElementById("trigger5wrap").childNodes[9];
var cmy66 = document.getElementById("trigger5wrap").childNodes[11];
var tween88 = TweenMax.to([cmy11], 0.5, {yPercent: 0, opacity:1, delay:0.25});
var tween99 = TweenMax.to([cmy22], 0.5, {yPercent: 0, opacity:1, delay:0.30});
var tween22 = TweenMax.to([cmy33], 0.5, {yPercent: 0, opacity:1, delay:0.35});
var tween33 = TweenMax.to([cmy44], 0.5, {yPercent: 0, opacity:1, delay:0.40});
var tween55 = TweenMax.to([cmy55], 0.5, {yPercent: 0, opacity:1, delay:0.45});
var tween66 = TweenMax.to([cmy66], 0.5, {yPercent: 0, opacity:1, delay:0.50});

var scene15 = new ScrollMagic.Scene({triggerElement: "#trigger5wrap",triggerHook: 'onEnter', offset: 50, duration: 600})
    .setTween([tween88,tween99,tween22,tween33,tween55,tween66])
    //.addIndicators() // add indicators (requires plugin)
    .addTo(controller);




// seccion empresas
var tle2 = document.getElementsByClassName("field--name-empresa-title");
var tle3 = document.getElementsByClassName("field--name-empresa-destacado");
var tween7 = TweenMax.to([tle2,tle3], 0.5, {yPercent: 0,opacity:1});
// build scene          
var scene3 = new ScrollMagic.Scene({triggerElement: "#trigger3",triggerHook: 'onEnter', offset: 350, duration: 200})
    .setTween([tween7])
    //.addIndicators() // add indicators (requires plugin)
    .addTo(controller);

var cmy1 = document.getElementById("trigger3wrap").childNodes[1];
var cmy2 = document.getElementById("trigger3wrap").childNodes[3];
var cmy3 = document.getElementById("trigger3wrap").childNodes[5];
var cmy4 = document.getElementById("trigger3wrap").childNodes[7];
var tween8 = TweenMax.to([cmy1], 0.5, {yPercent: 0, opacity:1, delay:0.25});
var tween9 = TweenMax.to([cmy2], 0.5, {yPercent: 0, opacity:1, delay:0.30});
var tween10 = TweenMax.to([cmy3], 0.5, {yPercent: 0, opacity:1, delay:0.35});
var tween11 = TweenMax.to([cmy4], 0.5, {yPercent: 0, opacity:1, delay:0.40});
var scene4 = new ScrollMagic.Scene({triggerElement: "#trigger3wrap",triggerHook: 'onEnter', offset: 50, duration: 600})
    .setTween([tween8,tween9,tween10,tween11])
    //.addIndicators() // add indicators (requires plugin)
    .addTo(controller);

var cmy5 = document.getElementById("trigger4wrap").childNodes[1];
var tween15 = TweenMax.to([cmy5], 0.5, {yPercent: 0, opacity:1,delay:2});    
var scene5 = new ScrollMagic.Scene({triggerElement: "#trigger3wrap",triggerHook: 'onEnter', offset: 103, duration: 600})
    .setTween(tween15)
    //.addIndicators() // add indicators (requires plugin)
    .addTo(controller);






//Smooth scroll for specific anchor
$(document).ready(function(){
   // for active class
    $(".nav-item.nav-link").on("click",function(){
      $(".nav-item.nav-link.current").removeClass("current");
      $(this).addClass("current");
    });
});

$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});








