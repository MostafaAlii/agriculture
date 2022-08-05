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
	// alert(page);
	// alert(id);
	// alert(type);
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

// $('#all_tags li').on('click', function () {

//     var tag_id = this.id;
//     alert(tag_id);
//     $.ajax({

//         type: "GET",
//         //url: "{{ URL::to('blogs.tag/')}}/" + tag_id,
//         url: "../blogs.tag/" + tag_id,
        
//         dataType: "json",
//         success: function (data)
//         {
//             if(data!='')
//             { 
//                  $('#blog_data').append(data);
//                  alert('data');
//             }else{
//                 alert('no data');
//             }
//             $.each(data, function (key) {
//                alert(key);
//             });
//         },
//         error:function()
//         { alert("false"); }
//     });
//  });
   