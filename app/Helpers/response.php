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
            "data" => $message
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
        
        #$extraHeaders['Authorization'] = app('Context')->getJwt();

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

        $extraHeaders['Authorization'] = app('Context')->getJwt();

        return response()->json($response, $status, $extraHeaders)->cookie('Authorization', app('Context')->getJwt(), 60, '/', 'test_ar_laravel');
    }
}

