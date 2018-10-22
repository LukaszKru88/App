function countdown()
{
	var currentTime = new Date();
	
	var day = currentTime.getDate();
	var month = currentTime.getMonth() + 1;
	var year = currentTime.getFullYear();
	
	var hour = currentTime.getHours();
	if(hour < 10) hour = "0" + hour;
	var minutes = currentTime.getMinutes();
	if(minutes < 10) minutes = "0" + minutes;
	var seconds = currentTime.getSeconds();
	if(seconds < 10) seconds = "0" + seconds;
	
	document.getElementById("clock").innerHTML = day + "|" + month + "|" + year + "| " + hour + ":" + minutes + ":" + seconds;
	
	setTimeout("countdown()" , 1000);
}
