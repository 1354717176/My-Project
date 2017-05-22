<?php
define('THINK_VERSION', '5.0.3');
define('THINK_START_TIME', microtime(true));
define('THINK_START_MEM', memory_get_usage());
define('EXT', '.php');
define('DS', DIRECTORY_SEPARATOR);

// 定义路径
define('ROOT_PATH', dirname(__DIR__) . DS);
define('THINK_PATH', ROOT_PATH . 'thinkphp' . DS);
define('LIB_PATH', THINK_PATH . 'library' . DS);
define('CORE_PATH', LIB_PATH . 'think' . DS);
define('TRAIT_PATH', LIB_PATH . 'traits' . DS);
define('EXTEND_PATH', ROOT_PATH . 'extend' . DS);
define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);

// 应用目录
define('APP_ROOT', ROOT_PATH . 'app' . DS);
define('APP_PATH', APP_ROOT . APP_NAME . DS);

// 运行时目录
define('RUNTIME_PATH', ROOT_PATH . 'runtime' . DS . APP_NAME . DS);
define('LOG_PATH', RUNTIME_PATH . 'log' . DS);
define('CACHE_PATH', RUNTIME_PATH . 'cache' . DS);
define('TEMP_PATH', RUNTIME_PATH . 'temp' . DS);

// 配置文件目录
define('CONF_PATH', APP_ROOT . 'conf' . DS);
define('CONF_EXT', EXT); // 配置文件后缀
define('ENV_PREFIX', 'PHP_'); // 环境变量的配置前缀

// 环境常量
define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);

// 载入Loader类
require CORE_PATH . 'Loader.php';

// 加载环境变量配置文件
if (is_file(ROOT_PATH . '.env')) {
    $env = parse_ini_file(ROOT_PATH . '.env', true);
    foreach ($env as $key => $val) {
        $name = ENV_PREFIX . strtoupper($key);
        if (is_array($val)) {
            foreach ($val as $k => $v) {
                $item = $name . '_' . strtoupper($k);
                putenv("$item=$v");
            }
        } else {
            putenv("$name=$val");
        }
    }
}

// 注册自动加载
\think\Loader::register();

// 注册错误和异常处理机制
\think\Error::register();

// 加载惯例配置文件
\think\Config::set(include THINK_PATH . 'convention' . EXT);
