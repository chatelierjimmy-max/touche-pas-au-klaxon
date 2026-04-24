<?php declare(strict_types = 1);

// odsl-C:\Users\elcor\Desktop\Cas pratique et devoirs CEF\Devoir MVC en PHP\touche-pas-au-klaxon\app\Middleware\AdminMiddleware.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Middleware\AdminMiddleware
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.0-8.2.29-e9256f0d49079f679b53f9c981a85afbfd8f2e6679d00fcb64250f355dc5c112',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Middleware\\AdminMiddleware',
        'filename' => 'C:/Users/elcor/Desktop/Cas pratique et devoirs CEF/Devoir MVC en PHP/touche-pas-au-klaxon/app/Middleware/AdminMiddleware.php',
      ),
    ),
    'namespace' => 'App\\Middleware',
    'name' => 'App\\Middleware\\AdminMiddleware',
    'shortName' => 'AdminMiddleware',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 32,
    'docComment' => '/**
 * Middleware de contrôle d\'accès administrateur.
 *
 * Vérifie que l\'utilisateur :
 * - est connecté
 * - possède le rôle ADMIN
 *
 * Si ces conditions ne sont pas respectées :
 * - redirige vers la page de connexion (si non connecté)
 * - renvoie une erreur 403 (si non administrateur)
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 20,
    'endLine' => 42,
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
 * Exécute la vérification des droits administrateur.
 *
 * @return void
 */',
        'startLine' => 27,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Middleware',
        'declaringClassName' => 'App\\Middleware\\AdminMiddleware',
        'implementingClassName' => 'App\\Middleware\\AdminMiddleware',
        'currentClassName' => 'App\\Middleware\\AdminMiddleware',
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