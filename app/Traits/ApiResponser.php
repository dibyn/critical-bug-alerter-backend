<?php
namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponser
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = null, string $message = null, int $code = Response::HTTP_OK)
    {
        $response['data'] = $data;

        if(!is_null($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = null, int $code, $errors = null)
    {
        $response['message'] = $message;

        if(!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

}
