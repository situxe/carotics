<?php
return array (
  'states' => 
  array (
    'new' => 
    array (
      'name' => 'Новый',
      'options' => 
      array (
        'icon' => 'icon16 ss new',
        'style' => 
        array (
          'color' => '#009900',
          'font-weight' => 'bold',
        ),
      ),
      'available_actions' => 
      array (
        0 => 'process',
        1 => 'pay',
        2 => 'ship',
        3 => 'complete',
        4 => 'comment',
        5 => 'edit',
        6 => 'message',
        7 => 'delete',
      ),
      'classname' => 'shopWorkflowState',
    ),
    'processing' => 
    array (
      'name' => 'Подтвержден',
      'options' => 
      array (
        'icon' => 'icon16 ss confirmed',
        'style' => 
        array (
          'color' => '#008800',
          'font-style' => 'italic',
        ),
      ),
      'available_actions' => 
      array (
        0 => 'pay',
        1 => 'ship',
        2 => 'complete',
        3 => 'comment',
        4 => 'edit',
        5 => 'message',
        6 => 'delete',
      ),
      'classname' => 'shopWorkflowState',
    ),
    'paid' => 
    array (
      'name' => 'Оплачен',
      'options' => 
      array (
        'icon' => 'icon16 ss flag-yellow',
        'style' => 
        array (
          'color' => '#FF9900',
          'font-weight' => 'bold',
          'font-style' => 'italic',
        ),
      ),
      'available_actions' => 
      array (
        0 => 'ship',
        1 => 'complete',
        2 => 'refund',
        3 => 'comment',
        4 => 'message',
      ),
      'classname' => 'shopWorkflowState',
    ),
    'shipped' => 
    array (
      'name' => 'Отправлен',
      'options' => 
      array (
        'icon' => 'icon16 ss sent',
        'style' => 
        array (
          'color' => '#0000FF',
          'font-style' => 'italic',
        ),
      ),
      'available_actions' => 
      array (
        0 => 'complete',
        1 => 'comment',
        2 => 'delete',
        3 => 'message',
      ),
      'classname' => 'shopWorkflowState',
    ),
    'completed' => 
    array (
      'name' => 'Выполнен',
      'options' => 
      array (
        'icon' => 'icon16 ss completed',
        'style' => 
        array (
          'color' => '#E68B2C',
        ),
      ),
      'available_actions' => 
      array (
        0 => 'comment',
        1 => 'refund',
        2 => 'message',
      ),
      'classname' => 'shopWorkflowState',
    ),
    'refunded' => 
    array (
      'name' => 'Возврат',
      'options' => 
      array (
        'icon' => 'icon16 ss refunded',
        'style' => 
        array (
          'color' => '#cc0000',
        ),
      ),
      'available_actions' => 
      array (
        0 => 'message',
      ),
      'classname' => 'shopWorkflowState',
    ),
    'deleted' => 
    array (
      'name' => 'Удален',
      'options' => 
      array (
        'icon' => 'icon16 ss trash',
        'style' => 
        array (
          'color' => '#800000',
        ),
      ),
      'available_actions' => 
      array (
        0 => 'restore',
        1 => 'message',
      ),
      'classname' => 'shopWorkflowState',
    ),
  ),
  'actions' => 
  array (
    'create' => 
    array (
      'classname' => 'shopWorkflowCreateAction',
      'internal' => true,
      'name' => 'Создать',
      'options' => 
      array (
        'log_record' => 'Заказ оформлен',
      ),
      'state' => 'new',
    ),
    'process' => 
    array (
      'classname' => 'shopWorkflowProcessAction',
      'name' => 'В обработку',
      'options' => 
      array (
        'log_record' => 'Заказ подтвержден и принят в обработку',
        'button_class' => 'green',
      ),
      'state' => 'processing',
    ),
    'pay' => 
    array (
      'classname' => 'shopWorkflowPayAction',
      'name' => 'Оплачен',
      'options' => 
      array (
        'log_record' => 'Заказ оплачен',
        'button_class' => 'yellow',
      ),
      'state' => 'paid',
    ),
    'ship' => 
    array (
      'classname' => 'shopWorkflowShipAction',
      'name' => 'Отправлен',
      'options' => 
      array (
        'log_record' => 'Заказ отправлен',
        'button_class' => 'blue',
      ),
      'state' => 'shipped',
    ),
    'refund' => 
    array (
      'classname' => 'shopWorkflowRefundAction',
      'name' => 'Возврат',
      'options' => 
      array (
        'log_record' => 'Возврат',
        'button_class' => 'red',
      ),
      'state' => 'refunded',
    ),
    'edit' => 
    array (
      'classname' => 'shopWorkflowEditAction',
      'name' => 'Редактировать заказ',
      'options' => 
      array (
        'position' => 'top',
        'icon' => 'edit',
        'log_record' => 'Заказ отредактирован',
      ),
    ),
    'delete' => 
    array (
      'classname' => 'shopWorkflowDeleteAction',
      'name' => 'Удалить',
      'options' => 
      array (
        'log_record' => 'Заказ удален',
      ),
      'state' => 'deleted',
    ),
    'restore' => 
    array (
      'classname' => 'shopWorkflowRestoreAction',
      'name' => 'Восстановить',
      'options' => 
      array (
        'icon' => 'restore',
        'log_record' => 'Заказ восстановлен',
        'button_class' => 'green',
      ),
    ),
    'complete' => 
    array (
      'classname' => 'shopWorkflowCompleteAction',
      'name' => 'Выполнен',
      'options' => 
      array (
        'log_record' => 'Заказ выполнен',
        'button_class' => 'purple',
      ),
      'state' => 'completed',
    ),
    'message' => 
    array (
      'classname' => 'shopWorkflowMessageAction',
      'name' => 'Написать клиенту',
      'options' => 
      array (
        'position' => 'top',
        'icon' => 'email',
        'log_record' => 'Сообщение отправлено',
      ),
    ),
    'comment' => 
    array (
      'classname' => 'shopWorkflowCommentAction',
      'name' => 'Добавить комментарий',
      'options' => 
      array (
        'position' => 'bottom',
        'icon' => 'add',
        'button_class' => 'inline-link',
        'log_record' => 'Добавлен комментарий к заказу',
      ),
    ),
    'callback' => 
    array (
      'classname' => 'shopWorkflowCallbackAction',
      'internal' => true,
      'name' => 'Ответ платежной системы (callback)',
      'options' => 
      array (
        'log_record' => 'Ответ платежной системы (callback)',
      ),
    ),
    'settle' => 
    array (
      'classname' => 'shopWorkflowSettleAction',
      'internal' => true,
      'name' => 'Объединить',
      'options' => 
      array (
        'head' => true,
        'log_record' => 'Заказ был объединен с другим',
      ),
    ),
  ),
);
