<?php

define('CHECK', 'ok');

/**
 * Checks if a $_SERVER variable exists and returns an appropriate message.
 *
 * @param string  $name
 * @param boolean $allowCLI If true, the $_SERVER variable will be checked even if the current
 *                script is running in the cli.
 *
 * @return string
 */
function checkServerVariable($name, $allowCLI = false)
{
  if (php_sapi_name() == 'cli' && !$allowCLI) {
    return CHECK;
  } else {
    return isset($_SERVER[$name]) ? CHECK : 'Missing';
  }
}

/**
 * Checks if a PHP function exists and returns an appropriate message.
 *
 * @param string $name
 *
 * @return string
 */
function checkPHPFunction($name)
{
  return function_exists($name) ? CHECK : $name . ' function does not exist.';
}

/**
 * Checks if a PHP extension exists and returns an appropriate message.
 *
 * @param string $name
 *
 * @return string
 */
function checkPHPExtension($name)
{
  return extension_loaded($name) ? CHECK : $name . ' extension is not installed';
}

/**
 * Checks if one of the given shell command exists (using `which`) and returns an appropriate message.
 *
 * @param array $names
 *
 * @return string
 */
function checkShellCommand($names)
{
  if (!is_array($names)) {
    $names = array($names);
  }
  $found = false;
  foreach ($names as $name) {
    $output = shell_exec('which ' . $name);
    if (!empty($output)) {
      $found = true;
      break;
    }
  }
  if ($found === false) {
    return 'Could not find executables: ' . implode(',', $names);
  } else {
    return CHECK;
  }
}

/**
 * Checks if a ruby gem exists (using `gem which`) and returns an appropriate message.
 *
 * @param string $name
 *
 * @return string
 */
function checkRubyGem($name)
{
  if (($check = checkShellCommand('gem')) !== CHECK) {
    return $check;
  }

  $output = shell_exec('gem which ' . $name);
  if($output === null) {
    return 'Could not find rubygem ' . $name;
  } else if (strpos($output, 'ERROR') === false) {
    return CHECK;
  } else {
    return 'Could not find rubygem ' . $name;
  }
}

/**
 * Checks an array of shell commands if they are available. Returns the first command that is
 * available.
 *
 * @param array $names
 *
 * @return string
 */
function getValidCommand($names)
{
  foreach ($names as $name) {
    $output = shell_exec('which ' . $name);
    if (!empty($output)) {
      return $name;
    }
  }

  return null;
}

/**
 * Gets the version number from a string using a version number pattern (e.g. 1.2.4).
 *
 * @param string $string
 * @param string $pattern The version number pattern to use
 *
 * @return string
 */
function getVersionNumbers($string, $pattern = '/\b[0-9.p]+\b/i')
{
  $matches = array();
  preg_match_all($pattern, $string, $matches);
  if (count($matches) > 0 && count($matches[0]) > 0) {
    return $matches[0];
  } else {
    return array('0');
  }
}

