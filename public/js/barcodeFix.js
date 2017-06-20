document.addEventListener('keydown', function(event) {
  	if (event.target.id === 'barcode' || event.target.id === 'search') {
		if (event.keyCode == 13 || event.keyCode == 17 || event.keyCode == 74) {
	   		event.preventDefault();

	   		if (event.target.placeholder != "" && event.target.id == 'search' && event.keyCode == 13) {
				if (confirm('zoeken op '+event.target.value)) {
					document.getElementById('searchForm').submit(); 
				}
			}

		}

		if (event.keyCode == 74 && event.target.id === 'search') {
			document.getElementById('search').value += "j";
		} else if(event.keyCode == 74 && event.target.id === 'barcode') {
			document.getElementById('barcode').value += "j";
		}
  	}

});