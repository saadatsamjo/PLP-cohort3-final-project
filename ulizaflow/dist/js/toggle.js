function inbox(){
	var box=getElementById("box");
	var name=getElementByName("sent_card");
	if(name){
		box.innerHTML=<?php echo $inbox; ?>;
	}
}

function sent(){
	var box=getElementById("box");
	var name=getElementByName("inbox_card");
	if(name){
		box.innerHTML=<?php echo $sent; ?>;
	}
}
function inbox(){
	var box=getElementById("box");
	var name=getElementByName("sent_card");
	if(box){
		box.innerHTML="<h1>inbox</h1>";
	}
}

function sent(){
	var box=getElementById("box");
	var name=getElementByName("inbox_card");
	if(box){
		box.innerHTML="<h1>sent</h1>";
	}
}