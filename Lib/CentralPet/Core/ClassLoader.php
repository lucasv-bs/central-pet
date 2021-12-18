<?php
namespace CentralPet\Core;

class ClassLoader {
    protected $prefixes = array();

    // Method responsible for registering the autoloader function
    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
    }

    // Method responsible for add a namespace
    public function addNamespace($prefix, $base_directory, $prepend = false) {
        // Normalize namespace prefix
        $prefix = trim($prefix, '\\') . '\\';
        $base_directory = rtrim($base_directory, DIRECTORY_SEPARATOR) . '/';

        // Initialize the namespace prefix array
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = array();
        }

        // Retain the base directory for the namespace prefix
        if ($prepend) {
            array_unshift($this->prefixes[$prefix], $base_directory);            
        }
        else {
            array_push($this->prefixes[$prefix], $base_directory);
        }
    }

    // Method responsible for load a class
    public function loadClass($class) {
        // The current namespace prefix
        $prefix = $class;

        while (false !== $position = strrpos($prefix, '\\')) {
            $prefix = substr($class, 0, $position + 1);
            $relative_class = substr($class, $position + 1);

            // Try to load a mapped file for the prefix and relative class
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);

            if ($mapped_file) {
                return $mapped_file;
            }

            // Remove the trailing namespace separator for the next iteration of strrpos()
            $prefix = rtrim($prefix, '\\');
        }

        // Never found a mapped file
        return false;
    }

    // Method responsible for load a mapped file
    protected function loadMappedFile($prefix, $relative_class) {
        // Are there any base directories for this namespace prefix?
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }
        
        foreach ($this->prefixes[$prefix] as $base_directory) {            
            $file = $base_directory
                    . str_replace('\\', '/', $relative_class)
                    . '.php';
            
            if ($this->requireFile($file)) {
                return $file;
            }
        }

        return false;
    }

    // Method responsible for executing the require file definitively
    protected function requireFile($file) {
        if (file_exists($file)) {
            require $file;
            return true;
        }
        return false;
    }
}