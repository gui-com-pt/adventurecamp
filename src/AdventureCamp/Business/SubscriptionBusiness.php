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
        $to = 'acampamento.aventura.viseu@gmail.com';
        $body = '<p><b>Nome</b> ' . $model->getName() . '</p>' .
         '<p><b>Data de Nascimento</b> ' . $model->getBirthday()->format('y-m-d') . '</p>' .
         '<p><b>Email </b> ' . $model->getEmail() . '</p>' .
         '<p><b>BI ou Cartão de Cidadão</b> ' . $model->getBi() . '</p>' .
         '<p><b>Contacto</b> ' . $model->getContact() . '</p>' .
         '<p><b>Morada</b> ' . $model->getAddress() . '</p>' .
         '<p><b>Código Postal</b> ' . $model->getCep() . '</p>' .
         '<p><b>Observações</b> <br>' . $model->getObservations() . '</p>';

         $this->sendEmail($from, $to, $subject, $body);
            
            $subject = 'AA 2014 - Inscrição';
            $from = 'email@guilhermecardoso.pt';
            $to = $model->getEmail();
            $body = '<p>Obrigado por te inscreveres!</p>' .
                    '<p>Para concluires a tua inscrição podes confirmar o pagamento por transferência bancária com o NIB 0033 0000 4525 7811 0850 5.<br>' .
                    'Quando voltares à página do Facebook, no fundo do formulário vai a <i>Confirma a tua inscrição aqui</i> e faz a confirmação com os dados que constam no talão da transferência.<br>' .
                    'Caso tenhas dúvidas adicionais, não hesites em contactar-nos através do mail: acampamento.aventura.viseu@gmail.com</p>' .
                    '<p>Esperamos por ti<br>
                    A equipa do Acampamento Aventura';

        $this->sendEmail($from, $to, $subject, $body);
            
        return $result;
    }

    private function sendEmail($from, $to, $subject, $body) {
        $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom(array($from => $from))
                    ->setTo(array($to => $to))
                    ->setBody($body, 'text/html');

        $transport = \Swift_SmtpTransport::newInstance($this->config['smtp.hostname'], $this->config['smtp.port'], $this->config['smtp.security']);
        $transport->setUsername($this->config['smtp.username'])
                    ->setPassword($this->config['smtp.password']);
        $mailer = \Swift_Mailer::newInstance($transport);
        $mailer->send($message);  
    }

    public function reqConfirmation($tranNumb, $when, $ammount, $name, $obs) {
        $subject = 'Confirmação Pagamento';
        $body = '<p>Nova confirmação de pagamento na página do Facebook.</p>' .
                '<p><b>Nome</b> ' . $name . '</p>' .
                '<p><b>Nº Transacção </b>' . $tranNumb . '</p>' .
                '<p><b>Data</b> ' . $when . '</p>' .
                '<p><b>Ammount</b> ' . $ammount . '</p>' .
                '<p><b>Observations</b> ' . $obs . ' </p>';
        $this->sendEmail('email@guilhermecardoso.pt', 'acampamento.aventura.viseu@gmail.com', $subject, $body);

    }
    
    public function confirm(\MongoId $subscriptionId) {
        $this->subscriptionRepository->confirm($subscriptionId);
        $this->dm->flush();
    }
}
