<?php
    namespace App\Enums\Auth\Role;
    use Kongulov\Traits\InteractWithEnum;
    enum RolesEnum: string {
    use InteractWithEnum;
        case ADMIN = 'admin';
        case BOATOWNER = 'boatowner';
        case CUSTOMER = 'customer';
    }