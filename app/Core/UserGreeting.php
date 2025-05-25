<?php
namespace App\Core;

use App\Core\Clock;

class UserGreeting {
    private $username;
    private $name;
    private $hour;
    private $minute;

    public function __construct($session) {
        $this->username = $session['username'] ?? '';
        $this->name = $session['name'] ?? '';
        $clock = new Clock('America/Sao_Paulo');
        $this->hour = $clock->getHour();
        $this->minute = $clock->getMinute();
    }

    public function getGreeting() {
        if ($this->hour >= 0 && $this->hour < 12) {
            return 'Bom dia';
        } elseif ($this->hour >= 12 && $this->hour < 18) {
            return 'Boa tarde';
        } else {
            return 'Boa noite';
        }
    }

    public function getFormattedHour() {
        return sprintf('%02d:%02d', $this->hour, $this->minute);
    }

    public function getName() {
        return htmlspecialchars($this->name);
    }

    public function getUsername() {
        return htmlspecialchars($this->username);
    }

    public function getFirstName() {
        $parts = explode(' ', trim($this->name));
        return htmlspecialchars($parts[0] ?? '');
    }
}
