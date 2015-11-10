<?php
/**
 * Created by JetBrains PhpStorm.
 * Date: 19.03.13
 * Time: 7:31
 */
/**
 * @property MailTemplates $template
 */

class Mailer
{
    private $tbs;
    private $template;
    private $type = 'html';

    public function __construct($alias, $model=null, $type = null)
    {
        include_once('includes/tbs_class.php');
        $type == 'text' ? $this->type = 'text' : null;
        $this->tbs = new clsTinyButStrong;
        $this->template = MailTemplates::model()->findByAttributes(array('alias' => $alias));
        $this->type == 'html' ? $this->tbs->Source = $this->template->body : $this->tbs->Source = $this->template->body_text;
        $this->tbs->SetOption('noerr',true);
        $this->setTags($model);
        $this->tbs->MergeBlock('data',$this->tbs->VarRef['data']);
        $this->tbs->Show(TBS_NOTHING);
    }

    /**
     * @var CActiveRecord $model
     */
    private function setTags($model)
    {

        foreach ($this->template->attributeNames() as $attribute) {
            $this->tbs->VarRef[$attribute] = $this->template->$attribute;
        }
        if($model){
            if (!is_array($model)) {
                foreach ($model->attributeNames() as $attribute) {
                    $this->tbs->VarRef[$attribute] = $model->$attribute;
                }
            } else {
                $iterator=0;
                foreach ($model as $submodel) {
                    /**
                     * @var CActiveRecord $submodel
                     */
                    foreach ($submodel->attributeNames() as $attribute) {
                        $this->tbs->VarRef['data'][$iterator][$attribute] = $submodel->$attribute;

                    }
                    $iterator++;
                }
            }
        }


    }

    public function sendMail(array $emails)
    {
        $mail = new YiiMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->From = $this->template->email;
        $mail->FromName = $this->template->from;
        $mail->Subject = $this->template->subject;
        $mail->Body = $this->tbs->Source;
        foreach($emails as $email){
            $mail->AddAddress($email);
        }

         if ($mail->Send()) {
            $mail->ClearAddresses();
          }
    }

}
