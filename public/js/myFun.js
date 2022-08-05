// $(function () {
//     'use strict';
//     $('[data-toggle="product_rating"]').on('change', function () {
//         $.post('../user/ratings/product', {
//             product_id: $(this).data('id'),
//             rating: $(this).val(),
//             _token: "{{ csrf_token() }}"
//         }, function(response) {
//             alert(response.rating)
//         })
//     });
// });


// $(document).ready(function () {

//     //---------------show all province of selected country------------------------//
//    $('select[id="product_rating"]').on('change', function () {

//         var product_rating = $(this).val();
//         alert(product_rating);

//         var product_id =document.getElementById("product_id").value;
//         alert(product_id);

//         $.ajax({
//            type: "GET",

//            url: "../user/ratings/product/"+ product_id+"/"+product_rating,
//            dataType: "json",
           
//            success: function (data)
//            {
//             alert(data);
//             document.getElementById("rate_msg").innerHTML=data;
//            },
//            error:function()
//            { alert("false"); }
//        });
//    });
//    });

   
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

function doAction(){				
	if (this.readyState == 4 && this.status == 200) {
       // alert(this.responseText);
		document.getElementById("rate_msg").innerHTML = '<span style="width: '+this.responseText+'%"></span>';		
       
	}							
}
//////////////////////////////////////////////////////////////////////////

function add_rate(rate,type){
    //alert(rate);
    //alert(type);
   
   if(type=='farmer'){
	var farmer_id =document.getElementById("farmer_id").value;
	$link="../user/ratings/farmer/"+ farmer_id+"/"+rate;
   }else if(type=='product'){
    var product_id =document.getElementById("product_id").value;
	$link="../user/ratings/product/"+ product_id+"/"+rate;
   }
    
	var xhhttp;
	xhhttp= createRequest();
	xhhttp.onreadystatechange = doAction;	
	xhhttp.open("GET",$link, true);
    xhhttp.setRequestHeader("Accept", "application/json");
    xhhttp.setRequestHeader("Content-Type", "application/json");

    //xhhttp.onload = () => console.log(xhhttp.responseText);

    let data = `{
    "product_id": "`+product_id+`"
    }`;

	xhhttp.send(data);
}
// //////////////////////////////////////////////////////////////////////////
