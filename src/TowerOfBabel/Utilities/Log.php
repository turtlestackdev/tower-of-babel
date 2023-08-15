<?php


namespace TowerOfBabel\Utilities;


use DateTimeZone;
use Monolog\Handler\NullHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use TowerOfBabel\Plugin;

class Log {
    private static Logger $logger;

    private function __construct() { }

    private static function getLogger(): Logger {
        if (!isset(self::$logger)) {
            // todo pull settings from plugin
            $logger = new Logger('TOWER-OF-BABEL');
            $stream = self::get_stream();
            if ($stream !== null) {
                $logger->pushHandler(new RotatingFileHandler(self::get_stream(), 7, Logger::INFO));
                $logger->setTimezone(new DateTimeZone('UTC'));
                try {
                    $logger->info("creating logger");
                } catch (\Exception) {
                    $logger->popHandler();
                    $logger->pushHandler(new NullHandler());
                }
            } else {
                $logger->pushHandler(new NullHandler());
            }

            self::$logger = $logger;
        }

        return self::$logger;
    }

    private static function get_stream(): ?string {
        $filesystem = new Filesystem();
        $log_dir = Plugin::resource_path('logs');
        if (!$filesystem->exists($log_dir)) {
            try {
                $filesystem->mkdir($log_dir);
            } catch (IOException) {
                return null;
            }
        }

        return Plugin::resource_path('logs/tower-of-babel.log');
    }

    public static function debug($message, array $context = []): void {
        $logger = self::getLogger();
        $logger->debug($message, $context);
    }

    public static function info($message, array $context = []): void {
        $logger = self::getLogger();
        $logger->info($message, $context);
    }

    public static function notice($message, array $context = []): void {
        $logger = self::getLogger();
        $logger->notice($message, $context);
    }

    public static function warning($message, array $context = []): void {
        $logger = self::getLogger();
        $logger->warning($message, $context);
    }

    public static function error($message, array $context = []): void {
        $logger = self::getLogger();
        $logger->error($message, $context);
    }

    public static function critical($message, array $context = []): void {
        $logger = self::getLogger();
        $logger->critical($message, $context);
    }

    public static function alert($message, array $context = []): void {
        $logger = self::getLogger();
        $logger->alert($message, $context);
    }

    public static function emergency($message, array $context = []): void {
        $logger = self::getLogger();
        $logger->debug($message, $context);
    }
}