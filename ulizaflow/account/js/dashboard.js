$("#submit").onclick(function(){
	$("#search").classList.toggle("active");
  $("#search").focus();
  $("#submit").classList.toggle("active");
  $("#search").html("");    
})
$("#search").onkeyup(function(){
  let keyword = $("#search").val();  
  if(keyword!=""){
    $("#search").addClass("active");
  }else{
    $("#search").removeClass("active");
  }
  $.ajax({
  	url: '',
  	method: "POST",
  	data: keyword:keyword,
  	success: function(response){
  		$("#row").html("");
  	}

  });
})


function fetchThread(key) {
	let id = key;
	const display = $('#row')
	const pageName = $('#page-name')
	$.ajax({
	    url: 'thread.php?fetchall',
	    type: "POST",
	    data: {
	        id:id,         
	    },
	    success: function(data){	    	
    		let thread = JSON.parse(data)
    		function readMore() {
	    		$('.timeline-body').html(` 
	    			<p><b>${thread.threadTitle}</b></p>
	    			<div>${thread.threadDesc}</div>
	    			`);
	    		$('.timeline-body').html(`
	    			<a class="btn btn-primary btn-sm" onclick="answerQuestion(${thread.threadId})">Provide Answer</a>
	    			`);
				}
	    	if (typeof thread.message !== 'undefined' && thread.message !== null) { 
	    		pageName.html(`<div class="col-sm-6">
		            <h1>${thread.categoryName} Thread</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="../account/">Home</a></li>
		              <li class="breadcrumb-item active" id="catName" data-id="${thread.categoryId}">${thread.categoryName}</li>
		            </ol>
		          </div>`);
	    		display.html(`<div class="container">
            <div class="text-right text-dark">
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#answer-question">Ask a Question</button>
            </div>
        </div><br>
        <div class="col-md-12">
		    		<div class="timeline" id="timeline"></div>
		    		</div>`);
	    		$('#timeline').html(`<div>
                <i class="fas fa-info bg-info"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header no-border">No Questions so far :) </h3>
                  <div class="timeline-body">Be the first one to ask a question.</div>
                </div>
              </div>`);
	    	}else{
		    	pageName.html(`<div class="col-sm-6">
		            <h1>${thread.categoryName} Thread</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="../account/">Home</a></li>
		              <li class="breadcrumb-item active" id="catName" data-id="${thread.categoryId}">${thread.categoryName}</li>
		            </ol>
		          </div>`);

		    	display.html(`<div class="container">
            <div class="text-right text-dark">
                <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#answer-question">Ask a Question</button>
            </div>
        </div><br>
		    		<div class="col-md-12">
		    		<div class="timeline" id="timeline"></div>
		    		</div>`);

		    	$('#timeline').html(`<div class="time-label">
		      <span class="bg-red">${thread.datePosted}</span>
		    </div>
		    <div>
		      <i class="fas fa-user bg-green"></i>
		      <div class="timeline-item">
  <h3 class="timeline-header"><a href="#">${thread.username}</a> posted a question.</h3>
  <div id="accordion">
  <div class="timeline-body">${thread.threadTitle}

<div id="collapseOne" class="collapse" data-parent="#accordion" style="">
  <div>${thread.threadDesc}</div>
</div>
  </div>
  <div class="timeline-footer">
    <a class="btn btn-primary btn-sm collapsed" data-toggle="collapse" id="readMore" href="#collapseOne" aria-expanded="false">Read more</a>
  </div>
</div>
</div>
		    </div>`);
		    }
		}
	});
}

