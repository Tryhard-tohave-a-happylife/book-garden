#!/usr/bin/env php
<?php

/**
 * Proxy PHP file generated by Composer
 *
 * This file includes the referenced bin path (../zendframework/zend-view/bin/templatemap_generator.php)
 * using a stream wrapper to prevent the shebang from being output on PHP<8
 *
 * @generated
 */

namespace Composer;

$GLOBALS['_composer_autoload_path'] = __DIR__ . '/..'.'/autoload.php';

if (PHP_VERSION_ID < 80000) {
    if (!class_exists('Composer\BinProxyWrapper')) {
        /**
         * @internal
         */
        final class BinProxyWrapper
        {
            private $handle;
            private $position;

            public function stream_open($path, $mode, $options, &$opened_path)
            {
                // get rid of composer-bin-proxy:// prefix for __FILE__ & __DIR__ resolution
                $opened_path = substr($path, 21);
                $opened_path = realpath($opened_path) ?: $opened_path;
                $this->handle = fopen($opened_path, $mode);
                $this->position = 0;

                // remove all traces of this stream wrapper once it has been used
                stream_wrapper_unregister('composer-bin-proxy');

                return (bool) $this->handle;
            }

            public function stream_read($count)
            {
                $data = fread($this->handle, $count);

                if ($this->position === 0) {
                    $data = preg_replace('{^#!.*\r?\n}', '', $data);
                }

                $this->position += strlen($data);

                return $data;
            }

            public function stream_cast($castAs)
            {
                return $this->handle;
            }

            public function stream_close()
            {
                fclose($this->handle);
            }

            public function stream_lock($operation)
            {
                return $operation ? flock($this->handle, $operation) : true;
            }

            public function stream_tell()
            {
                return $this->position;
            }

            public function stream_eof()
            {
                return feof($this->handle);
            }

            public function stream_stat()
            {
                return fstat($this->handle);
            }

            public function stream_set_option($option, $arg1, $arg2)
            {
                return true;
            }
        }
    }

    if (function_exists('stream_wrapper_register') && stream_wrapper_register('composer-bin-proxy', 'Composer\BinProxyWrapper')) {
        include("composer-bin-proxy://" . __DIR__ . '/..'.'/zendframework/zend-view/bin/templatemap_generator.php');
        exit(0);
    }
}

include __DIR__ . '/..'.'/zendframework/zend-view/bin/templatemap_generator.php';
