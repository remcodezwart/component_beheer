document.addEventListener('keydown', function(event) {
  if( event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 74 )
    event.preventDefault();
});