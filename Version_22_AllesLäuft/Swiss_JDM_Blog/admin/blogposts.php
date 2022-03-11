<?php
require_once('../includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('../includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('../includes/functions.inc.php'); // functions which refers to session_init() and session_check()

// ----- Users are allowed to see this content when they're logged in ONLY ----- //
session_init();
// $usertype = $_POST["admin_usertype"];
$isLoggedIn = sessioncheck();
  if($isLoggedIn == false){ 
    // if($usertype !== 1)
	// schüztt dieses Script vor Zurgriff ohne Login
	header("location: ../admin/login.php"); 
	exit;
  }
  // --x-- Users are allowed to see this content when they're logged in ONLY --x-- // 
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include('html/start-logout.php'); // Use of the html admin folder ?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->


<section id="admin-control">
  <div class="table-container">
    <h1 class="heading">Published Blogposts</h1>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Release Date</th>
          <th>Author</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="ID">1 Jan 2021</td>
          <td data-label="Title">09:00 - 13:00</td>
          <td data-label="Release Date">Weekend</td>
          <td data-label="Author">Online Training</td>
          <td data-label="Edit"><a class="admin-btn-edit" href="tellyourstory.php?task=edit&id=<?php echo $datapieces['IDblogpost']; ?>"><i class="fas fa-edit"></i></a></td>
          <td data-label="Delete"><a class="admin-btn-delete" href="tellyourstory.php?task=delete&id=<?php echo $datapieces['IDblogpost']; ?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
      </tbody>
    </table>
    <div class="returnfield">
      <a href="../admin/index.php" name="return" class="btn-return">Return</a>
    </div>
  </div>
</section>


<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include('html/end-clean-end.php'); // Use of the html admin folder ?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->