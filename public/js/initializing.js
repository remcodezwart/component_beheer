var url = document.head.querySelector("[name=url]").content+"index/background";
var csrf_token = document.head.querySelector("[name=csrf_token]").content;

httpRequest = new XMLHttpRequest();
httpRequest.onreadystatechange = function(){return};
httpRequest.open('POST', url, true);
httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
httpRequest.send('csrf_token=' + encodeURIComponent(csrf_token) );