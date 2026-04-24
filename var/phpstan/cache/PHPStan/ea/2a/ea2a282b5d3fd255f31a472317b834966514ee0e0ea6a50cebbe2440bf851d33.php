<?php declare(strict_types = 1);

// odsl-C:\Users\elcor\Desktop\Cas pratique et devoirs CEF\Devoir MVC en PHP\touche-pas-au-klaxon\app\Middleware\GuestMiddleware.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Middleware\GuestMiddleware
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.0-8.2.29-e82e35e17b83aa5e3251e9a2adcc4bf3a23e704c9a1b7d105b84e630fd516890',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Middleware\\GuestMiddleware',
        'filename' => 'C:/Users/elcor/Desktop/Cas pratique et devoirs CEF/Devoir MVC en PHP/touche-pas-au-klaxon/app/Middleware/GuestMiddleware.php',
      ),
    ),
    'namespace' => 'App\\Middleware',
    'name' => 'App\\Middleware\\GuestMiddleware',
    'shortName' => 'GuestMiddleware',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Middleware réservé aux utilisateurs non authentifiés (invités).
 *
 * Permet de protéger certaines routes (ex : /login)
 * afin qu\'elles ne soient accessibles qu\'aux utilisateurs non connectés.
 *
 * Si l\'utilisateur est déjà connecté :
 * - redirection vers la page d\'accueil
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 19,
    'endLine' => 32,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
      0 => 'App\\Middleware\\MiddlewareInterface',
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
      'handle' => 
      array (
        'name' => 'handle',
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
 * Exécute la vérification d\'accès pour les invités.
 *
 * @return void
 */',
        'startLine' => 26,
        'endLine' => 31,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Middleware',
        'declaringClassName' => 'App\\Middleware\\GuestMiddleware',
        'implementingClassName' => 'App\\Middleware\\GuestMiddleware',
        'currentClassName' => 'App\\Middleware\\GuestMiddleware',
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