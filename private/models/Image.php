<?php

class Image
{
    public function crop($srcImagePath, $destImagePath, $maxSize = 600)
    {
        if (file_exists($srcImagePath)) {

            $ext = strtolower(pathinfo($srcImagePath, PATHINFO_EXTENSION));
            if ($ext == 'png') {
                $srcImage = imagecreatefrompng($srcImagePath);
            } else if ($ext == 'jpeg' || $ext == 'jpg') {
                $srcImage = imagecreatefromjpeg($srcImagePath);
            } else if ($ext == 'gif') {
                $srcImage = imagecreatefromgif($srcImagePath);
            } else {
                $srcImage = imagecreatefromjpeg($srcImagePath);
            }

            if ($srcImage) {
                $width = imagesx($srcImage);
                $height = imagesy($srcImage);

                if ($width > $height) {
                    $extraSpace = $width - $height;
                    $srcX = $extraSpace / 2;
                    $srcY = 0;

                    $srcW = $height;
                    $srcH = $height;
                } else {
                    $extraSpace = $height - $width;
                    $srcY = $extraSpace / 2;
                    $srcX = 0;

                    $srcW = $width;
                    $srcH = $width;
                }

                $destImage = imagecreatetruecolor($maxSize, $maxSize);

                imagecopyresampled($destImage, $srcImage, 0, 0, $srcX, $srcY, $maxSize, $maxSize, $srcW, $srcH);
                if ($ext == 'png') {
                    imagepng($destImage, $destImagePath);
                } else
                if ($ext == 'jpeg' || $ext == 'jpg') {
                    imagejpeg($destImage, $destImagePath);
                } else
                if ($ext == 'gif') {
                    imagegif($destImage, $destImagePath);
                } else {
                    imagejpeg($destImage, $destImagePath);
                }
            }
        }
    }

    public function profileThumb($imagePath)
    {
        $cropSize = 600;
        $ext = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $thumbnail = str_replace('.' . $ext, '__thumb.' . $ext, $imagePath);

        if (!file_exists($thumbnail)) {
            $this->crop($imagePath, $thumbnail, $cropSize);
        } else {
            return $thumbnail;
        }
    }
}
