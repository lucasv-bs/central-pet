<?php
namespace CentralPet\Core;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Exception;

class AppLoader {
    protected $directories;

    public function addDirectory($directory) {
        $this->directories[] = $directory;
    }

    // Method responsible for registering the autoloader function
    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
    }

    // Method responsible for load a class
    public function loadClass($class) {
        $folders = $this->directories;

        foreach ($folders as $folder) {
            if (file_exists("{$folder}/{$class}.php")) {
                require_once "{$folder}/{$class}.php";
                return true;
            }
            else {
                if (file_exists($folder)) {
                    foreach (
                        new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($folder)
                            , RecursiveIteratorIterator::SELF_FIRST
                        ) as $entry
                    ) {
                        if (is_dir($entry)) {
                            if (file_exists("{$entry}/{$class}.php")) {
                                require_once "{$entry}/{$class}.php";
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
}