<?php



function responseOk()
{
     return response()->json([
        'status' =>'success',
     ], 200);
}
function responseBad(?string $message = null, int $code = 400)
{
     return response()->json([
        'message' =>$message,
     ], $code);
}