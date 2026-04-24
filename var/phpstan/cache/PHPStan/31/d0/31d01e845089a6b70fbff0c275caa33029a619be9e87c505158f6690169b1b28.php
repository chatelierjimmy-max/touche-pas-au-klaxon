<?php declare(strict_types = 1);

// osfsl-C:/Users/elcor/Desktop/Cas pratique et devoirs CEF/Devoir MVC en PHP/touche-pas-au-klaxon/vendor/composer/../nikic/fast-route/src/Dispatcher.php-PHPStan\BetterReflection\Reflection\ReflectionClass-FastRoute\Dispatcher
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-f2055b11d7574b68f66ff78f0f8dece8bf205fe4fb95a707bbf7ebb8a7f84bf7-8.2.29-6.70.0.0',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'FastRoute\\Dispatcher',
        'filename' => 'C:/Users/elcor/Desktop/Cas pratique et devoirs CEF/Devoir MVC en PHP/touche-pas-au-klaxon/vendor/composer/../nikic/fast-route/src/Dispatcher.php',
      ),
    ),
    'namespace' => 'FastRoute',
    'name' => 'FastRoute\\Dispatcher',
    'shortName' => 'Dispatcher',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 5,
    'endLine' => 26,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
      'NOT_FOUND' => 
      array (
        'declaringClassName' => 'FastRoute\\Dispatcher',
        'implementingClassName' => 'FastRoute\\Dispatcher',
        'name' => 'NOT_FOUND',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '0',
          'attributes' => 
          array (
            'startLine' => 7,
            'endLine' => 7,
            'startTokenPos' => 19,
            'startFilePos' => 74,
            'endTokenPos' => 19,
            'endFilePos' => 74,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 7,
        'endLine' => 7,
        'startColumn' => 5,
        'endColumn' => 24,
      ),
      'FOUND' => 
      array (
        'declaringClassName' => 'FastRoute\\Dispatcher',
        'implementingClassName' => 'FastRoute\\Dispatcher',
        'name' => 'FOUND',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '1',
          'attributes' => 
          array (
            'startLine' => 8,
            'endLine' => 8,
            'startTokenPos' => 28,
            'startFilePos' => 95,
            'endTokenPos' => 28,
            'endFilePos' => 95,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 8,
        'endLine' => 8,
        'startColumn' => 5,
        'endColumn' => 20,
      ),
      'METHOD_NOT_ALLOWED' => 
      array (
        'declaringClassName' => 'FastRoute\\Dispatcher',
        'implementingClassName' => 'FastRoute\\Dispatcher',
        'name' => 'METHOD_NOT_ALLOWED',
        'modifiers' => 1,
        'type' => NULL,
        'value' => 
        array (
          'code' => '2',
          'attributes' => 
          array (
            'startLine' => 9,
            'endLine' => 9,
            'startTokenPos' => 37,
            'startFilePos' => 129,
            'endTokenPos' => 37,
            'endFilePos' => 129,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 9,
        'endLine' => 9,
        'startColumn' => 5,
        'endColumn' => 33,
      ),
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'dispatch' => 
      array (
        'name' => 'dispatch',
        'parameters' => 
        array (
          'httpMethod' => 
          array (
            'name' => 'httpMethod',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 25,
            'endLine' => 25,
            'startColumn' => 30,
            'endColumn' => 40,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'uri' => 
          array (
            'name' => 'uri',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 25,
            'endLine' => 25,
            'startColumn' => 43,
            'endColumn' => 46,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Dispatches against the provided HTTP method verb and URI.
 *
 * Returns array with one of the following formats:
 *
 *     [self::NOT_FOUND]
 *     [self::METHOD_NOT_ALLOWED, [\'GET\', \'OTHER_ALLOWED_METHODS\']]
 *     [self::FOUND, $handler, [\'varName\' => \'value\', ...]]
 *
 * @param string $httpMethod
 * @param string $uri
 *
 * @return array
 */',
        'startLine' => 25,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 48,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'FastRoute',
        'declaringClassName' => 'FastRoute\\Dispatcher',
        'implementingClassName' => 'FastRoute\\Dispatcher',
        'currentClassName' => 'FastRoute\\Dispatcher',
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