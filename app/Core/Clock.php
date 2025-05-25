<?php
namespace App\Core;

class Clock {
    private $timezone;
    public function __construct($timezone = 'America/Sao_Paulo') {
        $this->timezone = $timezone;
    }
    public function getHour() {
        $dt = new \DateTime('now', new \DateTimeZone($this->timezone));
        return (int)$dt->format('H');
    }
    public function getMinute() {
        $dt = new \DateTime('now', new \DateTimeZone($this->timezone));
        return (int)$dt->format('i');
    }
    public function getSecond() {
        $dt = new \DateTime('now', new \DateTimeZone($this->timezone));
        return (int)$dt->format('s');
    }
    public function getTimeFormatted() {
        $dt = new \DateTime('now', new \DateTimeZone($this->timezone));
        return $dt->format('H:i:s');
    }
}
