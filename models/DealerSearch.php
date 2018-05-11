<?php

namespace app\models;

use Yii;

class DealerSearch extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'view_dealers';
    }

    public function rules()
    {
        return [
            [['id','nombre', 'telefono', 'salario', 'pedidos', 'ganancias'], 'safe'],
            [['salario', 'pedidos', 'ganancias'], 'integer', 'message' => 'Solo se aceptan números'],
            [['telefono'], 'string', 'max' => 13, 'message' => 'No se deben superar los 10 caracteres'],
            [['nombre'], 'string', 'max' => 100, 'message' => 'No se deben superar los 60 caracteres'],
            [['nombre', 'telefono', 'salario'], 'required', 'message' => 'Este campo es requerido'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Folio',
            'telefono' => 'Teléfono',
            'nombre' => 'Nombre completo',
            'salario' => 'Salario',
            'pedidos' => 'Pedidos',
            'ganancias' => 'Ganancias',
        ];
    }
}