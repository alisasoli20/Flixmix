function Register(){
    var formdata = collectInputs();
    document.getElementById("register").value = "Please Wait....";
    document.getElementById("register").disabled = true;
    postAjax(
        BASE_URL+'/middle/register.php',
        formdata+"&BASE_URL="+BASE_URL,
        function(data){
            document.getElementById("register").value = "Register";
            document.getElementById("register").disabled = false;
             var Result = JSON.parse(data);
             if(Result.status == 'success'){
                document.getElementById("register_form").reset();
                 alert(Result.msg);
             }
             else{
                alert(Result.msg);
             }
        }
    );
}

function Login(){
    var formdata = collectInputs();
    document.getElementById("login").value = "Please Wait....";
    document.getElementById("login").disabled = true;
    postAjax(
        BASE_URL+'/middle/login.php',
        formdata+"&BASE_URL="+BASE_URL,
        function(data){
            console.log(data);
            document.getElementById("login").value = "Login";
            document.getElementById("login").disabled = false;
             var Result = JSON.parse(data);
             if(Result.status == 'success'){
                window.location.href="search.php";
             }
             else{
                alert(Result.msg);
             }
        }
    );
}

function Search(){
    var searchTerm = document.getElementById("searchTerm").value;
    if(searchTerm != ''){
        getAjax(
            BASE_URL+'/middle/search.php?s='+searchTerm+'&BASE_URL='+BASE_URL, 
            function(data){
                var json = JSON.parse(data);
                var html = "<ul>";
                document.getElementById("livesearch").style.display = 'block';
                if(json.status == 'success'){
                    if(json.data){
                        for(var i =0;i<json.data.length;i++){
                            var html = html + "<li> <a href='profile.php?id="+json.data[i].id+"'>"+json.data[i].name+"</a></li>";
                        }
                        //document.getElementById("livesearch").style.display = 'block';
                    }
                    else{
                        var html = html + "<li> No Data Found</li>";
                        console.log('No Data Found');
                    }
                html = html+"</ul>";
                document.getElementById("livesearch").innerHTML = html;
                }
                else{
                    alert(json.msg);
                }
            }
        );
    }
    else{
        document.getElementById("livesearch").style.display = 'none';
    }
}

function Profile(){
    if(!USER_ID){
        window.location.href='search.php';
    }
    else{
        postAjax(
            BASE_URL+'/middle/profile.php',
            {
                'profile_id':USER_ID,
                'BASE_URL':BASE_URL
            },
            function(data){
                console.log(data);
                 var Result = JSON.parse(data);
                 if(Result.status == 'success' && Result.data != null){
                    document.getElementById("name").innerHTML = Result.data.name;
                    document.getElementById("email").innerHTML = Result.data.email;
                 }
                 else{
                    window.location.href='search.php';
                    console.log(Result.msg);
                 }
            }
        );
    }
}

function getComments(){
    var formData = {
        profile_id:USER_ID,
        BASE_URL:BASE_URL
    };

    postAjax(
        BASE_URL+'/middle/comments.php',
        formData,
        function(data){
            var html = '';
            console.log(data);
             var Result = JSON.parse(data);
             if(Result.status == 'success'){
                 if(Result.data){
                    for(var i=0;i<Result.data.length;i++){
                        html = html + '<div class="users-list"><div class="user-img"><img class="img rounded-img" src="user.png"></div><div class="user-details"><h4 class="name">Name - '+Result.data[i].name+'</h4><h4 class="name">Date - '+Result.data[i].created_at+'</h4><h4 class="name">Comments - <br>'+Result.data[i].comments+'</h4></div></div>';
                    }
                 }
                 else{
                    html = html + '<div class="users-list"><div class="user-img"></div><div class="user-details"><h4 class="name">No Comments Found</h4></div></div>';
                 }
             }
             else{
                html = html + '<div class="users-list"><div class="user-img"></div><div class="user-details"><h4 class="name">No Comments Found</h4></div></div>';
                 console.log(Result.msg)
             }
             document.getElementById("comment_section").innerHTML = html;
        }
    );
}

function addComment(){
    document.getElementById("post").value = "Please Wait....";
    document.getElementById("post").disabled = true;
    var comments = document.getElementById("comments").value;
    var formData = {
        profile_id:USER_ID,
        comment:comments,
        BASE_URL:BASE_URL
    };
    postAjax(
        BASE_URL+'/middle/addcomment.php',
        formData,
        function(data){
            document.getElementById("post").value = "Post";
            document.getElementById("post").disabled = false;
            console.log(data);
             var Result = JSON.parse(data);
             if(Result.status == 'success'){
                getComments();
                document.getElementById("comments").value = "";
                 alert(Result.msg);
             }
             else{
                 console.log(Result.msg)
             }
        }
    );
}