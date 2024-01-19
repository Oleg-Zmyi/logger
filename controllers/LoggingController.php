<?php

namespace app\controllers;

use app\Components\Exceptions\LoggerException;
use app\Components\Logging\LoggerFactory;
use app\models\Log;
use Yii;

class LoggingController extends \yii\web\Controller
{
    public function actionLog()
    {
        $model = new Log();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            try {
                $logger = LoggerFactory::createLogger();
                $logger->send($model->message);
            } catch (\Exception $e) {
                Yii::error($e->getMessage());
                throw new LoggerException(Yii::$app->params['logger']['general']);
            }
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $model->getErrors();
        }
    }

    public function actionLogTo($type)
    {
        $model = new Log();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            try {
                $logger = LoggerFactory::createLogger($type);
                $logger->send($model->message);
            } catch (\Exception $e) {
                Yii::error($e->getMessage());
                throw new LoggerException(Yii::$app->params['logger']['general']);
            }
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $model->getErrors();
        }
    }

    public function actionLogToAll()
    {
        $availableLoggerTypes = Yii::$app->params['logger_types'];
        $model = new Log();

        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            foreach ($availableLoggerTypes as $key => $type) {
                try {
                    $logger = LoggerFactory::createLogger($key);
                    $logger->send($model->message);
                } catch (\Exception $e) {
                    Yii::error($e->getMessage());
                }
            }
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $model->getErrors();
        }
    }

    // disabled csrf validation to be able to make requests via postman
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
}
