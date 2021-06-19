<?php


abstract class StatusEnum {
    const TRAITE = 'Traité';
    const EN_ATTENTE = 'En attente';
    const NON_TRAITE = 'Non traité';
    const StatusList = [
        'Traité' => self::TRAITE,
        'En attente' => self::EN_ATTENTE,
        'Non traité' => self::NON_TRAITE
    ];

}
