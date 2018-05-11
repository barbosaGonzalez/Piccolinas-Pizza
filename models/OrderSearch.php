<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;
use yii\db\Expression;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'count', 'subtotal', 'delivery', 'money', 'change', 'quantity'], 'integer'],
            [['cheese_border', 'size', 'phone', 'wait', 'date', 'only_date', 'address', 'neighborhood', 'ingredients', 'description', 'note', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $type_search)
    {
      $expression = new Expression('NOW()');
      $now = (new \yii\db\Query)->select($expression)->scalar();
      $now = substr($now, 0, 10);

      if($type_search == 0){
        $query = Order::find();
      }
      
      if($type_search == 1){
        $query = Order::find()->andFilterWhere(['like', 'date', $now])->andFilterWhere(['=', 'done', 0]);;
      }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
             'defaultOrder' => [
                 'size' => SORT_ASC,
             ]
          ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'wait' => $this->wait,
            'time' => $this->time,
            'date' => $this->date,
            // 'only_date' => $this->only_date,
            'cheese_border' => $this->cheese_border,
            'subtotal' => $this->subtotal,
            'delivery' => $this->delivery,
            'money' => $this->money,
            'change' => $this->change,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'count' => $this->count,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'neighborhood', $this->neighborhood])
            ->andFilterWhere(['like', 'ingredients', $this->ingredients])
            ->andFilterWhere(['like', 'note', $this->note]);

            if(isset ($this->only_date)&&$this->only_date!=''){
              $date_explode=explode(" - ",$this->only_date);
              $date1=trim($date_explode[0]);
              $date2=trim($date_explode[1]);
              $query->andFilterWhere(['between','only_date',$date1,$date2]);
            }


        return $dataProvider;
    }
}