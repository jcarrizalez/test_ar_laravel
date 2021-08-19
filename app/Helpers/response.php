<?php

if (!function_exists("jsend_error")) {
    /**
     * @param string $message Error message
     * @param string $code Optional custom error code
     * @param string | array $data Optional data
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function jsend_error($message, $code = 500, $extraHeaders = [])
    {
        $response = [
            "status" => "false",
            "message" => $message
        ];
        return response()->json($response, $code, $extraHeaders);
    }
}
if (!function_exists("jsend_fail")) {
    /**
     * @param string $data
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function jsend_fail($data, $status = 400, $extraHeaders = [])
    {
        $response = [
            "status" => "fail",
            "data" => $data
        ];
        
        #$extraHeaders['Authorization'] = #debo crear token jwt;

        return response()->json($response, $status, $extraHeaders);
    }
}
if (!function_exists("jsend_success")) {
    /**
     * @param array | Illuminate\Database\Eloquent\Model $data
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function jsend_success($data = [], $status = 200, $extraHeaders = [])
    {
        $response = [
            "status" => "success",
            "data" => $data
        ];
        return response()->json($response, $status, $extraHeaders);

        #$extraHeaders['Authorization'] = #debo crear token jwt;

        return response()->json($response, $status, $extraHeaders)
            ->cookie('Authorization', null, 60, '/', 'test_ar_laravel');
    }
}

if (!function_exists("file_success")) {
    /**
     * @param string | storage_path
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function file_success(string $file, $status = 200, $extraHeaders = [])
    {
        if (!File::exists($file)) {
            return jsend_error('Archivo no Disponible', 404);
            abort(404);
        }

        #$extraHeaders['Authorization'] = #debo crear token jwt;
        
        $extraHeaders['Content-Type'] = File::mimeType($file);

        return response()->file($file, $extraHeaders);
    }
}