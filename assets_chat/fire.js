//create firebase reference
var dbRef = new Firebase("https://okiklan-com.firebaseio.com/");
var chatsRef = dbRef.child('chat');

var newItems = false;


//load older conatcts as well as any newly added one...
chatsRef.on("child_added", function(snap){
    console.log("added", snap.key(), snap.val());
	
    document.querySelector('#message_box').innerHTML += (chatHtmlFromObject(snap.val()));
	
	
	
	if (!newItems) return;	
	//automatic scroll to bottom
    $("html, body").animate({
        scrollTop: $(document).height()
    }, 1000);
	
	
//*********************notification********************************************//
	new Audio("notif.mp3").play();
	doNotification (snap.val().name,snap.val().message,snap.val().date);
	
//*********************notification********************************************//
	
	
	
});

chatsRef.once('value', function(snap){
  newItems = true;
  $("html, body").animate({
        scrollTop: $(document).height()
    }, 1000);
	
});




//prepare conatct object's HTML
function chatHtmlFromObject(chat) 
{
    
	console.log(chat);
	var bubble = (chat.name == document.querySelector('#ip').innerHTML ? "bubble-right" : "bubble-left");
    var html = '<div class="' + bubble + '"><p><span class="name">' + chat.name + '</span><span class="msgc">' + chat.message + '</span><span class="date">' + chat.date + '</span></p></div>';
    return html;
}




//save chat
document.querySelector('#save').addEventListener("click", function(event){
    var a = new Date(),
        b = a.getDate(),
        c = a.getMonth(),
        d = a.getFullYear(),
        date = b + '/' + c + '/' + d,
		chatForm = document.querySelector('#msg_form');
		event.preventDefault();
		if (document.querySelector('#message').value != '') 
		{
			chatsRef.push({
					name: document.querySelector('#name').value,
					message: document.querySelector('#message').value,
					date: date,
					abc:'horas...123'
				});
				
			//chatForm.reset();
			document.querySelector('#message').value='';
		} else {
			alert('Please fill atlease message!');
		}
}, false);




