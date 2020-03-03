<?php


namespace App\Status;


use InvalidArgumentException;

trait Status
{
    /**
     * Return list of status codes and labels
     * @return array
     */
    public static function listStatus()
    {
        return [];
    }

    /**
     * Returns label of actual status
     * @param string
     * @return mixed
     */
    public function getStatus(string $status): string
    {
        $list = self::listStatus();
        if(!isset($list[$status])){
            throw new InvalidArgumentException('Status not found.');
        }
        return $list[$status];
    }
}
