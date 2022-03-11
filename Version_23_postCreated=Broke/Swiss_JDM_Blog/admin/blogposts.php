<?php
require_once('../includes/config.php');        // Serverconfiguration that apply to the whole project
require_once('../includes/mysql-connect.php'); // Initializing the mysql database connection
require_once('../includes/functions.inc.php'); // functions which refers to session_init() and session_check()

// ----- Users are allowed to see this content when they're logged in ONLY ----- //
session_init();
// $usertype = $_POST["admin_usertype"];
$isLoggedIn = sessioncheck();
if ($isLoggedIn == false) {
  // if($usertype !== 1)
  // schüztt dieses Script vor Zurgriff ohne Login
  header("location: ../admin/login.php");
  exit;
}
// --x-- Users are allowed to see this content when they're logged in ONLY --x-- // 
$hasError = false;
$errorMsg = array();



if (isset($_GET['task']) && isset($_GET['id']) && $_GET['task'] == 'delete') {
  $articleID = $_GET['id'];

  if ($articleID > 0) {
    $getquery = "DELETE FROM blogpost WHERE IDblogpost=" . $articleID;
    if ($res = mysqli_query($conn, $getquery)) {
      $successMsg = 'Blogpost is successfully deleted!';
    }
  }
}

// Daten auslesen
$getquery = "SELECT * FROM blogpost ORDER BY post_created DESC";
$res = mysqli_query($conn, $getquery);
$data = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>

<!---------- Header + Navigation -------------------------------------------------------------------------------------------->
<?php include('html/start-logout.php'); // Use of the html admin folder 
?>
<!-----x---- Header + Navigation ----x--------------------------------------------------------------------------------------->


<section id="admin-control">

  <div class="table-container">

  <?php if (isset($successMsg)) { ?>
    <div class="successfulpublish">
      <p><i class="fas fa-trash-alt"></i> <?php echo $successMsg; ?></p>
    </div>
  <?php } ?>

    <h1 class="heading">Published Blogposts</h1>
    <div class="informationzone">
      <h2 class="info">
        <i class="fas fa-exclamation-triangle"></i> Editing a post will kick you out of the admin session. You will therefore take on a user role. <br>
        <i class="fas fa-exclamation-triangle"></i> Be warned: when it comes to deleting, there is no way back!
      </h2>
    </div>
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
        <?php if (isset($data) && count($data) > 0) { ?>
          <?php foreach ($data as $datapieces) { ?>
            <tr>
              <td data-label="ID"><?php echo $datapieces['IDblogpost']; ?></td>
              <td data-label="Title"><?php echo $datapieces['post_title']; ?></td>
              <td data-label="Release Date"><?php echo $datapieces['post_created']; ?></td>
              <td data-label="Author"><?php echo $datapieces['post_author']; ?></td>
              <td data-label="Edit"><a class="admin-btn-edit" href="../tellyourstory.php?task=edit&id=<?php echo $datapieces['IDblogpost']; ?>"><i class="fas fa-edit"></i></a></td>
              <td data-label="Delete"><a class="admin-btn-delete" href="blogposts.php?task=delete&id=<?php echo $datapieces['IDblogpost']; ?>"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
          <?php } ?>
        <?php } ?>
      </tbody>
    </table>
    <div class="returnfield">
      <a href="../admin/index.php" name="return" class="btn-return">Return</a>
    </div>
  </div>
</section>


<!------------ footer ----------------------------------------------------------------------------------------------------->
<?php include('html/end-clean-end.php'); // Use of the html admin folder 
?>
<!-----x---- footer ----x-------------------------------------------------------------------------------------------------->