function checkQuestion() {
	let value = $('#title').val()
	$.ajax({
	    url: 'http://localhost/ulizaflow/backend/account/thread/?userProfile='+value,
	    type: "GET",
	    success: function(response){
	    	console.log(response)
	    	if (response == 'OK') {
	    		$('#title').removeClass('is-invalid');
	    		$('#titleHelp').html("Keep the title as simple as possible.");
	    		$('#desc').html(`<label for="description">Question Description</label>
          <textarea type="text" class="form-control" id="description" name="description" rows="3" placeholder="Enter a description of your problem"></textarea>`)
          $('#postQuestion').prop('disabled', false);
	    	}else{
	    		let existingThread = JSON.parse(response)
	    		$('#title').addClass('is-invalid');
	    		$('#titleHelp').html("")
		      $('#desc').html(`<p>A similar thread (${existingThread.thread_title}) already exists <a class="btn btn-block btn-primary btn-sm" onclick="viewExisting(${existingThread.thread_id})">check it out</a> or restructure your question<p>`);
		      $('#postQuestion').prop('disabled', true);				
	    	}

	    }
	});
}

$.validator.setDefaults({
  submitHandler: function () {
    let form = $('#ulizaQuestion').serializeArray()
    let categoryId = $('#catName').attr('data-id')
    form.push({
    	"name":'category_id',
    	"value":categoryId
    });
    $.ajax({
	    url: 'uliza.php',
	    type: "POST",
	    data: form, 
	    success: function(response){
	    	console.log(response)
	    }
	});
  }
});
$('#ulizaQuestion').validate({
  rules: {
    title: {
      required: true
    },
    description: {
      required: true,
      minlength: 10
    },
  },
  messages: {
    title: {
      required: "Please provide a title for your question"
    },
    description: {
      required: "Please provide a description of your question",
      minlength: "Your description must be at least 10 characters long"
    }
  },
  errorElement: 'span',
  errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
  }
});

function viewExisting(id) {
	let threadId = id
	const display = $('#row')
	const pageName = $('#page-name')
	$.ajax({
    url: 'thread.php?existing',
    type: "POST",
    data: {
        id:id,         
    },
    success: function(data){
    	let thread = JSON.parse(data)
    	function readMore() {
    		$('.timeline-body').html(` 
    			<p><b>${thread.threadTitle}</b></p>
    			<div>${thread.threadDesc}</div>
    			`);
    		$('.timeline-body').html(`
    			<a class="btn btn-primary btn-sm" onclick="answerQuestion(${thread.threadId})">Provide Answer</a>
    			`);
			}
    	pageName.html(`<div class="col-sm-6">
		            <h1>${thread.threadTitle}</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="../account/">Home</a></li>
		              <li class="breadcrumb-item"><a href="#" onclick="fetchThread(${thread.categoryId})" >${thread.categoryName}</a></li>
		              <li class="breadcrumb-item active" id="catName" data-id="${thread.threadId}">${thread.threadTitle}</li>
		            </ol>
		          </div>`);  	
    	display.html(`<div class="container">
            <div class="text-right text-dark">
                <a class="btn btn-outline-info" onclick="fetchThread(${thread.categoryId})">Go Back</a>
            </div>
        </div><br>
		    		<div class="col-md-12">
		    		<div class="timeline" id="timeline"></div>
		    		</div>`);

		    	$('#timeline').html(`<div class="time-label">
		      <span class="bg-red">${thread.datePosted}</span>
		    </div>
		    <div>
		      <i class="fas fa-user bg-green"></i>
		      <div class="timeline-item">
  <h3 class="timeline-header"><a href="#">${thread.username}</a> posted a question.</h3>
  <div id="accordion">
  <div class="timeline-body">${thread.threadTitle}

<div id="collapseOne" class="collapse" data-parent="#accordion" style="">
  <div>${thread.threadDesc}</div>
</div>
  </div>
  <div class="timeline-footer">
    <a class="btn btn-primary btn-sm collapsed" data-toggle="collapse" id="readMore" href="#collapseOne" aria-expanded="false">Read more</a>
  </div>
</div>
</div>
		    </div>`);
		  $('#answer-question').modal('hide');
    }
	});
}

function answerQuestion(key) {
	let id = key;
	const display = $('#row')
	const pageName = $('#page-name')
	$.ajax({
	    url: 'answer.php',
	    type: "POST",
	    data: {
	        id:id,         
	    },
	    success: function(data){


	    }
	});
}

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