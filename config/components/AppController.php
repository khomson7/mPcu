<?php

namespace app\config\components;

class AppController extends \yii\web\Controller {

    public function init() {
        parent::init();
    }

    protected function overclock($memory = '2048M') {

        set_time_limit(0);
        ini_set('memory_limit', $memory);
    }

    protected function exec_sql($sql) {
        $affect_row = \Yii::$app->db->createCommand($sql)->execute();
        return $affect_row;
    }

    protected function SaveLogs(/* $action, */ $detail = null) {

        if (@\Yii::$app->user->identity->id)
            $uid = \Yii::$app->user->identity->id;
        $log = new Reportlog();
        $log->user_id = $uid;
        $log->remark = $detail;
        //  $log->actions = $action;
        $log->datetime = date('Y-m-d H:i:s');
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();
    }
    
    
      protected function SaveCountdatapcu($detail = null) {

        
        $log = new \app\modules\pcu\models\CountDataPcu();   
        $log->datetime = date('Y-m-d H:i:s');
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();
    }

}
