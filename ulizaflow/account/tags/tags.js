async function loadData () {
	try{
		const url = 'http://localhost/ulizaflow/backend/account/?allCategories';
		const results = await fetch(url)
		const finalData = await results.json()
		finalData.forEach((category) => {
			$('#row').append(`
				<div class="col-lg-3 col-6">
            		<div class="small-box bg-info">
              			<div class="inner">
                			<h3>${category.category_name}</h3>
                			<p>${category.category_description}</p>
              			</div>
		              	<div class="icon">
		                	<i class="ion ion-bag"></i>
		              	</div>
              			<a onclick="fetchThread(${category.category_id})" class="small-box-footer">View Thread <i class="fas fa-arrow-circle-right"></i></a>
            		</div>
          		</div>
			`);
		});
	} catch (err) {
		console.error(err)
	}
}
loadData()

async function fetchThread(key) {
	let id = key;
	try{
		const url = 'http://localhost/ulizaflow/backend/account/thread/?fetchAll='+id;
		const results = await fetch(url)
		const finalData = await results.json()
		$('#askbox').append(`
			&nbsp;
			<a href="../tags/" type="button" class="btn btn-outline-info" >Back</a>
		`);
		$('#row').html(`
			<div class="col-md-8" id="quizbox">
        		<div class="timeline" id="timeline"></div>
      		</div>
      	`);
      	if(finalData == "None"){
      		$('#timeline').html(`
				<div>
            		<i class="fas fa-info bg-info"></i>
            		<div class="timeline-item">
              			<h3 class="timeline-header no-border">No Questions so far :) </h3>
              		<div class="timeline-body">Be the first one to ask a question.</div>
            	</div>
	    	`);
      	}else{
      		finalData.forEach((question) => {
      			if(question.status == 0){
      				$('#timeline').append(`
						<div>
			      			<i class="fas fa-envelope bg-blue"></i>
			      			<div class="timeline-item">
						  		<span class="time"><i class="fas fa-clock"></i> ${question.date_posted}</span>
						  		<h5 class="timeline-header"><a href="?q=${question.thread_id}">${question.thread_title}</a></h5>
							</div>
			    		</div>
			    	`);
      			}else{
      				$('#timeline').append(`
						<div>
			      			<i class="fas fa-lock bg-danger"></i>
			      			<div class="timeline-item">
						  		<span class="time"><i class="fas fa-clock"></i> ${question.date_posted}</span>
						  		<h5 class="timeline-header"><a href="?q=${question.thread_id}">${question.thread_title}</a></h5>
							</div>
			    		</div>
			    	`);
      			}
			});
		}
	} catch (err) {
		console.error(err)
	}
}
async function openQuiz(id) {
	try{
		const url = 'http://localhost/ulizaflow/backend/account/thread/?existing='+id;
		const results = await fetch(url)
		const finalData = await results.json()
		$('#askbox').append(`
			&nbsp;
			<a href="../tags/" type="button" class="btn btn-outline-info" >Back</a>
		`);
		$('#row').html(`
			<div class="col-md-8" id="quizbox"></div>
      	`);
		finalData.forEach((val) => {
			if(val.status == 0){
				$('#quizbox').html(`
				<div class="col-sm-12">
					<div class="card card-primary">
					  <div class="card-header">
					    <h5 class="card-title">${val.thread_title}</h5>
					    <div class="card-tools">
			                <span class="badge">Asked by <a href="#">${val.username}</a> on ${val.date_posted}</span>                      
			              </div>
						  </div>
						  <div class="card-body">
						    ${val.thread_desc}
						  </div>
						  <div class="card-footer">
						    <button type="button" class="btn btn-warning btn-sm" onclick="answer()">Answer</button>
						    <button type="button" class="btn btn-primary btn-sm" onclick="comment()">Add Comment</button>
						  </div>
						</div><br>
						<div class="card card-primary" id="answerbox">
							<form class="form-validate-summernote" method="POST" id="giveAnswer">
								<div class="card-body">
							        <div class="form-group">
							          <label>My Answer</label>
							          <textarea class="summernote" required="required" data-msg="Please write something :)" id="my_answer" name="my_answer"></textarea>
							        </div>
							        <input type="hidden" id="quiz_id" name="quiz_id" value="${val.thread_id}" >
						            <input type="hidden" id="user_id" name="user_id" value="${val.user_id}">
							    </div>				        
					            <div class="card-footer">
					            	<div class="form-group">
				                  		<a id="postAnswer" class="btn btn-primary">Submit</a>
				                  	</div>
				                </div>
						    </form>							
				        </div><br>
						<div class="card card-primary" id="commentbox">
							<form class="form-validate-summernote" method="POST" id="makeComment">
								<div class="card-body">
							        <div class="form-group">
							          <label>My Comment</label>
							          <textarea class="summernote" required="required" data-msg="Please write something :)" id="my_answer" name="my_answer"></textarea>
							        </div>
							        <input type="hidden" id="quiz_id" name="quiz_id" value="${val.thread_id}" >
						            <input type="hidden" id="user_id" name="user_id" value="${val.user_id}">
							    </div>				        
					            <div class="card-footer">
					            	<div class="form-group">
				                  		<a id="postComment" class="btn btn-primary">Submit</a>
				                  	</div>
				                </div>
						    </form>
							
				        </div>
			        </div>
				`);
			}else{			
				$('#quizbox').html(`
					<div class="col-sm-12">
						<div class="card card-primary">
						  	<div class="card-header">
						    	<h5 class="card-title">${val.thread_title}</h5>
						    	<div class="card-tools">
	                				<span class="badge">Asked by <a href="#">${val.username}</a> on ${val.date_posted}</span>                      
	              				</div>
						  	</div>
						  	<div class="card-body">
						    	${val.thread_desc}
						  	</div>
						  	<div class="card-footer">
						    	<button type="button" class="btn btn-warning btn-sm" title="This Thread was closed" disabled>Answer</button>
						    	<button type="button" class="btn btn-primary btn-sm" onclick="comment()">Add Comment</button>
						  	</div>
						</div><br>
						<div class="card card-primary" id="commentbox">
							<form class="form-validate-summernote" method="POST" id="makeComment">
								<div class="card-body">
							        <div class="form-group">
							          <label>My Comment</label>
							          <textarea class="summernote" required="required" data-msg="Please write something :)" id="my_answer" name="my_answer"></textarea>
							        </div>
							        <input type="hidden" id="quiz_id" name="quiz_id" value="${val.thread_id}" >
						            <input type="hidden" id="user_id" name="user_id" value="${val.user_id}">
							    </div>				        
					            <div class="card-footer">
					            	<div class="form-group">
				                  		<a id="postComment" class="btn btn-primary">Submit</a>
				                  	</div>
				                </div>
						    </form>							
				        </div>
			        </div>
				`);
			}
		});
		$('#answerbox').hide()
		$('#commentbox').hide()
		$(function () {
			let summernoteElement = $('.summernote');
			summernoteElement.summernote({
		        height: 300,
		        callbacks: {
		            onChange: function (contents, $editable) {
		                summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);
		                summernoteValidator.element(summernoteElement);
		            }
		        }
		    });
			$('#postAnswer').click(function(){
				let formData = $('#giveAnswer').serializeArray()
			    $.ajax({
				    url: 'uliza.php',
				    type: "POST",
				    data: formData, 
				    cache: false,
				    success: function(response){
				    	if (response == "OK"){
							Toast.fire({
					        icon: 'success',
					        title: 'Your Answer has been Posted.'
					      })
						}else{
							Toast.fire({
					        icon: 'error',
					        title: 'Failed to post your answer..Try Again.'
					      })

						}
				    }
				});
			    return false;
			})
			$('#postComment').click(function(){
				let formData = $('#makeComment').serializeArray()
				$.ajax({
				    url: 'uliza.php',
				    type: "POST",
				    data: formData, 
				    cache: false,
				    success: function(response){
				    	if (response == "OK"){
							Toast.fire({
					        icon: 'success',
					        title: 'Your Comment has been Posted.'
					      })
						}else{
							Toast.fire({
					        icon: 'error',
					        title: 'Failed to post your comment..Try Again.'
					      })

						}
				    }
				});
				return false;
			})
		    var summernoteForm = $('.form-validate-summernote');
		    
		    var summernoteValidator = summernoteForm.validate({
		        errorElement: "div",
		        errorClass: 'is-invalid',
		        validClass: 'is-valid',
		        ignore: ':hidden:not(.summernote),.note-editable.card-block',
		        errorPlacement: function (error, element) {
		            // Add the `help-block` class to the error element
		            error.addClass("invalid-feedback");
		            if (element.prop("type") === "checkbox") {
		                error.insertAfter(element.siblings("label"));
		            } else if (element.hasClass("summernote")) {
		                error.insertAfter(element.siblings(".note-editor"));
		            } else {
		                error.insertAfter(element);
		            }
		        },/*
		        submitHandler: function (form) {	
		        	console.log(form)
			    if(formType == "giveAnswer"){
			    	let form = $('#giveAnswer').serializeArray()
			    }else if(formType == "makeComment"){
			    	let form = $('#makeComment').serializeArray()
			    }
			    //console.log(form)
			    $.ajax({
				    url: 'uliza.php',
				    type: "POST",
				    data: form, 
				    cache: false,
				    success: function(response){
				    	console.log(response)
				    	return false;
				    }
				});
				return false;
			  }*/
		    });

		});
	} catch (err) {
		console.error(err)
	}
	
}

