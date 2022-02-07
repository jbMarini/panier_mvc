<?php
class TmdbController extends Controller
{
    // TMDB
    public function tmdbAction()
    {
        if(isset($_POST['searchByTitle'])){
            $search = $_POST['searchByTitle'];
            $searchUrl = urlencode($search);
            $url = 'http://api.themoviedb.org/3/search/movie?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&query='.$searchUrl;
            $result = UTILS::searchTMDB($url);
            $this->view->return = $result;
        }
    }

    public function viewAction()
    {
        $id = $this->_getParam('id_TMDb');
        $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
        $result = UTILS::searchTMDB($url);
        $this->view->return = $result;
    }
}