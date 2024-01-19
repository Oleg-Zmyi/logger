<?php

namespace app\models;

use yii\base\Model;

class Log extends Model
{
    public $message;

    public function rules()
    {
        return [
            ['message', 'string', 'max' => 20],
            ['message', 'required'],
        ];
    }
}