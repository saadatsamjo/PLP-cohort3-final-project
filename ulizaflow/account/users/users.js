async function loadUsers() {
	try{
		const url = 'http://localhost/ulizaflow/backend/account/users/?fetchAll';
		const results = await fetch(url)
		const finalData = await results.json()
		finalData.forEach((user) => {
			if(user.profilepic != "user-default.jpg"){
				$('#row').append(`
				<div class="col-md-3">
			        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
			        <div class="image">
			          <img src="../../file-uploads/${user.profilepic}" class="img-circle elevation-2" alt="${user.username}'s Profile Pic">
			        </div>
			        <div class="info">
			          <a href="?user=${user.user_id}" class="d-block">${user.username}</a>
			        </div>
			      </div>
			    </div> 
			`);
			}else{
				$('#row').append(`
				<div class="col-md-3">
			        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
			        <div class="image">
			          <img src="../../dist/img/user-default.jpg" class="img-circle elevation-2" alt="${user.username}'s Profile Pic">
			        </div>
			        <div class="info">
			          <a href="?user=${user.user_id}" class="d-block">${user.username}</a>
			        </div>
			      </div>
			    </div> 
			`);
			}
		});
	} catch (err) {
		console.error(err)
	}
}
loadUsers()

async function viewUser(id) {
	try{
		const url = 'http://localhost/ulizaflow/backend/account/users/?existing='+id;
		const results = await fetch(url)
		const finalData = await results.json()
		$('#askbox').append(`
			&nbsp;
			<a href="../users/" type="button" class="btn btn-outline-info" >Back</a>
		`);
		$('#row').attr('id', 'quizbox');
		finalData.forEach((user) => {
			if(user.profilepic != "user-default.jpg"){
				$('#quizbox').html(`
					<div class="col-md-4">
	            		<div class="card card-widget widget-user shadow">
	                        <div class="widget-user-header bg-info">
	                			<h3 class="widget-user-username">${user.username}</h3>
	              			</div>
	              			<div class="widget-user-image">
	                			<img class="img-circle elevation-2" src="../../file-uploads/${user.profilepic}" alt="${user.username}'s Profile Pic">
	              			</div>
	              			<div class="card-footer">
	                			<div class="row">
	                  				<div class="col-sm-4 border-right">
	                    				<div class="description-block">
	                      					<h5 class="description-header bg-danger">{user.3,200}</h5>
	                      					<span class="description-text">Asked Questions</span>
	                    				</div>
	                  				</div>
	                  				<div class="col-sm-4 border-right">
	                    				<div class="description-block">
	                      					<h5 class="description-header bg-warning">{user.3,200}</h5>
	                      					<span class="description-text">Answered Questions</span>
	                    				</div>
	                  				</div>
	                  				<div class="col-sm-4">
	                    				<div class="description-block">
	                      					<h5 class="description-header bg-success">{user.3,200}</h5>
	                      					<span class="description-text">Rating</span>
	                    				</div>
	                  				</div>
	                  			</div>
	                  		</div>
	                  	</div>
	                </div>
				`);
			}else{
				$('#quizbox').html(`
					<div class="col-md-4">
	            		<div class="card card-widget widget-user shadow">
	                        <div class="widget-user-header bg-info">
	                			<h3 class="widget-user-username">${user.username}</h3>
	              			</div>
	              			<div class="widget-user-image">
	                			<img class="img-circle elevation-2" src="../../dist/img/user-default.jpg" alt="${user.username}'s Profile Pic">
	              			</div>
	              			<div class="card-footer">
	                			<div class="row">
	                  				<div class="col-sm-4 border-right">
	                    				<div class="description-block">
	                      					<h5 class="description-header bg-danger">{user.3,200}</h5>
	                      					<span class="description-text">Asked Questions</span>
	                    				</div>
	                  				</div>
	                  				<div class="col-sm-4 border-right">
	                    				<div class="description-block">
	                      					<h5 class="description-header bg-warning">{user.3,200}</h5>
	                      					<span class="description-text">Answered Questions</span>
	                    				</div>
	                  				</div>
	                  				<div class="col-sm-4">
	                    				<div class="description-block">
	                      					<h5 class="description-header bg-success">{user.3,200}</h5>
	                      					<span class="description-text">Rating</span>
	                    				</div>
	                  				</div>
	                  			</div>
	                  		</div>
	                  	</div>
	                </div>
				`);
			}
		});
	} catch (err) {
		console.error(err)
	}

}


$('#submit').on('click', function(){
	$('#search').classList.toggle("active");
  $('#search').focus();
  $('#submit').classList.toggle("active");
  $('#search').html("");    
})
$('#search').on('keyup', function(){
  let keyword = $('#search').val();  
  if(keyword!=""){
    $('#search').addClass("active");
  }else{
    $('#search').removeClass("active");
  }
  $.ajax({
  	url: '',
  	method: "POST",
  	data: {keyword:keyword},
  	success: function(response){
  		$('#row').html("");
  	}

  });
})
async function logout(id){
	const doLogout = async () => {
	  	try{
			const results = await $.ajax({
										url: 'http://localhost/ulizaflow/backend/auth/logout/?endSession='+id,
										type: "GET",
										dataType: "text"
									});
			return results;		
			} catch (err) {
				console.error(err)
			}
	}
	doLogout().then(data => {
			let response = data
			if(response == "User Logged Out"){
	    	window.location = 'http://localhost/ulizaflow/'
	    }else{
	    	Toast.fire({
			    icon: 'error',
			    title: response
			  });
	    }
	})
}