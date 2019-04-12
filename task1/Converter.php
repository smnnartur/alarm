<?php

class Converter
{
    /**
     * Возвращает сконвертированые данные скорости
     * @return integer
     */
    public static function conversion ()
    {
        return !empty( $_POST[ 'km' ] ) ? ( $_POST[ 'km' ] * 1000 ) / 3600 : 0;
    }
}
