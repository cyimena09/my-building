<?php


abstract class StatusEnum {
    const TRAITE = 'Traité';
    const EN_ATTENTE = 'En Attente';
    const NON_TRAITE = 'Non Traité';
    const StatusList = [
        'Traité' => self::TRAITE,
        'En Attente' => self::EN_ATTENTE,
        'Non Traité' => self::NON_TRAITE
    ];

}
