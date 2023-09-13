<?php
/**
 * Trait
 * PHP version 8.2
 *
 * @category App\Http\Helpers
 * @package  Vatsal Tech.
 * @author   Vatsal Tech. <https://www.vatsalshah.netlify.app/>
 * @license  https://www.vatsalshah.netlify.app/ N/A
 * @link     https://www.vatsalshah.netlify.app/
 */

namespace App\Http\Helpers;

use App\Models\Wallet;
use Illuminate\Http\Request;

/**
 * Trait CommonTrait
 *
 * @category App\Http\Helpers
 * @package  Vatsal Tech.
 * @author   Vatsal Tech. <https://www.vatsalshah.netlify.app/>
 * @license  https://www.vatsalshah.netlify.app/ N/A
 * @link     https://www.vatsalshah.netlify.app/
 */
trait CommonTrait
{
    /**
     * add getUserBalance
     * @param request $request
     * @param object $lastUser
     * @param object $event
     * @author Brainvire Inc. <https://www.brainvire.com/>
     */
    private function getUserBalance($userId)
    {
        if ((int)$userId > 0) {
            $wallet = Wallet::select('id', 'balance')->where('user_id', $userId)->first();
            if (!empty($wallet)) {
                //$balance = $wallet->balance ?? 0;
                return $wallet;
            }
        }
        return null;
                
    }

    private function getUserWalletBalance($userId)
    {
        $balance = 0;
        if ((int)$userId > 0) {
            $wallet = Wallet::select('id', 'balance')->where('user_id', $userId)->first();
            if (!empty($wallet)) {
                $balance = $wallet->balance ?? 0;
                return $balance;
            }
        }
        return $balance;
                
    }
}
