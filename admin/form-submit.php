<?

include('config.php');

// form was submitted
if (!empty($_POST) && !$_POST['password']){

  if( $_POST['api-key'] !== $codame_api_key ){
    echo "Permission denied.";
    die;
  }

  $table        = $_POST['table'];
  $name         = $_POST['name'];
  $slug         = to_slug($name);
  $now          = time();
  $original_pic = $_POST['pic'];

  // upload picture
  $pic = upload_image( $_FILES['pic'], $slug );

  // echo $pic;

  // die;

  if( !$pic ){
    $pic = $original_pic;
  } 

  // add a row
  if( $_POST['action'] == 'add' ){

    // check if a post exists with this slug
    $existing_amount = get_amount_of_results($table,'slug',$slug);
    
    if( $existing_amount == 0 ){
      
      // event row
      if( $table == 'events' ){
        $row_array = array(
          'name'           => $name,
          'slug'           => $slug,
          'date'           => $_POST['date'],
          'pic'            => $pic,
          'description'    => $_POST['description'],
          'artists_array'  => $_POST['artists-array'],
          'projects_array' => $_POST['projects-array'],
          'old_url'        => $_POST['old-url']
        );
      }

      // artist row
      if( $table == 'artists' ){
        $row_array = array(
          'name'        => $name,
          'slug'        => $slug,
          'pic'         => $pic,
          'description' => $_POST['description'],
          'twitter'     => $_POST['twitter'],
          'website'     => $_POST['website'],
          'email'       => $_POST['email'],
          'old_url'     => $_POST['old-url'],
          'edited'      => $now
        );
      }

      // project row
      if( $table == 'projects' ){
        $row_array = array(
          'name'          => $name,
          'slug'          => $slug,
          'pic'           => $pic,
          'description'   => $_POST['description'],
          'twitter'       => $_POST['twitter'],
          'website'       => $_POST['website'],
          'artists_array' => $_POST['artists-array'],
          'old_url'       => $_POST['old-url'],
          'edited'        => $now
        );
      }

      // page row
      if( $table == 'pages' ){
        $row_array = array(
          'name'          => $name,
          'slug'          => $slug,
          'pic'           => $pic,
          'description'   => $_POST['description'],
          'old_url'       => $_POST['old-url']
        );
      }

      insert_row($table, $row_array);

    }else{
      $error = "A post with this name already exists.";
    }

  }

  // edit row
  if( $_POST['action'] == 'edit' ){

    $old_slug = $_POST['slug'];

    // event row
    if( $table == 'events' ){
      $row_array = array(
        'name'           => $name,
        'slug'           => $slug,
        'date'           => $_POST['date'],
        'pic'            => $pic,
        'description'    => $_POST['description'],
        'artists_array'  => $_POST['artists-array'],
        'projects_array' => $_POST['projects-array'],
        'old_url'        => $_POST['old-url']
      );
    }

    // artist row
    if( $table == 'artists' ){
      $row_array = array(
        'name'        => $name,
        'pic'         => $pic,
        'description' => $_POST['description'],
        'twitter'     => $_POST['twitter'],
        'website'     => $_POST['website'],
        'email'       => $_POST['email'],
        'slug'        => $slug,
        'old_url'     => $_POST['old-url'],
        'edited'      => $now
      );
    }

    // project row
    if( $table == 'projects' ){
      $row_array = array(
        'name'          => $name,
        'slug'          => $slug,
        'pic'           => $pic,
        'description'   => $_POST['description'],
        'twitter'       => $_POST['twitter'],
        'website'       => $_POST['website'],
        'artists_array' => $_POST['artists-array'],
        'old_url'       => $_POST['old-url'],
        'edited'      => $now
      );
    }

    // page row
    if( $table == 'pages' ){
      $row_array = array(
        'name'          => $name,
        'slug'          => $slug,
        'pic'           => $pic,
        'description'   => $_POST['description'],
        'old_url'       => $_POST['old-url']
      );
    }

    foreach ($row_array as $key => $value) {
      update_field($table,'slug',$old_slug,$key,$value);
    }

  }

  // generate the sidebar links
  if( $table == 'pages' ){
    generate_sidebar_pages($site_url);
  }

  if( $error ){
    echo $error;
  }else{
    // die;
    echo "<script>location.href='$site_url/$table/$slug'</script>";  
  }  

}

?>