$requirements = array(
  'PHP'         => array(
    array(
      'name'           => 'PHP',
      'pass' => version_compare(PHP_VERSION, '5.5.3', '>=') ? CHECK : 'Invalid version',
      'minimumVersion' => '5.5.3',
      'currentVersion' => PHP_VERSION,
    ),
    array('name' => 'curl', 'pass' => checkPHPExtension('curl')),
    array('name' => 'exif', 'pass' => checkPHPExtension('exif')),
    array('name' => 'gd', 'pass' => checkPHPExtension('gd')),
    array('name' => 'geoip', 'pass' => checkPHPExtension('geoip')),
    array('name' => 'gmagick', 'pass' => checkPHPExtension('gmagick')),
    array('name' => 'imagick', 'pass' => checkPHPExtension('imagick')),
    array('name' => 'json', 'pass' => checkPHPExtension('json')),
    array('name' => 'mbstring', 'pass' => checkPHPExtension('mbstring')),
    array('name' => 'mcrypt', 'pass' => checkPHPExtension('mcrypt')),
    array('name' => 'memcache', 'pass' => checkPHPExtension('memcache')),
    array('name' => 'memcached', 'pass' => checkPHPExtension('memcached')),
    array('name' => 'pcntl', 'pass' => checkPHPExtension('pcntl')),
    array('name' => 'pcre', 'pass' => checkPHPExtension('pcre')),
    array('name' => 'pdo', 'pass' => checkPHPExtension('pdo')),
    array('name' => 'pdo_mysql', 'pass' => checkPHPExtension('pdo_mysql')),
    array('name' => 'posix', 'pass' => checkPHPExtension('posix')),
    array('name' => 'redis', 'pass' => checkPHPExtension('redis')),
    array('name' => 'readfile', 'pass' => checkPHPFunction('readfile')),
    array('name' => 'pathinfo', 'pass' => checkPHPFunction('pathinfo')),
  ),
  '$_SERVER'    => array(
    array('name' => 'HTTP_HOST', 'pass' => checkServerVariable('HTTP_HOST')),
    array('name' => 'SERVER_NAME', 'pass' => checkServerVariable('SERVER_NAME')),
    array('name' => 'SERVER_PORT', 'pass' => checkServerVariable('SERVER_PORT')),
    array('name' => 'HTTP_ACCEPT', 'pass' => checkServerVariable('HTTP_ACCEPT')),
    array('name' => 'HTTP_USER_AGENT', 'pass' => checkServerVariable('HTTP_USER_AGENT')),
    array('name' => 'SCRIPT_NAME', 'pass' => checkServerVariable('SCRIPT_NAME', true)),
    array('name' => 'SCRIPT_FILENAME', 'pass' => checkServerVariable('SCRIPT_FILENAME', true)),
    array('name' => 'PHP_SELF', 'pass' => checkServerVariable('PHP_SELF', true)),
    array('name' => 'SCRIPT_FILENAME value', 'pass' => function () {
      if (realpath($_SERVER["SCRIPT_FILENAME"]) == realpath(__FILE__)) {
        return CHECK;
      } else {
        return '$_SERVER["SCRIPT_FILENAME"] must be the same as the entry script file path.';
      }
    }),
    array('name' => 'REQUEST_URI or QUERY_STRING', 'pass' => function () {
      if (!isset($_SERVER["REQUEST_URI"]) && isset($_SERVER["QUERY_STRING"])) {
        return 'Either $_SERVER["REQUEST_URI"] or $_SERVER["QUERY_STRING"] must exist.';
      } else {
        return CHECK;
      }
    }),
    array('name' => 'Url Path Info', 'pass' => function () {
      if (!isset($_SERVER["PATH_INFO"]) && strpos($_SERVER["PHP_SELF"], $_SERVER["SCRIPT_NAME"]) !== 0) {
        return 'Unable to determine URL path info. Please make sure $_SERVER["PATH_INFO"] '
        . '(or $_SERVER["PHP_SELF"] and $_SERVER["SCRIPT_NAME"]) contains proper value.';
      } else {
        return CHECK;
      }
    }),
  ),
  'Components'  => array(
    array(
      'name' => 'Nginx',
      'pass' => checkShellCommand('nginx'),
    ),
    array(
      'name' => 'PHP FPM/CGI',
      'pass' => checkShellCommand(array('php-cgi', 'php5-fpm')),
    ),
    array(
      'name'           => 'Redis',
      'minimumVersion' => '2.0.1',
      'currentVersion' => function () {
        $output   = shell_exec('redis-server --version');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('redis-server'),
    ),
    array(
      'name'           => 'MySQL',
      'minimumVersion' => '5.1.54',
      'currentVersion' => function () {
        $command  = getValidCommand(array('mysql5', 'mysql'));
        $output   = shell_exec($command . ' --version');
        $versions = getVersionNumbers($output);

        return count($versions) > 1 ? $versions[1] : '0';
      },
      'pass'           => checkShellCommand(array('mysql5', 'mysql')),
    ),
    array(
      'name'           => 'Postgre SQL',
      'minimumVersion' => 'Optional',
      'currentVersion' => function () {
        $output   = shell_exec('postgres --version');
        $versions = getVersionNumbers($output);
        return $versions[0];
      },
      'pass'           => checkShellCommand('postgres'),
    ),
    array(
      'name'           => 'Beanstalkd',
      'minimumVersion' => '1.4.6',
      'currentVersion' => function () {
        $output   = shell_exec('beanstalkd -v');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('beanstalkd'),
    ),
    array(
      'name'           => 'Memcached',
      'minimumVersion' => '1.4.5',
      'currentVersion' => function () {
        $output   = shell_exec('memcached -h');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('memcached'),
    ),
    array(
      'name'           => 'Ruby',
      'minimumVersion' => '1.9.3',
      'currentVersion' => function () {
        $output   = shell_exec('ruby --version');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('ruby'),
    ),
    array(
      'name'           => 'RubyGems',
      'minimumVersion' => '1.8.24',
      'currentVersion' => function () {
        $output   = shell_exec('gem --version');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('gem'),
    ),
    array(
      'name'           => 'NodeJS',
      'minimumVersion' => '0.8.10',
      'currentVersion' => function () {
        $output   = shell_exec('node --version');
        $versions = getVersionNumbers($output, '/\bv[0-9.p]+\b/i');

        return str_replace('v', '', $versions[0]);
      },
      'pass'           => checkShellCommand('node'),
    ),
    array(
      'name'           => 'NPM',
      'minimumVersion' => '1.1.62',
      'currentVersion' => function () {
        $output   = shell_exec('npm --version');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('npm'),
    ),
    array(
      'name'           => 'Composer',
      'minimumVersion' => '1.0.0',
      'currentVersion' => function () {
        $output   = shell_exec('composer --version --no-ansi');
        $versions = getVersionNumbers($output);

        return $versions[0];
      }
    ),
  ),
  'Development' => array(
    array(
      'name'           => 'Git',
      'minimumVersion' => '1.9.2',
      'currentVersion' => function () {
        $output   = shell_exec('git --version');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('git'),
    ),
    array(
      'name'           => 'Capistrano',
      'minimumVersion' => '3.4.0',
      'currentVersion' => function () {
        $output   = shell_exec('cap -V');
        $versions = getVersionNumbers($output);

        return str_replace('v', '', $versions[0]);
      },
      'pass'           => checkShellCommand('cap'),
    ),
    // Check this out first
    //array(
      //'name' => 'railsless-deploy',
      //'check' => true,
      //'pass' => checkRubyGem('railsless-deploy'),
    //),
    array(
      'name'           => 'CoffeeScript',
      'minimumVersion' => '1.2.0',
      'currentVersion' => function () {
        $output   = shell_exec('coffee --version');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('coffee'),
    ),
    array(
      'name'           => 'LESS',
      'minimumVersion' => '1.3.0',
      'currentVersion' => function () {
        $output   = shell_exec('lessc --version');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('lessc'),
    ),
    array(
      'name'           => 'Grunt CLI',
      'minimumVersion' => '0.1.6',
      'currentVersion' => function () {
        $output   = shell_exec('grunt --version');
        $versions = getVersionNumbers($output, '/\bv[0-9.p]+\b/i');

        return str_replace('v', '', $versions[0]);
      },
      'pass'           => checkShellCommand('grunt'),
    ),
    array(
      'name'           => 'PhantomJS',
      'minimumVersion' => '1.9.1',
      'currentVersion' => function () {
        $output   = shell_exec('phantomjs --version');
        $versions = getVersionNumbers($output);

        return $versions[0];
      },
      'pass'           => checkShellCommand('phantomjs'),
    ),
  )

);

if (php_sapi_name() != 'cli') {
  echo '<pre>';
}

echo PHP_EOL . 'Development Enviroment Requirements Checker for OSX';
echo PHP_EOL;
echo PHP_EOL . 'Name                               Minimum Version       Installed Version     Pass';
echo PHP_EOL . '=======================================================================================================';
foreach ($requirements as $name => $items) {

  echo PHP_EOL . PHP_EOL . $name;
  echo PHP_EOL . '-------------------------------------------------------------------------------------------------------';

  foreach ($items as $item) {
    if (!isset($item['minimumVersion'])) {
      $item['minimumVersion'] = '';
    }
    if (!isset($item['currentVersion'])) {
      $item['currentVersion'] = '';
    }
    if (is_callable($item['currentVersion'])) {
      $item['currentVersion'] = $item['currentVersion']();
    }
    if (isset($item['pass']) && is_callable($item['pass'])) {
      $item['pass'] = $item['pass']();
    }
    if (!isset($item['pass'])) {
      $item['pass'] = CHECK;
    }

    if ($item['pass'] === CHECK && isset($item['minimumVersion']) && isset($item['currentVersion'])) {
      if (!version_compare($item['currentVersion'], $item['minimumVersion'], '>=')) {
        $item['pass'] = 'Invalid version';
      }
    }

    $line = str_pad($item['name'], 35, ' ');
    $line .= str_pad($item['minimumVersion'], 22, ' ');
    $line .= str_pad($item['currentVersion'], 22, ' ');
    $line .= isset($item['check']) ? 'For Review' : $item['pass'];

    echo PHP_EOL . $line;
  }

}

echo PHP_EOL;
echo PHP_EOL . '-------------------------------------------------------------------------------------------------------';

echo PHP_EOL . 'Done.' . PHP_EOL . PHP_EOL;

if (php_sapi_name() != 'cli') {
  echo '</pre>';
}
