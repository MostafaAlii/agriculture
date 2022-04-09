

$('#all_tags li').on('click', function () {

    var tag_id = this.id;
    alert(tag_id);
    $.ajax({
        type: "GET",
        
        //url: "{{ URL::to('blogs.tag/')}}/" + tag_id,
        url: "blogs.tag/" + tag_id,
        
        dataType: "json",
        success: function (data)
        {
            $('#blog_data').append(data);
            alert(data);
        },
        error:function()
        { alert("false"); }
    });
 });
   