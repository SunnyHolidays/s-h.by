<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 13.08.13
 * Time: 14:23
 * To change this template use File | Settings | File Templates.
 */

class AttachmentsHelper
{

    private static $savePathAlias = 'webroot.uploads';

    protected static function getSavePath()
    {
        return Yii::getPathOfAlias(self::$savePathAlias) . DIRECTORY_SEPARATOR;
    }

    /**
     * @param $owner integer Model-owner primary key
     * @param $type string Name of model class
     * @param $fileInstance CUploadedFile[] uploaded file instance
     * @param bool $singleAttach is owner can has one attach or more
     * @return CUploadedFile
     */
    public static function saveAttachment($owner, $type, $fileInstance, $singleAttach = false)
    {
        $uniqueId = uniqid();
        $attach = new Attachments;
        if ($singleAttach) {
            $oldAttach = Attachments::model()->find('owner=:owner AND type=:type', array(':owner' => $owner, ':type'=>$type));
            if(!empty($oldAttach)){
                $attach = $oldAttach;
                self::deleteAttachment($attach->getAttribute('path'));
            }
        }
        $attach->attributes = array(
            'owner' => $owner,
            'type' => $type,
            'path' => self::transliterate(str_replace('.'.$fileInstance->extensionName,'_'.$uniqueId.'.'.$fileInstance->extensionName,$fileInstance->name))
        );
        if ($attach->save()) {
            $fileInstance->saveAs(self::getSavePath() . $attach->path);
        }
        return $fileInstance;
    }

    /**
     * @param $instance CUploadedFile[]
     * @param $owner
     * @param $type
     * @return array
     */
    public static function  saveAttachments($instance, $owner, $type)
    {
        $info = array();
        $uniqueId = uniqid();
        foreach($instance as $key=>$file){
            $attach = new Attachments;
            $attach->attributes = array(
                'owner' => $owner,
                'type' => $type,
                'path' => self::transliterate(str_replace('.'.$file->extensionName,'_'.$uniqueId.'.'.$file->extensionName,$file->name))
            );
            if($attach->save()){
                $file->saveAs(self::getSavePath() . $attach->path);
                $info[] = array(
                    'name' => $attach->path,
                    'size' => $file->size,
                    'type' => $file->getType(),
                    'url' => Yii::app()->createUrl('backend/attachments/download', array('id' => $attach->id)),
                    'deleteUrl' => Yii::app()->createUrl('backend/attachments/delete', array('id' => $attach->id)),
                    'deleteType' => 'post'
                );
                if(empty($owner)){
                    $ids = Yii::app()->session['attachments'];
                    $ids[] = $attach->id;
                    Yii::app()->session['attachments'] = $ids;
                }

            }
        }
        return array(
            'files' => $info
        );
    }

    public static function deleteAttachment($fileName)
    {
        $filePath=self::getSavePath().$fileName;
        if(@is_file($filePath))
            @unlink($filePath);
    }

    protected static function transliterate($str)
    {
        $alphabet = array(
            "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e",
            "ё" => "yo", "ж" => "j", "з" => "z", "и" => "i", "й" => "i", "к" => "k", "л" => "l", "м" => "m",
            "н" => "n", "о" => "o", "п" => "p", "р" => "r", "с" => "s", "т" => "t",
            "у" => "y", "ф" => "f", "х" => "h", "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "sh",
            "ы" => "i", "э" => "e", "ю" => "u", "я" => "ya",
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D", "Е" => "E", "Ё" => "Yo",
            "Ж" => "J", "З" => "Z", "И" => "I", "Й" => "I", "К" => "K", "Л" => "L", "М" => "M",
            "Н" => "N", "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T", "У" => "Y",
            "Ф" => "F", "Х" => "H", "Ц" => "C", "Ч" => "Ch", "Ш" => "Sh", "Щ" => "Sh",
            "Ы" => "I", "Э" => "E", "Ю" => "U", "Я" => "Ya",
            "ь" => "", "Ь" => "", "ъ" => "", "Ъ" => "", "—" => "-"
        );
        return strtr($str, $alphabet);
    }
}