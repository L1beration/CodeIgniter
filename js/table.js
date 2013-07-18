function deleteElement(id) {
	var XMLHttpRequest = createRequestObject();
		XMLHttpRequest.onreadystatechange = function () {
			if ( XMLHttpRequest.readyState === 4 && XMLHttpRequest.status === 200 ) {
                var response = JSON.parse(XMLHttpRequest.responseText);
				document.getElementById('container').innerHTML = response.response_view;
			}
		};
        var site_request = '';
        site_request = '/index.php/student_controller/delete/'+id;

		XMLHttpRequest.open ( "POST", site_request , true );
		XMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		XMLHttpRequest.send ("request");
}

function updateElement(id, student_name, class_id) {
	var XMLHttpRequest = createRequestObject();
		XMLHttpRequest.onreadystatechange = function () {
			if ( XMLHttpRequest.readyState === 4 && XMLHttpRequest.status === 200 ) {
				var response = JSON.parse(XMLHttpRequest.responseText);
				document.getElementById('container').innerHTML = response.response_view;
            }
		};
        var parameters = 'student_old_name='+student_name+'&old_class_id='+class_id;
        var site_request = '';
        site_request = '/index.php/student_controller/update/'+id;
        if(document.getElementById('class_id')) {
        var student_new_name = document.getElementById('student_new_name').value;
        var class_id = document.getElementById('class_id').value;
        parameters += '&student_new_name='+student_new_name+'&class_id='+class_id;
        }

		XMLHttpRequest.open ( "POST", site_request , true );
		XMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		XMLHttpRequest.send (parameters);
}

function createRequestObject() {
	  if (typeof XMLHttpRequestRequest === 'undefined') {
	    XMLHttpRequestRequest = function() {
	      try { return new ActiveXObject("Msxml2.XMLHttpRequest.6.0"); }
	        catch(e) {}
	      try { return new ActiveXObject("Msxml2.XMLHttpRequest.3.0"); }
	        catch(e) {}
	      try { return new ActiveXObject("Msxml2.XMLHttpRequest"); }
	        catch(e) {}
	      try { return new ActiveXObject("Microsoft.XMLHttpRequest"); }
	        catch(e) {}
	      throw new Error("This browser does not support XMLHttpRequestRequest.");
	    };
	  }
	  return new XMLHttpRequest();
}

function confirmDelete(id) {
	if (confirm("Вы подтверждаете удаление?")) {
		deleteElement(id);
	} else {
		return false;
	}
}
