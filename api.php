 <?php
    require 'vendor/autoload.php';
    
    $method = $_SERVER['REQUEST_METHOD'];
    $dir = __DIR__.'/db';

    $config = new \JamesMoss\Flywheel\Config($dir);
    $repo = new \JamesMoss\Flywheel\Repository('posts', $config);
    
    switch($method) {
        case 'GET':
            $comments = $repo->query()
                ->orderBy('dateAdded ASC')
                ->limit(10,0)
                ->execute();
            $array = [];
            foreach($comments as $comment) {
                array_push($array, ['nick' => $comment->nick, 'message' => $comment->message, 'date' => $comment->dateAdded]);
            }
            $response = json_encode($array);
            echo $response;
            break;

        case 'POST':
            if((isset($_POST['nick']) && !empty($_POST['nick'])) && (isset($_POST['message']) && !empty($_POST['message']))) {
                $date = new DateTime();
                $date = date_format($date, 'Y-m-d H:i:s');
                $post = new \JamesMoss\Flywheel\Document(array(
                    'nick'      => $_POST['nick'],
                    'message'   => $_POST['message'],
                    'dateAdded' => $date               
                ));
                $repo->store($post);
                response(200, "Comment added");
            } else {
                response(404, "Invalid input");
            }
            break;
        case 'DELETE':
                $comments = $repo->query()->execute();
                foreach($comments as $comment) {
                     $repo->delete($comment->getId());
                }
            break;
        default:
            response(405, "Method not allowed");
    }
    
    function response($status, $message) {
        header("HTTP/1.1 $status $message");
        $response['status'] = $status;
        $response['message'] = $message;
        $json_response = json_encode($response);
        echo $json_response;
    }

?>    
