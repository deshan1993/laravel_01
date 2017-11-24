<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register Page</title>
  </head>
  <body>
    <h1>Registeration Form</h1>
    <form class="" action="" method="post">
      {{ csrf_field() }}

      <!-- <label for="id">ID :</label>
      <input type="text" name="" value=""><br><br> -->

      <label for="id">Name :</label>
      <input type="text" name="name" value=""><br><br>

      <label for="id">Email :</label>
      <input type="email" name="email" value=""><br><br>

      <label for="id">Status :</label>
      <input type="radio" name="status" value="1">Enable
      <input type="radio" name="status" value="0">Disable<br><br>

      <label for="id">Deleted :</label>
      <input type="radio" name="delete" value="1">Yes
      <input type="radio" name="delete" value="0">No<br><br>

      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
