<?php
class MainController extends Controller
{
    // utilisateurs
    public function accueilAction(){
        //affichage caroussel
        $movies = new Movie();
        $order = 'id desc';
        $movies = $movies->fetchAll($order);
        $return = [];
        foreach ($movies as $movie){
            $id = $movie->id_TMDb;
            $url =  'http://api.themoviedb.org/3/movie/'.$id.'?api_key=bf57f49ead0ced1ae34a5f0785d56290&language=fr-FR&append_to_response=query,videos,credits';
            $return[] = UTILS::searchTMDB($url);
        }
        $this->view->movies = $return;

        $userModel = new User();
        //traitement connexion user
        if(isset($_POST['login'])){
            // récupération des données
            $login = $_POST['login'];
            $pwd = $_POST['pwd'];
            $hash_pwd = md5($pwd);
            echo $hash_pwd;
            
            //récupération du mot de passe hashé
            $userReturn = $userModel->loginCheck($login, $hash_pwd);
            if($userReturn != FALSE){
                $_SESSION['user']['profil'] = $userReturn;
                Utils::message(
                    1,
                    '<strong>Succés!</strong> Vous êtes maintenant connecté.',
                    '<strong>Erreur!!!</strong> Le nom d\'utilisateur ou le mot de passe est incorrect'
                );
                header('Location: ' . WEB_ROOT . '/accueil');
                die();
            }else{

                Utils::message(
                    0,
                    '<strong>Succés!</strong> Vous êtes maintenant connecté.',
                    '<strong>Erreur!!!</strong> Le nom d\'utilisateur ou le mot de passe est incorrect'
                );
                header('Location: ' . WEB_ROOT . '/accueil');
                die();
            }
        }

        //traitement formulaire nouveau user
        if(isset($_POST['registerLogin'])){
            // récupération des données
            $login = $_POST['registerLogin'];
            $email = $_POST['registerMail'];
            $password = $_POST['registerPwd'];

            //avatar
            if ($_FILES['registerAvatar']['name'] != '') {
                $titleImg = md5(uniqid(rand(), true));
                $extensions_valides = array('jpg', 'jpeg', 'gif', 'png', 'webp');
                $extensions_upload = strtolower(substr(strrchr($_FILES['registerAvatar']['name'], '.'), 1));
                $titleImg = $titleImg . '.' . $extensions_upload;
                Utils::upload('registerAvatar', 'images/users/' . $titleImg, FALSE, $extensions_valides);
            } else {
                $titleImg = "default.jpg";
            }

            // hashage du mdp
            $hashed_pwd = md5($password);

            $params = [
                'login' => $login,
                'email' => $email,
                'password' => $hashed_pwd,
                'avatar' => $titleImg
            ];
            $returnRegister = $userModel->save($params);

            if ($returnRegister > 0) {
                Utils::message(
                    1,
                    '<strong>Succés!</strong> Vous pouvez désormais vous connecter avec votre compte.',
                    '<strong>Erreur!!!</strong> Désolé, une erreur s\'est produite, veillez recommencer'
                );
                header('Location: ' . WEB_ROOT . '/accueil');
                die();
            }else{

                Utils::message(
                    0,
                    '<strong>Succés!</strong> Vous pouvez désormais vous connecter avec votre compte.',
                    '<strong>Erreur!!!</strong> Désolé, une erreur s\'est produite, veillez recommencer'
                );
                header('Location: ' . WEB_ROOT . '/accueil');
                die();
            }
        }
    }

    //panier
    public function cartshoppingAction()
    {
        if (($_SESSION['user']['profil']->id==''))
            header('Location.movies');
        if (!isset($_SESSION['user']['panier'])) {
            $_SESSION['user']['panier'] = [];
        }
        $panier = ($_SESSION['user']['panier'])?
        $_SESSION['user']['panier']:array();
        $this->view->panier = $panier;
    }
    
    public function checkoutAction()
    {
    }
}