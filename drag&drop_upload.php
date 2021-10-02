<?php   

 $output = '';
 if(isset($_FILES['file']['name'][0]))
 {

      foreach($_FILES['file']['name'] as $keys => $values)
      {
           if(move_uploaded_file($_FILES['file']['tmp_name'][$keys], 'uploads/' . $values))
           {
                $output .= '<div class=col-md-3"><img src="uploads/'.$values.'" class="img-responsive" /></div>';
           }
      }
 }
 echo $output;
 ?>
