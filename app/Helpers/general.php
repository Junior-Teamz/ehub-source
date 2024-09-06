<?php

use App\Models\ParticipantUser;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

if (!function_exists('errorLog')) {
    /**
     *  error log template
     *  @param $filename
     *  @param $message
     */
    function errorLog($filename, $line, $message)
    {
        $appName = config('app.name');
        $username = "UserID " . !Auth::check() ? "Unknown" : Auth::user()->id;
        $message = is_array($message) ? json_encode($message) : $message;

        return Log::critical("{$appName} \n{$username} \n{$filename} go to line {$line} \n{$message}");
    }
}

if (!function_exists('rupiah_format')) {
    function rupiah_format($number, $is_decimals = false)
    {
        if ($is_decimals) {
            return "Rp " . number_format($number, 2, ',', '.');
        }

        return "Rp " . number_format($number, 0, '', '.');
    }
}

if (!function_exists('format_date')) {
    function format_date($date, $format)
    {
        $date = new Carbon($date);
        return $date->isoFormat($format);
    }
}

if (!function_exists('limit_sentence')) {
    function limit_sentence($str, $limit = 100)
    {
        $truncated = Str::limit($str, $limit, '...');
        return $truncated;
    }
}

if (!function_exists('is_profile_updated')) {
    function is_profile_updated()
    {
        $currentUser = Auth::user();
        $fullname = !empty($currentUser->hasParticipant->fullname);
        $email = !empty($currentUser->email);
        $phone = !empty($currentUser->hasParticipant->phone_number);
        $businessName = !empty($currentUser->hasParticipant->phone_number);
        $businessAddress = !empty($currentUser->hasParticipant->phone_number);

        return $fullname && $email && $phone && $businessName && $businessAddress;
    }
}

if (!function_exists('workshop_count')) {
    function workshop_count()
    {
        $currentUser = Auth::user();
        $currentParticipant = ParticipantUser::with(['hasWorkshops'])->where('user_id', $currentUser->id)->first();

        return !empty($currentParticipant) ? count($currentParticipant->hasWorkshops) : 0;
    }
}

if (!function_exists('sendApiResponse')) {
    function sendApiResponse($status = true, $message = '', $data = null, $code = 200)
    {
        $data = [
            'success' => $status,
            'message' => $message,
            'data' => !empty($data) ? $data : (object) [],
        ];
        return response()->json($data, $code);
    }
}

if (!function_exists('formatWhatsapp')) {
    function formatWhatsapp($phoneNumber)
    {
        return preg_replace('/^0/', '62', $phoneNumber, 1);
    }
}

if (!function_exists('stateByName')) {
    function stateByName($state_code)
    {
        $state = State::where('state_code', $state_code)->first();
        return $state->state_name;
    }
}

if (!function_exists('getCoordinate')) {
    function getCoordinate($state_code)
    {
        $state = State::where('state_code', $state_code)->first();

        if (in_array(null, [$state->latitude, $state->longitude])) {
            return [];
        }

        return [(float) $state->latitude, (float) $state->longitude];
    }
}

if (!function_exists('isExistPlatform')) {
    function isExistPlatform($platforms, $name)
    {
        return in_array($name, explode(",", $platforms));
    }
}
