<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(

	// générale
	'/test' => 'test#index',
	'/accueil' => 'main#accueil',

	//users
	'/check-register' => 'ajax#checkregister',
	'/logout' => 'ajax#logout',

	//TMDB
	'/tmdb' => 'tmdb#tmdb',
	'/tmdb_view' => 'tmdb#view',

	// movies
	'/add-movie' => 'movie#addMovie',
	'/movie-add' => 'movie#movieAdd',
	'/movies' => 'movie#movies',
	'/movie' => 'movie#movie',
	'/search' => 'ajax#searchBy',

	// films
	'/films' => 'film#films',
	'/film' => 'film#film',
	'/view-film' => 'film#viewfilm',
	'/search' => 'ajax#searchBy',

	// catégories
	'/categories' => 'main#categories',
	'/add-categorie' => 'main#addcateg',
	'/categorie-update' => 'ajax#categorieUpdate',

	// réalisateurs// acteurs
	'/view' => 'star#view',
	'/add' => 'star#add',
	'/all' => 'star#all',

	//panier
	'/addcart' => 'ajax#Cartadd',
	'/shoppingcart' => 'main#cartshopping',
	'/checkout' => 'main#checkout',
);
