<?php

if (!function_exists('asset')) {
    /**
     * The asset function returns the full URL for a given path, taking into account the current server
     * protocol and host.
     * 
     * @param string path The `path` parameter is a string that represents the path to a file or resource.
     * It is optional and defaults to an empty string if not provided.
     * 
     * @return string a string that represents the URL of an asset file.
     */
    function asset(string $path = ''): string
    {
        return ($_SERVER['REQUEST_SCHEME'] ?? 'http') . "://" . $_SERVER['HTTP_HOST'] . "/" . ltrim($path, '/');
    }
}

if (!function_exists('url')) {
    /**
     * The function `url` returns the full URL for a given path, using the current server's scheme, host,
     * and a base path.
     * 
     * @param string path The `path` parameter is a string that represents the path to a file or resource
     * within the `/storage` directory. It is optional and defaults to an empty string if not provided.
     * 
     * @return string a string that represents a URL. The URL is constructed using the base URL of the
     * current server, followed by the "/storage/" path, and then the provided  parameter.
     */
    function url(string $path = ''): string
    {
        $base_url = ($_SERVER['REQUEST_SCHEME'] ?? 'http') . '://' . $_SERVER['HTTP_HOST'];
        return $base_url . '/storage/' . $path;
    }
}

if (!function_exists('redirect')) {
    /**
     * The function redirects the user to a specified URL with optional HTTP status code and headers.
     * 
     * @param string url The URL to which the user will be redirected.
     * @param int status The status parameter is an optional parameter that specifies the HTTP status code
     * to be sent with the redirect response. The default value is 302, which represents a temporary
     * redirect. Other commonly used status codes for redirects include 301 (permanent redirect) and 307
     * (temporary redirect).
     * @param array headers The `` parameter is an optional array that allows you to specify
     * additional HTTP headers to be sent along with the redirect response. Each element in the array
     * represents a header name-value pair, where the key is the header name and the value is the header
     * value.
     */
    function redirect(string $url, int $status = 302, array $headers = []): void
    {
        try {
            foreach ($headers as $name => $value) {
                header("$name: $value");
            }

            http_response_code($status);
            header("Location: $url");
            exit;
        } catch (\Throwable $th) {
            ErrorHandler::renderError(500, 'Internal Server Error', $th->getMessage());
        }
    }
}

if (!function_exists('isJsonRequest')) {
    /**
     * The function checks if the request is for JSON data.
     * 
     * @return bool The function isJsonRequest() returns a boolean value.
     */
    function isJsonRequest(): bool
    {
        $acceptHeader = $_SERVER['HTTP_ACCEPT'] ?? '';
        return strpos($acceptHeader, 'application/json') !== false;
    }
}

if (!function_exists('isAjaxRequest')) {
    /**
     * The function checks if the request is for AJAX data.
     * 
     * @return bool The function isAjaxRequest() returns a boolean value.
     * */
    function isAjaxRequest(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}

if (!function_exists('config_path')) {
    /**
     * Returns the path to the configuration directory.
     * 
     * @return string The path to the configuration directory.
     * */
    function config_path(): string
    {
        return base_path() . '/config';
    }
}

if (!function_exists('storage_path')) {
    /**
     * Returns the path to the storage directory.
     * 
     * @return string The path to the storage directory.
     * */
    function storage_path(): string
    {
        return base_path() . '/storage';
    }
}

if (!function_exists('app_path')) {
    /**
     * Returns the path to the application directory.
     * 
     * @return string The path to the application directory.
     * */
    function app_path(): string
    {
        return base_path() . '/app';
    }
}

if (!function_exists('http_path')) {
    /**
     * Returns the path to the HTTP directory.
     * 
     * @return string The path to the HTTP directory.
     * */
    function http_path(): string
    {
        return app_path() . '/Http';
    }
}

if (!function_exists('controller_path')) {
    /**
     * Returns the path to the controllers directory.
     * 
     * @return string The path to the controllers directory.
     * */
    function controller_path(): string
    {
        return http_path() . '/Controllers';
    }
}

if (!function_exists('middleware_path')) {
    /**
     * Returns the path to the middleware directory.
     * 
     * @return string The path to the middleware directory.
     * */
    function middleware_path(): string
    {
        return http_path() . '/Middleware';
    }
}

if (!function_exists('model_path')) {
    /**
     * Returns the path to the models directory.
     * 
     * @return string The path to the models directory.
     * */
    function model_path(): string
    {
        return app_path() . '/Models';
    }
}

if (!function_exists('base_path')) {
    /**
     * Returns the path to the base directory.
     * 
     * @return string The path to the base directory.
     * */
    function base_path(int $levels = 2): string
    {
        return dirname(__DIR__, $levels);
    }
}

if (!function_exists('public_path')) {
    /**
     * Returns the path to the public directory.
     * 
     * @return string The path to the public directory.
     * */
    function public_path(): string
    {
        return base_path() . '/public';
    }
}

if (!function_exists('asset_path')) {
    /**
     * Returns the path to the public directory.
     * 
     * @return string The path to the public directory.
     * */
    function asset_path(): string
    {
        return base_path() . '/public';
    }
}

if (!function_exists('view_path')) {
    /**
     * Returns the path to the views directory.
     * 
     * @return string The path to the views directory.
     * */
    function view_path(): string
    {
        return base_path() . '/resources/views/';
    }
}

if (!function_exists('components_path')) {
    /**
     * Returns the path to the components directory.
     * 
     * @return string The path to the components directory.
     * */
    function components_path(): string
    {
        return view_path() . '/components';
    }
}

if (!function_exists('lang_path')) {
    /**
     * Returns the path to the language directory.
     * 
     * @return string The path to the language directory.
     * */
    function lang_path(): string
    {
        return base_path() . '/lang';
    }
}

if (!function_exists('routes_path')) {
    /**
     * Returns the path to the routes directory.
     * 
     * @return string The path to the routes directory.
     * */
    function routes_path(): string
    {
        return base_path() . '/routes';
    }
}

if (!function_exists('framework_path')) {
    /**
     * Returns the path to the framework directory.
     * 
     * @return string The path to the framework directory.
     * */
    function framework_path(): string
    {
        return storage_path() . '/framework';
    }
}

if (!function_exists('cache_path')) {
    /**
     * Returns the path to the cache directory.
     * 
     * @return string The path to the cache directory.
     * */
    function cache_path(): string
    {
        return framework_path() . '/.cache';
    }
}

if (!function_exists('session_path')) {
    /**
     * Returns the path to the session directory.
     * 
     * @return string The path to the session directory.
     * */
    function session_path(): string
    {
        return framework_path() . '/sessions';
    }
}

if (!function_exists('log_path')) {
    /**
     * Returns the path to the log directory.
     * 
     * @return string The path to the log directory.
     * */
    function log_path(): string
    {
        return storage_path() . '/logs';
    }
}

if (!function_exists('lib_path')) {
    /**
     * Returns the path to the lib directory.
     * 
     * @return string The path to the lib directory.
     * */
    function lib_path(): string
    {
        return base_path() . '/lib';
    }
}

if (!function_exists('database_path')) {
    /**
     * Returns the path to the database directory.
     * 
     * @return string The path to the database directory.
     */
    function database_path(): string
    {
        return base_path() . '/database';
    }
}

if (!function_exists('method')) {
    /**
     * Get the HTML form method input.
     * 
     * @param string $method The method to use. Defaults to 'PUT'.
     * 
     * @return string The HTML form method input.
     * */
    function method(string $method): string
    {
        return '<input type="hidden" name="_method" value="' . strtoupper($method) . '">';
    }
}