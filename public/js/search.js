var token = document.head.querySelector("[name=csrf_token]").content;
var url = document.head.querySelector("[name=url]").content;

document.addEventListener('keydown', function(key) {
	if (key.keyCode == 13) {
		var terms = document.getElementById('search').value;
		if ( confirm("zoeken op "+terms) ) {
			$.ajax({
				type: "POST",
				url: url+"index/searchAction",
				data:{csrf_token: token, search: terms, json: true},
				success: function(data) {	
					var html = "";
					if (data.length > 0) {
						for (index in data) {
							html += "\
							<tr>\
								<td>"+data[index].name+"</td>\
				                <td><img src=\""+data[index].hyperlink+"\" alt=\"component plaatje\"></td>\
				                <td>"+data[index].description+"</td>\
				                <td><pre>"+data[index].specs+"</pre></td>\
					    	</tr>"
				    	}
					} else {
						html += "\
						<tr>\
							<td colspan=\"4\" class=\"center-align red\">geen resultaten gevonden </td>\
				    	</tr>"
					}
					
					$('#results').empty().append(html);
				},
				fail: function() {
					alert('er is een onbekende fout opgetreden');
				},
			});
		};
	};
})