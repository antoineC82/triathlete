function randomHSL(){
    return "hsla(" + ~~(360 * Math.random()) + "," +
                    "70%,"+
                    "80%,0.8)"
  }

$(".project-box").each(function() {
      //On change la couleur de fond au hasard
      $(this).css("background-color", randomHSL());
    })