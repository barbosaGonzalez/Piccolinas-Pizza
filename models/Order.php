<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class Order extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'order';
    }

    public function rules()
    {
        return [
            [['wait', 'done', 'time','time_arrive', 'time_leave', 'repartidor_id', 'repartidor_name','cheese_border', 'date', 'only_date', 'ingredients', 'change', 'status', 'size', 'description', 'soda_type', 'soda_size'], 'safe'],
            [['subtotal', 'count', 'total', 'delivery', 'money', 'quantity', 'soda_quantity'], 'integer', 'message' => 'Solo se aceptan números'],
            [['change'], 'integer', 'message' => 'Debes de indicar un pago mayor al total'],
            [['phone'], 'string', 'max' => 13, 'message' => 'No se deben superar los 10 caracteres'],
            [['address', 'neighborhood', 'status'], 'string', 'max' => 60, 'message' => 'No se deben superar los 60 caracteres'],
            [['description', 'ingredients', 'note'], 'string', 'max' => 255, 'message' => 'No se deben superar los 255 caracteres'],
            [['ingredients', 'total', 'size', 'subtotal', 'money'], 'required', 'message' => 'Este campo es requerido'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Folio',
            'count' => 'Folio',
            'phone' => 'Teléfono',
            'wait' => 'Tiempo de Espera',
            'time' => 'Hora de pedido',
            'date' => 'Fecha',
            'address' => 'Dirección',
            'neighborhood' => 'Colonia',
            'cheese_border' => 'Orilla',
            'ingredients' => 'Ingredientes',
            'description' => 'Descripción',
            'soda_size' => 'Tamaño de refresco',
            'soda_type' =>  'Tipo de refresco',
            'soda_quantity' => 'Número de refrescos',
            'subtotal' => 'Costo',
            'delivery' => 'Costo del Envio',
            'money' => 'Paga con',
            'change' => 'Cambio',
            'quantity' => 'Cantidad',
            'note' => 'Hora de pedido',
            'status' => 'Status',
            'total' => 'Total',
            'size' => 'Tamaño',
            'only_date' => 'Fecha',
            'done' => 'Pedido realizado',
        ];
    }
}