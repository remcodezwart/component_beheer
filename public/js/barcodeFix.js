document.addEventListener('keydown', function(event) {
  	
  	if (event.target.id === 'search') {
		if (event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 74 ) {
	   		event.preventDefault();
		}

		if (event.keyCode == 74) {
			document.getElementById('search').value += "j";
		}
  	}

});