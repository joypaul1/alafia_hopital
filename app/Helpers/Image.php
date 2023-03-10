<?php

namespace App\Helpers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Image as InImage;

class Image
{
    private $file = null;
	private $fileBase64 = null;
	private $dirName = null;
	private $fileName = null;
	private $diskName = null;
	private $previousPath = null;
	private $width = null;
	private $height = null;
	private $keepAspectRatio = false;
	private $skipYear = false;
	private $skipMonth = false;
	private $skipDay = false;
	private $callback = null;


    public function file($file)
	{
		$this->file = $file??null;

		return $this;
	}

    /**
	 * Default is diskName disk. Publish config file to change default disk.
	 * @param string $diskName
	 */

    public function dirName($dirName)
	{
		$this->dirName = $dirName;

		return $this;
	}

    /**
	 * Null value is acceptable.
	 *
	 * @param integer $width
	 * @param integer $height

	 */
	public function resizeImage($width, $height)
	{
		$this->width = $width;
		$this->height = $height;
		return $this;
	}


    public function deleteIfExists($previousPath)
	{
		if ($previousPath) {
			$this->previousPath = $previousPath;

			// deleted previousPath image
			if ($this->previousPath && File::exists(($this->previousPath))) {
				File::delete($this->previousPath);
			}
		}
		return $this;
	}

    public function skipYear()
	{
		$this->skipYear = true;
		return $this;
	}

    public function skipMonth()
	{
		$this->skipMonth = true;
		return $this;
	}

    public function skipDay()
	{
		$this->skipDay = true;
		return $this;
	}

    public  function makeDir( $path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        return $path;
    }

    private function getUploadDir()
	{
		$uploadDir = 'uploads'. '/' . $this->dirName . '/';

		if (!$this->skipYear) {
			$uploadDir .= '/' . date('Y') . '/';
		}
		if (!$this->skipMonth) {
			$uploadDir .= '/' . date('m') . '/';
		}
		if (!$this->skipDay) {
			$uploadDir .= '/' . date('d') ;
		}
		$uploadDir =  preg_replace('!//+!', '/', $uploadDir);
        return  $this->makeDir($uploadDir);

	}


    public function save()
    {
		if($this->file){
			$input['file']      = time().rand(10,100).'.'.$this->file->getClientOriginalExtension(); // file name a& extension
			// $destinationPath    = public_path($this->getUploadDir());
			$destinationPath    = ($this->getUploadDir());  //uploaded  directory
			$input['fileName']  = $destinationPath.'/'.$input['file'] ; // full image name with directory
			// $imgFile            = InImage::make($this->file->getRealPath());  //make image for store
			// $imgFile            = InImage::make(realpath($this->file));  //make image for store

			// resize image
			if($this->width && $this->height){

                InImage::make($this->file->getRealPath())->resize($this->width, $this->height,
                    function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                ->resizeCanvas($this->width, $this->height)
                ->save($input['fileName']);
			}else{
				InImage::make($this->file->getRealPath())->save($input['fileName']);
			}

		   return  $input['fileName'];
		}


    }
}
