window.onload = function() {
	var post = document.getElementById('post').innerHTML;
	var files = document.getElementById('files').innerHTML;
	var files_contents = document.getElementById('files_contents').innerHTML;
	var toMany = document.getElementById('toMany').innerHTML.split("\n");
	var el = toMany.pop();
	if (el != "") {
		toMany.push(el);
	}
	var freq = +document.getElementById('freq').innerHTML;
	var st1 = document.getElementById('st1');
	var st2 = document.getElementById('st2');

	var i = 0;
	var count = toMany.length;
	var delay = 60000./freq;
	var elapsedTime = delay*count;
	var time = elapsedTime/1000;
	var days = Math.floor(time/(24*3600));
	time %= (24*3600);
	var hours = Math.floor(time/3600);
	time %= 3600;
	var minutes = Math.floor(time/60);
	st1.innerHTML = 'отправлено <span>0/'+count+'</span> адрессов из импортированого списка';
	st2.innerHTML = 'окончание через <span>'+days+'</span> суток <span>'+hours+'</span> часов <span>'+minutes+'</span> минут';
	var timer = setInterval(function() {
		elapsedTime -= delay;
		if (elapsedTime < 0) {
			elapsedTime = 0;
		}
		var time = elapsedTime/1000;
		var days = Math.floor(time/(24*3600));
		time %= (24*3600);
		var hours = Math.floor(time/3600);
		time %= 3600;
		var minutes = Math.floor(time/60);
	
		if (i < count) {
			send(post, files, files_contents, toMany[i]); 
			i++;
			st1.innerHTML = 'отправлено <span>' + i + '/'+count+'</span> адрессов из импортированого списка';
			st2.innerHTML = 'окончание через <span>'+days+'</span> суток <span>'+hours+'</span> часов <span>'+minutes+'</span> минут';	
		} else {
			clearInterval(timer);
		}

	}, delay);
}

function send(post, files, files_contents, toOne) {
	// alert("Send");

	var xhr = new XMLHttpRequest();

	// var json = JSON.stringify({
	// 	name: "Vlad",
	// 	surname: "Dzyuba"
	// });

	// json = "name=Vlad";

	xhr.open("POST", "send.php", true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


	xhr.onreadystatechange = function() {
		// console.log(xhr.readyState);
		// console.log("OK");
		if (xhr.readyState == 4) {
			console.log(xhr.responseText);
		}
	};

	var query = 'post='+encodeURIComponent(post)+
				'&files='+encodeURIComponent(files)+
				'&files_contents='+encodeURIComponent(files_contents)+
				'&toOne='+encodeURIComponent(toOne);

	xhr.send(query);
}