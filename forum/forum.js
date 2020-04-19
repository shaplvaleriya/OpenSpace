$('#forum-form').submit((e) => {
    e.preventDefault();
    const forumValue = $('#forum-input').val();
    const forumDate = new Date();
    const day=forumDate.getDate();
    const month = forumDate.getMonth();
    const year=forumDate.getFullYear();
    const hours = forumDate.getHours();
    const minutes = forumDate.getMinutes();
    const second = forumDate.getSeconds();

    const mainDate = year + "-" + month + "-" + day + " "+hours+":"+minutes+":"+second;


    $.post('addMessage.php', {forumString: forumValue, mainDate})
    .done(res => {
    	console.log(res);
        document.getElementById("forum_list").innerHTML = res;
    $('#forum-input').val("");
    })
})

function GetMessages()
{
	// console.log("rnigklva");
	$.get('getMessage.php')
    .done(res => {
    	console.log(res);
        document.getElementById("forum_list").innerHTML = res;
    })
}

setInterval(()=>{GetMessages()},3000)