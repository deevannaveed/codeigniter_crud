Advnaced Codeigniter CRUD is a small Task CRUD.

Technologies used:
PHP
Codeigniter
MySql
jQuery
Bootstrap

How it works?

When you run the application you will see a screen with a list of tasks(loaded from database) and a Create Task button.
When you click the Create Task button it will show a Bootstrap Modal and prompt you to enter the name and description of the task, wehn you click Create Task button on the modal it will send an Ajax request to the server and add the Task to the database after Validation and also add a row containing the information returned from the server to show the added task on the list.
Each Task in the list have a Delete and Edit button, When you click the Edit button it will show a Bootstrap Modal populated with selected task data and a button Update Task which allows you to Update the Task in the database, when you click the Update task button an Ajax Request is sent to the server and the selected Task on the list is also updated if the server Responded with success(which means the Task was successfully stored in the database) else an error message is shwon. 
To delete a Task there is a Delete button at the end of each Task on the list and it will show a confirmation Modal and if you click delete on the modal the task will be Deleted from the Database on the server and also disappear from the list.