function answer() {	
	$('#answerbox').toggle();
	$('#commentbox').hide()
}
function comment() {	
	$('#commentbox').toggle();
	$('#answerbox').hide()
}
async function checkQuestion() {
	let value = $('#title').val()
	const url = 'http://localhost/ulizaflow/backend/account/thread/?userProfile='+value;
	const docheck = async () => {
	  	try{
			const results = await $.ajax({
									    	url: 'http://localhost/ulizaflow/backend/account/thread/?checktitle',
									    	type: "POST",
									    	data: {
									    		value:value
									    	}
										});
			return results;		
		} catch (err) {
			console.error(err)
		}
	}
	docheck().then(data => {
			let response = data
			if (response == 'OK') {
	    		$('#title').removeClass('is-invalid');
	    		$('#titleHelp').html("Keep the title as simple as possible.");
	    		$('#desc').html(`
	    			<label for="description">Question Description</label>
	          		<textarea type="text" class="form-control" id="description" name="description" rows="3" placeholder="Enter a description of your problem"></textarea> 
	          	`);
	          	$('#postQuestion').prop('disabled', false);
	    	}else{
	    		$('#title').addClass('is-invalid');
	    		$('#titleHelp').html("")
		      	$('#desc').html(`
		      		<p>A similar thread already exists <a class="btn btn-block btn-primary btn-sm" href="?q=${response.thread_id}">check it out</a> or restructure your question<p> 
		      	`);
		    	$('#postQuestion').prop('disabled', true);				
		    }
	});	
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
  		$('#row').append(`
			<div class="col-lg-3 col-6">
	        	<div class="small-box bg-info">
	          		<div class="inner">
	            		<h3>${category.category_name}</h3>
	            		<p>${category.category_description}</p>
	          		</div>
	          		<div class="icon">
	            		<i class="ion ion-bag"></i>
	          		</div>
	          		<a onclick="fetchThread(${category.category_id})" class="small-box-footer">View Thread <i class="fas fa-arrow-circle-right"></i></a>
	        	</div>
	      	</div>
		`);
  	},
  	error:function(error){
  		console.error(error)
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