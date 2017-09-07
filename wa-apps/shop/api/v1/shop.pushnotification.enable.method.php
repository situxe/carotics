<?php
class shopPushnotificationEnableMethod extends waAPIMethod
{
    protected $method = 'POST';

    public function execute()
    {
        $client_id = waRequest::post('client_id', '', 'string');
        if (!strlen($client_id)) {
            throw new waAPIException('invalid_param', 'invalid client_id', 400);
        }
        $shop_url = waRequest::post('shop_url', wa()->getRootUrl(true), 'string');

        $push_client_model = new shopPushClientModel();

        $force = waRequest::post('force', null, 'int');
        if (!$force && $force !== null) {
            $row = $push_client_model->getById($client_id);
            if ($row && $row['shop_url'] != $shop_url) {
                throw new waAPIException('already_subscribed', 'client_id subscribed via different URL', 412, array(
                    'shop_url' => $row['shop_url'],
                ));
            }
        }

        $push_client_model->insert(array(
            'contact_id' => wa()->getUser()->getId(),
            'client_id' => $client_id,
            'shop_url' => $shop_url,
        ), 1);
        $this->response = 'ok';
    }
}