<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 30.07.13
 * Time: 15:35
 * To change this template use File | Settings | File Templates.
 */

class AttachmentsBehavior extends CActiveRecordBehavior{

    /**
     * @var string
     */
    public $attributeName = 'newAttach';

    /**
     * @var string
     */
    public $relationName = 'attachments';

    /**
     * @var string
     */
    public $savePathAlias='webroot.uploads';

    /**
     * @var array
     */
    public $scenarios=array('insert','update');

    /**
     * @var string
     */
    public $fileTypes='txt,doc,docx,xls,xlsx,odt,pdf,jpg,jpeg,png';

    public $singleAttachment = false;
    /**
     * @return string
     */
    public function getSavePath(){
        return Yii::getPathOfAlias($this->savePathAlias).DIRECTORY_SEPARATOR;
    }

    /**
     * @param CComponent $owner
     */
    public function attach($owner){
        parent::attach($owner);
        if(in_array($owner->scenario,$this->scenarios)){
            $fileValidator=CValidator::createValidator('file',$owner,$this->attributeName,
                array('types'=>$this->fileTypes,'allowEmpty'=>true));
            $owner->validatorList->add($fileValidator);
        }
    }
    /**
     * @var $sender CActiveRecord
     * @param CModelEvent $event
     * @return bool|void
     */
    public function afterSave($event){
        $sender = $event->sender;
        $attribute = $this->attributeName;
        if(in_array($this->owner->scenario,$this->scenarios)){
            if($files=CUploadedFile::getInstances($this->owner,$this->attributeName)){
                foreach($files as $key=>$file){
                    AttachmentsHelper::saveAttachment($sender->getPrimaryKey(),get_class($sender),$file, $this->singleAttachment);
                }
            }elseif($file = CUploadedFile::getInstance($this->owner, $this->attributeName)){
                AttachmentsHelper::saveAttachment($sender->getPrimaryKey(),get_class($sender),$file,$this->singleAttachment);
            }
        }
        return true;
    }

    /**
     * @param CEvent $event
     */
    public function beforeDelete($event){
        foreach($this->owner->getRelated($this->relationName) as $key=>$value){
            /**
             * @var $value Attachments
             */
            if($value->delete()){
                AttachmentsHelper::deleteAttachment($value->path);
            }
        }
    }

    /**
     * @param $str
     * @return string
     */
    private function transliterate($str){
        $alphabet = array(
            "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e",
            "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i","й"=>"i","к"=>"k","л"=>"l", "м"=>"m",
            "н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
            "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch", "ш"=>"sh","щ"=>"sh",
            "ы"=>"i","э"=>"e","ю"=>"u","я"=>"ya",
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D","Е"=>"E", "Ё"=>"Yo",
            "Ж"=>"J","З"=>"Z","И"=>"I","Й"=>"I","К"=>"K", "Л"=>"L","М"=>"M",
            "Н"=>"N","О"=>"O","П"=>"P", "Р"=>"R","С"=>"S","Т"=>"T","У"=>"Y",
            "Ф"=>"F", "Х"=>"H","Ц"=>"C","Ч"=>"Ch","Ш"=>"Sh","Щ"=>"Sh",
            "Ы"=>"I","Э"=>"E","Ю"=>"U","Я"=>"Ya",
            "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"","—"=>"-"
        );
        return strtr($str, $alphabet);
    }

}