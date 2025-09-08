<?php

namespace App\Helpers;

class TimeHelper
{
    public static function timeAgo($timestamp)
    {
        $timeAgo = strtotime($timestamp);
        $currentTime = time();
        $timeDifference = $currentTime - $timeAgo;
        $seconds = $timeDifference;

        $minutes = round($seconds / 60);
        $hours = round($seconds / 3600);
        $days = round($seconds / 86400);
        $weeks = round($seconds / 604800);
        $months = round($seconds / 2629440);
        $years = round($seconds / 31553280);

        if ($seconds <= 60) {
            return "baru saja";
        } elseif ($minutes <= 60) {
            return $minutes . " menit yang lalu";
        } elseif ($hours <= 24) {
            return $hours . " jam yang lalu";
        } elseif ($days <= 7) {
            return $days . " hari yang lalu";
        } elseif ($weeks <= 4.3) {
            return $weeks . " minggu yang lalu";
        } elseif ($months <= 12) {
            return $months . " bulan yang lalu";
        } else {
            return $years . " tahun yang lalu";
        }
    }
}
