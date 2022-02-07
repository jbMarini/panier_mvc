<?php
class MovieController extends Controller
{
    public function addMovieAction(){
        $id = $this->_getParam('id_TMDb');
        $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
        $result = UTILS::searchTMDB($url);
        $this->view->return = $result;
    }
    
    public function movieAddAction(){
    
        //Construire le model
        $movieModel = new Movie();
        //Récupérer les données
        $id_TMDb = $this->_getParam('id_TMDb');
        $name = $this->_getParam('moviename');
        $price = $this->_getParam('movieprice');
        $quantity = $this->_getParam('moviequantity');
        $params = [
            'id_TMDb' => $id_TMDb,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity
        ];
        $returnMovie = $movieModel->save($params);

        if ($returnMovie > 0) {
            Utils::message(
                1,
                '<strong>Succés!</strong> Le film a été ajouté',
                '<strong>Erreur!!!</strong> Le film n\'a pas été ajouté'
            );
            header('Location: ' . WEB_ROOT . '/accueil');
        }else{

        Utils::message(
            0,
            "<strong>Succés!</strong> Le film a été ajouté",
            "<strong>Erreur!!!</strong> Le film n\'a pas été ajouté"        );
        header('Location: ' . WEB_ROOT . '/accueil');
        }
        die();
    }

    public function moviesAction(){

        // Affichage des catégories 
        $url = 'http://api.themoviedb.org/3/genre/movie/list?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR';
        $genres = UTILS::searchTMDB($url);
        foreach ($genres as $value)
        $this->view->categories = $value;

        $movies = new Movie();
        $order = 'name asc';
        $movies = $movies->fetchAll($order);
        $return = [];
        foreach ($movies as $movie){
            $id = $movie->id_TMDb;
            $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
            $return[] = UTILS::searchTMDB($url);
        }
        $this->view->movies = $return;
    }

    public function movieAction()
    {
        $id = $this->_getParam('id');
        $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
        $result = UTILS::searchTMDB($url);
        $this->view->return = $result;

        
        $movie = new Movie();
        $movie = $movie->fetchOneTmdb($id);
        $this->view->movie = $movie;
    }
}