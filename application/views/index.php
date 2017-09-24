<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<title>Task</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<h1 class="text-center">Tasks</h1>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-sm-12" id="message2"></div>
			<div class="col-sm-12" style="padding-bottom: 5px;">
				<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#createModel">
					<span class="glyphicon glyphicon-plus"></span>&emsp;Create Task
				</button>
			</div>
		</div>
		<table class="table table-striped" style="border: 1px solid black;">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Date Created</th>
					<th>Date Updated</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody id="tableBody">
				<?php foreach($tasks as $task): ?>
					<tr id="tsk_<?= $task->id ?>">
						<td class="task_name"><?= $task->name ?></td>
						<td class="task_desc"><?= $task->description ?></td>
						<td class="date_created"><?= $task->date_created ?></td>
						<td class="date_updated"><?= $task->date_updated ?></td>
						<td>
							<button class="btn btn-primary edit_task" data-id="<?= $task->id ?>" data-toggle='modal' data-target='#editModel'>Edit</button>
							<button class="btn btn-danger delete_task" data-id="<?= $task->id ?>" data-toggle="modal" data-target="#deleteModel">x</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="col-xs-12 text-center h3" id="table_status"><?= count($tasks) > 0 ? '' : 'No Tasks' ?></div>
	</div>

<!-- Create Task Modal -->
<div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">
					Create Task
				</h4>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<form role="form" id="taskForm">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Task Name"/>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" id="description" name="description" placeholder="Task Description"></textarea>
					</div>
				</form>
				<div id="message1">
				</div>
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" id="create_task" class="btn btn-success">
					Create Task
				</button>
			</div>
		</div>
	</div>
</div>	

<!-- Edit Task Modal -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">
					Edit Task
				</h4>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<form role="form" id="editTaskForm">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="m_task_name" name="name" placeholder="Task Name"/>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" id="m_task_description" name="description" placeholder="Task Description"></textarea>
					</div>
					<input type="hidden" id="m_task_id" name="task_id">
				</form>
				<div id="message1">
				</div>
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<button type="button" id="update_task" class="btn btn-success">
					Update Task
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Delete Task Modal -->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					Create Task
				</h4>
			</div>

			<!-- Modal Body -->
			<div class="modal-body">
				<p>Are you sure you want to delete the selected Task?</p>
			</div>
			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
				<button type="button" id="del_btn" class="btn btn-danger">
					Delete
				</button>
			</div>
		</div>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>

	$(function(){

		/* The following function inserts a new task on click */
		$('#create_task').on('click', function(e){
			e.preventDefault();
			var formData = $("#taskForm").serialize();
			$.ajax({
				type: 'post',
				url: 'crud/create_task',
				data: formData
			}).then(function(res){
				if(res.type == 'success'){
					appendRow(res.message);
					$("#message2").html("<div class='alert alert-success' id='success-alert'>Task "+res.message.name+" created Successfully!</div>");
					$("#taskForm").get(0).reset();
					$('#createModel').modal('toggle');
					hideAlert("#success-alert");
				} else{
					$("#message1").html("<div class='alert alert-danger'>"+res.message+"</div>");
				}
			}, function(){
				alert('Sorry! Some Error Occured');
			})
		});

		$('#tableBody').on('click', '.edit_task', function(e){
			e.preventDefault();
			var rowId = $(this).data('id');
			var name = $('#tsk_'+rowId).find('.task_name').text();
			var desc = $('#tsk_'+rowId).find('.task_desc').text();
			$("#editTaskForm").find('#m_task_id').val(rowId);
			$("#editTaskForm").find('#m_task_name').val(name);
			$("#editTaskForm").find('#m_task_description').val(desc);
		});

		/* The following function Updates the Selected Task */
		$('#update_task').on('click', function(e){
			e.preventDefault();
			var formData = $("#editTaskForm").serialize();
			$.ajax({
				type: 'post',
				url: 'crud/update_task',
				data: formData
			}).then(function(res){
				if(res.type == 'success'){
					updateRow(res.message);
					$("#message2").html("<div class='alert alert-success' id='success-alert'>Task "+res.message.name+" updated Successfully!</div>");
					$("#editTaskForm").get(0).reset();
					$('#editModel').modal('toggle');
					hideAlert("#success-alert");
				} else{
					$("#message1").html("<div class='alert alert-danger'>"+res.message+"</div>");
				}
			}, function(){
				alert('Sorry! Some Error Occured');
			})
		});



		$('#tableBody').on('click', '.delete_task', function(e){
			e.preventDefault();
			var id = $(this).data('id');
			$('#deleteModel #del_btn').data('id', id);
		});

		$('#del_btn').click(function(e){
			e.preventDefault();
			var id = $(this).data('id');
			$('#deleteModel').modal('toggle');
			$.ajax({
				type: 'post',
				url: 'crud/delete_task',
				data: {'id': id}
			}).then(function(res){
				if(res.type == 'success'){
					$("#message2").html("<div class='alert alert-success' id='success-alert'>Task deleted Successfully!</div>");
						$('#tsk_'+id).remove();
					hideAlert("#success-alert");
				} else{
					$("#message2").html("<div class='alert alert-danger' id='success-alert'>Cannot Delete the Task!</div>");
					hideAlert("#success-alert");
				}
			}, function(){
				alert('Sorry! Some Error Occured');
			})
		});
		
		function appendRow(message){
			$('#tableBody').append([
				"<tr id='tsk_"+message.id+"'>", 
					"<td class='task_name'>"+message.name+"</td>",
					"<td class='task_desc'>"+message.description+"</td>",
					"<td class='date_created'>"+message.date_created+"</td>",
					"<td class='date_updated'>"+message.date_updated+"</td>",
					"<td>",
					"<button class='btn btn-primary edit_task' data-id='"+message.id+"' data-toggle='modal' data-target='#editModel'>Edit</button>&nbsp;",
					"<button class='btn btn-danger delete_task' data-id='"+message.id+"' data-toggle='modal' data-target='#deleteModel'>x</button>",
					"</td>",
				"</tr>"].join('')
			);
		}		

		function updateRow(message){
			var row = $('#tableBody').find('#tsk_' + message.id);
			row.find('.task_name').text(message.name);
			row.find('.task_desc').text(message.description);
			row.find('.date_created').text(message.date_created);
			row.find('.date_updated').text(message.date_updated);
		}

		function hideAlert(id){
				$(id).fadeTo(2000, 500).slideUp(500, function(){
					$(id).slideUp(500);
				});
		}

		$('#tableBody').bind('DOMSubtreeModified', function(e) {
		  if ($("#tableBody > tr").length > 0) {
		  	$("#table_status").text('');
		  } else{
		    $("#table_status").text('No Tasks');
		  }
		});


	});

</script>
</body>
</html>