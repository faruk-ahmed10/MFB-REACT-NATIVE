<?php

namespace App\Helper;

class CommonHelper
{

    public static function Response($success, $message, $errorCode = null, $data = null, $status = 200)
    {
        return response()->json([
            'success' => $success,
            'error_code' => $errorCode,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    private static function __generateZeroes($Length)
    {
        $Length = intval($Length);
        $Zeroes = '';
        for ($i = 1; $i <= $Length; $i++) {
            $Zeroes .= '0';
        }
        return $Zeroes;
    }

    public static function GenerateNewCode($Prefix, $ZeroesLength, $LastIncrement = 0)
    {
        $NewIncrement = $LastIncrement + 1;
        $N_I_LENGTH = strlen($NewIncrement);
        return $Prefix . '' . self::__generateZeroes((int)$ZeroesLength - (int)$N_I_LENGTH) . '' . $NewIncrement;
    }
}
