<?php declare(strict_types = 1);

// odsl-C:\Users\elcor\Desktop\Cas pratique et devoirs CEF\Devoir MVC en PHP\touche-pas-au-klaxon\app\Controller\AuthController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Controller\AuthController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.0-8.2.29-07e2a2de889b977cd814dcdc469ba4c23514457b9d7c68010fa85a8a5b14348b',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Controller\\AuthController',
        'filename' => 'C:/Users/elcor/Desktop/Cas pratique et devoirs CEF/Devoir MVC en PHP/touche-pas-au-klaxon/app/Controller/AuthController.php',
      ),
    ),
    'namespace' => 'App\\Controller',
    'name' => 'App\\Controller\\AuthController',
    'shortName' => 'AuthController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Gère l\'authentification des utilisateurs.
 *
 * Cette classe permet :
 * - d\'afficher le formulaire de connexion
 * - de traiter la connexion
 * - de déconnecter l\'utilisateur
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 87,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Controller\\Controller',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'showLogin' => 
      array (
        'name' => 'showLogin',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Affiche le formulaire de connexion.
 *
 * @return void
 */',
        'startLine' => 27,
        'endLine' => 32,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\AuthController',
        'implementingClassName' => 'App\\Controller\\AuthController',
        'currentClassName' => 'App\\Controller\\AuthController',
        'aliasName' => NULL,
      ),
      'login' => 
      array (
        'name' => 'login',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'never',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Traite la tentative de connexion utilisateur.
 *
 * La méthode :
 * - récupère les données du formulaire
 * - valide les champs (email + mot de passe)
 * - tente l\'authentification
 * - redirige selon le résultat
 *
 * @return never
 */',
        'startLine' => 45,
        'endLine' => 73,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\AuthController',
        'implementingClassName' => 'App\\Controller\\AuthController',
        'currentClassName' => 'App\\Controller\\AuthController',
        'aliasName' => NULL,
      ),
      'logout' => 
      array (
        'name' => 'logout',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'never',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Déconnecte l\'utilisateur actuellement connecté.
 *
 * Supprime la session et redirige vers la page d\'accueil.
 *
 * @return never
 */',
        'startLine' => 82,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Controller',
        'declaringClassName' => 'App\\Controller\\AuthController',
        'implementingClassName' => 'App\\Controller\\AuthController',
        'currentClassName' => 'App\\Controller\\AuthController',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));