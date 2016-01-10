<?php 
if (!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{

  $name = $_SESSION['Username'];
  $message .= '<h1>Hello, ' . $name . ' </h1>';

  if ($_FILES)
  {
    $time = $_SERVER['REQUEST_TIME'];

    $file_name = $_FILES['upload']['name'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $file_size = $_FILES['upload']['size'];
    $file_error = $_FILES['upload']['error'];

    $file_ext = explode('.', $file_name);
    $file_begin = $file_ext[0];
    $file_ext = strtolower(end($file_ext));

    $file_name = $file_begin . '_' . $time . '.' . $file_ext;
    $file_destination = 'img';

    $allowed = array('jpg', 'png', 'GIF', 'SVG', 'TIFF');

    if(in_array($file_ext, $allowed))
    {
      if($file_error === 0)
      {
        if($file_size <= 2097152)
        {}

          if(isset($_POST['title']) && isset($_POST['text']))
          {
            $title = sanitizeString($db, $_POST['title']);
            $text = sanitizeString($db, $_POST['text']);

            $_css_filter = '';

            if ($_POST['filter'] == 'myNostalgia')
            {
              $_css_filter = "style='-webkit-filter:sepia(100%);filter:sepia(100%);'";
            }
            elseif ($_POST['filter'] == 'grayscale')
            {
              $_css_filter = "style='-webkit-filter:grayscale(100%);filter:grayscale(100%);'";
            }
            elseif ($_POST['filter'] == 'lomo')
            {
              $_css_filter = '';
            }

            move_uploaded_file($_FILES['upload']['tmp_name'], $file_destination . DIRECTORY_SEPARATOR . $file_name);
            SavePostToDB($db, $name, $title, $text, $time, $file_name, $_css_filter);

          }
        }
        else
        {
          $message = 'file too big';
        }
      }
      else
      {
        $message = 'file error';
      }
    }
  }
}
?>
