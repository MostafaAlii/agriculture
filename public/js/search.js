function createRequest(){			 
	var xmlhttp;
	if(window.XMLHttpRequest){
		 xmlhttp = new XMLHttpRequest();
	}else{
		 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}	  
	return xmlhttp;		 
}
//////////////////////////////////////////////////////////////////////////

function searchAction(){				
	if (this.readyState == 4 && this.status == 200) {				
		document.getElementById("search_data").innerHTML = this.responseText;		
  	   
	}							
}
//////////////////////////////////////////////////////////////////////////

function search_result(page,id,type){
	var xhhttp;
	xhhttp= createRequest();
	xhhttp.onreadystatechange = searchAction;	
	xhhttp.open("GET","../"+page+".search/" + id + "/" + type, true); 
	xhhttp.send();
}
//////////////////////////////////////////////////////////////////////////
function input_search_result(){
	
    var text=document.getElementById('search').value;
    if(text==''){
        var alert_txt=document.getElementById('alert_txt').value;
        
        alert(alert_txt);
    }else{
        var xhhttp;
        xhhttp= createRequest();
        xhhttp.onreadystatechange = searchAction;	
        xhhttp.open("GET","../blogs.search2/" + text , true); 
        xhhttp.send();
    }
}

//-----------------------chat parts------------------------------------------
//-----------------------chat parts------------------------------------------
//-----------------------chat parts------------------------------------------

//////////////////////////////////////////////////////////////////////////

function chatAction(){
	if (this.readyState == 4 && this.status == 200) {				
		document.getElementById("chat").innerHTML = this.responseText;		
	}
}
//////////////////////////////////////////////////////////////////////////
function start_converstion(value,type){
	document.getElementById('guard_id').value=value;
	// document.getElementById('guard_id2').value=value;
	// document.getElementById("disabled").disabled = false;
	//alert(value+' , '+type);
	var xhhttp;
        xhhttp= createRequest();
        xhhttp.onreadystatechange = chatAction;	
        xhhttp.open("GET","../single_chat/"+value+"/"+type , true); 
        xhhttp.send();
}

