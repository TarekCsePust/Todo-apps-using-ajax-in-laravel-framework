<!DOCTYPE html>
<html>
<head>
	<title>ToDO List</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>
<body>
	<br>
	<br>
	
	<div class="container">
  		<div class="row">
  			<div class="col-lg-offset-3 col-lg-6">
	  			<div class="panel panel-default">
					<div class="panel-heading">
						Ajax Todo List
						<a href="#" class="pull-right" id="addNew" 
						data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i>
						</a>
					</div>
					<div class="panel-body" id="items">
					 	<ul class="list-group">
					 		 @foreach($items as $item)
					 		
							 <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">{{$item->item}}
							 	 <input type="hidden" id="item_id" value="{{$item->id}}">
							 </li>

							 @endforeach
							 
						</ul>
					</div>
				</div>
  			</div>
  			<div class="col-lg-2">
  				<input type="text" id="search" placeholder="Search" class="form-control">
  			</div>
  		</div>
	</div>

    <input type="hidden" id="id">
	<div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog">
    
      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title" id="title">Add New Item</h4>
	        </div>
	        <div class="modal-body">
	          <p><input type="text" placeholder="Write here" id="addItem" class="form-control"></p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal" style="display: none;" id="delete">Delete</button>
	           <button type="button" class="btn btn-primary" data-dismiss="modal" style="display: none;" id="savechanges">Save Changes</button>
	            <button type="button" class="btn btn-primary" data-dismiss="modal" id="AddItem">Add Item
		      	   </button>
	      	    </div>
		      	  
	      	    </div>
        </div>    
    </div>
  </div>

{{csrf_field()}}


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.ourItem').each(function(){
				$(this).click(function(){
					var text = $(this).text();
					var id = $(this).find('#item_id').val();
					var text = $.trim(text);
					$("#id").val(id);
					$("#addItem").val(text);
					$("#title").text("Edit Item");
					$("#delete").show();
					$("#savechanges").show();
					$("#AddItem").hide();
					console.log(id);
				});
			});

			$("#addNew").click(function(){
					var text = $(this).text();
					$("#addItem").val("");
					$("#title").text("Add New Item");
					$("#delete").hide();
					$("#savechanges").hide();
					$("#AddItem").show();
					console.log(text);
				});

			$("#AddItem").click(function(){
				var text = $("#addItem").val();
				if(text=="")
				{
					alert("Please type anything for item");
				}
				else
				{
					$.post('todo',{'text':text,'_token':$('input[name=_token]').val()},function(data){
					 //location.reload();
					$("#items").load(location.href + ' #items');
					console.log(data);
					//console.log(data["text"]);
					});
				}
				
				
			});

			$("#delete").click(function(){
				var id = $("#id").val();
				$.post('delete',{'id':id,'_token':$('input[name=_token]').val()},function(data){
					 location.reload();
					//$("#items").load(location.href + ' #items');
					//console.log(data);
					//console.log(data["text"]);
				});
				
			});

			$("#savechanges").click(function(){
				var text = $("#addItem").val();
				var id = $("#id").val();
				$.post('update',{'id':id,'text':text,'_token':$('input[name=_token]').val()},function(data){
					 location.reload();
					//$("#items").load(location.href + ' #items');
					//console.log(data);
					//console.log(data["text"]);
				});
				

			});

			  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#search" ).autocomplete({
      source: 'http://localhost:8000/search'
    });
  } );

			
			
		});
	</script>
</body>
</html>