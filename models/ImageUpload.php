<?php

namespace app\models;

use Yii;

use yii\base\Model;

use yii\web\UploadedFile;

class ImageUpload extends Model
{
	public $image;

	public function rules()
	{
		return [
		   [['image'], 'required'],
		   [['image'], 'file', 'extensions' => 'jpg,png']
		];   
	}

	public function uploadFile(UploadedFile $file, $currentImage)
	{
		/*
           $this->image = $file;
           if( $this->validate() )
           {
	           if ( file_exists($this->getFolder() . $currentImage))
		       {
			       unlink($this->getFolder() . $currentImage);
		       }

		       $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
		       $file->saveAs($this->getFolder() . $filename);

		       return $filename;
           }
		*/
		$this->image = $file;

		if( $this->validate() )
		{
			$this->deleteCurrentImage($currentImage);

			return $this->saveImg();
		}
	}

	private function getFolder()
	{
		return Yii::getAlias('@web') . 'uploads/';
	}

	public function generateFilename()
	{
		return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
	}

	public function deleteCurrentImage($currentImage)
	{
		if ( $this->fileExists($currentImage))
		{
			unlink($this->getFolder() . $currentImage);
		}
	}

	public function fileExists($currentImage)
	{
		if( !empty($currentImage) && $currentImage != null )
		{
			return file_exists($this->getFolder() . $currentImage);
		}
	}

	public function saveImg()
	{
		$filename = $this->generateFilename();
		$this->image->saveAs($this->getFolder() . $filename);

		return $filename;
	}
}