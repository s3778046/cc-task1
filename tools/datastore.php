<?php require './vendor/autoload.php'; ?>

<?php use Google\Cloud\Datastore\DatastoreClient;  ?>


<?php

function getAllUsers($kind) {

    # Instantiates a ne datastore client
    $datastore = new DatastoreClient([
      'projectId' => 'a1-task1-s3778046'
    ]);

    // Create query
    $query = $datastore->query()->kind($kind);

    // Run query
    $users = $datastore->runQuery($query);

    foreach ($users as $index => $user) {
        printf('ID: %s', $user['id']);
        printf(', USERNAME: %s', $user['user_name']);
        printf(', PASSWORD: %s', $user['password']);
      }
}

function entityIsUnique($kind, $property, $propertyValue) {

    # Instantiates a ne datastore client
    $datastore = new DatastoreClient([
        'projectId' => 'a1-task1-s3778046'
    ]);
  
    // Create query
    $query = $datastore->query()
    ->kind($kind)
    ->filter($property, '=', $propertyValue);

    // Run query
    $users = $datastore->runQuery($query);

    $count = 0;
    foreach ($users as $index => $user) {
    $count++;
    }

    if($count > 0) {
        return true;
    } else {
        return false;
    }
}



function addNewUser($id, $username, $password) {

     # Instantiates a ne datastore client
     $datastore = new DatastoreClient([
        'projectId' => 'a1-task1-s3778046'
    ]);

    $taskKey = $datastore->key('user');
    $user = $datastore->entity(
        $taskKey,
        [
            'id' => $id,
            'user_name' => $username,
            'password' => $password,
            
        ]
    );
    $datastore->insert($user);
}


function authLogin($id, $password){

         # Instantiates a ne datastore client
         $datastore = new DatastoreClient([
            'projectId' => 'a1-task1-s3778046'
        ]);

        // Create query
        $query = $datastore->query()
        ->kind('user')
        ->filter('id', '=', $id)
        ->filter('password', '=', $password);

        // Run query
        $users = $datastore->runQuery($query);

        $count = 0;
        foreach ($users as $index => $user) {
            $count++;
        }

        if($count > 0) {
            return true;
        } else {
            return false;
        }
}

function getUser($id) {
    # Instantiates a ne datastore client
    $datastore = new DatastoreClient([
        'projectId' => 'a1-task1-s3778046'
    ]);

    // Create query
    $query = $datastore->query()
    ->kind('user')
    ->filter('id', '=', $id);

    // Run query
    $user = $datastore->runQuery($query);

    return $user;
}

function addNewPost($subject, $message, $userId) {

    # Instantiates a ne datastore client
    $datastore = new DatastoreClient([
       'projectId' => 'a1-task1-s3778046'
   ]);

    // Current date and time
   $date = date("d/m/y");
   $time = date("h:i:sa");


   $taskKey = $datastore->key('post');
   $post = $datastore->entity(
       $taskKey,
       [
           'subject' => $subject,
           'message' => $message,
           'date' => $date,
           'time' => $time,
           'userid' => $userId,
       ]
   );
   $datastore->insert($post);
}


function getAllPosts($kind) {

    # Instantiates a ne datastore client
    $datastore = new DatastoreClient([
      'projectId' => 'a1-task1-s3778046'
    ]);

    // Create query
    $query = $datastore->query()->kind($kind);

    // Run query
    $posts = $datastore->runQuery($query);

    return $posts;
}







?>