<?php

class AjaxController extends Controller
{
    public function logoutAction(){
        $return = session_destroy();
        if ($return == true){
            echo json_encode(array("statusCode"=>200));
        }else {
            echo json_encode(array("statusCode"=>201));
        }
        die();
    }

    public function checkregisterAction(){
        
        $userModel = new User();
        //Vérification du login
        if(!empty($_POST['login_check'])){ 
        $login = $_POST['login_check'];
            // vérification sur la base de données
        $loginReturn = $userModel->checkLogin($login);
            if($loginReturn != FALSE){
                echo'Ce nom d\'utilisateur est déjà utilisé !';
                exit();
            } else {
                echo 'success';
                exit();
            }
        }
        //Vérification de l'email
        if(!empty($_POST['mail_check'])){
            $email = $_POST['mail_check'];
            //Vérifier l'adresse mail
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
                echo 'cette adresse email n\'est pas valide !';
                exit();
            }
            // vérification sur la base de données
            $emailReturn = $userModel->checkMail($email);
            if($emailReturn != FALSE){
                echo 'Cette adresse email est déjà utilisée !';
                exit();
            } else {
                echo 'success';
                exit();
            }
        }
    }

    public function CartaddAction(){
        $add = $this->_getParam('add');
        $remove = $this->_getParam('remove');

        $filmModel = new Movie();
        $film = $filmModel->fetchOne(($add)?$add:$remove);
        
        $quantity = (isset($_SESSION['user']['panier'][$film->id]))?
            $_SESSION['user']['panier'][$film->id]['quantité']:0;

        if($add != '')
            $_SESSION['user']['panier'][$film->id] = [
                'quantité' => $quantity + 1,
                'film' => $film
            ];

        if($remove != '')
        $_SESSION['user']['panier'][$film->id] = [
            'quantité' => $quantity - 1,
            'film' => $film
        ];
        if($_SESSION['user']['panier'][$film->id]['quantité'] == 0)
            unset($_SESSION['user']['panier'][$film->id]);
        die();
    }

    public function searchByAction(){
        
        // Affichage des catégories 
        $url = 'http://api.themoviedb.org/3/genre/movie/list?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR';
        $genres = UTILS::searchTMDB($url);
        foreach ($genres as $value)
        $this->view->categories = $value;

        if($this->_getParam('genre') != ''){
            $genre = $this->_getParam('genre');
            {
                $movies = new Movie();
                $order = 'name asc';
                $movies = $movies->fetchAll($order);
                $search = [];
                foreach ($movies as $movie){
                    $id = $movie->id_TMDb;
                    $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
                    $search[] = UTILS::searchTMDB($url);
                }
                $return = [];
                foreach($search as $value){
                    $this->view->test = $value;
                    foreach ($value->genres as $genre_cpr) {
                        if ($genre_cpr->name == $genre){
                            $id = $value->id;
                            $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
                            $return[] = UTILS::searchTMDB($url);
                        }
                    } 
                }
                $this->view->movies = $return;
                $this->view->disableLayout();
            }
        }elseif($this->_getParam('director') != ''){

            $director = $this->_getParam('director');
            {
                $movies = new Movie();
                $order = 'name asc';
                $movies = $movies->fetchAll($order);
                $search = [];
                foreach ($movies as $movie){
                    $id = $movie->id_TMDb;
                    $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
                    $search[] = UTILS::searchTMDB($url);
                }
                $return = [];
                foreach($search as $value){
                    $this->view->test = $value;
                    foreach ($value->credits->crew as $result) {
                        if($result->job == 'Director'){
                            if ($result->name == $director){
                                $id = $value->id;
                                $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
                                $return[] = UTILS::searchTMDB($url);
                            }
                        }
                    } 
                }
                $this->view->movies = $return;
                $this->view->disableLayout();
            }
        }elseif($this->_getParam('actor') != ''){

            $actor = $this->_getParam('actor');
            {
                $movies = new Movie();
                $order = 'name asc';
                $movies = $movies->fetchAll($order);
                $search = [];
                foreach ($movies as $movie){
                    $id = $movie->id_TMDb;
                    $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
                    $search[] = UTILS::searchTMDB($url);
                }
                $return = [];
                foreach($search as $value){
                    $this->view->test = $value;
                    foreach ($value->credits->cast as $result) {
                        if ($result->name == $actor){
                            $id = $value->id;
                            $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
                            $return[] = UTILS::searchTMDB($url);
                        }
                    } 
                }
                $this->view->movies = $return;
                $this->view->disableLayout();
            }
        }elseif($this->_getParam('title') != ''){

            $title = $this->_getParam('title');
            {
                $modelMovie = new Movie();
                $movies = $modelMovie->searchByTitle($title);
                $return = [];
                foreach ($movies as $movie){
                    $id = $movie->id_TMDb;
                    $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
                    $return[] = UTILS::searchTMDB($url);
                }
                $this->view->movies = $return;
                $this->view->disableLayout();
            }
        }else{

            $letter = $this->_getParam('letter');
            {
                $modelMovie = new Movie();
                $movies = $modelMovie->searchByLetter($letter);
                $return = [];
                foreach ($movies as $movie){
                    $id = $movie->id_TMDb;
                    $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
                    $return[] = UTILS::searchTMDB($url);
                }
                $this->view->movies = $return;
                $this->view->disableLayout();
            }
        }
    }
}