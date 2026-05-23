<?php

namespace App\Enums;

enum Jabatan: string
{
    case Manager = 'manager';
    case Supervisor = 'supervisor';
    case Staff = 'staff';
    case Admin = 'admin';
    case Teknisi = 'teknisi';

    public function label(): string
    {
        return match ($this) {
            self::Manager => 'Manager',
            self::Supervisor => 'Supervisor',
            self::Staff => 'Staff',
            self::Admin => 'Admin',
            self::Teknisi => 'Teknisi',
        };
    }
}
