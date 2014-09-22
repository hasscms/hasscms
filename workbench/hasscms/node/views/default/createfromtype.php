<?php
use yii\widgets\ListView;

echo ListView::widget([
    
    'dataProvider' => $dataProvider,
    
    'itemOptions' => [
        'class' => 'admin-list',
        'tag' => "ul"
    ],
    
    'itemView' => '_type_list_view',
    'layout'=>"{items}"
]
);
?>