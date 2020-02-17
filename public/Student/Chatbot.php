<?php
    require_once( dirname(__FILE__, 3) . "\logic\Student\Chatbot_Methods.php");
?>

<html>
  <head>
	<title>Student - Chatbot</title>
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Student.css">
  </head>
  <body>
	<div class="sidebar">
	  <a class="active" href="stu-chatbot.php">Use the Chatbot</a>
	  <a href="stu-addCourse.php">Add a Class</a>
	  <a class="bottom" href="user-logout.php">Logout</a>
	</div>
	
	<div class="content">
	  <iframe
		allow="microphone;"
		src="https://console.dialogflow.com/api-client/demo/embedded/b14732c6-8cd0-4592-af6c-e160574569ae">
	  </iframe>
	</div>
  </body>
</html>