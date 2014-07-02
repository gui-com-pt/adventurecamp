<?php
namespace AdventureCamp\Business;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubscriptionBusiness
 *
 * @author gui
 */
class SubscriptionBusiness {
    
    /** * @var \AdventureCamp\Data\SubscriptionRepository */
    protected $subscriptionRepository;
    /** * @var \Doctrine\ODM\MongoDB\DocumentMannager $dm */
    protected $dm;

    protected $config;
    
    public function __construct(\Pimple $ioc) {
        $this->subscriptionRepository = new \AdventureCamp\Data\SubscriptionRepository($ioc);
        $this->dm = $ioc['dm'];
        $this->config = $ioc['config'];
    }
    
    /**
     * 
     * @param \MongoId $id
     * @return \AdventureCamp\Domain\Subscription
     */
    public function get(\MongoId $id) {
        $result = $this->subscriptionRepository->get($id);
        return $result;
    }
    
    /**
     * 
     * @param \AdventureCamp\ServiceModel\FindSubscriptionModel $model
     * @return \AdventureCamp\Domain\SubscriptionInfo
     */
    public function find(\AdventureCamp\ServiceModel\FindSubscriptionModel $model){
        $results = $this->subscriptionRepository->find($model);
        return $results;
    }
    
    /**
     * 
     * @param \AdventureCamp\ServiceModel\CreateSubscriptionModel $model
     * @return \AdventureCamp\Domain\Subscription
     */
    public function create(\MongoId $userId, \AdventureCamp\ServiceModel\CreateSubscriptionModel $model) {
        $result = $this->subscriptionRepository->create($userId, $model);
        $this->dm->flush();

        $subject = 'AA 2014 - Inscrição';
        $from = $model->getEmail();
        $to = 'email@guilhermecardoso.pt';
        $body = '<p><b>Nome</b> ' . $model->getName() . '</p>' .
         '<p><b>Data de Nascimento</b> ' . $model->getBirthday()->format('y-m-d') . '</p>' .
         '<p><b>BI ou Cartão de Cidadão</b> ' . $model->getBi() . '</p>' .
         '<p><b>Contacto</b> ' . $model->getContact() . '</p>' .
         '<p><b>Morada</b> ' . $model->getAddress() . '</p>' .
         '<p><b>Código Postal</b> ' . $model->getCep() . '</p>' .
         '<p><b>Observações</b> <br>' . $model->getObservations() . '</p>';

      $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom(array($from => $from))
                    ->setTo(array($to => $to))
                    ->setBody($body, 'text/html');

            $transport = \Swift_SmtpTransport::newInstance($this->config['smtp.hostname'], $this->config['smtp.port'], $this->config['smtp.security']);
            if (!is_null($this->config['smtp.username']) && !is_null($this->config['smtp.password'])) {
                $transport->setUsername($this->ioc['config']['smtp.username'])
                        ->setPassword($this->config['smtp.password']);
            }
            $mailer = \Swift_Mailer::newInstance($transport);

            //$mailer->send($message);
        return $result;
    }
    
    public function confirm(\MongoId $subscriptionId) {
        $this->subscriptionRepository->confirm($subscriptionId);
        $this->dm->flush();
    }
}
