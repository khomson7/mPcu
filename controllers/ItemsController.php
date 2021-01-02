<?php

namespace app\controllers;

use app\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class ItemsController extends Controller
{
  
    public function actionIndex2()
    {
        $query = Item::find();

        foreach (['itemVote', 'itemFavorite'] as $entity) {
            $query->withVoteAggregate($entity); // include votes and favorites
            $query->withUserVote($entity); // include user vote status
        }

        /**
         * After attaching behaviors, you'll get access to new attributes - positive, negative and rating
         * So, if you have 'itemVote' entity, you should use 'itemVotePositive', 'itemVoteNegative' and
         * 'itemVoteRating' attributes.
         *
         * For example:
         */
        $query->orderBy('itemVoteRating desc');
        // or
        $query->orderBy('itemFavoritePositive desc');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
 
    public function actionIndex()
    {
        return $this->render('index');
    }
}